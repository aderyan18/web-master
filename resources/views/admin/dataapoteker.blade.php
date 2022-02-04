@extends('layout.admin')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <a class="btn btn-success mb-3" href="javascript:void(0)" id="tambahuser">Tambah Data</a>
  @if (session()->has('berhasil'))  
    <div class="alert alert-success">
      {{ session()->get('berhasil') }}
    </div>
  @endif
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">
        Data Apoteker
      </h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php
            $no=1;
            @endphp
            @foreach ($apoteker as $data)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $data->nip }}</td>
              <td>{{$data->nama}}</td>
              <td>
                <a href="javascript:void(0)" id="editAdmin" data-id="{{ $data->id }}" data-toggle="tooltip"
                  class="badge badge-primary">Edit
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
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="nama..." required>
            </div>
            <div class="form-group">
              <label for="jenis_kelamin">Jenis Kelamin</label>
              <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="" selected disabled hidden>Choose here</option>
                <option>laki-laki</option>
                <option>perempuan</option>
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
$('#actionform').attr("action","dataapoteker")
$('#method').html('')
$('#isiBody').removeAttr('hidden','disabled')
$('#pesan').remove()
$(':disabled').removeAttr('disabled')
$('#modelHeading').html("Tambah Data Apoteker");
$('#saveBtn').val("Tambah Data");
$('#password').attr("required","true")
$('#modalForm').modal('show');
});

//edit button clicked
$('body').on('click', '#editAdmin', function () {
var id = $(this).data('id');
console.log(id);
$.get("{{ url('dataapoteker') }}"+"/"+id+"/edit", function (data) {
$('#actionform').attr("action","dataapoteker/update")
$('#isiBody').removeAttr('hidden','disabled')
$('#pesan').remove()
$('#method').html('@method("patch")')
$(':disabled').removeAttr('disabled')
$('#modelHeading').html("Edit Data Apoteker");
$('#saveBtn').val("Edit");
$('#modalForm').modal('show');
$('#id').val(data.id);
$('#nama').val(data.nama);
$('#jenis_kelamin').val(data.jenis_kelamin);
})
})

//delete
  $('body').on('click', '#deleteAdmin', function () {
  var id = $(this).data('id');
  $('#pesan').remove()
  $('#modalBody').append('<p id="pesan">Anda Yakin ingin menghapus Data ?');
    $('#modelHeading').html("Hapus Data Apoteker");
    $('#isiBody').attr('hidden','true');
    $(':required').attr('disabled','true')
    $('#actionform').attr("action","dataapoteker/"+id+"/hapus")
    $('#method').html('@method("delete")')
    $('#saveBtn').val("Ya");
    $('#modalForm').modal('show');
    })
    });
@endsection