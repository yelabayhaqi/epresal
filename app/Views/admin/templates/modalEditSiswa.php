<div class="modal fade mt-2" id="editSiswaModal" tabindex="-1" aria-labelledby="editSiswaForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title">Edit Data Siswa</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/datasiswa/edit" method="post">
        <?= csrf_field(); ?>
          <div class="form-group my-0">
            <label for="editNis" class="col-form-label">NIS :</label>
            <input type="text" class="form-control" name="editNis" id="editNis" placeholder="(Nomor Induk Sekolah)" required>
          </div>
          <div class="form-group my-0">
            <label for="editNisn" class="col-form-label">NISN :</label>
            <input type="text" class="form-control" name="editNisn" id="editNisn" placeholder="(Nomor Induk Siswa Nasional)" required>
          </div>
          <div class="form-group my-0">
            <label for="editNama" class="col-form-label">NAMA :</label>
            <input type="text" class="form-control" name="editNama" id="editNama" placeholder="(nama lengkap siswa)" required>
          </div>
          <div class="form-group my-0">
            <label for="inputKelas" class="col-form-label">KELAS :</label>
            <input type="text" class="form-control" name="editKelas" id="editKelas" placeholder="(ex. XII-TKJ-2)" required>
          </div>
          <div class="modal-footer px-0 py-0 pt-1">
            <input type="text" name="idswapedit" id="idswapedit" style="opacity: 0.0; width: 1px;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>