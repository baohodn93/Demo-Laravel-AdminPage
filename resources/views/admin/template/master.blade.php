<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{url('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/dist/css/adminlte.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- ListUser -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script> -->
    <script src="{{url('js/admin/admin.js')}}"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{url('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{url('/')}}" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        @if(Auth::user()->gender == '1')
                        <i class="fas fa-male"></i>
                        Hello:<b>{{Auth::user()->fullname}}</b>
                        @else
                        <i class="fas fa-female"></i>
                        Hello:<b>{{Auth::user()->fullname}}</b>
                        @endif
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @if(Auth::user()->role_id == 1)
                        <a href="{{url('admin/staff/list')}}" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 会員情報管理
                        </a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a href="{{url('admin/staff/profile')}}" class="dropdown-item">
                            <i class="fas fa-user-edit fa-fw"></i> 管理者情報
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('/admin/dashboard')}}" class="brand-link">
                <img src="{{url('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                @if(Auth::user()->role_id == 1)
                <span class="brand-text font-weight-light">Admin</span>
                @else
                <span class="brand-text font-weight-light">Seo</span>
                @endif
            </a>
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @if(Auth::user()->role_id == 1)
                        <li class="nav-item">
                            <a href="{{url('/admin/dashboard')}}" class="nav-link @yield('dashboard')">
                                <i class="fas fa-home"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/system')}}" class="nav-link @yield('system')">
                                <i class="fas fa-cog fa-fw"></i>
                                <p>
                                    System
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url ('/admin/page/list')}}" class="nav-link @yield('page')">
                                <i class="fas fa-sitemap fa-fw"></i>
                                <p>
                                    Pages
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url ('/admin/social/list')}}" class="nav-link @yield('social')">
                                <i class="fas fa-share-alt"></i>
                                <p>
                                    Social
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url ('/admin/slider/list')}}" class="nav-link @yield('Slider')">
                                <i class="fas fa-sliders-h"></i>
                                <p>
                                    Slider
                                </p>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                        <li class="nav-item">
                            <a href="#" class="nav-link @yield('news')">
                                <i class="far fa-newspaper"></i>
                                <p>
                                    News
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{url ('/admin/news/cat_list')}}" class="nav-link @yield('catalogue')">
                                        <i class="fas fa-list"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url ('/admin/news/list')}}" class="nav-link @yield('list')">
                                        <i class="fas fa-list"></i>
                                        <p>List News</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{url ('/admin/promotion/list')}}" class="nav-link @yield('promotion')">
                                <i class="fas fa-mail-bulk"></i>
                                <p>
                                    Promotion
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url ('/admin/contact/list')}}" class="nav-link @yield('contact')">
                                <i class="fas fa-envelope-open-text fa-fw"></i>
                                <p>
                                    Contact
                                </p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0 text-dark">@yield('heading')</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- /.Main-content -->
            <session class="content">
                <div class="container-fluid">
                    <!-- Error表示 -->
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
                    @yield('content')
                </div>
            </session>
            <!-- .Main-content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2021 <a href="#">BaoHo</a>.</strong>
            All rights reserved.
        </footer>
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{url('admin/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{url('admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{url('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{url('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{url('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{url('admin/dist/js/adminlte.js')}}"></script>>
    <!-- DataTables  & Plugins -->
    <script src="{{url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{url('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script>
        $(function() {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    {{-- CKEditor --}}
    <script src="{{url('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('ckeditor', {
            filebrowserBrowseUrl: '{!!url("responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=")!!}',
            filebrowserUploadUrl: '{!!url("responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=")!!}',
            filebrowserImageBrowseUrl: '{!!url("responsive_filemanager/filemanager/dialog.php?type=2&editor=ckeditor&fldr=")!!}'
        });
    </script>
    <script type="text/javascript">
        function ChangeToSlug() {
            var title, slug;

            //Lấy text từ thẻ input title
            title = document.getElementById("title").value;

            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        };
    </script>
</body>

</html>
