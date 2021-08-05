<div class="modal fade mt-2" id="addPesanModal" tabindex="-1" aria-labelledby="addPesanForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Pesan Siaran Baru</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/pesan/save" method="post">
        <?= csrf_field(); ?>
            <div id="box-pesan" class="alert alert-warning">
                <div class="form-group my-1">
                    <span style="font-size: 12pt;"><?=format_hari_tanggal_lengkap(date('Y-m-d H:i:s'))?></span>
                    <input type="hidden" name="inputWaktu" value="<?=date('Y-m-d H:i:s')?>">
                </div>
                <div class="form-group my-1">
                    <label for="inputJudul" class="col-form-label">Judul :</label>
                    <input type="text" class="form-control" name="inputJudul" placeholder="judul pesan" required>
                </div>
                <div class="form-group my-1">
                    <label for="inputIsi" class="col-form-label">Isi Pesan :</label>
                    <textarea class="form-control" name="inputIsi" placeholder="isi pesan" style="height: 100px" required></textarea>
                </div>
                <div class="row">
                    <div class="form-group my-1 col">
                        <label for="inputPenerima" class="col-form-label">Penerima :</label>
                            <div class="form-check ml-2">
                                <input class="form-check-input" type="checkbox" value="1" id="tampilGuru" name="penerima0" checked>
                                <label class="form-check-label" for="tampilGuru">
                                    Guru Mapel
                                </label>
                            </div>
                            <div class="form-check ml-2">
                                <input class="form-check-input" type="checkbox" value="1" id="tampilBK" name="penerima1" checked>
                                <label class="form-check-label" for="tampilBK">
                                    Guru BK
                                </label>
                            </div>
                    </div>
                    <div class="form-group my-1 col">
                        <label for="inputTipe" class="col-form-label">Tipe :</label>
                        <div class="form-check ml-2">
                            <input class="form-check-input" type="radio" name="inputType" id="typeWarning" value="1" checked>
                            <label class="form-check-label" for="typeWarning">
                                Warning
                            </label>
                        </div>
                        <div class="form-check ml-2">
                            <input class="form-check-input" type="radio" name="inputType" id="typeDanger" value="2">
                            <label class="form-check-label" for="typeDanger">
                                Danger
                            </label>
                        </div>
                    </div>
                </div>

          </div>

          
          <div class="modal-footer px-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>