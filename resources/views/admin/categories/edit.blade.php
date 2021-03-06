@extends('layouts.app')

@section('title', 'Edit category')

@section('content')
<section>
    <div class="container">
        <h1>Edit category</h1>
        <form action="{{ route('admin.categories.update',$category) }}" method="post">
            @csrf
            @method('put')
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
                <label for="name">name</label>
                <input type="text" class="form-control" id="name" name="name"  value="{{ old('name' , $category->name) }}">
              </div>
            <div class="form-group">
                <label for="name_ar">Name Arabic</label>
                <input type="text" class="form-control" id="name_ar" name="name_ar"  value="{{ old('name_ar' , $category->name_ar) }}">
              </div>
            <div class="form-group">
              <label for="Capacity">Capacity</label>
              <input type="number" min="2"  id="price" name="capacity" class="form-control" value="{{ old('capacity' , $category->capacity) }}">
            </div>
            <div class="form-group">
             <button type="submit" class="btn btn-primary">Submit</button>
            </div>
      </div>






          </form>
   </div>
</section>
@endsection
