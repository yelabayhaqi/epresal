<div class="modal fade mt-4" id="delMapelModal" tabindex="-1" aria-labelledby="delMapelForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title">Hapus Data Guru</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/datamapel/dropall" method="post">
        <?= csrf_field(); ?>
          <div class="form-group">
            <h3 class="text-dark">Hapus Semua Data Mapel dan Kelas?</h3>
            <label for="confirmpsswd" class="col-form-label">Konfirmasi Password Admin :</label>
            <input type="password" class="form-control" name="confirmpsswd" required>
          </div>
          <div class="modal-footer px-0 py-0 pt-1">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger">HAPUS DATA</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>