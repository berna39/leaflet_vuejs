<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coordonnee;

class SideController extends Controller
{
    public function add_side(Request $request){

        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $my_string = null;

        for ($i=0; $i < count($latitude); $i++) { 
            $my_string .= $latitude[$i].','.$longitude[$i].';';
        }
        // print_r($my_string);
        $coordonnees = new Coordonnee;
        $coordonnees->coordonnee = $my_string;
        $coordonnees->save();

        $response = array(
            'status' => 1,
            'message' => 'success'
        );
    }
}
