<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon" id="name">Nome</span>
        {!! Form::input('text', 'name', null, ['class' => 'form-control', 'aria-describedby' => 'name']) !!}
    </div>
</div>

<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon" id="email">E-mail</span>
        {!! Form::input('email', 'email', null, ['class' => 'form-control', 'aria-describedby' => 'email']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="telephone">Telefone</span>
        {!! Form::input('text', 'telephone', null, ['class' => 'form-control telefone', 'aria-describedby' => 'telephone']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="document">Documento</span>
        {!! Form::input('text', 'document', null, ['class' => 'form-control phone', 'aria-describedby' => 'document']) !!}
    </div>
</div>

<div class='col-md-12 text-center margin-top-g margin-bottom'>
    <h2>Endereço</h2>
</div>

<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon">CEP</span>
        {!! Form::input('text', 'zipcode', null, ['class' => 'form-control cep', 'aria-describedby' => 'zipcode', 'id' => 'zipcode']) !!}
    </div>
</div>

<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon">Rua</span>
        {!! Form::input('text', 'street', null, ['class' => 'form-control', 'aria-describedby' => 'street', 'id' => 'street']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon">Número</span>
        {!! Form::input('number', 'number', null, ['class' => 'form-control', 'aria-describedby' => 'number', 'id' => 'number']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon">Complemento</span>
        {!! Form::input('text', 'complement', null, ['class' => 'form-control', 'aria-describedby' => 'complement']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon">Bairro</span>
        {!! Form::input('text', 'neighborhood', null, ['class' => 'form-control', 'aria-describedby' => 'neighborhood', 'id' => 'neighborhood']) !!}
    </div>
</div>

<div class='col-md-3 margin-top'>
    <div class="input-group">
        <span class="input-group-addon">Cidade</span>
        {!! Form::input('text', 'city', null, ['class' => 'form-control', 'aria-describedby' => 'city', 'id' => 'city']) !!}
    </div>
</div>

<div class='col-md-3 margin-top'>
    <div class="input-group">
        <span class="input-group-addon">Estados</span>
        {!! Form::select('state', $states, null, ['class' => 'form-control', 'id' => 'state']) !!}
    </div>
</div>

<div class='col-md-12 text-center margin-top'>
    {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Salvar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>

@section('scripts')
    {!! Html::script('/js/common/maskedinput.min.js') !!}
    {!! Html::script('/js/common/mascaras.min.js') !!}
@endsection