@extends('admin.template.master')
@section('title', 'Pages')
@section('heading', 'Pages Edit')
@section('page', 'active')
@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card">
        <div class="card-header">
            <a href="{{url('admin/page/list')}}" class="btn btn-primary btn-add">
                {{ __('Back') }}
            </a>
        </div>
        <!-- form start -->
        <form role="form" action="{{url ('admin/page/edit/' .$pages->id) }}" method="POST">
            @csrf
            <!-- Error Message表示 -->
            @include('admin.error')
            <div class="card-body">
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="1" @if($pages->status == 1) selected ="" @endif>
                            Status：On
                        </option>
                        <option value="0" @if($pages->status == 0) selected ="" @endif>
                            Status：Off
                        </option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$pages->id}}">
                <div class="form-group">
                    <label for="pagename" class="color-red">Page Name</label>
                    <input type="text" class="form-control" id="title" name="pagename" value="{{$pages->name}}" onkeyup="ChangeToSlug();">
                </div>
                <div class="form-group">
                    <label for="alias">Alias</label>
                    <input type="text" class="form-control" id="slug" name="alias" value="{{$pages->alias}}">
                </div>
                <div class="form-group">
                    <label for="font">Font</label>
                    <input type="text" class="form-control" name="font" id="font" value="{{$pages->font}}">
                </div>
                <div class="form-group">
                    <label for="sort" class="color-red">Sort</label>
                    <input type="text" class="form-control" name="sort" id="sort" value="{{$pages->sort}}">
                </div>
                <div class="form-group">
                    <label for="metatitle">Meta Title</label>
                    <textarea name="metatitle" rows="2" class="form-control">{{$pages->metatitle}}</textarea>
                </div>
                <div class="form-group">
                    <label for="metadescription">Meta Description</label>
                    <textarea name="metadescription" rows="4" class="form-control">{{$pages->metadescription}}</textarea>
                </div>
                <div class="form-group">
                    <label for="metakeyword">Meta Keyword</label>
                    <textarea name="metakeyword" rows="2" class="form-control">{{$pages->metakeyword}}</textarea>
                </div>
                <div class="form-group">
                    <label for="description" class="color-red">Description</label>
                    <textarea name="description" rows="8" class="form-control" id="ckeditor">{{$pages->description}}</textarea>
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
