<?php

namespace App\Http\Controllers;

use App\Car;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;


class CarController extends Controller
{




    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']); //if we are not logged in, we only executed index and show method, actually view
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $cars = Car::all();  */ //all is eloquent function
       /* $cars = Car::paginate(10); */
       $cars = Car::orderBy('created_at', 'DESC')->paginate(10); //show last inserted car

       return view('car.index')->with([
        'cars' => $cars
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:2',
            'description' => 'required|min:5',
            'manufacturer' => 'required|min:2',
            'image'=> 'mimes:jpeg,jpg,bmp,png,gif'
        ]);



        $car = new Car([
            'manufacturer' => $request['manufacturer'],
            'name' => $request['name'],
            'image' => $request['image'],
            'description' => $request['description'],
            'user_id' => auth()->id()   // Retrieve the currently authenticated user's ID
        ]);

        if($request->image){
            $this->saveImages($request->image, $car->id);
        }


        $car->save();


      return redirect('/car/' . $car->id)->with(
        [
            'message_warning' => "Please assign some tags now."
        ]
    );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {

        $allTags = Tag::all();
         $usedTags = $car->tags;   //tagss - eloquent relation
         $availableTags = $allTags->diff($usedTags);

       return view('car.show')->with([
           'car' => $car,
           'availableTags' => $availableTags,
            'message_success' => Session::get('message_success'),  //flash session - deleted automatic
            'message_warning' => Session::get('message_warning')

       ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {


        return view('car.edit')->with([
            'car'=> $car
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)  //Request from the form and instance of car that we WANT DISPLAY
    {
        $request->validate([
            'name' => 'required|min:2',
            'description' => 'required|min:5',
            'manufacturer' => 'required|min:2',
            'image'=> 'mimes:jpeg,jpg,bmp,png,gif'
        ]);

        $car->update([
            'manufacturer' => $request['manufacturer'],
            'name' => $request['name'],
            'image' => $request['image'],
            'description' => $request['description'],
        ]);

         if($request->image){
            $this->saveImages($request->image, $car->id);
            /*  $image = Image::make($request->image);  //new instance of Intervention\Image\Facades\Image
             if ( $image->width() > $image->height() ) { // Landscape
                $image->widen(1200)
                ->save(public_path() . "/img/cars/" . $car->id . "_large.jpg")
                ->widen(400)->pixelate(12)
                ->save(public_path() . "/img/cars/" . $car->id . "_pixelated.jpg");
            $image = Image::make($request->image);
            $image->widen(60)
                ->save(public_path() . "/img/cars/" . $car->id . "_thumb.jpg");
             }else{
                // Portrait
                $image->heighten(900)
                    ->save(public_path() . "/img/cars/" . $car->id . "_large.jpg")
                    ->heighten(400)->pixelate(12)
                    ->save(public_path() . "/img/cars/" . $car->id . "_pixelated.jpg");
                $image = Image::make($request->image);
                $image->heighten(60)
                    ->save(public_path() . "/img/cars/" . $car->id . "_thumb.jpg");
             } */
         }
        $car->save();
        return $this->index()->with(
               [
                'message_success' => "The Car" . " " . $car->name . " " . "was updated."
               ]
      );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $oldName = $car->name;
        $car->delete();
        return $this->index()->with(
            [
                'message_success' => "The Car " . $oldName . " was deleted."
            ]
        );
    }

    public function saveImages($imageInput, $carId)

    {
        $image = Image::make($imageInput);  //new instance of Intervention\Image\Facades\Image
        if ( $image->width() > $image->height() ) { // Landscape
           $image->widen(1200)
           ->save(public_path() . "/img/cars/" . $carId . "_large.jpg")
           ->widen(400)->pixelate(12)
           ->save(public_path() . "/img/cars/" . $carId . "_pixelated.jpg");
       $image = Image::make($imageInput);
       $image->widen(60)
           ->save(public_path() . "/img/cars/" . $carId . "_thumb.jpg");
        }else{
           // Portrait
           $image->heighten(900)
               ->save(public_path() . "/img/cars/" . $carId . "_large.jpg")
               ->heighten(400)->pixelate(12)
               ->save(public_path() . "/img/cars/" . $carId . "_pixelated.jpg");
           $image = Image::make($imageInput);
           $image->heighten(60)
               ->save(public_path() . "/img/cars/" .$carId . "_thumb.jpg");
        }
    }



    public function deleteImages($car_id){
        if(file_exists(public_path() . "/img/cars/" . $car_id . "_large.jpg"))
            unlink(public_path() . "/img/cars/" . $car_id . "_large.jpg");
        if(file_exists(public_path() . "/img/cars/" . $car_id . "_thumb.jpg"))
            unlink(public_path() . "/img/cars/" . $car_id . "_thumb.jpg");
        if(file_exists(public_path() . "/img/cars/" . $car_id . "_pixelated.jpg"))
            unlink(public_path() . "/img/cars/" . $car_id . "_pixelated.jpg");

        return back()->with(
            [
                'message_success' => "The Image was deleted."
            ]
        );
    }


}
