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
        <span class="input-group-addon" id="quantity">Estoque</span>
        {!! Form::input('number', 'quantity', null, ['class' => 'form-control', 'aria-describedby' => 'quantity', 'step' => 1, 'min' => 0]) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="product_category_id">Categoria</span>
        {!! Form::select('product_category_id', $productCategories, null, ['class' => 'form-control product_category_id',]) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="product_subcategory_id">Subcategoria</span>
        <select name='product_subcategory_id' class='form-control product_subcategory_id'>
        </select>
    </div>
</div>

<div class='col-md-12 text-center margin-top'>
    {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Salvar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>


@section('scripts')
    {!! Html::script('/js/common/maskedinput.min.js') !!}
    {!! Html::script('/js/common/mascaras.min.js') !!}
    {!! Html::script('/js/painel/products.min.js') !!}

    <script>
        categorieID = $('.product_category_id').val();
        console.log(categorieID);
        getSubcategories(categorieID);

        @if(isset($product))
            //Espera 1 segundo e atualiza o valor de subcategoria
            setTimeout(function() 
            {
                $('.product_subcategory_id').val('{{$product->product_subcategory_id}}');
            }, 1000);
        @endif
    </script>
@endsection