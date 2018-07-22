<div class='col-md-12 returnedMessages'>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('message') > 0)
        <div class="alert {{Session::get('alert-type')}} alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <ul>
                @foreach (Session::get('message') as $message)
                    <li>{!! $message !!}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<script>
    setTimeout(function() {
        $('.alert-dismissable').fadeOut('slow');
    }, 1000);
</script>