@extends('admin.template.master')
@section('title', 'News')
@section('heading', 'Newsletter Edit')
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
        <form role="form" action="{{url ('admin/news/edit/' .$news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Error Message表示 -->
            @include('admin.error')
            <div class="card-body">
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="1" @if($news->status == 1) selected ="" @endif>
                            Status：On
                        </option>
                        <option value="0" @if($news->status == 0) selected ="" @endif>
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
                    <input type="text" class="form-control" id="title" name="newsname" value="{{$news->name}}" onkeyup="ChangeToSlug();">
                </div>
                <div class="form-group">
                    <label for="alias">Alias</label>
                    <input type="text" class="form-control" id="slug" name="alias" value="{{$news->alias}}">
                </div>
                <div class="form-group">
                    <label for="images">Images</label>
                    </br>
                    @if(!empty($news->images))
                    <img src="{{url('images/news/' .$news->images) }}" alt="images">
                    @endif
                    <input type="file" class="form-control" name="images">
                </div>
                <div class="form-group">
                    <label for="metatitle" class="color-red">Meta Title</label>
                    <textarea name="metatitle" rows="2" class="form-control">{{$news->metatitle}}</textarea>
                </div>
                <div class="form-group">
                    <label for="metadescription" class="color-red">Meta Description</label>
                    <textarea name="metadescription" rows="4" class="form-control">{{$news->metadescription}}</textarea>
                </div>
                <div class="form-group">
                    <label for="metakeyword" class="color-red">Meta Keyword</label>
                    <textarea name="metakeyword" rows="2" class="form-control">{{$news->metakeyword}}</textarea>
                </div>
                <div class="form-group">
                    <label for="smalldescription">Small Description</label>
                    <textarea name="smalldescription" rows="3" class="form-control">{{$news->smalldescription}}</textarea>
                </div>
                <div class="form-group">
                    <label for="description" class="color-red">Description</label>
                    <textarea name="description" rows="8" class="form-control" id="ckeditor">{{$news->description}}</textarea>
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
