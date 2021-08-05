<div class="modal fade mt-2" id="delSiswaSingle" tabindex="-1" aria-labelledby="delSiswaForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/datasiswa/dropsingle" method="post">
          <?= csrf_field(); ?>
          <h4>Hapus Data Berikut</h4>
          <div class="form-group py-0 my-0">
            <label for="cnfNisn" class="col-form-label">NISN :</label>
            <input type="text" class="form-control" name="cnfNisnDel" id="cnfNisnDel" disabled>
          </div>
          <div class="form-group py-0 my-0">
            <label for="cnfNis" class="col-form-label">NIS :</label>
            <input type="text" class="form-control" name="cnfNisDel" id="cnfNisDel" disabled>
          </div>
          <div class="form-group py-0 my-0">
            <label for="cnfNama" class="col-form-label">NAMA :</label>
            <input type="text" class="form-control" name="cnfNamaDel" id="cnfNama" disabled>
          </div>
          <div class="form-group py-0 my-0">
            <label for="cnfKelas" class="col-form-label">KELAS :</label>
            <input type="text" class="form-control" name="cnfKelasDel" id="cnfKelas" disabled>
          </div>
          <div class="modal-footer px-0 py-0 pt-1">
            <input type="text" name="idswap" id="idswap" style="opacity: 0.0; width: 1px;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger">HAPUS DATA</button>
          </div>
        </form> 
      </div>
    </div>
  </div>
</div>