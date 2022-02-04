@extends('layout.admin')
@section('content')
<!-- halaman form-->
<div class="container ">
    <div class="row">
        
        <div class="col-lg col-sm-10">
            <form method="POST" action="{{ url('/pemeriksaan') }}">
              @csrf
                <div class="form-group">
                  <label for="id_register">ID Register</label>
                  <input type="text-area" class="form-control" name="id_register" id="id_register" value='{{ $data->id_register }}' readonly>
                </div>
                <div class="form-group">
                  <label for="namapasien">Nama Pasien</label>
                  <input type="text-area" class="form-control" name='namapasien' id="namapasien" value='{{ $data->nama }}' readonly>
                </div>
                <div class="form-group">
                  <label for="diagnosa">Diagnosa</label>
                  <input type="text-area" class="form-control" name="diagnosa" id="diagnosa" placeholder="Diagnosa Penyakit" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Resep Obat</label>
                  <div class="row">
                      <div class="col">
                            <label for="obat_id" class="small">Nama Obat</label>
                      </div>
                      <div class="col">
                            <label for="aturan" class="small">Aturan Pakai</label>
                      </div>
                      <div class="col">
                            <label for="jumlah" class="small">jumlah</label>
                      </div>
                      <div class="col-3 mr-3"></div>
                  </div>
                  <div class="row after-add-more mb-3">
                      <div class="col">
                        <select name="obat_id[]" id="obat_id" class='form-control' required>
                          <option value="" selected disabled hidden>Choose here</option>
                          @foreach ($obat as $b)
                          <option value="{{ $b->id }}">{{ $b->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col"><input type="text" name='aturan[]' id="aturan" class='form-control' placeholder="Aturan Pakai" required></div>
                      <div class="col"><input type="number" name="jumlah[]" id="jumlah" class='form-control' required></div>                      
                      <div class="col-3 mr-3"><button class="btn btn-success add-more" type="button">
                        <i class="glyphicon glyphicon-plus"></i> Add
                      </button></div>
                  </div>
                </div>
                <div class="row">
                    <div class="col">
                      <input type="submit" name="tambah" id="saveBtn" class="btn btn-success">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class=" mx-auto">
            <a href="javascript:void(0)" id="kartupasien" data-id="{{ $data->id }}" data-toggle="tooltip" class="btn btn-primary p-3 btn-block mt-4">Kartu Pasien</a>
              {{-- <a href="javascript:void(0)" id="riwayat" data-id="{{ $data->id }}" data-toggle="tooltip"
                class="btn btn-primary p-3 btn-block">Riwayat
              </a> --}}
            <a href="{{ url('riwayat').'/'.$data->id }}" class="btn btn-primary p-3 btn-block mt-4">Riwayat</a>

          </div>
        </div>
    </div>
    

</div>
<div class="invisible copy">
    <div class="control-group">
        <div class="row mb-3">
          <div class="col">
            <select name="obat_id[]" id="obat_id[]" class='form-control' required>
              <option value="" selected disabled hidden>Choose here</option>
              @foreach ($obat as $a)
              <option value="{{ $a->id }}">{{ $a->nama }}</option>
              @endforeach
            </select>
          </div>
          <div class="col"><input type="text" name='aturan[]' id="aturan" class='form-control' placeholder="Aturan Pakai" required></div>
          <div class="col"><input type="number" name="jumlah[]" id="jumlah" class='form-control'></div>             
            <div class="col-3 mr-3">
                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove" required></i> Remove</button>
            </div>
        </div>
    </div>
</div>
<!--Endmodal-->
@include('layout.kartupasien')
@include('layout.riwayat')
@endsection
@section('js')
$(document).ready(function() {
    $(".add-more").click(function(){ 
        var html = $(".copy").html();
        $(".after-add-more").after(html);
    });

    // saat tombol remove dklik control group akan dihapus 
    $("body").on("click",".remove",function(){ 
        $(this).parents(".control-group").remove();
    });

    $('body').on('click', '#kartupasien', function () {
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

      //riwayat
      $('body').on('click', '#riwayat', function () {
      var id = $(this).data('id');
      console.log(id);
      $.get("{{ url('datapasien') }}"+"/"+id+"/kartu", function (data) {
        
      $('#modalriwayat').modal('show');
      })
      })

  });
@endsection