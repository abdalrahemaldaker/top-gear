<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Category;



class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request )
    {
       // $cars= Car::all();
        //$categories=

        $query = Car::latest();
        if($request->filled('category')){
            $query->Where('category_id',"$request->category");
        }
        /*if(  $request->filled('category') ){

            $query->where(function($q) use ($request){
                $q->Where('brand','like',"%$request->q%")
                 ->orwhere('model','like' ,"%$request->q%" )
                 ->orWhere('color','like',"%$request->q%");
            }); }*/



        //dd($query->toSql());
        $cars=$query->paginate(3);
        $cars->withquerystring();

        $categories=Category::whereHas('cars')->get();
        return view('admin.cars.index',compact('cars','categories'));
    }

    /**
     * Show the form for Category $categoryting a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(['id','name','capacity']);
        return view('admin.cars.create' ,compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


       $validated= $request->validate([
            'brand'         =>'required',
            'model'         =>'required',
            'category_id'   =>'required|numeric|exists:categories,id',
            'price'         =>'required|numeric|min:1000000',
            'color'         =>'required',
            'gear_type'     =>'required',
            'is_new'        =>'boolean|nullable',
            'year'          =>'required',
            'country'       =>'required',
            'description'   =>'required',
            'featured_image'=>'required|file|image'

        ]);
        $validated['is_new'] = $validated ['is_new'] ?? false;
        $validated['description']=clean($validated['description']);
        $validated['featured_image']=$request->file('featured_image')->store('/','public');
        //dd($request->is_new);
        $car = new Car;
        $car=Car::create($validated);
        /*$car->brand = $request-> brand;
        $car->model = $request-> model;
        $car->category_id = $request->category_id;
        $car->price = $request-> price;
        $car->color = $request-> color;
        $car->gear_type = $request-> gear_type;
        $car->is_new = $request-> is_new ?? false;
        $car->year = $request-> year;
        $car->country = $request-> country;
        $car->description = $request-> description;

        $car->save();*/
        session()->flash('message' , 'Added succesfuly');
        session()->flash('message-color' , 'success');
         return redirect()->route('admin.cars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        $categories=Category::all();
        return view('admin.cars.edit',compact('car' , 'categories'));
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
        $validated= $request->validate([
            'brand'         =>'required',
            'model'         =>'required',
            'price'         =>'required|numeric|min:1000000',
            'color'         =>'required',
            'gear_type'     =>'required',
            'is_new'        =>'boolean|nullable',
            'year'          =>'required',
            'country'       =>'required',
            'description'   =>'required',
            'category_id'   =>'required|numeric',
            'featured_image'=>'required|file|image'

        ]);
        $validated['featured_image']=$request->file('featured_image')->store('/','public');
        $car->update($validated);
        /*$car->brand = $request-> brand;
        $car->model = $request-> model;
        $car->price = $request-> price;
        $car->color = $request-> color;
        $car->gear_type = $request-> gear_type;
        $car->is_new = $request-> is_new ?? false;
        $car->year = $request-> year;
        $car->country = $request-> country;
        $car->description = $request-> description;
        $car->category_id = $request-> category_id;
        $car->save();*/
        return redirect()->route('admin.cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index');
    }
}
