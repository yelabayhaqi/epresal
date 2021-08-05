<div class="modal fade mt-2" id="addTugasModal" tabindex="-1" aria-labelledby="addTugasForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Tugas</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="<?= base_url()?>/admin/tugas/savetugas" method="post">
            <?= csrf_field(); ?>
                <div class="form-group my-1 fs-5">
                    <label for="inputKelas" class="col-form-label">Nama Tugas Tambahan : </label>
                    <input type="text" class="form-control" name="inputTugas" placeholder="input tugas tambahan baru" required>
                </div>
                <div class="form-group my-1 fs-5">
                    <label for="inputKelas" class="col-form-label">Kategori : (opsional)</label>
                    <input type="text" class="form-control" name="inputKtg" placeholder="kategori tugas">
                </div>
                <div class="modal-footer px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>