@if(session()->has('register'))
@include('layout.modalpasien')
@endif
@extends('layout.admin',['tittle'=>'Data Pasien'])
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
        Data Pasien
      </h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>No Registrasi</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Umur</th>
              <th>Jenis Pasien</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php
            $no=1;
            @endphp
            @foreach ($pasien as $data)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{$data->id_register}}</td>
              <td>{{$data->nama}}</td>
              <td>{{$data->jenis_kelamin}}</td>
              <td>
                @php
                    tes($data->tanggal_lahir);
                @endphp
              </td>
              {{-- <td>{{$data->tanggal_lahir}}</td> --}}
              <td>{{$data->jenis_pasien}}</td>
              <td>
                <a href="javascript:void(0)" id="editAdmin" data-id="{{ $data->id }}" data-toggle="tooltip"
                  class="badge badge-primary">Edit
                </a>
                <a href="javascript:void(0)" id="deleteAdmin" data-id="{{ $data->id }}" data-toggle="tooltip"
                  class="badge badge-danger">delete
                </a>
                <a href="javascript:void(0)" id="showkartu" data-id="{{ $data->id }}" data-toggle="tooltip"
                  class="badge badge-danger">Liat Kartu
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
<!--  modal liat kartu -->
@include('layout.kartupasien')
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
              <label for="tempat_lahir">Tempat Lahir</label>
              <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                placeholder="tempat lahir..." required>
            </div>
            <div class="form-group">
              <label for="tanggal_lahir">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="form-group">
              <label for="jenis_kelamin">Jenis Kelamin</label>
              <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="" selected disabled hidden>Choose here</option>
                <option>laki-laki</option>
                <option>perempuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="agama">Agama</label>
              <input type="text" class="form-control" id="agama" name="agama" placeholder="Agama..." required>
            </div>
            <div class="form-group">
              <label for="pekerjaan">Pekerjaan</label>
              <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan..."
                required>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat..." required>
            </div>
            <div class="form-group">
              <label for="status">Status Perkawinan</label>
              <select class="form-control" id="status" name="status" required>
                <option value="" selected disabled hidden>Choose here</option>
                <option>menikah</option>
                <option>belum menikah</option>
              </select>
            </div>
            <div class="form-group">
              <label for="jenis_pasien">Jenis Pasien</label>
              <select class="form-control" id="jenis_pasien" name="jenis_pasien" onchange="nomorbpjs()" required>
                <option value="" selected disabled hidden>Choose here</option>
                <option>BPJS</option>
                <option>umum</option>
              </select>
            </div>
            <div id='formnomor'>
              <div class="form-group">
                <label for="no_BPJS">Nomor BPJS</label>
                <input type="text" class="form-control" id="no_BPJS" name="no_BPJS" placeholder="Nomor BPJS..."
                  required>
              </div>
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
$('#actionform').attr("action","datapasien")
$('#method').html('')
$('#isiBody').removeAttr('hidden','disabled')
$('#pesan').remove()
$(':disabled').removeAttr('disabled')
$('#modelHeading').html("Tambah Data Pasien");
$('#formnomor').attr('hidden','true')
$('#saveBtn').val("Tambah Data");
$('#password').attr("required","true")
$('#modalForm').modal('show');
});

//edit button clicked
$('body').on('click', '#editAdmin', function () {
var id = $(this).data('id');
console.log(id);
$.get("{{ url('datapasien') }}"+"/"+id+"/edit", function (data) {
$('#actionform').attr("action","datapasien/update")
$('#isiBody').removeAttr('hidden','disabled')
$('#pesan').remove()
$('#method').html('@method("patch")')
$(':disabled').removeAttr('disabled')
$('#modelHeading').html("Edit Data Pasien");
$('#saveBtn').val("Edit");
$('#modalForm').modal('show');
$('#id').val(data.id);
$('#nama').val(data.nama);
$('#tempat_lahir').val(data.tempat_lahir);
$('#tanggal_lahir').val(data.tanggal_lahir);
$('#jenis_kelamin').val(data.jenis_kelamin);
$('#agama').val(data.agama);
$('#pekerjaan').val(data.pekerjaan);
$('#alamat').val(data.alamat);
$('#status').val(data.status);
$('#jenis_pasien').val(data.jenis_pasien);
$('#no_BPJS').val(data.no_BPJS);
$('#spesialis').val(data.spesialis);
})
})

//delete
$('body').on('click', '#deleteAdmin', function () {
var id = $(this).data('id');
$('#pesan').remove()
$('#modalBody').append('<p id="pesan">Anda Yakin ingin menghapus Data ?');
  $('#modelHeading').html("Hapus Data Pasien");
  $('#isiBody').attr('hidden','true');
  $(':required').attr('disabled','true')
  $('#actionform').attr("action","datapasien/"+id+"/hapus")
  $('#method').html('@method("delete")')
  $('#saveBtn').val("Ya");
  $('#modalForm').modal('show');
  })

//show
$('body').on('click', '#showkartu', function () {
var id = $(this).data('id');
console.log(id);
$.get("{{ url('datapasien') }}"+"/"+id+"/kartu", function (data) {
$('#formcetakkartu').attr("href","datapasien/"+id+"/pdf")
  $('#kartuid').html(": "+ data.id_register)
  $('#kartunama').html(": "+ data.nama)
  $('#kartujk').html(": "+ data.jenis_kelamin)
  $('#kartupekerjaan').html(": "+ data.pekerjaan)
  $('#kartualamat').html(": "+ data.alamat)
  $('#kartutl').html(": "+ data.tanggal_lahir)
  $('#kartujenis').html(": "+ data.jenis_pasien)
  $('#kartuno').html(": "+ data.no_BPJS)
  $('#kartuuser').html(": "+ data.id_register)
  $('#kartupass').html(": "+ data.id_register)
  if(data.jenis_pasien =='umum'){
    $('#kartunobpjs').attr('hidden','true')
  }else{
    $('#kartunobpjs').removeAttr('hidden','true')
    
  }
  $('#modalkartu').modal('show');
  })
  })
  });

  function nomorbpjs(){
  var jenis= document.getElementById('jenis_pasien').value;
  if(jenis=="BPJS"){
  $('#formnomor').removeAttr('hidden')
  $('#no_BPJS').val('')
  }else if(jenis=="umum"){
  $('#formnomor').attr('hidden','true')
  $('#no_BPJS').val('umum')
  }

  }
  $('#modalpasien').modal('show')
  @endsection