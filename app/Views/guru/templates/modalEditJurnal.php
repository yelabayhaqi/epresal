<div class="modal fade mt-2" id="editJurnalModal" tabindex="-1" aria-labelledby="editJurnalForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Edit Data Jurnal Mengajar</h6>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/guru/jurnal/edit" method="post">
        <?= csrf_field(); ?>
            <div class="row">
                <div class="col py-2" style="max-width: 30%;">Kelas </div>
                <select name="inputKelasEdit" class="col custom-select mr-3" id="inputKelasEdit" disabled>
                    <?php foreach ($kelas as $dat) :?>
                    <option value="<?=$dat['kelas']?>"><?=$dat['kelas']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row mt-3">
                <div class="col py-2" style="max-width: 30%;">Mapel </div>
                <select name="inputMapelEdit" class="col custom-select mr-3" id="inputMapelEdit" disabled>
                    <option value="">-</option>
                </select>

            </div>

            <div class="row mt-3 mb-3">
                <div class="col py-2" style="max-width: 30%;">Jam ke </div>
                <div class="col px-0 py-0">
                    <select id="inputJam1Edit" name="inputJam1Edit" class="col custom-select px-2 py-0" style="min-width: 60px; max-width: 70px" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <span class="col fw-bolder fs-2 py-1"  style="max-width: 25px"> - </span>
                    <select id="inputJam2Edit" name="inputJam2Edit" class="col custom-select px-2 py-0" style="min-width: 60px; max-width: 70px" required>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inputKegiatanEdit" class="col-form-label">Kegiatan :</label>
                <textarea class="form-control" id="inputKegiatanEdit" name="inputKegiatanEdit" placeholder="Kegiatan Pembelajaran"rows="4"></textarea>
            </div>

            <div class="modal-footer px-0">
                <input type="text" name="idswapjurnal" id="idswapjurnal" style="opacity: 0.0; width: 1px;">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-2">Buat Perubahan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
