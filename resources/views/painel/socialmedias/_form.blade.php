<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon" id="name">Nome</span>
        {!! Form::input('text', 'name', null, ['class' => 'form-control', 'aria-describedby' => 'name']) !!}
    </div>
</div>

<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon" id="url">Link</span>
        {!! Form::input('url', 'url', null, ['class' => 'form-control', 'aria-describedby' => 'url']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="icon">Ícone</span>
        {!! Form::input('text', 'icon', null, ['class' => 'form-control', 'aria-describedby' => 'icon']) !!}
    </div>
    <div class="input-group margin-top">
        <p>
            Use esse modelo, substituindo SEU_ICONE pelo segundo campo "fa" do ícone desejado deste <a href='http://fontawesome.io/icons/'>site</a>
        </p>
        <p>
            &lt;span class="fa-stack fa-lg"&gt;&lt;i class="fa fa-circle fa-stack-2x"&gt;&lt;/i&gt;&lt;i class="fa SEU_ICONE fa-stack-1x fa-inverse"&gt;&lt;/i&gt;&lt;/span&gt;
        </p>
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
    {!! Html::script('/js/painel/upload.min.js') !!}
@endsection