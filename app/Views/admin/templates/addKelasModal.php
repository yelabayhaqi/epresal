<div class="modal fade mt-2" id="addKelasModal" tabindex="-1" aria-labelledby="addKelasForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Kelas</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="<?= base_url()?>/admin/datamapel/editmapel/addkelas" method="post">
            <?= csrf_field(); ?>
                <div class="form-group my-1 fs-4">
                    <label for="inputKelas" class="col-form-label">Kelas : </label>
                    <input type="text" class="form-control" name="inputKelas" placeholder="input kelas baru" required>
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