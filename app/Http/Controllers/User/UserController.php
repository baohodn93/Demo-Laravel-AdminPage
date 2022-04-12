<?php

namespace App\Http\Controllers\User;

use App\LogActivity;
use App\User;
use Illuminate\Support\Facades\file;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('user.index');
    }

    public function profile_edit()
    {
        // $data = User::get();
        // return view('user.profile',compact('data'));
        $users = Auth::user();
        $data = User::find($users->id);
        return view('user.profile',compact('data'));
    }

    public function profile_edit_post(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'fullname' => 'required',
                'address' => 'required|max:100',
                'phone' => 'required|min:11|max:14',
                'images' => 'image|mimes:png',
            ]
        );
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $users = User::find($id);
            $users->fullname = $request->fullname;
            $users->phone = $request->phone;
            $users->address = $request->address;
            $users->gender = !empty($request->gender) ? $request->gender : 0;

            //check upload images profile
            if (!empty($request->file('images'))) {
                $destination_path = 'images/profile/users/' . $users->images;
                if (file_exists($destination_path)) {
                    unlink($destination_path);
                }
                //upload images profile
                $filename = $request->file('images')->getClientOriginalName();
                $request->file('images')->move('images/profile/users/', $filename);

                $users->images = $filename;
            }
            $Flag = $users->save();
            if ($Flag == true) {
                return back()->with([
                    'flash_level' => 'success',
                    'flash_message' => '情報更新しました。'
                ]);
            } else {
                return back()->with([
                    'flash_level' => 'danger',
                    'flash_message' => '情報更新失敗しました。'
                ]);
            }
        }
    }
}
