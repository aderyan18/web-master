<div class="modal fade" id="modalpemeriksaan" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">pemeriksaan</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('/pemeriksaan') }}">
          @csrf
            <div class="form-group">
              <label for="id_register">ID Register</label>
              <input type="text-area" class="form-control" name="id_register" id="id_register" value='' readonly>
            </div>
            <div class="form-group">
              <label for="namapasien">Nama Pasien</label>
              <input type="text-area" class="form-control" name='namapasien' id="namapasien" value='' readonly>
            </div>
            <div class="form-group">
              <label for="diagnosa">Diagnosa</label>
              <input type="text-area" class="form-control" name="diagnosa" id="diagnosa" placeholder="Diagnosa Penyakit" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label for="formGroupExampleInput2">Resep Obat</label>
              <div class="row">
                  <div class="col">
                        <label for="nama" class="small">Nama Obat</label>
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
                    <select name="nama[]" id="nama" class='form-control' required>
                      <option value="" selected disabled hidden>Choose here</option>
                      {{-- @foreach ($obat as $data)
                      <option>{{ $data->nama }}</option>
                      @endforeach --}}
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="invisible copy">
  <div class="control-group">
      <div class="row mb-3">
        <div class="col">
          <select name="nama[]" id="nama[]" class='form-control' required>
            <option value="" selected disabled hidden>Choose here</option>
            {{-- @foreach ($obat as $data)
            <option>{{ $data->nama }}</option> --}}
            {{-- @endforeach --}}
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