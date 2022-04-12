@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile Edit') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{url('user/profile/edit/' .Auth::user()->id)}}" enctype="multipart/form-data">
                        @csrf
                        <!-- Error Message 表示 -->
                        @include('admin.error')
                        <!-- Successfully 表示-->
                        <div class="col-sm-12">
                            @if(Session::has('flash_message'))
                            <div class="ad_message alert alert-{!! Session::get('flash_level') !!}">
                                {!! Session::get('flash_message')!!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="fullname" type="text" class="form-control" name="fullname" value="{{$data->fullname}}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$data->phone}}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{$data->address}}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6" style="padding-top:5px;">
                                <div class="form-check-inline">
                                    <input id="male" type="radio" name="gender" class="form-check-input" value="1">
                                    <label for="male" class="form-check-label">Male</label>
                                </div>
                                <div class="form-check-inline">
                                    <input id="male" type="radio" name="gender" class="form-check-input" value="2">
                                    <label for="female" class="form-check-label">Female</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="images" class="col-md-4 col-form-label text-md-right" alt="Images">{{ __('Avatar') }}</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control" name="images">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('更新') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
