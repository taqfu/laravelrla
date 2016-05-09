<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Achievement;
use App\Criterion;
use App\Inventory;
use App\ProspectiveAchievement;
use Auth;
use View;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()){
            return View::make('Achievement.index', [
                "achievements"=>Achievement::get(),
                "inventory"=>Inventory::where("user_id", Auth::user()->id)->where("achievement_id", ">", 0)->get(),   
            ]);
        } else if (!Auth::user()){
            return View::make('Achievement.index', [
                "achievements"=>Achievement::get(),
                
            ]);
        }
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rel_row = ProspectiveAchievement::orderBy('election_id', "desc")->whereNotNull('completed_at')->first();
        if ($rel_row==null){
            $election_id = 1;
        } else if($rel_row!=null) {
            $election_id = $rel_row['election_id']+1;
        }
        
        return View::make('Achievement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|string|max:255|unique:achievements,name,NULL,id,deleted_at,NULL'
        ]);
        if(!Auth::user()){
            return back();
        }
        $achievement = new Achievement;
        $achievement->name = trim($request->name);
        $achievement->owner_id = Auth::user()->id;
        $achievement->save();
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
        if (Auth::user()){
            return View::make('Achievement.show', [
                "achievement"=>Achievement::where("id", $id)->first(),
                "criteria"=>Criterion::where("achievement_id", $id)->get(),
                "owned_criteria"=>Inventory::where("criterion_id", ">", 0)->where("user_id", Auth::user()->id)->get(),
                "achievement_owned"=>Inventory::where("achievement_id", $id)->where("user_id", Auth::user()->id)->first(),
                "id"=> $id, "user_id"=>Auth::user()->id
            ]);
        } else {
            return View::make('Achievement.show', [
                "achievement"=>Achievement::where("id", $id)->first(),
                "criteria"=>Criterion::where("achievement_id", $id)->get(),
            ]);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
