<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('icon/icon.ico') }}">
    <title>{{ $tittle ?? 'Apotek Assyifa Medika'  }}</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('vendor/fontawesome-free-5.14.0-web/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-briefcase-medical"></i>
                </div>
                <div class="sidebar-brand-text mx-1">ASSYIFA MEDIKA</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- menu 1 -->
            <li class="nav-item{{ request()->is('dashboard') ? ' active' : ''}}" id="dashboard">
                <a class="nav-link" href="/dashboard">
                    <i class="fa fa-desktop" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role =='apoteker')            
            <li class="nav-item{{ request()->is('dataobat') ? ' active' : ''}}" id="dataobat">
                <a class="nav-link" href="/dataobat">
                    <i class="fa fa-fw fa-folder" aria-hidden="true"></i>
                    <span>Data Obat</span>
                </a>
            </li>

            <li class="nav-item{{ request()->is('kasir') ? ' active' : ''}}" id="kasir">
                <a class="nav-link" href="/kasir">
                    <i class="fa fa-fw fa-folder" aria-hidden="true"></i>
                    <span>Kasir</span>
                </a>
            </li>

            <li class="nav-item{{ request()->is('datapenjualan') ? ' active' : ''}}" id="datapenjualan">
                <a class="nav-link" href="/datapenjualan">
                    <i class="fa fa-fw fa-folder" aria-hidden="true"></i>
                    <span>Data Penjualan</span>
                </a>
            </li>

            @endif

            <!-- menu master data dropdown -->
            @if (auth()->user()->role =='super admin'||auth()->user()->role =='admin')
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masterdata"
                    aria-expanded="true" aria-controls="masterdata">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Master Data</span>
                </a>
                <div id="masterdata" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Master Data :</h6>
                        <a class="collapse-item" href="/datauser">Data User</a>
                        <a class="collapse-item" href="/dataapoteker">Data Apoteker</a>
                    </div>
                </div>
            </li>
            @endif
         
            <!-- menu Apotik dropdown -->
            @if (auth()->user()->role =='super admin'||auth()->user()->role =='admin')
                
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#apotik"
                    aria-expanded="true" aria-controls="apotik">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Apotek</span>
                </a>
                <div id="apotik" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Apotek :</h6>
                        @if (auth()->user()->role =='admin' || auth()->user()->role =='super admin')
                        <a class="collapse-item" href="/dataobat">Data Obat</a>
                        @endif
                        @if (auth()->user()->role =='super admin')
                        <a class="collapse-item" href="/kasir">Kasir</a>
                        @endif
                        <a class="collapse-item" href="/datapenjualan">Data Penjualan Obat</a>
                    </div>
                </div>
            </li>
            @endif
            
            <!-- menu 7 -->
            <li class="nav-item" id="menu6">
                <a class="nav-link" href={{ route('logout') }}>
                    <i class="fa fa-outdent" aria-hidden="true"></i>
                    <span>Logout</span></a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            @php
                            if(auth()->user()->role=='dokter'){
                                $username = auth()->user()->username;
                                $dokter = App\Models\Dokter::where('nip', $username)->first();
                                $poli = $dokter->poli->nama;
                                echo $dokter['nama'] . ' - dokter ' . $poli;
                            }else{
                                $nama = auth()->user()->name;
                                $jabatan = auth()->user()->role;
                                echo $nama . ' - ' . $jabatan;
                            }
                            @endphp
                        </span>
                    </ul>

                </nav>
                <!-- End of Topbar -->
                @yield('content')
                <!-- Footer -->

                <!-- End of Footer -->
                <!-- End of Content Wrapper -->
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>APOTEK ASSYIFA MEDIKA &copy; Website 2022</span>
                    </div>
                </div>
            </footer>
        </div>
        <!-- End of Page Wrapper -->

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
        <script type="text/javascript">
            @yield('js')
        </script>
</body>
</html>