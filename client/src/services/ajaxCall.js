import Cookies from "js-cookie";
import axios from "axios";
import NProgress from "nprogress/nprogress.js";
import 'nprogress/nprogress.css';
import router from "@/router";

export default {
      // eslint-disable-next-line no-unused-vars
      async callApi(route = '/', payload = null, withAuthorizationToken = false, method = 'POST', contentType = 'application/json', access = 'application/json'){
            return this.call(process.env.VUE_APP_URL_API + route, payload, withAuthorizationToken, method, contentType, access);
      },

      // eslint-disable-next-line no-unused-vars
      async call(apiUrl, payload = null, withAuthorizationToken = false, method = 'POST', contentType = 'application/json', access = 'application/json'){
            const instance = axios.create();

            // Adiciona um interceptador na requisição
            instance.interceptors.request.use(function (config) {
                  // Faz alguma coisa antes da requisição ser enviada
                  NProgress.start()
                  return config
            }, function (error) {
                  // Faz alguma coisa com o erro da requisição
                  NProgress.done()
                  return Promise.reject(error);
            });

            // Adiciona um interceptador na resposta
            instance.interceptors.response.use(function (response) {
                  // Qualquer código de status que dentro do limite de 2xx faz com que está função seja acionada
                  // Faz alguma coisa com os dados de resposta
                  NProgress.done()
                  return response
            }, function (error) {
                  // Qualquer código de status que não esteja no limite do código 2xx faz com que está função seja acionada
                  // Faz alguma coisa com o erro da resposta
                  NProgress.done()
                  return Promise.reject(error);
            });

            const cookieName = Cookies.get(process.env.VUE_APP_COOKIE_NAME);

            return instance({
                  method: method,
                  url: apiUrl,
                  headers: {
                        'Content-Type': contentType,
                        'Access': access,
                        'Authorization' : (withAuthorizationToken ? `Bearer ${cookieName}` : '')
                  },
                  data: payload !== null ? JSON.stringify(payload) : null,
            }).catch(error => {
                  if(error.response.status === 401)
                        router.push('login')
                  else
                        throw error;
            });
      }
}
