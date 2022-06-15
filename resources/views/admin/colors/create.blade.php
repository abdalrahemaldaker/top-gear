@extends('layouts.app')

@section('title', 'Add a new Color')

@section('content')
<section>
    <div class="container">
        <h1>Create a Color</h1>
        <form action="{{ route('admin.colors.store') }}" method="post">
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
                <label for="name">name</label>
                <input type="text" class="form-control" id="name" name="name"  placeholder="Name">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>

          </div>






          </form>
   </div>
</section>
@endsection
