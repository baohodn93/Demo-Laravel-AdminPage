@extends('admin.template.master')
@section('title', 'システム構成')
@section('heading', 'システム構成')
@section('system', 'active')
@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">システム構成</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" action="{{url ('admin/system') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- Error Message表示 -->
                @include('admin.error')
                <div class="form-group">
                    <label for="name" class="color-red">Company</label>
                    <input type="text" class="form-control" name="name" value="{{$name->Description}}">
                </div>
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <img src="{{url('images/logo/' .$logo->Description)}}" alt="Logo">
                    <input type="file" class="form-control" name="logo">
                </div>
                <div class="form-group">
                    <label for="favicon">Favicon</label>
                    <img src="{{url('images/favicon/' .$favicon->Description)}}" alt="Favicon">
                    <input type="file" class="form-control" name="favicon">
                </div>
                <div class="form-group">
                    <label for="email" class="color-red">Email</label>
                    <input type="email" class="form-control" name="email" value="{{$email->Description}}">
                </div>
                <div class="form-group">
                    <label for="phone" class="color-red">Phone</label>
                    <input type="text" class="form-control" name="phone" value="{{$phone->Description}}">
                </div>
                <div class="form-group">
                    <label for="address" class="color-red">Address</label>
                    <input type="text" class="form-control" name="address" value="{{$address->Description}}">
                </div>
                <div class="form-group">
                    <label for="copyright" class="color-red">Copyright</label>
                    <input type="text" class="form-control" name="copyright" value="{{$copyright->Description}}">
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
