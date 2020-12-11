@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Edit {{ $productType->name }}</div>
            <div class="card-body">
                <form autocomplete="off" action="/productType/{{$productType->id}}" method="post" enctype="multipart/form-data" class="needs-validation">
                    <!-- csrf to generate hidden token. Laravel session. Laravel safety feature
                    So only us in this session that can do the post
                    Prevent other people from manipulating our data from the outside  !-->
                    @csrf
                    @method("PATCH") <!-- HTML only accept method get and post, so add this so laravel knows we are sending a patch request !-->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $productType->name }}">
                        @error('name') <!-- if name ga valid !-->
                            <div class="invalid-feedback">{{ $message }}</div> <!-- display the first error message !-->
                        @enderror

                        <!-- in the value, we put a helper function.
                        If there is no product name, show old input
                        So, when our input in incorrect, it still shows the old input!-->
                        
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <input class="btn btn-primary card-link" type="submit" value="Submit">
                    <a href="/" class="btn btn-secondary card-link">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection