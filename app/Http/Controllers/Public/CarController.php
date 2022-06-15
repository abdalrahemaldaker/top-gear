<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    //$cars=Car::all();
    $query = Car::latest();
        if($request->filled('category')){
            $query->Where('category_id',"$request->category");
        }
      /*  if($request->filled('colors')){
            foreach ($request->colors as $color){
                $query->Wherehas('colors' ,function(){
                    select
                } );
                }

            };
*/

                $query->Wherehas('colors',function( $que) use ($request){
                    $que->where('id','in',$request->colors);
                });


        if(  $request->filled('q') ){

            $query->where(function($q) use ($request){
                $q->Where('brand','like',"%$request->q%")
                 ->orwhere('model','like' ,"%$request->q%" );

            });


        }
        ($query->toSql());
        $cars=$query->paginate(3);
        $cars->withquerystring();

    $categories=Category::whereHas('cars')->get();
   // dd(request());
    $colors=Color::all();
    return view('public.cars.index',compact('cars' , 'categories' ,'colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('public.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        //
    }
}
