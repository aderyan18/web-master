@extends('layout.admin')
@section('content')
<div class="container ">
  <div class="row">

    <div class="col-lg col-sm-10">
      <form method="POST" action="{{ url('/kasir/temporary') }}">
        @csrf
          <div class="row">
            <div class="col">
              <label for="obat_id" class="small">Nama Obat</label>
            </div>
            <div class="col">
              <label for="hs" class="small">Harga Satuan</label>
            </div>
            <div class="col">
              <label for="banyak" class="small">banyak</label>
            </div>
            <div class="col-3 mr-3"></div>
          </div>
          <div class="row after-add-more mb-3">
            <div class="col">
              <select name="obat_id" id="obat_id" class='form-control' onchange="nomorbpjs()" required>
                <option value="" selected disabled hidden>Choose here</option>
                @foreach ($obat as $b)
                <option value="{{ $b->id }}">{{ $b->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="col"><input type="text" name='hs' id="hs" class='form-control' readonly required></div>
            <div class="col"><input type="number" name="banyak" id="banyak" class='form-control' min=1 required></div>
            <div class="col-3 mr-3"><input type="submit" name="tambah" id="saveBtn" class="btn btn-success" value="Add"></div>
          </div>        
      </form>
    </div>
  </div>
  <div class="row mt-5">
    <div class="col">
      @php
          $no=1;
      @endphp
      <table width=100% class="table table-bordered border-primary">
        <thead align="center">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Banyak</th>
            <th>Sub Total</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($transaksi as $data)
          <tr>
            <td align="center">{{ $no++ }}</td>
            <td>{{ $data->obat->nama }}</td>
            <td>{{ $data->obat->harga }}</td>
            <td>{{ $data->banyak }}</td>
            <td>{{ $data->sub_total }}</td>
            <td><a href="javascript:void(0)" id="editAdmin" data-id="{{ $data->id }}" data-toggle="tooltip"
              class="badge badge-primary">Edit
            </a>
            <a href="javascript:void(0)" id="deleteAdmin" data-id="{{ $data->id }}" data-toggle="tooltip"
              class="badge badge-danger">delete
            </a></td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <td colspan="4" align="right">Total :</td>
          <td>{{ $transaksi->sum('sub_total') }}</td>
          <td></td>
        </tfoot>
      </table>
    </div>
  </div>
  <div class="row mt-2 ">
    <div class="col d-flex justify-content-between">
      <div>
        <a href="javascript:void(0)" id="bataltransaksi" data-toggle="tooltip"
          class="btn btn-danger center-block">Batalkan Transaksi
        </a>      
      </div>
      <div>
        <form action="/kasir" method="POST">
          @csrf
          <input type="submit" name="selesai" id="saveBtn" class="btn btn-success center-block px-5 p-2" value="Selesai">    
        </form>  
      </div>
    </div>
    
  </div>
</div>

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
              <label for="banyak">Banyak</label>
              <input type="number" class="form-control" id="banyaktemp" name="banyak" placeholder="banyak" required>
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
@endsection

@section('js')
$(function () {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

//edit button clicked
$('body').on('click', '#editAdmin', function () {
var id = $(this).data('id');
console.log(id);
$.get("{{ url('kasir') }}"+"/"+id+"/edit", function (data) {
$('#actionform').attr("action","kasir/update")
$('#isiBody').removeAttr('hidden','disabled')
$('#pesan').remove()
$('#method').html('@method("patch")')
$(':disabled').removeAttr('disabled')
$('#modelHeading').html("Edit Data Pembelian");
$('#saveBtn').val("Edit");
$('#modalForm').modal('show');
$('#id').val(data.id);
$('#banyaktemp').val(data.banyak);
$('#banyaktemp').attr('max',data.max);

})
})

//delete
  $('body').on('click', '#deleteAdmin', function () {
  var id = $(this).data('id');
  $('#pesan').remove()
  $('#modalBody').append('<p id="pesan">Anda Yakin ingin menghapus Data ?');
    $('#modelHeading').html("Hapus Data Pembelian");
    $('#isiBody').attr('hidden','true');
    $(':required').attr('disabled','true')
    $('#actionform').attr("action","kasir/"+id+"/hapus")
    $('#method').html('@method("delete")')
    $('#saveBtn').val("Ya");
    $('#modalForm').modal('show');
    })

    $('body').on('click', '#bataltransaksi', function () {
      $('#pesan').remove()
      $('#modalBody').append('<p id="pesan">Yakin Batalkan Transaksi ?');
        $('#modelHeading').html(" ");
        $('#isiBody').attr('hidden','true');
        $(':required').attr('disabled','true')
        $('#actionform').attr("action","/kasir/batal")
        $('#method').html('@method("delete")')
        $('#saveBtn').val("Ya");
        $('#modalForm').modal('show');
        })
    });
function nomorbpjs(){

var id = document.getElementById('obat_id').value;
$.get("{{ url('kasir') }}"+"/"+id+"/stock", function (data) {
$('#banyak').attr('max',data.stok);
$('#hs').val(data.harga);
})
}
@endsection