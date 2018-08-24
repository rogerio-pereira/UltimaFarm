<div class='col-md-6'>
    <div class="form-group">
        <div class='text-right'>
            <label for="name">Nome</label>
        </div>
        {!! Form::input('text', 'user[name]', null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
</div>

<div class='col-md-6'>
    <div class="form-group">
        <div class='text-right'>
            <label for="email">E-mail</label>
        </div>
        {!! Form::input('email', 'user[email]', null, ['class' => 'form-control', 'id' => 'email']) !!}
    </div>
</div>

<div class='col-md-6'>
    <div class="form-group">
        <div class='text-right'>
            <label for="email">Senha</label>
        </div>
        {!! Form::input('password', 'user[password]', null, ['class' => 'form-control', 'id' => 'password']) !!}
    </div>
</div>

<div class='col-md-6'>
    <div class="form-group">
        <div class='text-right'>
            <label for="confirmation">Confirmacao</label>
        </div>
        {!! Form::input('password', 'user[confirmation]', null, ['class' => 'form-control', 'id' => 'confirmation']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="form-group">
        <div class='text-right'>
            <label for="telephone">Telefone</label>
        </div>
        {!! Form::input('text', 'telephone', null, ['class' => 'form-control telefone', 'id' => 'telephone']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="form-group">
        <div class='text-right'>
            <label for="document">Documento</label>
        </div>
        {!! Form::input('text', 'document', null, ['class' => 'form-control phone', 'id' => 'document']) !!}
    </div>
</div>

<div class='col-md-12 text-center margin-top-g margin-bottom'>
    <h2 class='no-margin'>Endereço</h2>
</div>

<div class='col-md-6'>
    <div class="form-group">
        <div class='text-right'>
            <label for="zipcode">CEP</label>
        </div>
        {!! Form::input('text', 'zipcode', null, ['class' => 'form-control zipcode', 'id' => 'zipcode', 'id' => 'zipcode']) !!}
    </div>
</div>

<div class='col-md-6'>
    <div class="form-group">
        <div class='text-right'>
            <label for="street">Rua</label>
        </div>
        {!! Form::input('text', 'street', null, ['class' => 'form-control', 'id' => 'street', 'id' => 'street']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="form-group">
        <div class='text-right'>
            <label for="number">Número</label>
        </div>
        {!! Form::input('number', 'number', null, ['class' => 'form-control', 'id' => 'number', 'id' => 'number']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="form-group">
        <div class='text-right'>
            <label for="complement">Complemento</label>
        </div>
        {!! Form::input('text', 'complement', null, ['class' => 'form-control', 'id' => 'complement']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="form-group">
        <div class='text-right'>
            <label for="neighborhood">Bairro</label>
        </div>
        {!! Form::input('text', 'neighborhood', null, ['class' => 'form-control', 'id' => 'neighborhood', 'id' => 'neighborhood']) !!}
    </div>
</div>

<div class='col-md-3 margin-top'>
    <div class="form-group">
        <div class='text-right'>
            <label for="city">Cidade</label>
        </div>
        {!! Form::input('text', 'city', null, ['class' => 'form-control', 'id' => 'city', 'id' => 'city']) !!}
    </div>
</div>

<div class='col-md-3 margin-top'>
    <div class="form-group">
        <div class='text-right'>
            <label for="state">Estados</label>
        </div>
        {!! Form::select('state', $states, null, ['class' => 'form-control', 'id' => 'state']) !!}
    </div>
</div>

<div class='col-md-12 text-center margin-top'>
    {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Salvar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>