<div class="modal fade mt-2" id="addPresensiModal" tabindex="-1" aria-labelledby="addPresensiForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Buat Laporan Daftar Hadir</h6>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/guru/presensi/new" method="post">
        <?= csrf_field(); ?>
            <div class="row">
                <div class="col py-2" style="max-width: 30%;">Pilih Kelas </div>
                <select name="inputKelas" class="col custom-select mr-3" id="inputKelas" required>
                    <option value="">-</option>
                    <?php foreach ($kelasInput as $k) :?>
                    <option value="<?=$k['nama_kelas']?>"><?=$k['nama_kelas']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="row mt-3">
                <div class="col py-2" style="max-width: 30%;">Pilih Mapel </div>
                <select name="inputMapel" class="col custom-select mr-3" id="inputMapel" required>
                    <option value="">-</option>
                </select>
            </div>
            <div class="row mt-3 mb-3">
                <div class="col py-2" style="max-width: 30%;">Jam ke </div>
                <div class="col px-0 py-0">
                    <select id="jam1" name="inputJam1" class="col custom-select px-2 py-0" style="min-width: 60px; max-width: 70px" required>
                        <option value="">-</option>
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
                    <select id="jam2" name="inputJam2" class="col custom-select px-2 py-0" style="min-width: 60px; max-width: 70px" required>
                        <option value="">-</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer px-0">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-5">Buat</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
