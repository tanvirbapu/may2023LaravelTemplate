<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\Crud;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ApicrudController extends Controller
{
    public function Index(Request $request)
    {
        $sql = Crud::orderBy('id', 'desc');
        $rows = $sql->paginate(10);

        $my_data = [];
        foreach ($rows as $row) {
            $imageUrl = url('/') . $row->image;
            $videoUrl = url('/') . $row->video;
            $my_data[] = [
                'id' => $row->id,
                'textbox' => $row->textbox,
                'image' => $imageUrl,
                'video' => $videoUrl,
                'multiple_value' => $row->multiple_value,
            ];
        }

        if (count($rows) == 0) {
            $data['success'] = false;
            $data['message'] = array('Data not found');
        } else {
            $data['success'] = true;
            $data['message'] = array('Get Data List.');
            $data['data'] = $my_data;
        }

        return response()->json($data, 200);
    }
    public function store(Request $request, Crud $model)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'textbox' => 'required|string',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'required|nullable|mimes:mp4|max:10000',
            'multiple_value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

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

        $inserted = $model->create($input);

        $data['success'] = true;
        $data['message'] = array('Data created successfully');
        $data['data'] = $inserted;

        return response()->json($data, 201);
    }
    public function update(Request $request)
    {
        $item = Crud::find($request->id);

        if (!$item) {
            return response()->json(['success' => false, 'message' => array('Wrong crud id')], 404);
        }

        $validator = Validator::make($request->all(), [
            'textbox' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4|max:10000',
            'multiple_value' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $item->textbox = $request->textbox;
        $item->multiple_value = $request->multiple_value;

        if ($request->hasFile('image')) {
            //delete existing image
            // if (Storage::disk('public')->exists($item->image)) {
            //     Storage::disk('public')->delete($item->image);
            // }
            $file = $request->file('image');
            $image_name = $file->getClientOriginalName();
            $file->move(public_path('/storage/uploads/images'), $image_name);
            $image_path = "/uploads/images/" . $image_name;
            $item->image = $image_path;
            //image update
        }

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $video_name = $file->getClientOriginalName();
            $file->move(public_path('/storage/uploads/videos'), $video_name);
            $video_path = "/storage/uploads/videos/" . $video_name;
            $item->video = $video_path;
            //video update
        }

        $item->save();
        $data['success'] = true;
        $data['message'] = array('Update data successfully');
        $data['data'] = $item;

        return response()->json($data);
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $crud = Crud::find($id);
            if ($crud == null) {
                return response()->json(['success' => false, 'message' => array('Wrong crud id')], Response::HTTP_NOT_FOUND);
            }

            $crud->delete();
            $data['success'] = true;
            $data['message'] = array('Deleted successfully');

        } catch (Exception $e) {
            DB::rollBack();
            throw new GeneralException($e->message());
        }

        DB::commit();

        return response()->json($data);
        //if i am using 204 then in response not show any other data.. it is like that return response()->json(null, 204);


    }

}