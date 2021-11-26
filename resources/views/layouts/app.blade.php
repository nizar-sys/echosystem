<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('/assets/img/favicon.ico') }}">
    <title>@yield('title')</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('/assets/css/mediumish.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
        type="text/css">

    {{-- Snackbar --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/snackbar.min.css') }}">
    <script src="{{ asset('/assets/js/snackbar.min.js') }}"></script>
    @yield('c_css')
</head>

<body>

    <!-- Begin Nav
================================================== -->
    <nav class="navbar navbar-toggleable-md navbar-light bg-white fixed-top mediumnavigation">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container">
            <!-- Begin Logo -->
            <a class="navbar-brand" href="{{ route('blog.home') }}">
                <p>RPL - ECHOSYSTEM</p>
            </a>
            <!-- End Logo -->
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <!-- Begin Menu -->
                <ul class="navbar-nav ml-auto mt-2">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('blog.home') }}">Stories</a>
                    </li>

                </ul>

                <!-- End Menu -->
                <!-- Begin Search -->
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <span class="search-icon"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25">
                            <path
                                d="M20.067 18.933l-4.157-4.157a6 6 0 1 0-.884.884l4.157 4.157a.624.624 0 1 0 .884-.884zM6.5 11c0-2.62 2.13-4.75 4.75-4.75S16 8.38 16 11s-2.13 4.75-4.75 4.75S6.5 13.62 6.5 11z">
                            </path>
                        </svg></span>
                </form>
                <!-- End Search -->

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <span class="avatar avatar-sm rounded-circle">
                                @php
                                    $avatar = Auth::check() ? Auth::user()->avatar : asset('assets/img/theme/team-4.jpg/');
                                @endphp
                                <img alt="Image placeholder" src="{{ $avatar }}">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                            @if (!Auth::check())
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#switchAuth">Join
                                    echosystem</a>

                            @else
                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="/new-story">Write new story</a>
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Nav
================================================== -->

    <!-- Begin Site Title
================================================== -->
    <div class="container">
        <div class="mainheading">
            <h1 class="sitetitle"></h1>
            <p class="lead">
            </p>
        </div>
        <!-- End Site Title
================================================== -->

        <div class="container-fluid">
            <div class="modal fade" id="switchAuth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Pilih untuk melanjutkan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <a href="{{ route('provider.login', ['provider'=>'github']) }}" class="btn btn-md btn-block btn-white"><i class="fab fa-github"></i> Lanjutkan dengan Github</a>
                            <a href="{{ route('provider.login', ['provider'=>'google']) }}" class="btn btn-md btn-block btn-primary"><i class="fab fa-google"></i> Lanjutkan dengan Google</a>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>

        <!-- Begin Footer
 ================================================== -->
        <div class="footer">
            <p class="pull-left">
                Copyright &copy; {{ date('Y') }} All Right Reserverd.
            </p>
            <p class="pull-right">
                Mediumish Theme by <a target="_blank" href="https://www.wowthemes.net">WowThemes.net</a>
            </p>
            <div class="clearfix">
            </div>
        </div>
        <!-- End Footer
 ================================================== -->

    </div>
    <!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/ie10-viewport-bug-workaround.js') }}"></script>

    <script>
        @if (Session::has('success'))
            Snackbar.show({
            text: "{{ session('success') }}",
            backgroundColor: '#28a745',
            actionTextColor: '#212529',
        })
        @elseif (Session::has('error'))
            Snackbar.show({
            text: "{{ session('error') }}",
            backgroundColor: '#dc3545',
            actionTextColor: '#212529',
        })
        @elseif (Session::has('info'))
            Snackbar.show({
            text: "{{ session('info') }}",
            backgroundColor: '#17a2b8',
            actionTextColor: '#212529',
            })
        @endif;
    </script>
    @yield('c_js')
</body>

</html>
