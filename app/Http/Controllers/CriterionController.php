<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Criterion;
use Auth;
use View;
class CriterionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('Criterion.index', [
            "criteria"=>Criterion::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'achievementID'=>'required|integer|min:1',
            'proven'=>'required|boolean',
            'name'=>'required|string|max:255|unique:criteria,name,NULL,id,deleted_at,NULL,achievement_id,'.$request->achievementID.',proven,'.$request->proven
        ]);
        if(!Auth::user()){
            return back();
        }
        $criterion = new Criterion;
        $criterion->name = trim($request->name);
        $criterion->proven = $request->proven;
        $criterion->owner_id = Auth::user()->id;
        $criterion->achievement_id = $request->achievementID;
        $criterion->save();
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
        return View::make('Criterion.show', [
            "criterion"=>Criterion::where("id", $id)->first(),
        ]);
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
