<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon">Cliente</span>
        {!! Form::select('client_id', $clients, null, ['class' => 'form-control', 'id' => 'client_id', 'placeholder' => 'Cliente']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon">Produto</span>
        {!! Form::select('product_id', $products, null, ['class' => 'form-control', 'id' => 'product_id', 'placeholder' => 'Produto']) !!}
    </div>
</div>

<div class='col-md-6 margin-top' id='clientDetail'></div>

<div class='col-md-6 margin-top' id='productDetail'></div>

<div class='col-md-12 text-center margin-top'>
    {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Salvar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>

@section('scripts')
    {!! Html::script('/js/painel/sales.min.js') !!}
@endsection