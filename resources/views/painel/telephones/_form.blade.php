<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon">Local</span>
        {!! Form::select('address_category_id', $categories, null, ['class' => 'form-control', 'id' => 'address_category_id']) !!}
    </div>
</div>

<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon" id="description">Descrição</span>
        {!! Form::input('text', 'description', null, ['class' => 'form-control', 'aria-describedby' => 'description']) !!}
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
        <span class="input-group-addon" id="whatsapp">Whatsapp</span>
        {!! Form::select('whatsapp', ['0' => 'Não', '1' => 'Sim'], null, ['class' => 'form-control', 'aria-describedby' => 'whatsapp']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="active">Ativo</span>
        {!! Form::select('active', ['1' => 'Ativo', '0' => 'Inativo'], null, ['class' => 'form-control', 'aria-describedby' => 'active']) !!}
    </div>
</div>

<div class='col-md-12 text-center margin-top'>
    {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Salvar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>

@section('scripts')
    {!! Html::script('/js/common/maskedinput.min.js') !!}
    {!! Html::script('/js/common/mascaras.min.js') !!}
@endsection