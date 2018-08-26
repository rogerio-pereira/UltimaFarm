@extends('painel.layout.layout')

@section('content')
    <div class='col-md-12 text-center'>
        <h1>Faqs</h1>
    </div>

    @can('create-faqs')
        <div class='col-md-12 text-center'>
            <a href='{{route('faqs.create')}}' alt='Cadastrar' title='Cadastrar' class='btn btn-default'>
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
                <th>Pergunta</th>
                <th>Resposta</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($faqs as $faq)
            <tr>
                <td>
                    @can('delete-faqs')
                        {!! Form::open(['route' => ['faqs.destroy', $faq->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan

                    @can('update-faqs')
                        <a href='faqs/{{$faq->id}}/edit' class='btn btn-info'>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                    @endcan
                </td>
                <td>{{$faq->id}}</td>
                <td>{{$faq->question}}</td>
                <td>{!!$faq->answer!!}</td>
            </tr>
            @empty
            <tr>
                <td colspan='4' class='text-center'>
                    Nenhuma FAQ cadastrado
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class='col-md-12 text-center'>
        {{$faqs->render()}}
    </div>
@endsection
