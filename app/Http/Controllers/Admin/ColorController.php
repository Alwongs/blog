<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Helpers\Settings;
use App\Http\Requests\Color\StoreRequest;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::orderBy('position', 'ASC')->paginate(Settings::getValue("admin_items_per_page"));
        return view('pages/admin/colors/manage', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/admin/colors/update');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {


        if ($request->validated()) {

            $color = $request->all();          

            Color::create($color);
            
            return redirect()->route('colors.index')->with('info', 'Post has been added!'); 
        } else {
            return redirect()->back()->with('status', 'not validated!'); 
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('pages/admin/colors/update', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $color->title = $request->title;
        $color->color = $request->color;
        $color->status = $request->status;
        $color->position = $request->position;
        $color->update();

        return redirect()->route('colors.edit', compact('color'))->with('info', 'Post has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->back()->with('info', 'Запись успешно удалена'); 
    }
}
