<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tower;
use Session;
use App\Http\Requests\StoreTowerElement;
use App\Http\Requests\SearchTower;

class TowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $towers = Tower::all();
        return view('home', compact('towers'));
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
    public function store(StoreTowerElement $request)
    {
       
        $tower = new Tower;

        $tower->name = $request->name;
        $tower->description = $request->description;
        $tower->x_axis = $request->x_axis;
        $tower->y_axis = $request->y_axis;

        $tower->save();

        return [$request->name,$request->description,$request->x_axis,$request->y_axis];

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
        $tower = Tower::find($id);
        return view('editTower')->withTower($tower);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTowerElement $request)
    {
        $tower = Tower::find($request->id);

        $tower->name = $request->name;
        $tower->description = $request->description;
        $tower->x_axis = $request->x_axis;
        $tower->y_axis = $request->y_axis;

        $tower->save();

        return view('editTower')->withTower($tower);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tower = Tower::find($id);
        $tower->delete();

        Session::flash('success', 'The tower was successfully deleted.');
        return redirect()->route('tower.editDestroy');
    }

    public function searchTower(SearchTower $request) {
        $tower = new Tower;

        $withinRadius = $tower->towersIntoRadius($request->sr_x_axis,$request->sr_y_axis,$request->sr_radius);

        return $withinRadius;
    }

    public function showEditDestroy() {
        $towers = Tower::all();
        return view('editDestroy', compact('towers'));
    }
}
