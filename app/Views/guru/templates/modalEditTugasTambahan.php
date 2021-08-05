<div class="modal fade mt-2" id="editKegiatanModal" tabindex="-1" aria-labelledby="editKegiatanForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Edit Data Jurnal Mengajar</h6>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url()?>/guru/kegiatan/edit" method="post">
        <?= csrf_field(); ?>
            <div class="row">
                <div class="col py-2" style="max-width: 120px;">Pilih Tugas</div>
                <select name="editTugas" class="col custom-select mr-3" id="editTugas" required>
                    <option value="">-</option>
                    <?php foreach ($tugas as $t) :?>
                    <option value="<?=$t['nama_tugas']?>"><?=$t['nama_tugas']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row mt-1">
                <div class="col py-2" style="max-width: 120px;">Pilih Tanggal</div>
                <input class="col mr-3"id="editbln" name="editbln" type="date" value="<?=date('Y-m-d')?>" required>
            </div>
            <div class="form-group">
                <label for="inputKegiatan" class="col-form-label">Kegiatan </label>
                <textarea class="form-control" name="editKegiatan" id="editKegiatan" placeholder="Detail Kegiatan" rows="4" required></textarea>
            </div>
            <div class="row mt-0 mb-2">
                <div class="col py-2" style="max-width: 120px;">Jumlah </div>
                <input type="number" class="col mr-3 form-control" style="max-width: 120px;" name="editJml" id="editJml" placeholder="(menit)" required>
            </div>
            <div class="modal-footer px-0">
                <input type="hidden" id="idKegiatan" name="idKegiatan">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-5">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
