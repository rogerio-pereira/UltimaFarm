@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Informações da Empresa</h1>
    </div>

    <table class="table table-responsive table-striped table-bordered table-hovered">
        <thead>
            <tr>
                <th width="50px">Ações</th>
                <th>Razão Social</th>
                <th>CNPJ</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($businessInfo as $info)
            <tr>
                <td>
                    @can('update-business_info')
                        <a href='business_info/{{$info->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$info->companyName}}</td>
                <td>{{$info->cnpj}}</td>
            </tr>
            @empty
            <tr>
                <td colspan='3' class='text-center'>
                    Nenhuma Informação da Empresa cadastrado
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$businessInfo->render()}}
    </div>
@endsection
