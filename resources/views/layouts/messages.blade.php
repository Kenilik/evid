@if ($errors->any())
    <div class="error text-center alert alert-danger ">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif