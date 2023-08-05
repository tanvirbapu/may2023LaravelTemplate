<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Crud::get();
        return view('crud.index', compact('data'));
        //redirect to crud index page
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $options = Option::get();
        return view('crud.create', compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Crud $model)
    {
        $input = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_name = $file->getClientOriginalName();
            $file->move(public_path('/uploads/images'), $image_name);
            $image_path = "/uploads/images/" . $image_name;
            $input['image'] = $image_path;
        } //image upload

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $video_name = $file->getClientOriginalName();
            $file->move(public_path('/uploads/videos'), $video_name);
            $video_path = "/uploads/videos/" . $video_name;
            $input['video'] = $video_path;
        } //video upload

        //multiple checkbox values by comma separated
        $checkboxValues = $request->input('checkbox');
        $input['checkbox'] = implode(',', $checkboxValues);

        $input['toggle'] = $request->input('toggle', 'off');

        // dd($input);
        $model->create($input);
        return redirect()->route('crud.index')->with('success', 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $data = Crud::with('option')->where('id', '=', $id)->get();
        // $my_data = [];
        // foreach ($data as $row) {
        // }

        // $checkbox = explode(',', $row->checkbox);
        // $checkboxSelect = [];
        // foreach ($checkbox as $checkId) {
        //     $Op = Option::where('id', '=', $checkId)->get();
        //     foreach ($Op as $row) {
        //         $checkboxSelect[] = [
        //             'checkbox_value' => $row->title,
        //         ];
        //     }
        // }
        // return view('crud.show', compact('data', 'checkboxSelect'));


        $data = Crud::where('id', '=', $id)->get();

        $options = Option::get();
        $datass = Crud::findOrFail($id);
        $selectedOptions = explode(',', $datass->checkbox);
        return view('crud.show', compact('data', 'options', 'selectedOptions'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Crud::where('id', '=', $id)->get();

        $options = Option::get();
        $datass = Crud::findOrFail($id);
        $selectedOptions = explode(',', $datass->checkbox);

        return view('crud.edit', compact('data', 'options', 'selectedOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Retrieve the record
        $record = Crud::findOrFail($id);

        // validate request data
        $validatedData = $request->validate([
            'textbox' => 'required',
            'dropdown' => 'required',
            'radiobutton' => 'required',
            'checkbox' => 'required',
            'editor' => 'required',
            'date' => 'required'
        ]);

        // Update other fields
        $record->fill($validatedData);

        $record->toggle = $request->input('toggle', 'off');

        if ($request->hasFile('image')) {
            //delete existing image
            if (Storage::disk('public')->exists($record->image)) {
                Storage::disk('public')->delete($record->image);
            }
            $file = $request->file('image');
            $image_name = $file->getClientOriginalName();
            $image_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/storage/uploads/images'), $image_name);
            $image_path = "/uploads/images/" . $image_name;
            $record->image = $image_path;
            //image update
        }

        if ($request->hasFile('video')) {
            //delete existing video
            if (Storage::disk('public')->exists($record->image)) {
                Storage::disk('public')->delete($record->image);
            }
            $file = $request->file('video');
            $video_name = $file->getClientOriginalName();
            $video_name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/storage/uploads/videos'), $video_name);
            $video_path = "/storage/uploads/videos/" . $video_name;

            $record->video = $video_path;
            //video update
        }

        //multiple checkbox values by comma separated
        $checkboxValues = $request->input('checkbox');
        $record->checkbox = implode(',', $checkboxValues);

        $record->save();

        // return a response to the user
        return redirect()->route('crud.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Get the user with the given id
        $delete = Crud::destroy($id);

        // Redirect back with success message
        return redirect()->route('crud.index')->with('success', 'Data deleted successfully.');
    }
}