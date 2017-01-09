<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ThreeColumnsWidget;
use Illuminate\Http\Request;

class ThreeColumnsWidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $widgets = ThreeColumnsWidget::all();

    return view('admin.widget.three-cols.index', compact('widgets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ThreeColumnsWidget $widget)
    {
     return view('admin.widget.three-cols.form', compact('widget'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $widget = ThreeColumnsWidget::create($request->all());

    return redirect()->route('three-cols-widget.index')->with('status', 'Widget creato correttamente!');
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
    $widget = ThreeColumnsWidget::find($id);
    return view('admin.widget.three-cols.form', compact('widget'));
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
    $widget = ThreeColumnsWidget::find($id);
    $widget->fill($request->all())->save();

     return redirect()->route('three-cols-widget.index')->with('status', 'Widget modificato correttamente!');
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
