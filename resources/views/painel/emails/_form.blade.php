<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon" id="email">Email</span>
        {!! Form::input('text', 'email', null, ['class' => 'form-control telefone', 'aria-describedby' => 'email']) !!}
    </div>
</div>

<div class='col-md-6'>
    <div class="input-group">
        <span class="input-group-addon" id="active">Ativo</span>
        {!! Form::select('active', ['1' => 'Ativo', '0' => 'Inativo'], null, ['class' => 'form-control', 'aria-describedby' => 'active']) !!}
    </div>
</div>

<div class='col-md-12 text-center margin-top'>
    {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Salvar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>