@extends('common')
@section('title', 'Home')
@section('description', '')
@section('keywords', '')
@section('url', url('/'))
@section('images', url('/'))
@section('content')

<div class="home_page">
    <div class="slider_wrap">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @if(isset($listSilders) && count($listSilders) > 0)
                @foreach ($listSilders as $k =>$v)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$v->sort}}" class="active"></li>
                @endforeach
                @endif
            </ol>
            <div class="carousel-inner">
                @if(isset($listSilders) && count($listSilders) > 0)
                @foreach ($listSilders as $k =>$v)
                @if($v->sort == 0)
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{url('images/slider/' .$v->images)}}">
                </div>
                @else
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{url('images/slider/' .$v->images)}}">
                </div>
                @endif
                @endforeach
                @endif
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="home_top">
                    <div class="home_top_left">
                        <div class="heading">
                            News Blog
                        </div>
                        <ul>
                            @if(isset($listNews) && count($listNews) > 0)
                            @foreach($listNews as $k => $v)
                            <li>
                                <a href="{{url('/' .$v->alias)}}.html" title="{{$v->name}}">
                                    <img src="{{url('images/news/' .$v->images)}}" alt="{{$v->name}}">
                                    <b>{{$v->name}}</b>
                                    <p>{{ Str::limit($v->smalldescription, $limit = 100, $end = '...') }}
                                        <span>[Read More]</span>
                                    </p>
                                </a>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="home_top_right">
                        <div class="heading">
                            About
                        </div>
                        <img src="{{url('images/profile/home/home.jpg')}}" alt="About" />
                        <b>Bao&Anh Wedding 2018
                        </b>
                        <p>
                            <span>2013から付き合った。</span> <a href="">[Read More]</a>
                        </p>
                        <div class="home_social">
                            @if(isset($socials) && count($socials) > 0)
                            @foreach($socials as $k => $v)
                            <a href="{{$v->class_alias}}" title="{{$v->name}}">
                                {!!$v->font!!}
                            </a>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="heading" style="margin-top: 55px; color:#fff">
                    News Sale
                </div>
            </div>
            @if(isset($listNewsSale) && count($listNewsSale) > 0)
            @foreach($listNewsSale as $k => $v)
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="home_center">
                    <a href="{{url('/' .$v->alias)}}.html" title="{{$v->name}}">
                        <img src="{{url('images/news/' .$v->images)}}" alt="{{$v->name}}">
                        <b>{{$v->name}}</b>
                        <p>{{ Str::limit($v->smalldescription, $limit = 100, $end = '...') }}
                            <span>[Read More]</span>
                        </p>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="home_bottom">
                    <div class="heading">
                        Blog Most View
                    </div>
                    <ul>
                            @if(isset($listNewsViews) && count($listNewsViews) > 0)
                            @foreach($listNewsViews as $k => $v)
                            <li>
                            <a href="{{url('/' .$v->alias)}}.html" title="{{$v->name}}">
                                <img src="{{url('images/news/' .$v->images)}}" alt="{{$v->name}}">
                                <b>{{$v->name}}</b>
                                <p>{{ Str::limit($v->smalldescription, $limit = 100, $end = '...') }}
                                    <span>[Read More]</span>
                                </p>
                            </a>
                            </li>
                            @endforeach
                            @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop
