@extends('admin.template.master')
@section('title', 'Social')
@section('heading', 'List Social')
@section('social', 'active')
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

    .btn-add,
    .btn-edit {
        margin-top: 10px;
    }
</style>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <button type="submit" class="btn btn-primary btn-add" id="btnAdd" class="btn btn-success" data-toggle="modal" data-target="#addModal">
                {{ __('New Social') }}
            </button>
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                    <thead>
                        <tr>
                            <!-- <th style="width: 10px;"></th> -->
                            <th style="width: 10px;">ID</th>
                            <th>Page Name</th>
                            <th>Arrange</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 一覧表示 -->
                        @if(isset($listSocials) && count($listSocials) > 0)
                        @foreach($listSocials as $k =>$v)
                        <tr>
                            <!-- <td><input type="checkbox" name="my-checkbox" id="opt-in"></td> -->
                            <td>{{$k+1}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->sort}}</td>
                            <td>
                                @if($v->status == 1)
                                on
                                @else
                                Off
                                @endif
                            </td>
                            <td>
                                <a href="{{url ('admin/social/edit/' .$v->id ) }}" title="Edit" class="ad_button" id="btnEdit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- modal add user -->
<div class="modal" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">New Social</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="{{url ('admin/social/add') }}" method="POST">
                    <!-- <form id="staffAdd"> -->
                    @csrf
                    <!-- Error Message表示 -->
                    @include('admin.error')
                    <div class="row">
                    <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" name="status">
                                    <option value="1">Status：On</option>
                                    <option value="0">Status：Off</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="socialname" class="color-red">Social Name</label>
                                <input type="text" class="form-control" name="socialname">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="font" class="color-red">Font</label>
                                <input type="text" class="form-control" name="font">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sort" class="color-red">Sort</label>
                                <input type="text" class="form-control" name="sort">
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
</div>
@stop
