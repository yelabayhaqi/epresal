<div class="modal fade mt-2" id="addKegiatanModal" tabindex="-1" aria-labelledby="addKegiatanForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Tambah Kegiatan</h6>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/guru/kegiatan/new" method="post">
        <?= csrf_field(); ?>
            <div class="row">
                <div class="col py-2" style="max-width: 120px;">Pilih Tugas</div>
                <select name="pilihTugas" class="col custom-select mr-3" id="pilihTugas" required>
                    <?php foreach ($tugas as $t) :?>
                    <option value="<?=$t['id']?>"><?=$t['nama_tugas']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row mt-1">
                <div class="col py-2" style="max-width: 120px;">Pilih Tanggal</div>
                <input class="col mr-3"id="bln" name="bln" type="date" value="<?=date('Y-m-d')?>" required>
            </div>
            <div class="form-group">
                <label for="inputKegiatan" class="col-form-label">Kegiatan </label>
                <textarea class="form-control" name="inputKegiatan" placeholder="Detail Kegiatan" rows="4" required></textarea>
            </div>
            <div class="row mt-0 mb-2">
                <div class="col py-2" style="max-width: 120px;">Jumlah </div>
                <input type="number" class="col mr-3 form-control" style="max-width: 120px;" name="inputJml" placeholder="(menit)" required>
            </div>
            <div class="modal-footer px-0">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-5">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
