@extends('layouts.app')

@section('title', 'Add a new category')

@section('content')
<section>
    <div class="container">
        <h1>Create a category</h1>
        <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="form-group">
                <label for="brand">name</label>
                <input type="text" class="form-control" id="brand" name="name"  placeholder="Name">
              </div>

              <div class="form-group">
                <label for="Capacity">Capacity</label>
                <input type="number" min="2"  id="price" name="capacity" class="form-control" placeholder="Capacity">
              </div>
          </div>
      </div>





            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
   </div>
</section>
@endsection
