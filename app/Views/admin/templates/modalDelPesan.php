<div class="modal fade mt-2" id="delPesanModal" tabindex="-1" aria-labelledby="delPesanForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/pesan/drop" method="post">
        <?=csrf_field();?>
          <div class="form-group my-3 pb-3 fs-4">
            <span>Hapus Pesan ini?</span>
          </div>
          <div class="modal-footer px-0">
            <input type="hidden" name="idPesan" id="cnfIdDel"/>
            <button type="button" class="btn btn-secondary mx-2" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger mx-2">HAPUS PESAN</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>