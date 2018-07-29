<div class='col-md-12'>
    <div class="input-group">
        <span class="input-group-addon" id="question">Pergunta</span>
        {!! Form::input('text', 'question', null, ['class' => 'form-control', 'aria-describedby' => 'question']) !!}
    </div>
</div>

<div class='col-md-12 margin-top'>
    <label for='answer'>Resposta</label>
    <textarea name="answer" id='answer' class='tinymce'>{{$faq->answer or old('answer')}}</textarea>
</div>

<div class='col-md-12 text-center margin-top'>
    {!! Form::button('<i class="fa fa-check" aria-hidden="true"></i> Salvar&nbsp;', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
</div>

@section('scripts')
    {!! Html::script('/js/painel/tinymce/tinymce.min.js') !!}
@endsection