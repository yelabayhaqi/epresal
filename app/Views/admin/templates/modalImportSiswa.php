<div class="modal fade mt-2" id="insertSiswaModal" tabindex="-1" aria-labelledby="insertSiswaModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title">Import Data Siswa</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-0">
        <img src="<?= base_url()?>/assets/img/sample-siswa.png" class="img-fluid">
        <ul class="alert alert-warning mt-2">
          <li class="ml-2">Sistem hanya akan membaca kolom tabel yang diblok biru (lihat gambar)</li>
          <li class="ml-2">Semua data wajib diisi. Jika terdapat satu kolom kosong, data di baris tersebut akan di skip</li>
          <li class="ml-2">Jika terdapat NISN sama dengan data yang sudah ada, Sistem hanya melakukan pembaruan tanpa menulis data baru untuk menghindari duplikasi</li>
        </ul>
        <span class="h6 mr-1">Download Sample :</span>
        <a href="<?= base_url()?>/assets/doc/datasiswa.xlsx" target="_blank">(.xlsx)</a>
        <a href="<?= base_url()?>/assets/doc/datasiswa.xls" target="_blank" class="ml-2">(.xls)</a>
        <form action="<?= base_url()?>/admin/datasiswa/import" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <label class="col-form-label">Masukan File :</label>
            <input type="file" name="file_xls" class="form-control-file" accept=".xls, .xlsx"/>
          </div>
          <div class="modal-footer px-0 py-0 pt-1">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-success">Insert Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>