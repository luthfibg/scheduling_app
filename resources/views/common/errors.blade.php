@if ($errors->count() > 0)
    <div class="alert alert-danger">
        <strong>Whoops, something went wrong!</strong>
        <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif