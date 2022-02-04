<div class="modal fade" id="modalriwayat" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table">
            <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Nama Pasien</th>
                  <th scope="col">Diagnosa</th>
                  <th scope="col">Resep</th>
                  <th scope="col">Dokter</th>
                </tr>
            </thead>
            <tbody id='barismodalriwayat'>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <form action="" method="get" id='formcetakkartu'>
        @csrf
        <input type="submit" class="btn btn-primary" value="Cetak Kartu">
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>