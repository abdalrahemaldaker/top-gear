@extends('layouts.app')

@section('title', 'Edit color')

@section('content')
<section>
    <div class="container">
        <h1>Edit color</h1>
        <form action="{{ route('admin.colors.update',$color) }}" method="post">
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
                <label for="brand">name</label>
                <input type="text" class="form-control" id="brand" name="name"  value="{{ old('name' , $color->name) }}">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>

      </div>






          </form>
   </div>
</section>
@endsection
