@extends('layouts.app')

@section('title','Car | index')

@section('content')
<div class="container">
    <h1><a href="{{ route('admin.categories.index') }}">Categories: </a>{{ $category->name .' | '.$category->capacity}}</h1>

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
        <th scope="col">description</th>
        <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>
        @php $cars= $category->cars @endphp
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
        <td>{!! car->description!!}</td>
        <td><a href="{{ route('admin.cars.edit', $car) }}"> edit</a> |    <form action="{{ route('admin.cars.destroy',$car) }}" method="POST">@csrf @method('Delete')<input type="submit" value="delete"></form></td>


      </tr>



@endforeach
</tbody>
</table>
</div>
