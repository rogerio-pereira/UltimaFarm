<div class='col-md-4'>
    @if(!isset($video))
        <img 
            src='{{ asset('img/template/painel/sem-imagem.jpg') }}' 
            alt='Video sem imagem' 
            title='Video sem imagem' 
            class='img-responsive'
            id='image-uploaded'
        >
        {!! Form::input('hidden', 'image', null, ['id' => 'image']) !!}
    @else
        <img 
            src='{{$video->image}}' 
            alt='Imagem' 
            title='Imagem' 
            class='img-responsive'
            id='image-uploaded'
        >
        {!! Form::input('hidden', 'image', null, ['id' => 'image']) !!}
    @endif
</div>

<div class='col-md-8'>
    <div class="input-group">
        <span class="input-group-addon" id="titulo">Titulo</span>
        {!! Form::input('text', 'title', null, ['class' => 'form-control', 'aria-describedby' => 'titulo']) !!}
    </div>
</div>

<div class='col-md-8 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="descricao">Descricao</span>
        {!! Form::input('text', 'description', null, ['class' => 'form-control', 'aria-describedby' => 'descricao']) !!}
    </div>
</div>

<div class='col-md-8 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="url">URL</span>
        {!! Form::input('text', 'url', null, ['class' => 'form-control', 'aria-describedby' => 'url', 'id' => 'urlField']) !!}
    </div>
    {!! Form::input('hidden', 'token', csrf_token(), ['id' => 'token']) !!}
</div>

<div class='col-md-8 margin-top'>
    <div class="input-group">
        <span class="input-group-addon" id="active">Ativo</span>
        {!! Form::select('active', ['1' => 'Ativo', '0' => 'Inativo'], null, ['class' => 'form-control', 'aria-describedby' => 'active', 'placeholder' => 'Ativo']) !!}
    </div>
</div>

<div class='col-md-12 text-center margin-top'>
    {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Salvar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>

@section('scripts')
    {!! Html::script('/js/painel/video.min.js') !!}
@endsection