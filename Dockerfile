FROM nginx:1.18-alpine

LABEL maintainer "Felipe Reis - https://github.com/devfelipereis"

ARG UID=1000
ARG GID=1000
ARG SSH_PASSWORD=123456

ENV NOTVISIBLE "in users profile"

# Define o usuário da aplicação
ARG CONTAINER_USER=nginx
ENV CONTAINER_USER ${CONTAINER_USER}

# Define o environment da aplicação: default `Production` para manter sempre o mais restrito
ARG ENVIRONMENT=Development
ENV ENVIRONMENT ${ENVIRONMENT}

ADD https://packages.whatwedo.ch/php-alpine.rsa.pub /etc/apk/keys/php-alpine.rsa.pub
RUN echo "@php https://packages.whatwedo.ch/php-alpine/v3.11/php-7.4" >> /etc/apk/repositories
RUN apk add --no-cache --update \
    ca-certificates openssl openssh \
    php@php \
    php-common@php \
    php-ctype@php \
    php-curl@php \
    php-fpm@php \
    php-gd@php \
    php-intl@php \
    php-json@php \
    php-mbstring@php \
    php-openssl@php \
    php-pdo@php \
    php-pdo_mysql@php \
    php-mysqlnd@php \
    php-xml@php \
    php-zip@php \
    php-redis@php \
    php-memcached@php \
    php-phar@php \
    php-pcntl@php \
    php-dom@php \
    php-posix@php \
    php-iconv@php \
    php-xmlreader@php \
    php-zlib@php \
    php-exif@php \
    bash git grep dcron tzdata su-exec shadow \
    supervisor  \
    mysql-client && \
    sed -ie 's/#Port 22/Port 22/g' /etc/ssh/sshd_config && \
    sed -i s/#PermitRootLogin.*/PermitRootLogin\ yes/ /etc/ssh/sshd_config && \
    echo "root:${SSH_PASSWORD}" | chpasswd && \
    /usr/bin/ssh-keygen -A && \
    ssh-keygen -t rsa -b 4096 -f  /etc/ssh/ssh_host_key && \
    echo "export VISIBLE=now" >> /etc/profile

# Somente na imagem de dev/testing, pros testes unitários
RUN apk add --no-cache --update mysql-client

# Sync user and group with the host
RUN usermod -u ${UID} nginx && groupmod -g ${GID} nginx

########################################################################################################################
#####                                         INSTALL NEW RELIC PHP AGENT                                          #####
########################################################################################################################
ARG NEW_RELIC_AGENT_VERSION=9.17.1.301
ARG NEW_RELIC_APPNAME=LOCAL-SPOTEN-${ENVIRONMENT}-KUBERNETES
ARG NEW_RELIC_DAEMON_ADDRESS
ARG NEW_RELIC_LICENSE_KEY



RUN curl -L https://download.newrelic.com/php_agent/archive/${NEW_RELIC_AGENT_VERSION}/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux-musl.tar.gz | tar -C /tmp -zx \
    && export NR_INSTALL_USE_CP_NOT_LN=1 \
    && export NR_INSTALL_SILENT=1 \
    && export MODULEDIR=/usr/lib/php7/modules \
    && export PHP_INI_SCAN_DIR=/etc/php7/conf.d \
    && mkdir -p /var/log/newrelic \
    && /tmp/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux-musl/newrelic-install install \
    && /tmp/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux-musl/newrelic-install install_daemon \
    && mkdir -p /etc/php7/conf.d && cp /tmp/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux-musl/scripts/newrelic.ini.template /etc/php7/conf.d/newrelic.ini \
    && cp /tmp/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux-musl/agent/x64/newrelic-20190902.so /usr/lib/php7/modules/newrelic.so \
    && rm -rf /tmp/newrelic-php5-* /tmp/nrinstall*

