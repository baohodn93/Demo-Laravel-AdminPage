@extends('admin.template.master')
@section('title', 'News')
@section('heading', 'Newsletter Edit')
@section('catalogue', 'active')
@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card">
        <div class="card-header">
            <a href="{{url('admin/news/cat_list')}}" class="btn btn-primary btn-add">
                {{ __('Back') }}
            </a>
        </div>
        <!-- form start -->
        <form role="form" action="{{url ('admin/news/cat_edit/' .$newsCat->id) }}" method="POST">
            @csrf
            <!-- Error Message表示 -->
            @include('admin.error')
            <div class="card-body">
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="1" @if($newsCat->status == 1) selected ="" @endif>
                            Status：Viewed
                        </option>
                        <option value="0" @if($newsCat->status == 0) selected ="" @endif>
                            Status：Un Viewed
                        </option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$newsCat->id}}">
                <div class="form-group">
                    <label for="name" class="color-red">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$newsCat->name}}">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('変更') }}</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>

@stop
