<div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
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
              <td>{{$data->nama}}</td>
              <td>{{$data->jenis_kelamin}}</td>
              <td>{{$data->tanggal_lahir}}</td>
              <td>{{$data->jenis_pasien}}</td>
              <td>
                <form action="datapasien/{{ $data->id }}/hapus" method="post">
                  @csrf
                  @method("delete")
                  <a href="javascript:void(0)" id="editAdmin" data-id="{{ $data->id }}" data-toggle="tooltip"
                    class="badge badge-primary">Edit
                  </a>
                  <button type="submit" class="badge badge-danger">HAPUS</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>





    <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama..." required>
          </div>
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="tempat lahir..."
              required>
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
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan..." required>
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
            <select class="form-control" id="jenis_pasien" name="jenis_pasien" required>
              <option value="" selected disabled hidden>Choose here</option>
              <option>BPJS</option>
              <option>umum</option>
            </select>
          </div>
          <div class="form-group">
            <label for="no_BPJS">Nomor BPJS</label>
            <input type="text" class="form-control" id="no_BPJS" name="no_BPJS" placeholder="Nomor BPJS..." required>
          </div>




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