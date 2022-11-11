<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOptionRequest;
use App\Http\Requests\Admin\UpdateOptionRequest;
use App\Models\Option;
use Inertia\Inertia;
use Inertia\Response;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $optionsAll = Option::all();
        $optionsParent = Option::where('parent_id', null)->get();
        $optionsChildren = Option::whereNotNull('parent_id')->get();

        return Inertia::render('Admin/Options', compact('optionsAll', 'optionsParent', 'optionsChildren'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOptionRequest $request)
//    public function store(Request $request)
    {
        $data = $request->validated();
        Option::create($data);

        return redirect()->route('options.index');
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
    public function update(UpdateOptionRequest $request, Option $option)
    {
        $data = $request->validated();
        Option::find($option->id)->update($data);

        return redirect()->route('options.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Option::where('id', $id)->delete();

        return redirect()->route('options.index');
    }
}
