@extends('admin.template.master')
@section('title', 'News')
@section('heading', 'Newsletter Add')
@section('list', 'active')
@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card">
        <div class="card-header">
            <a href="{{url('admin/news/list')}}" class="btn btn-primary btn-add">
                {{ __('Back') }}
            </a>
        </div>
        <!-- form start -->
        <form role="form" action="{{url ('admin/news/add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Error Message表示 -->
            @include('admin.error')
            <div class="card-body">
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="1">
                            Status：On
                        </option>
                        <option value="0">
                            Status：Off
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="idcat">
                        @if(isset($newsCat) && count($newsCat) >0)
                        @foreach($newsCat as $k=>$v)
                        <option value="{{$v->id}}">
                            Catalogue：{{$v->name}}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="newsname" class="color-red">News Name</label>
                    <input type="text" class="form-control" id="title" name="newsname" value="{{ old('newsname') }}" onkeyup="ChangeToSlug();">
                </div>
                <div class="form-group">
                    <label for="alias">Alias</label>
                    <input type="text" class="form-control" id="slug" name="alias" value="{{ old('alias') }}">
                </div>
                <div class="form-group">
                    <label for="metatitle">Meta Title</label>
                    <textarea name="metatitle" rows="2" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="metadescription">Meta Description</label>
                    <textarea name="metadescription" rows="4" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="metakeyword">Meta Keyword</label>
                    <textarea name="metakeyword" rows="2" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="smalldescription">Small Description</label>
                    <textarea name="smalldescription" rows="3" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="images" class="color-red">Imgaes</label>
                    <input type="file" class="form-control" name="images">
                </div>
                <div class="form-group">
                    <label for="description" class="color-red">Description</label>
                    <textarea name="description" rows="8" class="form-control" id="ckeditor"></textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('登録') }}</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>

@stop
