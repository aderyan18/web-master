@extends('layout.admin')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <a class="btn btn-success" href="javascript:void(0)" id="tambahuser">Tambah User</a>
  @if (session()->has('berhasil'))  
    <div class="alert alert-success">
      {{ session()->get('berhasil') }}
    </div>
  @endif
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-info">
        Data User
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
              <th>Role Account</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php
            $no=1;
            @endphp
            @foreach ($user as $data)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{$data->name}}</td>
              <td>{{$data->username}}</td>
              <td>{{$data->role}}</td>
              <td>
                <a href="javascript:void(0)" id="editAdmin" data-id="{{ $data->id }}" data-toggle="tooltip"
                  class="badge badge-primary">Edit
                </a>
                <a href="javascript:void(0)" id="resetAdmin" data-id="{{ $data->id }}" data-toggle="tooltip"
                  class="badge badge-primary">reset
                </a>
                <a href="javascript:void(0)" id="deleteAdmin" data-id="{{ $data->id }}" data-toggle="tooltip"
                  class="badge badge-danger">delete
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- modal -->
<div class="modal fade" id="modalForm" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modelHeading"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="" method="POST" id="actionform">
        @csrf
        <div id="method"></div>
        <div class="modal-body" id="modalBody">
          <div id='isiBody'>
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="nama..." required>
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="username..." required>
            </div>
            <div class="form-group" id="pasworddiv">
              <label for="password" id="labelpassword">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="password...">
            </div>
            <div class="form-group">
              <label for="class">Class</label>
              <select class="form-control" id="role" name="role" required>
                <option value="" selected disabled hidden>Choose here</option>
                <option>admin</option>
                <option>apoteker</option>
                <option>user</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" name="tambah" id="saveBtn" class="btn btn-success">
        </div>
      </form>
    </div>
  </div>
</div>
<!--Endmodal-->
@endsection
@section('js')
$(function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

//create product clicked
$('#tambahuser').click(function () {
$('#id').val('');
$('#actionform').trigger("reset");
$('#actionform').attr("action","datauser")
$('#method').html('')
$('#isiBody').removeAttr('hidden','disabled')
$('#pesan').remove()
$('#labelpassword').removeAttr("hidden")
$(':disabled').removeAttr('disabled')
$('#password').removeAttr("hidden")
$('#modelHeading').html("Tambah Data User");
$('#saveBtn').val("Tambah User");
$('#password').attr("required","true")
$('#modalForm').modal('show');
});

//edit button clicked
$('body').on('click', '#editAdmin', function () {
var id = $(this).data('id');
console.log(id);
$.get("{{ url('datauser') }}"+"/"+id+"/edit", function (data) {
$('#actionform').attr("action","datauser/update")
$('#isiBody').removeAttr('hidden','disabled')
$('#pesan').remove()
$('#method').html('@method("patch")')
$('#password').attr("hidden","true")
$(':disabled').removeAttr('disabled')
$('#labelpassword').attr("hidden","true")
$('#password').attr("disabled","true")
$('#modelHeading').html("Edit User");
$('#saveBtn').val("Edit User");
$('#modalForm').modal('show');
$('#id').val(data.id);
$('#name').val(data.name);
$('#username').val(data.username);
$('#role').val(data.role);
})
})


//reset
$('body').on('click', '#resetAdmin', function () {
var id = $(this).data('id');
$('#pesan').remove()
$('#modalBody').append('<p id="pesan">Anda Yakin ingin Mereset Password ?');
  $('#modelHeading').html("Reset Password");
  $('#isiBody').attr('hidden','true');
  $('#isiBody').attr('disabled','true');
  $(':required').attr('disabled','true')
  $('#actionform').attr("action","datauser/"+id+"/reset")
  $('#method').html('@method("patch")')
  $('#saveBtn').val("Ya");
  $('#modalForm').modal('show');
  });

  //delete
  $('body').on('click', '#deleteAdmin', function () {
  var id = $(this).data('id');
  $('#pesan').remove()
  $('#modalBody').append('<p id="pesan">Anda Yakin ingin menghapus User ?');
    $('#modelHeading').html("Hapus User");
    $('#isiBody').attr('hidden','true');
    $(':required').attr('disabled','true')
    $('#actionform').attr("action","datauser/"+id+"/hapus")
    $('#method').html('@method("delete")')
    $('#saveBtn').val("Ya");
    $('#modalForm').modal('show');
    })
    });
    @endsection