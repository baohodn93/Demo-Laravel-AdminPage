@extends('admin.template.master')
@section('title', 'Slider')
@section('heading', 'Slider Edit')
@section('slider', 'active')
@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card">
        <div class="card-header">
            <a href="{{url('admin/slider/list')}}" class="btn btn-primary btn-add">
                {{ __('Back') }}
            </a>
        </div>
        <!-- form start -->
        <form role="form" action="{{url ('admin/slider/edit/' .$sliders->id) }}" method="POST">
            @csrf
            <!-- Error Message表示 -->
            @include('admin.error')
            <div class="card-body">
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="1" @if($sliders->status == 1) selected ="" @endif>
                            Status：On
                        </option>
                        <option value="0" @if($sliders->status == 0) selected ="" @endif>
                            Status：Off
                        </option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$sliders->id}}">
                <div class="form-group">
                    <label for="name" class="color-red">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$sliders->name}}">
                </div>
                <div class="form-group">
                    <label for="images">Images</label>
                    </br>
                    @if(!empty($sliders->images))
                    <img style="width: 520px;" src="{{url('images/slider/' .$sliders->images) }}" alt="images">
                    @endif
                    <input type="file" class="form-control" name="images">
                </div>
                <div class="form-group">
                    <label for="sort" class="color-red">Arrange</label>
                    <input type="text" class="form-control" name="sort" id="sort" value="{{$sliders->sort}}">
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