RUN sed -i -e "s/REPLACE_WITH_REAL_KEY/${NEW_RELIC_LICENSE_KEY}/" \
    -e "s/newrelic.appname[[:space:]]=[[:space:]].*/newrelic.appname=\"${NEW_RELIC_APPNAME}\"/" \
    -e 's/;newrelic.daemon.app_connect_timeout =.*/newrelic.daemon.app_connect_timeout=15s/' \
    -e 's/;newrelic.daemon.start_timeout =.*/newrelic.daemon.start_timeout=5s/' \
    $(php7 -r "echo(PHP_CONFIG_FILE_SCAN_DIR);")/newrelic.ini

RUN chown -R ${CONTAINER_USER}:${CONTAINER_USER} /var/log/newrelic && \
    chown -R ${CONTAINER_USER}:${CONTAINER_USER} /etc/php7/conf.d/newrelic.ini

## Download and install NewRelic PHP extension.
#RUN curl -L "https://download.newrelic.com/php_agent/archive/${NEW_RELIC_AGENT_VERSION}/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux-musl.tar.gz" | tar -C /tmp -zx \
# && export NR_INSTALL_USE_CP_NOT_LN=1 \
# && export NR_INSTALL_SILENT=1 \
# && sudo /tmp/newrelic-php5-*/newrelic-install install \
# && rm -rf /tmp/newrelic-php5-* /tmp/nrinstall*
#
#
#curl -L "https://download.newrelic.com/php_agent/archive/9.17.1.301/newrelic-php5-9.17.1.301-linux-musl.tar.gz" | tar -C /tmp -zx \
# && export NR_INSTALL_USE_CP_NOT_LN=1 \
# && export NR_INSTALL_SILENT=1 \
# && /tmp/newrelic-php5-*/newrelic-install install
#RUN sed -i \
#  -e "s/REPLACE_WITH_REAL_KEY/${NEW_RELIC_LICENSE_KEY}/" \
#  -e "s/newrelic.appname = \"PHP Application\"/newrelic.appname = \"${NEW_RELIC_APPNAME}\"/" \
#  -e "s^;newrelic.daemon.address = \"/tmp/.newrelic.sock\"^newrelic.daemon.address=${NEW_RELIC_DAEMON_ADDRESS}^" \
# /etc/php7/conf.d/newrelic.ini

########################################################################################################################
#####                                                                                                              #####
########################################################################################################################

# Configure time
RUN echo "America/Cuiaba" > /etc/timezone && \
    cp /usr/share/zoneinfo/America/Cuiaba /etc/localtime && \
    apk del --no-cache tzdata && \
    rm -rf /var/cache/apk/* && \
    rm -rf /tmp/*

# CRON SETUP
COPY docker/cron/crontab /var/spool/cron/crontabs/root
RUN chmod -R 0644 /var/spool/cron/crontabs

RUN mkdir -p /var/www/html && \
    mkdir -p /var/cache/nginx && \
    mkdir -p /var/lib/nginx && \
    mkdir -p /etc/nginx/ssl && \
    chown -R nginx:nginx /var/cache/nginx /var/lib/nginx && \
    chmod -R g+rw /var/cache/nginx /var/lib/nginx /etc/php7/php-fpm.d && \
    ln -s /usr/bin/php7 /usr/bin/php
    # openssl dhparam -out /etc/nginx/ssl/dhparam.pem 2048

# COPY _SSL/dev.crt /etc/nginx/ssl/dev.crt
# COPY _SSL/dev.key /etc/nginx/ssl/dev.key
COPY docker/conf/php-fpm-pool.conf /etc/php7/php-fpm.d/www.conf
COPY docker/conf/supervisord.conf /etc/supervisor/supervisord.conf
COPY docker/conf/nginx.conf /etc/nginx/nginx.conf
COPY docker/conf/nginx-site.conf /etc/nginx/conf.d/default.conf
# COPY docker/conf/php.ini /etc/php7/conf.d/50-settings.ini
COPY docker/entrypoint.sh /sbin/entrypoint.sh

WORKDIR /var/www/html/

COPY --chown=nginx:nginx ./ .

COPY --from=composer:1.10.9 /usr/bin/composer /usr/bin/composer

VOLUME /var/www/html/storage

EXPOSE 8000 443 22

RUN chmod 0700 /sbin/entrypoint.sh

ENTRYPOINT ["/sbin/entrypoint.sh"]

CMD ["true"]
