<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Car;

class CarTagController extends Controller
{
    public function getFilterdCars($tag_id)
    {

        $tag = new Tag();
        $cars = $tag::findOrFail($tag_id)->filteredCars()->paginate(10);

        $filter = $tag::find($tag_id);


        return view('car.index', [
            'cars' => $cars,
            'filter' => $filter
        ]);


    }


    public function attachTag($car_id, $tag_id)
    {
              $car = Car::find($car_id);
              $tag = Tag::find($tag_id); //need fetch tag to add succss message
              $car->tags()->attach($tag_id);
              return back()->with([
                'message_success' => "The Tag " . $tag->name . " was added."
            ]);


    }

    public function detachTag($car_id, $tag_id)
    {
        $car = Car::find($car_id);
        $tag = Tag::find($tag_id); //need fetch tag to add succss message
        $car->tags()->detach($tag_id);
        return back()->with([
          'message_success' => "The Tag " . $tag->name . " was removed."
      ]);



    }
}