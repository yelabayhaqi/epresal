<div class="modal fade mt-2" id="editGuruModal" tabindex="-1" aria-labelledby="editGuruForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title">Edit Data User</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body py-1">
        <form action="<?= base_url()?>/admin/dataguru/edit" method="post">
        <?= csrf_field(); ?>
          <div class="form-group my-0">
            <label for="editNip" class="col-form-label">NIP :</label>
            <input type="text" class="form-control" name="editNip" id="editNip" required>
          </div>
          <div class="form-group my-0">
            <label for="editNama" class="col-form-label">NAMA :</label>
            <input type="text" class="form-control" name="editNama" id="editNama" required>
          </div>
          <div class="form-group my-0">
            <label for="inputUname" class="col-form-label">USERNAME :</label>
            <input type="text" class="form-control" name="editUname" id="editUname" disabled>
          </div>
          <div class="form-group mt-1">
            <div class="alert alert-success mt-3" role="alert">
                <ul class="mb-1">
                    <li>user yang direset akan berstatus non-active</li>
                    <li>username default : NIP</li>
                    <li>password default : p@ssw0rd</li>
                </ul>
                <button type="button" class="btn btn-warning col" id="btnReset">Reset User</button>
            </div>
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

<div class="modal fade mt-2" id="cnfReset" tabindex="-1" aria-labelledby="cnfReset" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Reset Data User?</h4>
            </div>
            <form action="<?= base_url()?>/admin/dataguru/reset" method="post">
                <?=csrf_field(); ?>
                <div class="modal-footer py-2">
                    <input type="hidden" name="idswapreset" id="idswapreset">
                    <input type="hidden" name="nipswapreset" id="nipswapreset">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-warning">RESET USER</button>
                </div>
            </form>
        </div>
    </div>
</div>