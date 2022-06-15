@extends('layouts.app')

@section('title','Car | index')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <form action="">
            <select name="colors[]" id="colors" multiple>
                <option value="">All</option>
                  @foreach ($colors as $color )
                  <option value="{{ $color->id }}" {{$colors->contains($color->id) ? 'selected':''  }}>{{ $color->name }}</option>
                  @endforeach
              </select>





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


</nav>

<section>
<div class="container">


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


      </tr>



@endforeach
{{ $cars->links() }}
</tbody>
</table>



</div>

</section>
    @endsection
