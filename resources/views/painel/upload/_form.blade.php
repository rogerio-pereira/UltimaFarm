{!! Form::open(['route' => 'upload.upload', 'method' => 'post','enctype' => 'multipart/form-data', 'id' => 'uploadForm']) !!}
    <div class='col-md-6'>
        <div class="input-group">
            <h2>{!! Form::label('file', 'Selecione as imagens') !!}</h2>
            {!! Form::input('file', 'file[]', null, ['aria-describedby' => 'file', 'accept' => "image/*", 'required', 'multiple']) !!}
        </div>
    </div>

    <div class='clearfix'></div>

    <div class='col-md-6 margin-top'>
        {!! Form::button('<i class="fa fa-upload" aria-hidden="true"></i> Enviar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>

    <div class='col-md-12 margin-top'>
        <div id="progress-div">
            <div id="progress-bar"></div>
        </div>
    </div>

    <div class='col-md-12 margin-top'>
        <div id="targetLayer"></div>
    </div>
{!! Form::close() !!}

@section('css')
    {!! Html::style('/css/painel/upload.min.js') !!}
@endsection