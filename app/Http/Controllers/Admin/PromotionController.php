<?php

namespace App\Http\Controllers\Admin;

use App\Models\Promotion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    //Promotion management
    public function promotion_list()
    {
        $listPromotions = Promotion::get();

        return view('admin.promotion.list', compact('listPromotions'));
    }

    public function promotion_edit($id)
    {
        $promotions = promotion::find($id);
        return view('admin.promotion.edit', compact('promotions'));
    }

    public function promotion_edit_post(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/promotion/edit/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $promotions = Promotion::find($id);
            $promotions->email = $request->email;
            $promotions->isviews = $request->status;
            $Flag = $promotions->save();
            if ($Flag == true) {
                return redirect('admin/promotion/edit/' . $id)->with([
                    'flash_level' => 'success',
                    'flash_message' => '情報更新しました。'
                ]);
            } else {
                return redirect('admin/promotion/edit/' . $id)->with([
                    'flash_level' => 'danger',
                    'flash_message' => '情報更新失敗しました。'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $promotions = Promotion::find($id);
        $Flag = $promotions->delete();

        if ($Flag == true) {
            return redirect('admin/promotion/list')->with([
                'flash_level' => 'success',
                'flash_message' => '情報削除しました。'
            ]);
        } else {
            return redirect('admin/promotion/list')->with([
                'flash_level' => 'danger',
                'flash_message' => '情報削除失敗しました。'
            ]);
        }
    }
}
