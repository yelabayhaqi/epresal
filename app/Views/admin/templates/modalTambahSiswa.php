<div class="modal fade mt-2" id="addSiswaModal" tabindex="-1" aria-labelledby="addSiswaForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title">Tambah Data Siswa</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-0">
        <form action="<?= base_url()?>/admin/datasiswa/save" method="post">
        <?= csrf_field(); ?>
          <div class="form-group">
            <label for="inputNis" class="col-form-label">NIS :</label>
            <input type="text" class="form-control" name="inputNis" placeholder="(Nomor Induk Sekolah)" required>
          </div>
          <div class="form-group">
            <label for="inputNisn" class="col-form-label">NISN :</label>
            <input type="text" class="form-control" name="inputNisn" placeholder="(Nomor Induk Siswa Nasional)" required>
          </div>
          <div class="form-group">
            <label for="inputNama" class="col-form-label">NAMA :</label>
            <input type="text" class="form-control" name="inputNama" placeholder="(nama lengkap siswa)" required>
          </div>
          <div class="form-group">
            <label for="inputKelas" class="col-form-label">KELAS :</label>
            <input type="text" class="form-control" name="inputKelas" placeholder="(ex. XII-TKJ-2)" required>
          </div>
          <div class="modal-footer px-0 py-0 pt-1">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>