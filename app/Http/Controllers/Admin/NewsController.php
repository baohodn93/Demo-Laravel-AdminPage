<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\NewsCatalogue;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    //News_catologue management
    public function news_cat_list()
    {
        $listNewsCat = NewsCatalogue::where('status', 1)->get();
        return view('admin.news.cat_list', compact('listNewsCat'));
    }

    public function news_cat_edit($id)
    {
        $newsCat = NewsCatalogue::find($id);
        return view('admin.news.cat_edit', compact('newsCat'));
    }

    public function news_edit_cat_post(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $news = NewsCatalogue::find($id);
            $news->name = $request->name;
            $news->status = $request->status;
            $Flag = $news->save();
            if ($Flag == true) {
                return redirect('admin/news/cat_edit/' . $id)->with([
                    'flash_level' => 'success',
                    'flash_message' => '情報更新しました。'
                ]);
            } else {
                return redirect('admin/news/cat_edit/' . $id)->with([
                    'flash_level' => 'danger',
                    'flash_message' => '情報更新失敗しました。'
                ]);
            }
        }
    }

    //News_list management
    public function news_list()
    {
        $listNews = DB::table('news as N')
            ->join('news_catalogues as NC', 'N.idcat', '=', 'NC.id')
            ->selectRaw('N.*, NC.name as CatalogueName')
            ->orderBy('N.id', 'ASC')
            ->get();
        return view('admin.news.list', compact('listNews'));
    }

    public function news_add()
    {
        $newsCat = NewsCatalogue::get();
        return view('admin.news.add', compact('newsCat'));
    }

    public function news_add_post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'newsname' => 'required',
            'metatitle' => 'required',
            'metadescription' => 'required',
            'metakeyword' => 'required',
            'description' => 'required',
            'images' => 'required|image|mimes:jpg,png,jpeg',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $addNews = new News;
            $addNews->status = $request->status;
            $addNews->alias = $request->alias;
            $addNews->idcat = $request->idcat;
            $addNews->name = $request->newsname;
            $addNews->metatitle = $request->newsname;
            $addNews->metadescription = $request->metadescription;
            $addNews->metakeyword = $request->metakeyword;
            $addNews->smalldescription = $request->smalldescription;
            $addNews->description = $request->description;
            //upload images
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit . '-' . $file->getClientOriginalName();
                $checkFile = strtolower($file->getClientOriginalExtension());

                $file->move('images/news', $name);

                $img = Image::make('images/news/' . $name);
                //Check exists
                $filePath = "images/news/" . date('Ymd');
                if (!file_exists($filePath)) {
                    mkdir("images/news/" . date('Ymd'), 0777, true);
                }
                //delete images upload
                if (file_exists('images/news/' . $name)) {
                    unlink('images/news/' . $name);
                }
                $img->fit(208, 141);
                $img->save('images/news/' . date('Ymd') . '/' . $name);

                $addNews->images = date('Ymd') . '/' . $name;
            }
            $Flag = $addNews->save();
            if ($Flag == true) {
                return back()->with([
                    'flash_level' => 'success',
                    'flash_message' => '情報登録しました。'
                ]);
            } else {
                return back()->with([
                    'flash_level' => 'danger',
                    'flash_message' => '情報登録失敗しました。'
                ]);
            }
        }
    }

    public function news_edit($id)
    {
        $news = News::find($id);
        $newsCat = NewsCatalogue::get();
        return view('admin.news.edit', compact('news', 'newsCat'));
    }

    public function news_edit_post(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'newsname' => 'required',
            'metatitle' => 'required',
            'metadescription' => 'required',
            'metakeyword' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $editNews = News::find($id);
            $editNews->status = $request->status;
            $editNews->alias = $request->alias;
            $editNews->idcat = $request->idcat;
            $editNews->name = $request->newsname;
            $editNews->metatitle = $request->metatitle;
            $editNews->metadescription = $request->metadescription;
            $editNews->metakeyword = $request->metakeyword;
            $editNews->smalldescription = $request->smalldescription;
            $editNews->description = $request->description;
            //upload images
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $random_digit = rand(000000000, 999999999);
                $name = $random_digit . '-' . $file->getClientOriginalName();


                if(!empty($editNews->images)){
                    if(file_exists('images/news/' . $editNews->images)){
                        unlink('images/news/' . $editNews->images);
                    }
                }
                $file->move('images/news', $name);
                $img = Image::make('images/news/' . $name);
                //Check exists
                $filePath = "images/news/" . date('Ymd');
                if (!file_exists($filePath)) {
                    mkdir("images/news/" . date('Ymd'), 0777, true);
                }
                //delete images upload
                if (file_exists('images/news/' . $name)) {
                    unlink('images/news/' . $name);
                }
                $img->fit(208, 141);
                $img->save('images/news/' . date('Ymd') . '/' . $name);

                $editNews->images = date('Ymd') . '/' . $name;
            }
            $Flag = $editNews->save();
            if ($Flag == true) {
                return redirect('admin/news/edit/' . $id)->with([
                    'flash_level' => 'success',
                    'flash_message' => '情報更新しました。'
                ]);
            } else {
                return redirect('admin/news/edit/' . $id)->with([
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
        $news = News::find($id);
        $Flag = $news->delete();

        if ($Flag == true) {
            return redirect('admin/news/list')->with([
                'flash_level' => 'success',
                'flash_message' => '情報削除しました。'
            ]);
        } else {
            return redirect('admin/news/list')->with([
                'flash_level' => 'danger',
                'flash_message' => '情報削除失敗しました。'
            ]);
        }
    }
}
