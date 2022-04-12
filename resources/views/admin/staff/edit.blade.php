@extends('admin.template.master')
@section('title', '会員情報管理')
@section('heading', '会員情報修正')
@section('system', 'active')
@section('content')

<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">会員情報修正</h3>
        </div>
        <!-- form start -->
        <form role="form" action="{{url ('admin/staff/edit/' .$users->id) }}" method="POST">
            @csrf
            <!-- Error Message表示 -->
            @include('admin.error')
            <div class="card-body">
                <div class="form-group">
                    <select class="form-control" name="level">
                        @if(isset($roles) && count($roles) > 0)
                        @foreach($roles as $k =>$v)
                        <option value="{{$v->id}}">
                            Level {{$v->id}}：{{$v->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="1" @if($users->status == 1) selected ="" @endif>
                            Status：On
                        </option>
                        <option value="0" @if($users->status == 0) selected ="" @endif>
                            Status：Off
                        </option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$users->id}}">
                <div class="form-group">
                    <label for="fullname" class="color-red">Full Name</label>
                    <input type="text" class="form-control" name="fullname" id="fullname" value="{{$users->fullname}}">
                </div>
                <div class="form-group">
                    <label for="email" class="color-red">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{$users->email}}">
                </div>
                <div class="form-group">
                    <label for="phone" class="color-red">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{$users->phone}}">
                </div>
                <div class="form-group">
                    <label for="address" class="color-red">Adrress</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{$users->address}}">
                </div>
                <div class="form-group">
                    <label for="gender" style="padding-right:30px;">Gender</label>
                    <input id="male" type="radio" name="gender" value="1">
                    <label for="male" style="padding-right:10px;">Male</label>
                    <input id="female" type="radio" name="gender" value="2">
                    <label for="female">Female</label>
                </div>
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" name="username" id="username" value="{{$users->username}}" disabled="">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <p class="ad_note_password">パスワード変更しない場合、空白のままにしてください。</p>
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
