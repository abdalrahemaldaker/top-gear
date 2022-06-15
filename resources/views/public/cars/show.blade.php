@extends('layouts.app')

@section('title', 'Cars' . ' - ' . $car->model)

@section('content')
    <section>
        <div class="container">
            <div class="card mb-3">
                <img class="card-img-top" src="card-img-top" src="/storage/{{ $car->featured_image }}" alt="Card image cap">
                <div class="card-body">
                  <h3 class="card-title">{{$car->brand .' | '. $car->model  }}</h3>
                  {{ $category=$car->category }}
                  <h5 class="card-title"><a href="{{route('categories.show' , $category)}}">{{$car->category->name ?? 'null'  }}</a></h5>

                  <p class="card-text">
                    <div class="table-responsive">
                      <table class=".table-bordered">
                        <tr><td>Price:</td><td>{{ $car->price}}</td></tr>
                        <tr><td>Color:</td><td>{{ $car->color}}</td></tr>
                        <tr><td>Gear type:</td><td>{{ $car->gear_type}}</td></tr>
                        <tr><td>New/used:</td><td>{{($car->is_new == "1") ?  'New' : 'Used'  }}</td></tr>
                        <tr><td>Year:</td><td>{{ $car->year}}</td></tr>
                        <tr><td>Country:</td><td>{{ $car->country}}</td></tr>
                        <tr><td>Details:</td><td>{{ $car->description}}</td></tr>


                      </table>
                    </div>
                  </p>

                </div>
              </div>
        </div>
    </section>
@endsection
