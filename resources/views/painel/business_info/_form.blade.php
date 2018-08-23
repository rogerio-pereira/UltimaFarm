<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon">Razão Social</span>
        {!! Form::input('text', 'companyName', null, ['class' => 'form-control', 'aria-describedby' => 'companyName']) !!}
    </div>
</div>

<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon">CNPJ</span>
        {!! Form::input('text', 'cnpj', null, ['class' => 'form-control cnpj', 'aria-describedby' => 'cnpj']) !!}
    </div>
</div>

<div class='col-md-12 text-center margin-top'>
    {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Salvar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>

@section('scripts')
    {!! Html::script('/js/common/maskedinput.min.js') !!}
    {!! Html::script('/js/common/mascaras.min.js') !!}
@endsection