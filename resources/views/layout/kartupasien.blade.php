<div class="modal fade" id="modalkartu" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="align-center">
          <table border="0" width="90%" cellpadding="0" cellspacing="0" style="font-family: Arial; color:black;"
            align='center'>
            <tr bgcolor="#19bd9b">
              <th colspan="2" style="padding-top: 10px;">
                <h3 align="center">KLINIK AZ ZAHRA</h3>
              </th>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">No Kartu</td>
              <td style="padding-top:10px;" id='kartuid'>: </td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Nama Lengkap</td>
              <td style="padding-top:10px;" id='kartunama'>: </td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Jenis Kelamin</td>
              <td style="padding-top:10px;" id='kartujk'>: </td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Pekerjaan</td>
              <td style="padding-top:10px;" id='kartupekerjaan'>: </td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Alamat</td>
              <td style="padding-top:10px;" id='kartualamat'>: </td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Tanggal Lahir</td>
              <td style="padding-top:10px;" id='kartutl'>: </td>
            </tr>
            <tr bgcolor="#e7e7e7">
              <td width="150" style="padding-left:20px;padding-top: 10px;">Jenis Pasien</td>
              <td style="padding-top:10px;" id='kartujenis'>: </td>
            </tr>
              <tr bgcolor="#e7e7e7" id="kartunobpjs">
                <td width="150" style="padding-left:20px;padding-top: 10px;">No BPJS</td>
                <td style="padding-top:10px;" id='kartuno'>: </td>
              </tr>
            <tr bgcolor="#19bd9b">
              <td width="150" style="padding-left:20px;padding-top: 10px;" colspan="2" align="center">
                Layanan
                online di aplikasi klinik azzahra <br>
                Username  <p id='kartuuser' style='display:inline;'></p> Password  <p id='kartupass' style='display:inline;'></p>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <a href="/datapasien/{{ $post['id'] ?? ''}}/pdf" id='formcetakkartu' target='_blank' class="btn btn-primary">cetak kartu</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>