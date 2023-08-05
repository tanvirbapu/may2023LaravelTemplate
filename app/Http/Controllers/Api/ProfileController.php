<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request, User $model, $id)
    {
        DB::beginTransaction();
        try {

            if ($request->has('name') && $request->name != null) {
                $rules['name'] = 'required|max:100';
                $input['name'] = $request->name;
            }

            $data['message'] = array('update profile has been successfully');

            if ($request->has('email') && $request->email != null) {
                $rules['email'] = 'required';
                $input['email'] = $request->email;
            }

            if ($request->has('phone') && $request->phone != null) {
                $rules['phone'] = 'required';
                $input['phone'] = $request->phone;
            }

            if ($request->has('password') && $request->password != null) {
                $rules['password'] = 'required';
                $input['password'] = bcrypt($request->password);

                $data['message'] = array('change password  has been successfully');
            }

            $input_validation = $request->only('name', 'email', 'phone', 'password');

            $validator = Validator::make($input_validation, $rules);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->messages()->all()]);
            }

            $user = $model->find($id);
            if ($user == null) {
                return response()->json(['success' => false, 'message' => array('Wrong user id'), 'data' => $user], 400);
            }

            $user->fill($input)->save();

            $user = $model->find($user->id);

            $data['success'] = true;

            $data['data'] = $user;


        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->message());
        }

        DB::commit();

        return response()->json($data);
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $user = User::find($id);
            if ($user == null) {
                return response()->json(['success' => false, 'message' => array('Wrong user id')], Response::HTTP_NOT_FOUND);
            }

            $user->delete();

            $data['success'] = true;
            $data['message'] = array('Profile deleted successfully');

        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException($e->message());
        }

        DB::commit();

        return response()->json($data);
        //if i am using 204 then in response not show any other data.. it is like that return response()->json(null, 204);


    }

}