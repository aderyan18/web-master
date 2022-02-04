@extends('layout.admin')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <a href="" class="btn btn-success btn-md mb-3" onclick="tambah()" data-toggle="modal"
    data-target="#exampleModalCenter">Tambah User</a>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">
        Data Penjualan
      </h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>User Name</th>
              <th>Password</th>
              <th>Role Account</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>TES</td>
              <td>TES</td>
              <td>TES</td>
              <td>TES</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection