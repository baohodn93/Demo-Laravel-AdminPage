@extends('admin.template.master')
@section('title', '会員管理')
@section('heading', '会員一覧')
@section('content')


<style>
    input[type=text],
    [type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100px;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    .modal {
        display: none;
        padding-top: 150px;
        /* Location of the box */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        border-radius: 5px;
        margin: auto;
        border: 3px solid #f1f1f1;
        width: 400px;
    }

    /* .modal-content h1 {
        text-align: center;
        padding: 20px;
    } */

    .btn-add,
    .btn-edit {
        margin-top: 10px;
    }
</style>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <button type="submit" class="btn btn-primary btn-add" id="btnAdd" class="btn btn-success" data-toggle="modal" data-target="#addModal">
                {{ __('New User') }}
            </button>
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                    <thead>
                        <tr>
                            <!-- <th style="width: 10px;"></th> -->
                            <th style="width: 10px;">ID</th>
                            <th>Full Name</th>
                            <th>Authority</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 一覧表示 -->
                        @if(isset($listUsers) && count($listUsers) > 0)
                        @foreach($listUsers as $k =>$v)
                        <tr>
                            <!-- <td><input type="checkbox" name="my-checkbox" id="opt-in"></td> -->
                            <td>{{$k+1}}</td>
                            <td>{{$v->fullname}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->email}}</td>
                            <td>{{$v->address}}</td>
                            <td>{{$v->phone}}</td>
                            <?php
                            $arrgendertype = ['0' => '未', '1' => '男', '2' => '女'];
                            ?>
                            <td>
                                <?php
                                if (array_key_exists($v->gender, $arrgendertype)) {
                                    echo $arrgendertype[$v->gender] . '<br />';
                                }
                                ?>
                            </td>
                            <td>
                                <!-- <a href="javascript:void(0)" class="btn btn-success edit-btn" data-toggle="modal" data-target="#editModal" data-id="{{ $v->id }}">Edit </a>
                                <a href="{{url ('admin/staff/delete/' .$v->id ) }}" title="削除" class="btn btn-danger delete-user">Delete</a> -->
                                <a href="{{url ('admin/staff/edit/' .$v->id ) }}" title="Edit" class="ad_button" id="btnEdit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{url ('admin/staff/delete/' .$v->id ) }}" title="Delete" class="ad_button ad_button_delete" style="color:red;">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div>
                <!-- Csv Export -->
                <form action="{{url ('admin/staff/csv-export') }}" method="GET">
                    @csrf
                    <input type="submit" class="btn btn-primary csv-export" value="CSV出力" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal add user -->
<div class="modal" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">会員登録</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="{{url ('admin/staff/add') }}" method="POST">
                    @csrf
                    <!-- Error Message表示 -->
                    @include('admin.error')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" name="level">
                                    @if(isset($roles) && count($roles) > 0)
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">Level {{$role->id}}：{{$role->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="username" class="color-red">User Name</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="color-red">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email" class="color-red">Email</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">{{ __('登録') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
