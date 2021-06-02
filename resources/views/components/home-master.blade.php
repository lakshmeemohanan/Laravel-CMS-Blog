<!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <title>Laravel CMS</title>
      <!-- Bootstrap core CSS -->
      <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="{{asset('css/blog-home.css')}}" rel="stylesheet">
    </head>
    <body>
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
          <a class="navbar-brand" href="/">Laravel CMS</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item {{ request()->segment(count(request()->segments())) ==  '' ? 'active' : ''  }}">
                <a class="nav-link" href="/">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>

              @if(Auth::check())
                <li class="nav-item {{ request()->segment(count(request()->segments())) ==  'admin' ? 'active' : ''  }}">
                    <a class="nav-link" href="{{route('admin.index')}}">Admin</a>
                </li>
              @else
                <li class="nav-item {{ request()->segment(count(request()->segments())) ==  'login' ? 'active' : ''  }}">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item {{ request()->segment(count(request()->segments())) ==  'register' ? 'active' : ''  }}">
                  <a class="nav-link" href="/register">Register</a>
                </li>
              @endif
              <li class="nav-item {{ request()->segment(count(request()->segments())) ==  'about' ? 'active' : ''  }}">
                <a class="nav-link" href="/about">About Us</a>
              </li>
              <li class="nav-item {{ request()->segment(count(request()->segments())) ==  'contact' ? 'active' : ''  }}">
                <a class="nav-link" href="/contact">Contact Us</a>
              </li>
              
              @if(Auth::check())
                <li class="nav-item dropdown no-arrow">
                  <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                      @if(Auth::check())
                        {{auth()->user()->name}}
                      @endif
                    </span>
                    <img height="20" class="img-profile rounded-circle" src="/storage/{{auth()->user()->profile_picture}}">
                  </a>
                  <!-- Dropdown - User Information -->
                  <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{route('admin.user.profile',auth()->user()->id)}}">
                      <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                      Profile
                    </a>
                    <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                      </a>
                    </div>
                  </div>
                </li>
                @endif

            </ul>
          </div>
        </div>
      </nav>
      <!-- Page Content -->
        @yield('content')
      
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
          <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-primary">Logout</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </div>
      <!-- Footer -->
      <footer class="footer">
        <div class="container">
          <p class="m-0 text-center text-white">Copyright &copy; Laravel CMS 2021</p>
        </div>
        <!-- /.container -->
      </footer>

      <!-- Bootstrap core JavaScript -->
      
      <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
      <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    </body>
  </html>
