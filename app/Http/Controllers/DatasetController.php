<?php

namespace App\Http\Controllers;

use Validator;
use App\Dataset;
use Illuminate\Http\Request;

class DatasetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $investigation_id = $request->input('investigation_id');
        return view('datasets/create', compact('investigation_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:20',
            'target_name' => 'required|max:100'
        ]);

        // process the login
        if ($validator->fails()) {
            return redirect('datasets/create')
                ->withErrors($validator)
                ->withInput($request);
        } else {
            // store
            $dataset = new Dataset;
            $dataset->investigation_id = $request->input('investigation_id');
            $dataset->description = $request->input('description');
            $dataset->target_name = $request->input('target_name');
            $dataset->save();

            // redirect
            $request->session()->flash('message', 'Successfully created dataset!');
            return redirect('/invs/' . $request->input('investigation_id') . '/items');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function show(Dataset $dataset)
    {
        return view('datasets/update', compact('dataset'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function edit(Dataset $dataset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dataset $dataset)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:20',
            'target_name' => 'required|max:100'
        ]);

        // process the login
        if ($validator->fails()) {
            return redirect('datasets/' . $request->input('id'))
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $dataset = Dataset::find($request->input('id'));
            $dataset->description = $request->input('description');
            $dataset->target_name = $request->input('target_num');
            $dataset->save();

            // redirect
            $request->session()->flash('message', 'Successfully updated dataset!');
            return redirect('/invs/' . $request->input('investigation_id') . '/items');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dataset  $dataset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataset = Dataset::find($id);
        $investigation_id = $dataset->investigation()->first()->id;
        $dataset->delete();

        // redirect
        //Session::flash('message', 'Successfully deleted the dataset!');
        return redirect('/invs/' . $investigation_id . '/items');
    }
}
