<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="footer_top">
                    <div class="footer_top_left">
                        Sign Up To Promotions
                    </div>
                    <div class="footer_top_right">
                        <input type="text" placeholder="Email...."/>
                        <button>Send</button>
                    </div>
                </div>
            </div>
        </div>
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
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="footer_copyright">
                        {{$copyright->Description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
