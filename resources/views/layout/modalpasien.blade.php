<div class="modal fade" id="modalpasien" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id=""></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="">
        <div class="align-center">
          <table border="0" width="90%" cellpadding="0" cellspacing="0" style="font-family: Arial; color:black;"
            align='center'>
            <tr bgcolor="#19bd9b">
              <th colspan="2" style="padding-top: 10px;">
                <h3 align="center">KLINIK AZ ZAHRA</h3>
              </th>
            </tr>
            @php
              $post = Session::get('post')
              
            @endphp
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">No Kartu</td>
              <td style="padding-top:10px;">: {{ $post['id_register'] ?? '' }}</td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Nama Lengkap</td>
              <td style="padding-top:10px;">: {{ $post['nama'] ?? '' }}</td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Jenis Kelamin</td>
              <td style="padding-top:10px;">: {{ $post['jenis_kelamin'] ?? '' }}</td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Pekerjaan</td>
              <td style="padding-top:10px;">: {{ $post['pekerjaan'] ?? '' }}</td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Alamat</td>
              <td style="padding-top:10px;">: {{ $post['alamat'] ?? '' }}</td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Tanggal Lahir</td>
              <td style="padding-top:10px;">: {{ $post['tanggal_lahir'] ?? '' }}</td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Jenis Pasien</td>
              <td style="padding-top:10px;">: {{ $post['jenis_pasien'] ?? '' }}</td>
            </tr>
            @if(isset($post))
              @if($post['jenis_pasien']=='BPJS')
              <tr bgcolor="#e7e7e7">
                <td width="150" style="padding-left:20px;padding-top: 10px;">No BPJS</td>
                <td style="padding-top:10px;">: {{ $post['no_BPJS'] ?? '' }}</td>
              </tr>
              @endif
            @endif
            <tr bgcolor="#19bd9b">
              <td width="150" style="padding-left:20px;padding-top: 10px;" colspan="2" align="center">
                Untuk Menikmati Layanan
                online di az-zahra.site <br>
                Username : {{ $post['id_register'] ?? '' }} Password : {{ $post['id_register'] ?? '' }}
              </td>
            </tr>
          </table>
          <p class='text-success p-2'>*screenshot atau cetak kartu pasien</p>
        </div>
      </div>
      <div class="modal-footer">
      <form action="/datapasien/{{ $post['id'] ?? ''}}/pdf" method="get">
        @csrf
        <input type="submit" class="btn btn-primary" value="Cetak Kartu">
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>