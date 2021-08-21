@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="small mb-2">
            <li class="text-danger"> {{ $error }}</li>
        </div>
    @endforeach
@endif
