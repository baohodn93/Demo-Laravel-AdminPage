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
    //
    public function slider_edit($id)
    {
        $sliders = Slider::find($id);
        return view('admin.slider.edit', compact('sliders'));
    }
    //
    public function slider_edit_post(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
        ]);
        if ($validator->fails()) {
            return redirect('admin/slider/edit/' .$id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $sliders = Slider::find($id);
            $sliders->status = $request->status;
            $sliders->name = $request->name;
            $sliders->sort = $request->sort;
            $Flag = $sliders->save();
            if ($Flag == true) {
                return redirect('admin/slider/edit/' . $id)->with([
                    'flash_level' => 'success',
                    'flash_message' => '情報更新しました。 '
                ]);
            } else {
                return redirect('admin/slider/edit/' . $id)->with([
                    'flash_level' => 'danger',
                    'flash_message' => '情報更新失敗しました。'
                ]);
            }
        }
    }

    public function slider_add_post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'slider_name' => 'required|max:50',
            'images' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/slider/list')
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
                    'flash_message' => '情報登録しました。 '
                ]);
            } else {
                return back()->with([
                    'flash_level' => 'danger',
                    'flash_message' => '情報登録失敗しました。'
                ]);
            }
        }
    }
}
