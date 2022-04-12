<?php

namespace App\Http\Controllers\Admin;

use App\LogActivity;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    const STATUS_OFF = 0;
    const STATUS_ON = 1;
    //
    public function index()
    {
        $countUsers = DB::table('users')
                    ->where([['role_id','<>',3],['deleted_flg','<>',1],])
                    ->count();
        return view('admin.index', compact('countUsers'));
    }

    public function staff_profile()
    {
        //
        return view('admin.staff.profile');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function staff_update(Request $request)
    {
        //Update information user
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email',
            'address' => 'required|max:100',
            'phone' => 'required|min:11|max:14',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $User = User::find($request->id);
            $User->fullname = $request->fullname;
            $User->email = $request->email;
            $User->phone = $request->phone;
            $User->address = $request->address;

            if (isset($request->password) && $request->password != '') {
                $User->password = bcrypt($request->password);
            }

            $Flag = $User->save();

            if ($Flag == true) {
                return back()->with([
                    'flash_level' => 'success',
                    'flash_message' => '会員更新しました。'
                ]);
            } else {
                return back()->with([
                    'flash_level' => 'danger',
                    'flash_message' => '会員更新失敗しました。'
                ]);
            }
        }
    }

    // Staff managent
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staff_list()
    {
        //
        $listUsers = DB::table('users as a')
            ->join('roles as b', 'a.role_id', '=', 'b.id')
            ->selectRaw('a.id,a.fullname,a.email,a.address,a.phone,a.gender,b.name')
            ->where('a.deleted_flg', '<>', 1)
            ->where('a.role_id', '<>', 3)
            ->get();

        $roles = Role::where([
            ['status', self::STATUS_ON], ['id', '<>', 3],
            ])->get();
        return view('admin.staff.list', compact('listUsers', 'roles'));
    }

    public function staff_add()
    {
        //staff add
        $roles = Role::where('status', self::STATUS_ON)->get();

        return view('admin.staff.add', compact('roles'));
    }

    public function staff_add_post(Request $request)
    {
        //Insert new user
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100|unique:users',
            'username' => 'required|string|max:40|unique:users',
            'password' => 'required|string|min:8|',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = new User;
            $user->role_id = $request->level;
            $user->email = $request->email;
            $user->username = $request->username;
            if (isset($request->password) && $request->password != '') {
                $user->password = bcrypt($request->password);
            }
            $Flag = $user->save();
            // return response()->json($Flag);
            if ($Flag == true) {
                return back()->with([
                    'flash_level' => 'success',
                    'flash_message' => '会員追加しました。'
                ]);
            } else {
                return back()->with([
                    'flash_level' => 'danger',
                    'flash_message' => '会員追加失敗しました。'
                ]);
            }
        }
    }

    public function staff_edit(Request $request, $id)
    {
        //get information user
        // return User::findOrFail($id);
        $users = User::find($id);
        $roles = Role::where([
            ['status', self::STATUS_ON], ['id', '<>', 3],
        ])->get();

        return view('admin.staff.edit', compact('users', 'roles'));
    }

    public function staff_edit_post(Request $request, $id)
    {
        //update information user
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:50',
            'address' => 'required|max:100',
            'phone' => 'required|min:10|max:12',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $User = User::find($id);
            $User->role_id = $request->level;
            $User->status = $request->status;
            $User->fullname = $request->fullname;
            $User->phone = $request->phone;
            $User->address = $request->address;
            $User->gender = !empty($request->gender) ? $request->gender : 0;

            if (isset($request->password) && $request->password != '') {
                $User->password = bcrypt($request->password);
            }
            $User->updated_at = date('Y-m-d H:i:s', strtotime('+9hour'));

            $Flag = $User->save();

            if ($Flag == true) {
                return back()->with([
                    'flash_level' => 'success',
                    'flash_message' => '会員更新しました。'
                ]);
            } else {
                return back()->with([
                    'flash_level' => 'danger',
                    'flash_message' => '会員更新失敗しました。'
                ]);
            }
        }
    }

    /**
     * CSV Export Dowload
     *
     */
    public function csvExport(Request $request)
    {
        // 本来ならここで、CSV出力のパラメータを受け取り、クエリで絞り込む
        $post = $request->all();
        $response = new StreamedResponse(function () use ($request, $post) {
            $stream = fopen('php://output', 'w');
            // 文字化け回避
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
            // ここでは仮に「Users」というテーブルの全データを取得
            $results = DB::table('users')
            ->where([['deleted_flg','<>',1],])
            ->get();
            if (empty($results[0])) {
                fputcsv($stream, [
                    'データが存在しませんでした。',
                ]);
            } else {
                foreach ($results as $row) {
                    fputcsv($stream, $this->_csvRow($row));
                }
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('content-disposition', 'attachment; filename=ユーザ情報一覧.csv');

        return $response;
    }

    /*
    * CSVの１行分のデータ ※本来はコントローラに書かない方が良い
    */
    private function _csvRow($row)
    {
        return [
            $row->id,
            $row->username,
            $row->email,
            $row->phone,
            $row->address,
            $row->fullname,
            $row->role_id,
        ];
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
        $users = User::find($id);
        $users->deleted_flg = 1;
        $Flag = $users->save();

        if ($Flag == true) {
            return back()->with([
                'flash_level' => 'success',
                'flash_message' => '会員削除しました。'
            ]);
        } else {
            return back()->with([
                'flash_level' => 'danger',
                'flash_message' => '会員削除失敗しました。'
            ]);
        }
    }
}
