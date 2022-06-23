<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\updateCarRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Color;
use App\Models\User;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,User $user)
    {
       // $cars= Car::all();
        //$categories=
        //dd($user);
        $this->authorize('view_any',Car::class);
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
        $colors=Color::all('id','name');
        $categories = Category::all(['id','name','capacity']);
        return view('admin.cars.create' ,compact('categories','colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {

        //dd($request->validated('description'));
        array_merge($request->validated(),array('is_new' => $request->validated('is_new')  ?? false ,'description' => clean($request->validated('description')),'featured_image' => $request->file('featured_image')->store('/','public')));
//        $request->validated('is_new') = $request->validated('is_new')  ?? false;
//        $request->validated('description')=clean($request->validated('description'));
//        $request->validated('featured_image')=$request->validated()->file('featured_image')->store('/','public');
        //$request->validated('featured_image')=$request->file('featured_image')->store('/','public');

        //dd($request->is_new);
        $car = new Car;
        $car=Car::create($request->validated());
        $car->colors()->attach($request->colors);
        $car->addAllMediaFromRequest()->each(function($file){
            $file->toMediaCollection();

        });

        if ($request->filled('newcolors')){
            //convert string to array
            $colors= explode(',',$request->newcolors);
            foreach($colors as $color){
                $color = trim($color);
                $model=Color::firstOrCreate(['name'=> $color]);
                $car->colors()->attach($model);
            }

            //add to colors DB


            //attach colors to car

        }

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
        $colors=Color::all('id','name');
        $categories=Category::all();
        return view('admin.cars.edit',compact('car' , 'categories','colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(updateCarRequest $request, Car $car)
    {
        $this->authorize('update',$car);

        //$validated['featured_image']=$request->file('featured_image')->store('/','public');
        array_merge($request->validated(),array('description' => clean($request->validated('description')),'featured_image' => $request->file('featured_image')->store('/','public')));
        $car->update($request->validated());
        $car->colors()->sync($request->colors);

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
