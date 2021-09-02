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
    public function index(Request $request, $coinId)
    {
        $usersCoinPriceAlertsForTheCoin = $request->user()->coinPriceAlerts()->coinId($coinId)->get();



        return response()->json([
            'coinPriceAlerts' => CoinPriceAlertResource::collection($usersCoinPriceAlertsForTheCoin)->resolve()
        ], 201); // Status code here
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
    public function store(CoinPriceAlertRequest $request)
    {
        $validatedData = $request->validated();
        $request->user()->coinPriceAlerts()->create($validatedData);
        return response()->json([
            'status' => 'Success'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CoinPriceAlertRequest $request, $id)
    {

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
