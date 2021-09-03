<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CoinPriceAlertResource;
use App\Http\Requests\CoinPriceAlertRequest;

class CoinPriceAlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usersCoinPriceAlerts = $request->user()->coinPriceAlerts;
        return response()->json([
            'coinPriceAlerts' => CoinPriceAlertResource::collection($usersCoinPriceAlerts)->resolve()
        ], 201); // Status code here

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoinPriceAlertRequest $request)
    {
        $validatedData = $request->validated();
        $newAlert = $request->user()->coinPriceAlerts()->create($validatedData);
        return response()->json([
            'status' => 'Success',
            'id' => $newAlert->id
        ], 201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Request $request, $id)
    public function destroy(Request $request)
    {
        $alert = $request->user()->coinPriceAlerts()->find($request->id);
        if($alert){
            $alert->delete();
            return response()->json([
                'status' => 'Deleted'
            ], 201);
        } 

        return response()->json([
            'status' => 'Error'
        ], 501);
    }
}
