@extends('admin.template.master')
@section('title', 'News')
@section('heading', 'List NewsLetter')
@section('list', 'active')
@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{url ('admin/news/add') }}" title="New news" class="btn btn-primary btn-add" id="btnAdd" class="btn btn-success">
            New News</a>
        </div>
        <div class="card-body">
            <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                    <thead>
                        <tr>
                            <!-- <th style="width: 10px;"></th> -->
                            <th style="width: 10px;">ID</th>
                            <th>News Name</th>
                            <th>In The Catalogue</th>
                            <th>Status</th>
                            <th>Avarta</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 一覧表示 -->
                        @if(isset($listNews) && count($listNews) > 0)
                        @foreach($listNews as $k =>$v)
                        <tr>
                            <!-- <td><input type="checkbox" name="my-checkbox" id="opt-in"></td> -->
                            <td>{{$k+1}}</td>
                            <td>{{$v->name}}</td>
                            <td>{{$v->CatalogueName}}</td>
                            <td>
                                @if($v->status == 1)
                                On
                                @else
                                Off
                                @endif
                            </td>
                            <td>
                                @if(!empty($v->images))
                                <img src="{{url('images/news/' .$v->images)}}" alt="Avartar">
                                @endif
                            </td>
                            <td>
                                <a href="{{url ('admin/news/edit/' .$v->id ) }}" title="Edit" class="ad_button" id="btnEdit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{url ('admin/news/delete/' .$v->id ) }}" title="Delete" class="ad_button ad_button_delete" style="color:red;">
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
