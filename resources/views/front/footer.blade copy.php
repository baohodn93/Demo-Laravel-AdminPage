<div class="footer">
    <div class="footer_top">
        Top footer
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="footer_logo">
                        <a href="{{url('/')}}" title="Home">
                            <img src="{{url('images/logo/' .$logo->Description)}}" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                <div class="footer_social">
                    @if(isset($socials) && count($socials) > 0)
                    @foreach($socials as $k => $v)
                    <a href="{{$v->class_alias}}" title="{{$v->name}}">
                        {!!$v->font!!}
                    </a>
                    @endforeach
                    @endif
                </div>
            </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="footer_copyright">
                        {{$copyright->Description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
