<div class="modal fade mt-2" id="addMapelModal" tabindex="-1" aria-labelledby="addMapelForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Mata Pelajaran</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="<?= base_url()?>/admin/datamapel/editmapel/addmapel" method="post">
            <?= csrf_field(); ?>
                <div class="form-group my-1 fs-4">
                    <label for="inputMapel" class="col-form-label">Nama Mata Pelajaran : </label>
                    <input type="text" class="form-control" name="inputMapel" placeholder="input mapel baru" required>
                </div>
                <div class="form-group my-1 fs-4">
                    <label for="inputKtg" class="col-form-label">Kategori (opsional) : </label>
                    <input type="text" class="form-control" name="inputKtg" placeholder="kategori mapel (opsional)">
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