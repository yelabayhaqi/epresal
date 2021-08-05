<div class="modal fade mt-2" id="editTugasModal" tabindex="-1" aria-labelledby="editTugasForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Tugas</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="<?= base_url()?>/admin/tugas/edittugas" method="post">
            <?= csrf_field(); ?>
                <div class="form-group my-1 fs-5">
                    <label for="editTugas" class="col-form-label">Nama Tugas Tambahan : </label>
                    <textarea type="text" class="form-control" id="editTugas" name="editTugas" placeholder="input tugas tambahan" required></textarea>
                </div>
                <div class="form-group my-1 fs-5">
                    <label for="editKtg" class="col-form-label">Kategori : (opsional)</label>
                    <input type="text" class="form-control" id="editKtg" name="editKtg" placeholder="kategori tugas">
                </div>
                <input type="hidden" id="idTugas" name="idTugas">
                <div class="modal-footer px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>
<script>
  var modalEdit = new bootstrap.Modal(document.getElementById('editTugasModal'));
</script>