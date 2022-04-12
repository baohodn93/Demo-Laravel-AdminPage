@extends('admin.template.master')
@section('title', 'Pages')
@section('heading', 'List Pages')
@section('page', 'active')
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
                            <th>Page Name</th>
                            <th>Arrange</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 一覧表示 -->
                        @if(isset($listPages) && count($listPages) > 0)
                        @foreach($listPages as $k =>$v)
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
                                <a href="{{url ('admin/page/edit/' .$v->id ) }}" title="Edit" class="ad_button" id="btnEdit">
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
@stop
