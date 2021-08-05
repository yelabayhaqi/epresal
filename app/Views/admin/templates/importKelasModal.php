<div class="modal fade mt-2" id="importKelasModal" tabindex="-1" aria-labelledby="importKelasModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Import Data Kelas</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="<?= base_url()?>/assets/img/sample-kelas.png" class="img-fluid mx-auto">
        <ul class="alert alert-warning mt-2">
          <li class="ml-2">Sistem hanya akan membaca kolom tabel yang diblok biru (lihat gambar)</li>
          <li class="ml-2">Data Kelas Wajib diisi</li>
          <li class="ml-2">Jika terdapat kesamaan dengan data yang sudah ada, Sistem tidak menambah data baru untuk menghindari duplikasi</li>
        </ul>
        <span class="h6 mr-1">Download Sample :</span>
        <a href="<?= base_url()?>/assets/doc/datakelas.xlsx" target="_blank">(.xlsx)</a>
        <a href="<?= base_url()?>/assets/doc/datakelas.xls" target="_blank" class="ml-2">(.xls)</a>
        <form action="<?= base_url()?>/admin/datamapel/editmapel/importkelas" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <label class="col-form-label">Masukan File :</label>
            <input type="file" name="file_xls" class="form-control-file" accept=".xls, .xlsx"/>
          </div>
          <div class="modal-footer px-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-success">Insert Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>