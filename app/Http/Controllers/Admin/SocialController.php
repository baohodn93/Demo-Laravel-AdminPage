<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Social;
use Illuminate\Support\Facades\Validator;

class SocialController extends Controller
{
    //
    public function social_list()
    {
        $listSocials = Social::get();
        return view('admin.social.list', compact('listSocials'));
    }
    //
    public function social_edit($id)
    {
        $socials = Social::find($id);
        return view('admin.social.edit', compact('socials'));
    }
    //
    public function social_edit_post(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'socialname' => 'required|max:50',
            'font' => 'required',
            'sort' => 'required|max:2',
        ]);
        if ($validator->fails()) {
            return redirect('admin/social/edit/' .$id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $socials = Social::find($id);
            $socials->status = $request->status;
            $socials->name = $request->socialname;
            $socials->alias = $request->alias;
            $socials->font = $request->font;
            $socials->sort = $request->sort;
            $Flag = $socials->save();
            if ($Flag == true) {
                return redirect('admin/social/edit/' . $id)->with([
                    'flash_level' => 'success',
                    'flash_message' => '情報更新しました。 '
                ]);
            } else {
                return redirect('admin/social/edit/' . $id)->with([
                    'flash_level' => 'danger',
                    'flash_message' => '情報更新失敗しました。'
                ]);
            }
        }
    }

    public function social_add_post(Request $request){
        $validator = Validator::make($request->all(), [
            'socialname' => 'required|max:50',
            'font' => 'required',
            'sort' => 'required|max:2',
        ]);
        if ($validator->fails()) {
            return redirect('admin/social/list')
                ->withErrors($validator)
                ->withInput();
        } else {
            $socials = new Social;
            $socials->status = $request->status;
            $socials->name = $request->socialname;
            $socials->alias = $request->alias;
            $socials->font = $request->font;
            $socials->sort = $request->sort;

            $Flag = $socials->save();
            if ($Flag == true) {
                return redirect('admin/social/list')->with([
                    'flash_level' => 'success',
                    'flash_message' => '情報登録しました。 '
                ]);
            } else {
                return redirect('admin/social/list')->with([
                    'flash_level' => 'danger',
                    'flash_message' => '情報登録失敗しました。'
                ]);
            }
        }

    }
}
