@extends('layouts.app')

@section('title', 'Add a new car')


@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

@endpush
@section('content')
    <section>
        <div class="container">
            <h1>Create a car</h1>
            <form action="{{ route('admin.cars.store') }}" method="post">
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
                    <label for="brand">Brand</label>
                    <input type="text" class="form-control" id="brand" name="brand"  placeholder="brand">
                  </div>
                <div class="form-group">
                    <label for="Model">Model</label>
                    <input type="text" class="form-control" id="Model" name="model"  placeholder="model">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                        <div class="input-group mb-3">

                        <div class="input-group-prepend">
                          <span class="input-group-text">SYP</span>
                        </div>
                        <input type="number" min="1000000" step="500000" id="price" name="price" class="form-control">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="color">Color</label>
                    <select class="custom-select" id="color" name="color" multiple>
                      <option selected disabled>Choose...</option>
                      <option value="black">black</option>
                      <option value="red">red</option>

                    </select>
                  </div>
                  <div class="form-group mb-3">
                    <label for="gear-type">Gear Type</label>
                    <select class="custom-select" id="gear-type" name="gear_type" >
                      <option selected disabled>Choose...</option>
                      <option value="auto">automatic</option>
                      <option value="manual">manual</option>

                    </select>
                  </div>

                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="is_new" id="is_new" value="1">
                  <label class="form-check-label"  for="is_new" {{ old('is_new') ? 'checked':'' }}>This is a new car?</label>
                </div>
                <div class="form-group">
                    <label for="price">year</label>
                        <div class="input-group mb-3">

                        <input type="number" min="1880" id="price" name="year" class="form-control">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="Country">Country</label>
                    <select class="custom-select" id="Country" name="country" >
                      <option selected disabled>Choose...</option>
                      <option value="germany">Germany</option>
                      <option value="Japan">Japan</option>

                    </select>
                  </div>

                  <div class="form-group">

                      <label for="Description">Description</label>

                    <textarea class="form-control" id="Description" name="description" rows="5"></textarea>
                  </div>



                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
       </div>
    </section>
@endsection


@push('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $('#Description').summernote({
      placeholder: 'Hello Bootstrap 4',
      tabsize: 2,
      height: 100
    });
  </script>
@endpush
