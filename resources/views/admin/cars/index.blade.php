@extends('layouts.app')

@section('title','Car | index')

@section('content')
<section>
<div class="container">

    <div class="cow">
        <div class="col-12">
            <form action="">
                <input type="hidden" name="q"  value="{{ request()->q; }}">
                  <select name="category" id="category">
                    <option value="">All</option>
                      @foreach ($categories as $category )
                      <option value="{{ $category->id }}" {{$category->id==request()->category  ? 'selected' :''  }}>{{ $category->name }}</option>
                      @endforeach
                  </select>
                  <input type="submit" value="view">
            </form>
        </div>
        <h5><a href="{{ route('admin.cars.create') }}">Create a car</a></h5>
    </div>
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">brand</th>
        <th scope="col">model</th>
        <th scope="col">Category</th>
        <th scope="col">price</th>
        <th scope="col">color</th>
        <th scope="col">gear_type</th>
        <th scope="col">is_new</th>
        <th scope="col">year</th>
        <th scope="col">country</th>
        <th scope="col">Image</th>
        <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>
@foreach ($cars as $car)




      <tr>
        <th scope="row">{{$car->id}}</th>
        <td><a href= "{{route('admin.cars.show' , $car)}}">{{$car->brand}}</a></td>
        <td>{{$car->model}}</td>
        <td>{{ $car->category->name ?? 'null' }}</td>
        <td>{{$car->price}}</td>
        <td>{{$car->color}}</td>
        <td>{{$car->gear_type}}</td>
        <td>{{($car->is_new == "1") ?  'new' : 'old'  }}</td>
        <td>{{$car->year}}</td>
        <td>{{$car->country}}</td>
        <td><img src="/storage/{{$car->featured_image}}" width="200px" ></td>

        <td><a href="{{ route('admin.cars.edit', $car) }}"> edit</a> |  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Delete
          </button> </td>




      </tr>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Do you want to delete this item
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <form action="{{ route('admin.cars.destroy',$car) }}" method="POST">@csrf @method('Delete')<input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="delete"></form>
            </div>
          </div>
        </div>
      </div>

@endforeach
{{ $cars->links() }}
</tbody>
</table>
</div>
</section>
    @endsection
