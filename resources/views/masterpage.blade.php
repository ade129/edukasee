<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> {{$title}}</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('sb-admin/vendor/fontawesome-free/css/all.min.css')}} " rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{asset('sb-admin/vendor/datatables/dataTables.bootstrap4.css')}} " rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('sb-admin/css/sb-admin.css')}}" rel="stylesheet">
  <!-- Summernote-->
  <link rel="stylesheet" href="{{asset('summernote/dist/summernote-bs4.css')}}">
  <!-- select2 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <!-- image upload -->
  <link rel="stylesheet" href="{{asset('bootstrap-imageupload/dist/css/bootstrap-imageupload.min.css')}}">
  <!--datepicker css-->
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <!--datepicker js-->
  <script src="{{asset('sb-admin/vendor/jquery/jquery.min.js')}} "></script>

  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>


</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">Edukasee</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      {{-- <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div> --}}
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      {{-- <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell fa-fw"></i>
          <span class="badge badge-danger">9+</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> --}}
      {{-- <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <span class="badge badge-danger">7</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> --}}
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          {{-- <a class="dropdown-item" href="#">Settings</a>
          <a class="dropdown-item" href="#">Activity Log</a>
          <div class="dropdown-divider"></div> --}}
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      @if (Auth::user()->role == 's' || Auth::user()->role == 'a' )
        <li class="nav-item" id="menu_home">
          <a class="nav-link" href="{{url('/home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
      @endif
      @if (Auth::user()->role == 's')
      <li class="nav-item dropdown" id="menu_master">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-database"></i>
          <span>Master</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="{{url('master/user')}}" id="submenu_users"><i class="far fa-user"></i> User</a>
            <a class="dropdown-item" href="{{url('master/product')}}" id="submenu_product"><i class="fas fa-tag"></i> Product
            </a>

          {{-- <a class="dropdown-item" href="{{url('master/product')}}" id="submenu_product"><i class="fas fa-tag"></i> Tags
          </a> --}}
          {{-- <a class="dropdown-item" href="{{url('admin/master/user')}}" id="submenu_users"><i class="far fa-user"></i> User</a>
          <a class="dropdown-item" href="{{url('admin/master/tags')}}" id="submenu_tags"><i class="fas fa-tag"></i> Tags</a>
          <a class="dropdown-item" href="{{url('admin/master/universities')}}" id="submenu_unive"><i class="fas fa-university"></i> Universitas</a>
          <a class="dropdown-item" href="{{url('admin/master/faculties')}}" id="submenu_faculties"><i class="fas fa-diploma"></i> Faculties</a> --}}

          {{-- <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Other Pages:</h6>
          <a class="dropdown-item" href="404.html">404 Page</a>
          <a class="dropdown-item" href="blank.html">Blank Page</a> --}}
        </div>
      </li>
          @endif
      {{-- <li class="nav-item" id="menu_artikel">
        <a class="nav-link" href="{{url('admin/artikel')}}">
          <i class="fab fa-blogger"></i>
          <span>Artikel</span></a>
      </li> --}}
      <li class="nav-item"  id="menu_purchase">
        <a class="nav-link" href="{{url('purchase')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>Purchase</span></a>
      </li>
      @if (Auth::user()->role == 's')
        <li class="nav-item"  id="menu_report">
          <a class="nav-link" href="{{url('report')}}">
            <i class="fas fa-fw fa-file"></i>
            <span>Report</span></a>
          </li>
      @endif
    </ul>

    <div id="content-wrapper">
      <div class="container-fluid">
        @if(session('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{session('success')}}
          </div>
        @elseif ($errors->any())
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Error!</h4>
            <ul>
              @foreach ($errors->all() as $error)
                 <li>{{$error}}</li>
               @endforeach
            </ul>
          </div>
        @endif

        {!!$pagecontent!!}

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
           {{ __('Logout') }}
           </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
           </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('sb-admin/vendor/jquery-easing/jquery.easing.min.js')}} "></script>

  <!-- Page level plugin JavaScript-->
  <script src="{{asset('sb-admin/vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{asset('sb-admin/vendor/datatables/jquery.dataTables.js')}} "></script>
  <script src="{{asset('sb-admin/vendor/datatables/dataTables.bootstrap4.js')}} "></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('sb-admin/js/sb-admin.min.js')}}"></script>
  <!-- summernote-->
  <script src="{{asset('summernote/dist/summernote-bs4.min.js')}}"></script>
  <!-- select2-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script src="{{asset('bootstrap-imageupload/dist/js/bootstrap-imageupload.min.js')}}" type="text/javascript">

  </script>
  <!-- Demo scripts for this page-->
  {{-- <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script> --}}
  <script type="text/javascript">
  $('#menu_{{$menu}}').addClass('active');
  $('#submenu_{{$submenu}}').addClass('active');

  $(document).ready(function() {
      $('#dataTable').DataTable();
      $('.summernote').summernote({
        height: 300,
        toolbar: [
          // [groupName, [list of button]]
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['height', ['height']]
        ]
      });
  } );

  $(document).ready(function() {
      $('.select2').select2();
  });


  </script>
</body>

</html>
