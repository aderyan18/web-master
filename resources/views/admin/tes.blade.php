@extends('layout.admin')
@section('content')
<!-- halaman form-->
<div class="container ">
    <div class="row">
        
        <div class="col-lg col-sl-10">
            <form>
                <div class="form-group">
                  <label for="id_register">ID Register</label>
                  <input type="text-area" class="form-control" id="id_register" value='202110001' placeholder="Diagnosa Penyakit">
                </div>
                <div class="form-group">
                  <label for="nama">Nama Pasien</label>
                  <input type="text-area" class="form-control" id="nama" value='ipul' placeholder="Diagnosa Penyakit">
                </div>
                <div class="form-group">
                  <label for="diagnosa">Diagnosa</label>
                  <input type="text-area" class="form-control" id="diagnosa" placeholder="Diagnosa Penyakit">
                </div>
                <div class="form-group">
                  <label for="formGroupExampleInput2">Resep Obat</label>
                  <div class="row">
                      <div class="col">
                            <label for="diagnosa" class="small">Nama Obat</label>
                      </div>
                      <div class="col">
                            <label for="aturan" class="small">Aturan Pakai</label>
                      </div>
                      <div class="col">
                            <label for="aturan" class="small">jumlah</label>
                      </div>
                      <div class="col-3 mr-3"></div>
                  </div>
                  <div class="row after-add-more mb-3">
                      <div class="col"><select name="pasien_id" id="pasien_id" class='form-control'>
                          <option value="sdfdsf">dsfdsf</option></select>
                        </div>
                      <div class="col"><select name="pasien_id" id="pasien_id" class='form-control'>
                          <option value="sdfdsf">sdfdsf</option></select>
                        </div>
                      <div class="col"><input type="text" class='form-control'></div>
                      <div class="col-3 mr-3"><button class="btn btn-success add-more" type="button">
                        <i class="glyphicon glyphicon-plus"></i> Add
                      </button></div>
                  </div>
                </div>
                <div class="row">
                    <div class="col">

                        <button class="">selesai</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-sl-10">
            <div class="card">
                    <button>Kartu Pasien</button>
                    <button>Kartu Pasien</button>
            </div>
        </div>
    </div>
    

</div>
<div class="invisible copy">
    <div class="control-group">
        <div class="row mb-3">
            <div class="col"><select name="pasien_id" id="pasien_id" class='form-control'>
                <option value="sdfdsf">dsfdsf</option></select>
              </div>
            <div class="col"><select name="pasien_id" id="pasien_id" class='form-control'>
                <option value="sdfdsf">sdfdsf</option></select>
              </div>
            <div class="col"><input type="text" class='form-control'></div>
            <div class="col-3 mr-3">
                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
        </div>
    </div>
</div>
<!--Endmodal-->
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
  });
@endsection