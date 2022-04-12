@extends('admin.template.master')
@section('title', 'Home Admin')
@if(Auth::user()->role_id == 1)
@section('heading', 'Wellcome Admin')
@else
@section('heading', 'Wellcome Seo')
@endif
@section('dashboard', 'active')

@section('content')
@if(Auth::user()->role_id == 1)
<!-- Order View -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$countUsers}}</sup></h3>

                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('admin/staff/list')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@endif
@stop
