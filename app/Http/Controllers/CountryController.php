<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Country;
use App\Activity;
use App\Http\Resources\Country as CountryResource;
use App\Http\Resources\Activity as ActivityResource;
use JWTAuth;


class CountryController extends Controller
{
    protected $user;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get Countries
        $countries = Country::all();

        $activity = "Get all Countries";
            
        $this->activity($activity);

        //Return collection of Countries as a resource
        return CountryResource::collection($countries);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country;

        $country->name = $request->input('name');
        $country->continent = $request->input('continent');

        if($country->save()) {
            $activity = "Create new Country".$country->name;

            
            $this->activity($activity);

            return new CountryResource($country);
        }

        

    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);

        $country->name = $request->input('name');
        $country->continent = $request->input('continent');

        if($country->save()) {

            $activity = "Updated Country ".$$country->name;
            
            $this->activity($activity);

            return new CountryResource($country);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get a single country
        $country = Country::findOrFail($id);

        //return single country as a resource
        return new CountryResource($country);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Get a single country
        $country = Country::findOrFail($id);

        //delete the single country 
        if($country->delete()) {
            $activity = "Deleted Country ".$country->name;
            
            $this->activity($activity);

            return new CountryResource($country);
        }
    }

    // to activities performed by the User
    public function activity($activity) {
        $activityClass = new Activity;

        $activityClass->user_id = auth()->user()->id;
        $activityClass->activity = $activity;

        
        if($activityClass->save()) {
           return new ActivityResource($activity);
        }

    }
}
