<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon">Produto</span>
        {!! Form::select('product_id', $products, null, ['class' => 'form-control', 'id' => 'product_id', 'placeholder' => 'Produto']) !!}
    </div>
</div>

<div class='col-md-6' id='productDetail'></div>

<div class='col-md-12 text-center margin-top'>
    {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Salvar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>