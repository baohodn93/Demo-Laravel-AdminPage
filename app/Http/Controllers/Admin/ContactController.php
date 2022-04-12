<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //Contact management
    public function contact_list()
    {
        $listContacts = Contact::get();

        return view('admin.contact.list', compact('listContacts'));
    }

    public function contact_edit($id)
    {
        $contacts = Contact::find($id);
        return view('admin.contact.edit', compact('contacts'));
    }

    public function contact_edit_post(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/contact/edit/' . $id)
                ->withErrors($validator)
                ->withInput();
        } else {
            $contacts = Contact::find($id);
            $contacts->name = $request->name;
            $contacts->phone = $request->phone;
            $contacts->email = $request->email;
            $contacts->isviews = $request->status;
            $Flag = $contacts->save();
            if ($Flag == true) {
                return redirect('admin/contact/edit/' . $id)->with([
                    'flash_level' => 'success',
                    'flash_message' => '情報更新しました。'
                ]);
            } else {
                return redirect('admin/contact/edit/' . $id)->with([
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
        $contacts = Contact::find($id);
        $Flag = $contacts->delete();

        if ($Flag == true) {
            return redirect('admin/contact/list')->with([
                'flash_level' => 'success',
                'flash_message' => '情報削除しました。'
            ]);
        } else {
            return redirect('admin/contact/list')->with([
                'flash_level' => 'danger',
                'flash_message' => '情報削除失敗しました。'
            ]);
        }
    }
}
