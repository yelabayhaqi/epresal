<div class="modal fade mt-1" id="addGuruModal" tabindex="-1" aria-labelledby="addGuruForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title">Tambah Data Guru</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-2">
        <form action="<?= base_url()?>/admin/dataguru/save" method="post">
        <?= csrf_field(); ?>
          <div class="form-group">
            <label for="inputNip" class="col-form-label">NIP :</label>
            <input type="text" class="form-control" name="inputNip" placeholder="masukan NIP" required>
          </div>
          <div class="form-group">
            <label for="inputNama" class="col-form-label">NAMA :</label>
            <input type="text" class="form-control" name="inputNama" placeholder="masukan nama Guru" required>
          </div>
          <div class="form-group">
            <label for="inputUname" class="col-form-label">USERNAME :</label>
            <input type="text" class="form-control" name="inputUname" placeholder="( jika kosong, default username = NIP )">
          </div>
          <div class="form-group">
            <label for="inputPsswd" class="col-form-label">PASSWORD :</label>
            <input type="password" class="form-control" name="inputPsswd" placeholder="( jika kosong, default password = '<?=$defpassword?>'">
          </div>
          <div class="form-group">
            <label for="inputRole" class="col-form-label">ROLE :</label>
            <select name="inputRole" class="custom-select">
                  <option value="2">GURU</option>
                  <option value="3">BK</option>
            </select>
          </div>
          
          <div class="modal-footer px-0 pt-1">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>