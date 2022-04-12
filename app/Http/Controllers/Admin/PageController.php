<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    //Page management
    public function page_list()
    {
        $listPages = Page::get();
        return view('admin.page.list', compact('listPages'));
    }

    public function page_edit($id)
    {
        $pages = Page::find($id);
        return view('admin.page.edit', compact('pages'));
    }

    public function page_edit_post(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pagename' => 'required|max:50',
            'sort' => 'required|max:2',
        ]);
        if ($validator->fails()) {
            return redirect('admin/page/edit/' .$id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $pages = Page::find($id);
            $pages->status = $request->status;
            $pages->alias = $request->alias;
            $pages->name = $request->pagename;
            $pages->font = $request->font;
            $pages->sort = $request->sort;
            $pages->metatitle = $request->metatitle;
            $pages->metadescription = $request->metadescription;
            $pages->metakeyword = $request->metakeyword;
            $pages->description = $request->description;
            $Flag = $pages->save();
            if ($Flag == true) {
                return redirect('admin/page/edit/' . $id)->with([
                    'flash_level' => 'success',
                    'flash_message' => '情報更新しました。'
                ]);
            } else {
                return redirect('admin/page/edit/' . $id)->with([
                    'flash_level' => 'danger',
                    'flash_message' => '情報更新失敗しました。'
                ]);
            }
        }
    }
}
