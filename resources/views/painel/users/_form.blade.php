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
        <span class="input-group-addon" id="password">Senha</span>
        {!! Form::input('password', 'password', null, ['class' => 'form-control', 'aria-describedby' => 'password']) !!}
    </div>
</div>

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="confirmation">Confirmação</span>
        {!! Form::input('password', 'confirmation', null, ['class' => 'form-control', 'aria-describedby' => 'confirmation']) !!}
    </div>
</div>

{{--@if(\Route::current()->getName() == 'users.create')--}}
    <div class='col-md-6 margin-top'>
        <div class="input-group">
            <span class="input-group-addon" id="role">Perfil</span>
            {!! Form::select('role', $roles, null, ['class' => 'form-control', 'aria-describedby' => 'role']) !!}
        </div>
    </div>
{{--@endif--}}

<div class='col-md-6 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="active">Ativo</span>
        {!! Form::select('active', ['1' => 'Ativo', '0' => 'Inativo'], null, ['class' => 'form-control', 'aria-describedby' => 'active', 'placeholder' => 'Ativo']) !!}
    </div>
</div>

<hr>

@can('update-permissions')
    <div class='col-md-12'>
        <h2 class='text-center'>Permissões</h2>

        <div class='table-responsive'>
            <table class='table table-striped table-bordered'>
                <tr>
                    <td colspan='4' class='tableLabel'>
                        Painel
                    </td>
                </tr>
                <tr>
                    @php
                        $i=0;
                    @endphp

                    @foreach ($permissions as $permission)
                        @if ($i%4 == 0)
                            </tr>
                            <tr>
                        @endif

                        @if($permission->description == 'Visualizar categorias de posts')
                            <tr>
                                <td colspan='4' class='tableLabel'>
                                    Blog
                                </td>
                            </tr>
                        @endif

                        <td class='text-center'>
                            <label>
                                @if(!in_array($permission->name, $notShowPermissions))
                                    @if(!isset($user))
                                        {!! Form::checkbox('permissions[]', $permission->id, false, ['id' => 'permission_'.$permission->id]) !!} {{$permission->description}}
                                    @else
                                        @php
                                            $item = $permission->toArray();

                                            $selected = in_array($item, $permissionsUser);
                                        @endphp

                                        {!! Form::checkbox('permissions[]', $permission->id, $selected, ['id' => 'permission_'.$permission->id]) !!} {{$permission->description}}
                                    @endif
                                @endif
                            </label>
                        </td>

                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tr>
            </table>
        </div>
    </div>
@endcan

<div class='col-md-12 text-center margin-top'>
    {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Salvar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>