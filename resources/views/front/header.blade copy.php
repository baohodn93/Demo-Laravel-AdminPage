<!-- <div class="header">
    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="header_logo">
                        <a href="{{url('/')}}" title="Home">
                            <img src="{{url('images/logo/' .$logo->Description)}}" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="header_social">
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
</div> -->
<div class="header_content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-12">
                <div class="float-sm-right">
                    <ul>
                        <a href="#"><i class="far fa-heart" title="お気に入り"></i></a>
                        @if (Route::has('login'))
                        @auth
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                        <li class="nav-item active"><a href="{{ url('/admin/dashboard') }}" class="nav-link active"><i class="fas fa-home">Home</i></a></li>
                        @else
                        <li class="nav-item active"><a href="{{ url('/user/dashboard') }}" class="nav-link active"><i class="fas fa-home">Home</i></a></li>
                        @endif
                        @else
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                        @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header_bottom">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-9">
                <div class="header_menu">
                    <ul>
                        @if(isset($pages) && count($pages) > 0)
                        @foreach($pages as $k =>$v)
                        <li>
                            @if($v->alias == '/')
                            <a href="{{url('/')}}" title="{{$v->name}}" class="active">
                                {!!$v->font!!}
                            </a>
                            @else
                            <a href="{{'/' .$v->alias}}" title="{{$v->name}}">
                                {{$v->name}}
                            </a>
                            @endif
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-3">
                <div class="header_search">
                    <input type="text" id="btnSearch" placeholder="Search">
                    <button><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
