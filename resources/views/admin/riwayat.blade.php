@extends('layout.admin')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h3 class="m-0 font-weight-bold text-primary">
        @php
            if(isset($namapasien)){
              echo 'Rekam Medis '.$namapasien;
            }else{
              echo 'Data Riwayat Pemeriksaan';
            }
        @endphp
        {{-- {{ $namapasien ? 'Rekam Medis '.$namapasien : 'Data Riwayat Pemeriksaan' }} --}}
      </h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Nama Pasien</th>
              <th>Diagnosa</th>
              <th>Resep</th>
              <th>Dokter</th>
            </tr>
          </thead>
          <tbody>
            @php
            $no=1;
            @endphp
            @foreach ($riwayat as $data)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{$data->tanggal}}</td>
              <td>{{$data->pasien->nama}}</td>
              <td>{{ $data->diagnosa }}</td>
              <td>
                  @php                  
                    $d = App\Models\Resep::where('pemeriksaan_id',$data->id)->get();
                    foreach ($d as $v) {
                      echo "- ".$v->obat->nama." ".$v->aturan."<br>";
                    }   
                  @endphp
              </td>
              <td>{{ $data->dokter->nama }}</td>
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
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="nama..." required>
            </div>
            <div class="form-group">
              <label for="spesialis">Spesialis</label>
              <input type="text" class="form-control" id="spesialis" name="spesialis" placeholder="spesialis..." required>
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
$('#actionform').attr("action","datadokter")
$('#method').html('')
$('#isiBody').removeAttr('hidden','disabled')
$('#pesan').remove()
$(':disabled').removeAttr('disabled')
$('#modelHeading').html("Tambah Data Dokter");
$('#saveBtn').val("Tambah Data");
$('#password').attr("required","true")
$('#modalForm').modal('show');
});

//edit button clicked
$('body').on('click', '#editAdmin', function () {
var id = $(this).data('id');
console.log(id);
$.get("{{ url('datadokter') }}"+"/"+id+"/edit", function (data) {
$('#actionform').attr("action","datadokter/update")
$('#isiBody').removeAttr('hidden','disabled')
$('#pesan').remove()
$('#method').html('@method("patch")')
$(':disabled').removeAttr('disabled')
$('#modelHeading').html("Edit Data Dokter");
$('#saveBtn').val("Edit");
$('#modalForm').modal('show');
$('#id').val(data.id);
$('#nama').val(data.nama);
$('#spesialis').val(data.spesialis);
})
})

//delete
  $('body').on('click', '#deleteAdmin', function () {
  var id = $(this).data('id');
  $('#pesan').remove()
  $('#modalBody').append('<p id="pesan">Anda Yakin ingin menghapus Data ?');
    $('#modelHeading').html("Hapus Data Dokter");
    $('#isiBody').attr('hidden','true');
    $(':required').attr('disabled','true')
    $('#actionform').attr("action","datadokter/"+id+"/hapus")
    $('#method').html('@method("delete")')
    $('#saveBtn').val("Ya");
    $('#modalForm').modal('show');
    })
    });
@endsection