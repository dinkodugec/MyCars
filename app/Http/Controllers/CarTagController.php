<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

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
}