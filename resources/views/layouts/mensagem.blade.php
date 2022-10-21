@if(session('mensagem'))
<div id="fadeOut" class="fadeOut alert alert-success mt-3" role="alert">
    <p>{{session('mensagem')}}</p>
</div>
@endif

@if(session('error'))
<div id="fadeOut" class="fadeOut alert alert-danger mt-3">
    <p>{{session('error')}}</p>
</div>
@endif

@if ($errors->any())
    <div id="fadeOut" class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif