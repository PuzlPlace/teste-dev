<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */
    
    'accepted'             => 'O campo <b>:attribute</b> deve ser aceito.',
    'active_url'           => 'O campo <b>:attribute</b> deve conter uma URL válida.',
    'after'                => 'O campo <b>:attribute</b> deve conter uma data posterior a :date.',
    'after_or_equal'       => 'O campo <b>:attribute</b> deve conter uma data superior ou igual a :date.',
    'alpha'                => 'O campo <b>:attribute</b> deve conter apenas letras.',
    'alpha_dash'           => 'O campo <b>:attribute</b> deve conter apenas letras, números e traços.',
    'alpha_num'            => 'O campo <b>:attribute</b> deve conter apenas letras e números .',
    'array'                => 'O campo <b>:attribute</b> deve conter um array.',
    'before'               => 'O campo <b>:attribute</b> deve conter uma data anterior a :date.',
    'before_or_equal'      => 'O campo <b>:attribute</b> deve conter uma data inferior ou igual a :date.',
    'between'              => [
        'numeric' => 'O campo <b>:attribute</b> deve conter um número entre :min e :max.',
        'file'    => 'O campo <b>:attribute</b> deve conter um arquivo de :min a :max kilobytes.',
        'string'  => 'O campo <b>:attribute</b> deve conter entre :min a :max caracteres.',
        'array'   => 'O campo <b>:attribute</b> deve conter de :min a :max itens.',
    ],
    'boolean'              => 'O campo <b>:attribute</b> deve conter o valor verdadeiro ou falso.',
    'confirmed'            => 'A confirmação para o campo <b>:attribute</b> não coincide.',
    'date'                 => 'O campo <b>:attribute</b> não contém uma data válida.',
    'date_format'          => 'A data informada para o campo <b>:attribute</b> não respeita o formato :format.',
    'different'            => 'Os campos <b>:attribute</b> e :other devem conter valores diferentes.',
    'digits'               => 'O campo <b>:attribute</b> deve conter :digits dígitos.',
    'digits_between'       => 'O campo <b>:attribute</b> deve conter entre :min a :max dígitos.',
    'dimensions'           => 'O valor informado para o campo <b>:attribute</b> não é uma dimensão de imagem válida.',
    'distinct'             => 'O campo <b>:attribute</b> contém um valor duplicado.',
    'email'                => 'O campo <b>:attribute</b> não contém um endereço de e-mail válido.',
    'exists'               => 'O valor selecionado para o campo <b>:attribute</b> não foi encontrado.',
    'file'                 => 'O campo <b>:attribute</b> deve conter um arquivo.',
    'filled'               => 'O campo <b>:attribute</b> é obrigatório.',
    'image'                => 'O campo <b>:attribute</b> deve conter uma imagem.',
    'in'                   => 'O campo <b>:attribute</b> não contém um valor válido.',
    'in_array'             => 'O campo <b>:attribute</b> não existe em :other.',
    'integer'              => 'O campo <b>:attribute</b> deve conter um número inteiro.',
    'ip'                   => 'O campo <b>:attribute</b> deve conter um IP válido.',
    'ipv4'                 => 'O campo <b>:attribute</b> deve conter um IPv4 válido.',
    'ipv6'                 => 'O campo <b>:attribute</b> deve conter um IPv6 válido.',
    'json'                 => 'O campo <b>:attribute</b> deve conter uma string JSON válida.',
    'max'                  => [
        'numeric' => 'O campo <b>:attribute</b> não pode conter um valor superior a :max.',
        'file'    => 'O campo <b>:attribute</b> não pode conter um arquivo com mais de :max kilobytes.',
        'string'  => 'O campo <b>:attribute</b> não pode conter mais de :max caracteres.',
        'array'   => 'O campo <b>:attribute</b> deve conter no máximo :max itens.',
    ],
    'mimes'                => 'O campo <b>:attribute</b> deve conter um arquivo do tipo: :values.',
    'mimetypes'            => 'O campo <b>:attribute</b> deve conter um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O campo <b>:attribute</b> deve conter um número superior ou igual a :min.',
        'file'    => 'O campo <b>:attribute</b> deve conter um arquivo com no mínimo :min kilobytes.',
        'string'  => 'O campo <b>:attribute</b> deve conter no mínimo :min caracteres.',
        'array'   => 'O campo <b>:attribute</b> deve conter no mínimo :min itens.',
    ],
    'not_in'               => 'O campo <b>:attribute</b> contém um valor inválido.',
    'numeric'              => 'O campo <b>:attribute</b> deve conter um valor numérico.',
    'present'              => 'O campo <b>:attribute</b> deve estar presente.',
    'regex'                => 'O formato do valor informado no campo <b>:attribute</b> é inválido.',
    'required'             => 'O campo <b>:attribute</b> é obrigatório.',
    'required_if'          => 'O campo <b>:attribute</b> é obrigatório quando o valor do campo :other é igual a :value.',
    'required_unless'      => 'O campo <b>:attribute</b> é obrigatório a menos que :other esteja presente em :values.',
    'required_with'        => 'O campo <b>:attribute</b> é obrigatório quando <b>:values</b> está presente.',
    'required_with_all'    => 'O campo <b>:attribute</b> é obrigatório quando um dos :values está presente.',
    'required_without'     => 'O campo <b>:attribute</b> é obrigatório quando <b>:values</b> não está presente.',
    'required_without_all' => 'O campo <b>:attribute</b> é obrigatório quando nenhum dos :values está presente.',
    'same'                 => 'Os campos <b>:attribute</b> e :other devem conter valores iguais.',
    'size'                 => [
        'numeric' => 'O campo <b>:attribute</b> deve conter o número :size.',
        'file'    => 'O campo <b>:attribute</b> deve conter um arquivo com o tamanho de :size kilobytes.',
        'string'  => 'O campo <b>:attribute</b> deve conter :size caracteres.',
        'array'   => 'O campo <b>:attribute</b> deve conter :size itens.',
    ],
    'string'               => 'O campo <b>:attribute</b> deve ser uma string.',
    'timezone'             => 'O campo <b>:attribute</b> deve conter um fuso horário válido.',
    'unique'               => 'O valor informado para o campo <b>:attribute</b> já está em uso.',
    'uploaded'             => 'Falha no upload do arquivo.',
    'url'                  => 'O formato da URL informada para o campo <b>:attribute</b> é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom'               => [
        'document' => [
            'required_if' => 'O campo <b>:attribute</b> é obrigatório para o perfil selecionado.',
        ],
        'phone' => [
            'required_if' => 'O campo <b>:attribute</b> é obrigatório para o perfil selecionado.',
        ],
        'gender' => [
            'required_if' => 'O campo <b>:attribute</b> é obrigatório para o perfil selecionado.',
        ],
        'holding_id' => [
            'required_if' => 'O campo <b>:attribute</b> é obrigatório para o perfil selecionado.',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes'           => [

        // User
        'id'                       => 'id',
        'companies'                => 'empresas',
        'name'                     => 'nome',
        'surname'                  => 'sobrenome',
        'full_name'                => 'mome completo',
        'email'                    => 'e-mail',
        'password'                 => 'senha',
        'password_confirmation'    => 'confirmar senha',
        'keep_password'            => 'manter senha',
        'role_name'                => 'perfil',
        'document'                 => 'CPF',
        'admission_date'           => 'Data de Admissão',
        'phone'                    => 'telefone',
        'gender'                   => 'gênero',
        'is_active'                => 'ativo',
        'photo'                    => 'foto',
        'push_device_id'           => 'push device id',
        'delete_img'               => 'deletar foto',
        'email_verified_at'        => 'e-mail verificado em',
        'created_at'               => 'criado em',
        'updated_at'               => 'atualizado em',
        'sexe_id'                  => 'Sexo',

        // Category
        'description'              => 'descrição',

        // CheckiIn
        'visit_time'               => 'hora da visita',

        // Company
        'address'                  => 'endereço',
        'number'                   => 'número',
        'neighborhood'             => 'bairro',
        'city'                     => 'cidade',
        'state'                    => 'estado',
        'zipcode'                  => 'CEP',
        'complement'               => 'complemento',
        'reference'                => 'referência',
        'latitude'                 => 'latitude',
        'longitude'                => 'longitude',
        'full_address'             => 'endereço completo',
        'map'                      => 'mapa',

        // Grade
        'grade'                    => 'nota',

        // Level
        'value'                    => 'valor',
        'cashback_percentage'      => 'porcentagem de cashback',

        // Voucher
        'current_value'            => 'valor atual',
        'total_value'              => 'valor total',
        'is_sold'                  => 'vendido',
        'is_redeemed'              => 'resgatado',

        // PushNotification
        'title'                    => 'título',
        'message'                  => 'mensagem',
        'schedule_time'            => 'agendar para',

        // FK
        'level_id'                 => 'nível',
        'company_id'               => 'empresa',
        'holding_id'               => 'gestora',
        'category_id'              => 'categoria',
        'user_id'                  => 'usuário',
        'user_ids'                 => 'usuários',
        'order_id'                 => 'pedido',
        'feedback_id'              => 'feedback',
        'type_feedback_id'         => 'tipo de feedback',
        'voucher_id'               => 'voucher',
        'status_payment_id'        => 'status do pagamento',

        // Module
        'type'                     => 'Tipo de Automação',

    ],
];
