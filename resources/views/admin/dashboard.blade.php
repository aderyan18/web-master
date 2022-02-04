@extends('layout.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- card 1 -->
        @if (auth()->user()->role =='admin'||auth()->user()->role =='super admin')    
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> 
                                @php                  
                                    $d = App\Models\Akun::all()->count();
                                    echo $d;
                                @endphp
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-1 justify-content-center d-flex">
                    <a href="/datauser">more info<i class="fa fa-arrow-circle-right ml-2"></i></a>
                </div>
            </div>
        </div>
        <!-- end card -->

       

    
        <!-- card 4 -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Apoteker</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php                  
                                    $d = App\Models\Apoteker::all()->count();
                                    echo $d;
                                @endphp
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-medkit fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-1 justify-content-center d-flex">
                    <a href="/dataapoteker">more info<i class="fa fa-arrow-circle-right ml-2"></i></a>
                </div>
            </div>
        </div>
        <!-- end card -->
    
        @endif
        

        @if (auth()->user()->role =='apoteker'||auth()->user()->role =='super admin' || auth()->user()->role =='admin')    
        <!-- card 7 -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Obat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php                  
                                    $d = App\Models\Obat::all()->count();
                                    echo $d;
                                @endphp
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pills fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-1 justify-content-center d-flex">
                    <a href="/dataobat">more info<i class="fa fa-arrow-circle-right ml-2"></i></a>
                </div>
            </div>
        </div>
        <!-- end card -->
         <!-- card 2 -->
        @if (auth()->user()->role =='super admin')    
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Kasir</div>
                            {{-- <div class="h5 mb-0 font-weight-bold text-gray-800"> 
                                @php                  
                                    $d = App\Models\kasir::all()->count();
                                    echo $d;
                                @endphp
                            </div> --}}
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cash-register fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-1 justify-content-center d-flex">
                    <a href="/kasir">more info<i class="fa fa-arrow-circle-right ml-2"></i></a>
                </div>
            </div>
        </div>
        <!-- end card -->
        @endif
        <!-- card 7 -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Penjualan Obat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php                  
                                    $d = App\Models\Transaksi::all()->count();
                                    echo $d;
                                @endphp
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer p-1 justify-content-center d-flex">
                    <a href="/datapenjualan">more info<i class="fa fa-arrow-circle-right ml-2"></i></a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection