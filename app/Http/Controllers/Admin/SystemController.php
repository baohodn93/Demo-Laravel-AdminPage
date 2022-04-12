<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\file;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\System;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class SystemController extends Controller
{
    //
    // System managent
    public function getInfoSystem()
    {
        $name = System::where('Status', 1)->where('Code', 'name')->first();
        $email = System::where('Status', 1)->where('Code', 'email')->first();
        $logo = System::where('Status', 1)->where('Code', 'logo')->first();
        $favicon = System::where('Status', 1)->where('Code', 'favicon')->first();
        $phone = System::where('Status', 1)->where('Code', 'phone')->first();
        $address = System::where('Status', 1)->where('Code', 'address')->first();
        $copyright = System::where('Status', 1)->where('Code', 'copyright')->first();
        return view('admin.system.system', compact(
            'name',
            'email',
            'logo',
            'favicon',
            'phone',
            'address',
            'copyright'
        ));
    }

    public function updateSystem(Request $request)
    {
        //Update information system
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'address' => 'required|max:100',
            'phone' => 'required|min:10|max:14',
            'copyright' => 'required|max:100',
            'logo' => 'image|mimes:png',
        ]);
        if ($validator->fails()) {
            return redirect('admin/system')
                ->withErrors($validator)
                ->withInput();
        } else {
            System::where('Status', 1)
                ->where('Code', 'name')
                ->update(['Description' =>  $request->name]);

            System::where('Status', 1)
                ->where('Code', 'email')
                ->update(['Description' =>  $request->email]);

            System::where('Status', 1)
                ->where('Code', 'phone')
                ->update(['Description' =>  $request->phone]);

            System::where('Status', 1)
                ->where('Code', 'address')
                ->update(['Description' =>  $request->address]);

            System::where('Status', 1)
                ->where('Code', 'copyright')
                ->update(['Description' =>  $request->copyright]);

            //check upload images logo
            if (!empty($request->file('logo'))) {
                $logo = System::where('Status', 1)
                    ->where('Code', 'logo')
                    ->first();
                $destination_path = 'images/logo/' . $logo->Description;
                if (File::exists($destination_path)) {
                    File::delete($destination_path);
                }
                //upload images
                $filename = $request->file('logo')->getClientOriginalName();
                $request->file('logo')->move('images/logo/', $filename);

                $logo->Description = $filename;
                $logo->save();
            }
            //check upload favicon logo
            if (!empty($request->file('favicon'))) {
                $favicon = System::where('Status', 1)
                    ->where('Code', 'favicon')
                    ->first();
                $this->validate($request, [
                    'image' => 'image|mimes:png,'
                ]);
                $destination_path = 'images/favicon/' . $favicon->Description;
                if (File::exists($destination_path)) {
                    File::delete($destination_path);
                }
                //upload favicon
                $filename = $request->file('favicon')->getClientOriginalName();
                $request->file('favicon')->move('images/favicon/', $filename);

                $favicon->Description = $filename;
                $favicon->save();
            }
            return redirect('admin/system')->with([
                'flash_level' => 'success',
                'flash_message' => 'システム情報更新しました。'
            ]);
        }
    }
}
