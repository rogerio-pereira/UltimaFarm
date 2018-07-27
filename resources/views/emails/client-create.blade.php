<style type="text/css">
    body
    {
        background-color: #eaeaea;
    }

    strong,
    a
    {
         color:#B99D39;
    }
</style>

<p>
    Olá {{$client->user->name}},<br/>
    Sua conta no site
    <a href='{{env('APP_URL')}}'>
        {{env('APP_NAME')}}
    </a> foi criada com sucesso
</p>

<p>
    Para acompanhar os seus contratos acesse nosso 
    <a href='{{env('APP_PAINEL_URL')}}'>
        painel administrativo
    </a> com os dados:<br/>
    <strong>E-mail:</strong> {{$client->user->email}}<br/>
    <strong>Senha:</strong> 

    @if(isset($password))
        {{$password}}
    @else
        Definida por você no momento do cadastro.
    @endif
</p>

<p>
    Obrigado,<br/>
    <img src='{{env('APP_URL')}}/public/img/painel/assinatura.png' alt='{{env('APP_NAME')}}'>
</p>