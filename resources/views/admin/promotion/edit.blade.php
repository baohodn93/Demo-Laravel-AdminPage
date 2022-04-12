@extends('admin.template.master')
@section('title', 'Promotion')
@section('heading', 'Promotion Edit')
@section('promotion', 'active')
@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card">
        <div class="card-header">
            <a href="{{url('admin/promotion/list')}}" class="btn btn-primary btn-add">
                {{ __('Back') }}
            </a>
        </div>
        <!-- form start -->
        <form role="form" action="{{url ('admin/promotion/edit/' .$promotions->id) }}" method="POST">
            @csrf
            <!-- Error Message表示 -->
            @include('admin.error')
            <div class="card-body">
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="1" @if($promotions->isviews == 1) selected ="" @endif>
                            Status：Viewed
                        </option>
                        <option value="0" @if($promotions->isviews == 0) selected ="" @endif>
                            Status：Un Viewed
                        </option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$promotions->id}}">
                <div class="form-group">
                    <label for="email" class="color-red">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="{{$promotions->email}}">
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
