@if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif