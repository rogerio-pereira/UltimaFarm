<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon" id="name">Nome</span>
        {!! Form::input('text', 'name', null, ['class' => 'form-control', 'aria-describedby' => 'name']) !!}
    </div>
</div>

<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon" id="price">Valor</span>
        {!! Form::input('text', 'price', null, ['class' => 'form-control dinheiro', 'aria-describedby' => 'price']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="deadline">Prazo de Retirada (em meses)</span>
        {!! Form::input('number', 'deadline', null, ['class' => 'form-control', 'aria-describedby' => 'deadline', 'min' => 1, 'step' => 1]) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="profitability">Rentabilidade (em %)</span>
        {!! Form::input('number', 'profitability', null, ['class' => 'form-control', 'aria-describedby' => 'profitability', 'min' => 1, 'step' => 0.01]) !!}
    </div>
</div>

<div class='col-md-8 margin-top'>
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