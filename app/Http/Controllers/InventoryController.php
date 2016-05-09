<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Inventory;
use App\Criterion;
use Auth;
use View;
class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()){
            return View::make('Inventory.index', [
                "achievements_in_inventory"=>Inventory::where("achievement_id", ">", 0)
                  ->where('user_id', Auth::user()->id)->get(),
                "criteria_in_inventory"=>Inventory::where("criterion_id", ">",0)->where("user_id", Auth::user()->id)->get(),
            ]);
        }
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
        if(!Auth::user()){
            return back();
        }
        $inventory = new Inventory;
        if (isset($request->achievementID)){
            $this->validate($request, [
                'achievementID'=>'required|integer|min:1|unique:inventories,achievement_id,NULL,id,deleted_at,NULL,user_id,'.Auth::user()->id,
            ]);
            $inventory->achievement_id = $request->achievementID;   
        } else if (isset($request->criterionID)){
            $this->validate($request, [
                'criterionID'=>'required|integer|min:1|unique:inventories,criterion_id,NULL,id,deleted_at,NULL,user_id,'.Auth::user()->id,
            ]);
            $inventory->criterion_id = $request->criterionID;
        }
        $inventory->user_id = Auth::user()->id;
        $inventory->save();
        return back();
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
    public function update(Request $request, $id)
    {
        if(!Auth::user()){
            return back();
        }
        $inventory = Inventory::find($id);
        if (isset($request->visible)){
            $this->validate($request, [
                'visible'=>'required|boolean'
            ]);
            $inventory->visible = $request->visible;   
        } else if (isset($request->active)){
            $this->validate($request, [
                'active'=>'required|boolean'
            ]);
            $inventory->active = $request->active;
        }
        if ($inventory->user_id== Auth::user()->id){
            $inventory->save();
        } 
        return back();
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        if ($inventory->achievement_id>0){
            $criteria_of_achievement = Criterion::where('achievement_id', $inventory->achievement_id)->get();
            foreach($criteria_of_achievement as $criterion_of_achievement){
                Inventory::where('criterion_id', $criterion_of_achievement->id)->delete();
            }
        }
        Inventory::where('id', $id)->delete();
        return back();
    }
}
