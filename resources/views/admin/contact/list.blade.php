@extends('admin.template.master')
@section('title', 'Contact')
@section('heading', 'List Contact')
@section('contact', 'active')
@section('content')


<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                    <thead>
                        <tr>
                            <!-- <th style="width: 10px;"></th> -->
                            <th style="width: 10px;">ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 一覧表示 -->
                        @if(isset($listContacts) && count($listContacts) > 0)
                        @foreach($listContacts as $k =>$v)
                        <tr>
                            <!-- <td><input type="checkbox" name="my-checkbox" id="opt-in"></td> -->
                            <td>{{$k+1}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->email}}</td>
                            <td>{{$v->message}}</td>
                            <td>
                                @if($v->isviews == 1)
                                <span style="color: red;">Viewed</span>
                                @else
                                <span style="color: green;">Un Viewed</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{url ('admin/contact/edit/' .$v->id ) }}" title="Edit" class="ad_button" id="btnEdit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{url ('admin/contact/delete/' .$v->id ) }}" title="Delete" class="ad_button ad_button_delete" style="color:red;">
                                    <i class="fas fa-trash-alt"></i>
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
@stop
