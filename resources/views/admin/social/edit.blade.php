@extends('admin.template.master')
@section('title', 'Social Edit')
@section('heading', 'Social Edit')
@section('social', 'active')
@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card">
        <div class="card-header">
            <a href="{{url('admin/social/list')}}" class="btn btn-primary btn-add">
                {{ __('Back') }}
            </a>
        </div>
        <!-- form start -->
        <form role="form" action="{{url ('admin/social/edit/' .$socials->id) }}" method="POST">
            @csrf
            <!-- Error Message表示 -->
            @include('admin.error')
            <div class="card-body">
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="1" @if($socials->status == 1) selected ="" @endif>
                            Status：On
                        </option>
                        <option value="0" @if($socials->status == 0) selected ="" @endif>
                            Status：Off
                        </option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$socials->id}}">
                <div class="form-group">
                    <label for="socialname" class="color-red">Social Name</label>
                    <input type="text" class="form-control" name="socialname" id="socialname" value="{{$socials->name}}">
                </div>
                <div class="form-group">
                    <label for="font" class="color-red">Font</label>
                    <input type="text" class="form-control" name="font" id="font" value="{{$socials->font}}">
                </div>
                <div class="form-group">
                    <label for="sort" class="color-red">Arrange</label>
                    <input type="text" class="form-control" name="sort" id="sort" value="{{$socials->sort}}">
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
