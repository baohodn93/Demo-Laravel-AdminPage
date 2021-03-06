<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    //
    public function slider_list()
    {
        $listSliders = Slider::get();
        return view('admin.slider.list', compact('listSliders'));
    }

    public function slider_add_post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slider_name' => 'required|max:50',
            'images' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/slider/edit/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $sliders = new Slider;
            $sliders->name = $request->slider_name;
            $sliders->alias = $request->alias;
            $sliders->status = $request->status;
            //upload images
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit . '-' . $file->getClientOriginalName();

                $file->move('images/slider', $name);

                $img = Image::make('images/slider/' . $name);
                //Check exists
                $filePath = "images/slider/" . date('Ymd');
                if (!file_exists($filePath)) {
                    mkdir("images/slider/" . date('Ymd'), 0777, true);
                }
                //delete images upload
                if (file_exists('images/slider/' . $name)) {
                    unlink('images/slider/' . $name);
                }
                $img->save('images/slider/' . date('Ymd') . '/' . $name);

                $sliders->images = date('Ymd') . '/' . $name;
            }
            $Flag = $sliders->save();
            if ($Flag == true) {
                return back()->with([
                    'flash_level' => 'success',
                    'flash_message' => '??????????????????????????? '
                ]);
            } else {
                return back()->with([
                    'flash_level' => 'danger',
                    'flash_message' => '?????????????????????????????????'
                ]);
            }
        }
    }
}
