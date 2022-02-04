@extends('layout.admin')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  @if (auth()->user()->role =='admin')
  <a class="btn btn-success" href="javascript:void(0)" id="tambahuser" style="margin-bottom:5px;">Tambah Data</a>
  @endif
  @if (session()->has('berhasil'))  
    <div class="alert alert-success">
      {{ session()->get('berhasil') }}
    </div>
  @endif
  @if (session()->has('gagal'))  
    <div class="alert alert-danger">
      {{ session()->get('gagal') }}
    </div>
  @endif
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">
        Daftar Reservasi
      </h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Poli Tujuan</th>
              <th>No Antrian</th>
              <th>Waktu</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @php
            $no=1;
            @endphp
            @foreach ($reservasi as $data)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $data->pasien->nama }}</td>
              <td>{{ $data->poli->nama }}</td>
              <td>{{ $data->nomor_antrian }}</td>
              <td>{{ $data->waktu }}</td>
              <td>
                <a href="javascript:void(0)" id="detail" data-id="{{ $data->pasien_id }}" data-toggle="tooltip"
                  class="badge badge-primary">Kartu Pasien
                </a>
                @if (auth()->user()->role =='super admin' || auth()->user()->role =='dokter')
                <a href="pemeriksaan/{{ $data->pasien->id }}" id="pemeriksaan" data-id="{{ $data->id }}" data-toggle="tooltip"
                  class="badge badge-primary">Pemeriksaan
                </a>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@include('layout.kartupasien')
@include('layout.riwayat')
@include('layout.pemeriksaan')
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
              <label for="pasien_id">Nama Pasien</label>
              <select name="pasien_id" id="pasien_id" class='form-control' required>
                <option value="" selected disabled hidden>Choose here</option>
                @foreach($pasien as $data)
                <option value="{{ $data->id }}">{{$data->id_register . " " . $data->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="poli_id">Poli Tujuan</label>
              <select name="poli_id" id="poli_id" class='form-control' required>
                <option value="" selected disabled hidden>Choose here</option>
                @foreach($poli as $data)
                <option value="{{ $data->id }}">{{ $data->nama }}</option>
                @endforeach
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
<table class="invisible">
    <tr class="copy">
      <td id="nomorriwayat"></td>
      <td id="tanggalriwayat"></td>
    </tr>      
</table>
<!--modal tess-->
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
$('#actionform').attr("action","daftarreservasi")
$('#method').html('')
$('#isiBody').removeAttr('hidden','disabled')
$('#pesan').remove()
$(':disabled').removeAttr('disabled')
$('#modelHeading').html("Reservasi");
$('#saveBtn').val("Tambah Data");
$('#password').attr("required","true")
$('#modalForm').modal('show');
});

//detail
$('body').on('click', '#detail', function () {
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
@endsection