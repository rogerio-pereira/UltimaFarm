@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Videos</h1>
    </div>

    @can('create-videos')
        <div class='col-md-12 text-center'>
            <a href='{{route('videos.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
                Cadastrar
            </a>
            <br/>
            <br/>
        </div>
    @endcan

    <table class="table table-responsive table-striped table-bordered table-hovered">
        <thead>
            <tr>
                <th width="100px">Ações</th>
                <th width="100px">ID</th>
                <th>Titulo</th>
                <th>URL</th>
                <th width="150px">Imagem</th>
                <th width="100px">Ativo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($videos as $video)
            <tr>
                <td>
                    @can('delete-videos')
                        {!! Form::open(['route' => ['videos.destroy', $video->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan

                    @can('update-videos')
                        <a href='videos/{{$video->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$video->id}}</td>
                <td>{{$video->title}}</td>
                <td>{{$video->url}}</td>
                <td>
                    <img src='{{$video->image}}' class='img-responsive'>
                </td>
                <td>
                    @php
                        $checked = '';

                        if($video->active == true)
                            $checked = 'checked';
                    @endphp

                    <input type="checkbox" {{$checked}} class='checkboxActive' data-model="Video" data-id="{{$video->id}}" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Ativo" data-off="Inativo" >
                </td>
            </tr>
            @empty
            <tr>
                <td colspan='6' class='text-center'>
                    Nenhum Video cadastrado
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$videos->render()}}
    </div>
@endsection
