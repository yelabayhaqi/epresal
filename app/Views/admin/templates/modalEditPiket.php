<div class="modal fade mt-2" id="editPiketModal" tabindex="-1" aria-labelledby="editPiketForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title">Edit Data User</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/dataguru/editpiket" method="post">
        <?= csrf_field(); ?>
          <div class="form-group my-0">
            <label for="editNip" class="col-form-label">NIP :</label>
            <input type="text" class="form-control" name="editNipP" id="editNipP" required>
          </div>
          <div class="form-group my-0">
            <label for="editNama" class="col-form-label">NAMA :</label>
            <input type="text" class="form-control" name="editNamaP" id="editNamaP" required>
          </div>
          <div class="form-group my-0">
            <label for="inputUname" class="col-form-label">USERNAME :</label>
            <input type="text" class="form-control" name="editUnameP" id="editUnameP" required>
          </div>
          <div class="form-group my-0">
            <label for="inputPsswd" class="col-form-label">PASSWORD :</label>
            <input type="password" class="form-control" name="editPsswdP" id="editPsswdP" placeholder="********">
          </div>
          <div class="modal-footer px-0 py-0 pt-1">
            <input type="hidden" name="idswapeditP" id="idswapeditP">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>