<div class="modal fade mt-2" id="editPesanModal" tabindex="-1" aria-labelledby="editPesanForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Pesan Siaran</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/pesan/edit/save" method="post">
        <?= csrf_field(); ?>
            <div id="edit-box-pesan" class="alert alert-warning">
                <div class="form-group my-1">
                    <input type="text" style="font-size: 12pt; border:none; width: 100% !important; " class="alert-warning" id="editInputWaktu" name="editInputWaktu" disabled>
                </div>
                <div class="form-group my-1">
                    <label for="editInputJudul" class="col-form-label">Judul :</label>
                    <input id="editJudul" type="text" class="form-control" name="editInputJudul" placeholder="judul pesan" required>
                </div>
                <div class="form-group my-1">
                    <label for="editInputIsi" class="col-form-label">Isi Pesan :</label>
                    <textarea id="editIsi" class="form-control" name="editInputIsi" placeholder="isi pesan" style="height: 100px" required></textarea>
                </div>
                <div class="row">
                    <div class="form-group my-1 col">
                        <label for="editInputPenerima" class="col-form-label">Penerima :</label>
                            <div class="form-check ml-2">
                                <input class="form-check-input" type="checkbox" value="1" id="editTampilGuru" name="editPenerima0" checked>
                                <label class="form-check-label" for="editTampilGuru">
                                    Guru Mapel
                                </label>
                            </div>
                            <div class="form-check ml-2">
                                <input class="form-check-input" type="checkbox" value="1" id="editTampilBK" name="editPenerima1" checked>
                                <label class="form-check-label" for="editTampilBK">
                                    Guru BK
                                </label>
                            </div>
                    </div>
                    <div class="form-group my-1 col">
                        <label for="editinputTipe" class="col-form-label">Tipe :</label>
                        <div class="form-check ml-2">
                            <input class="form-check-input" type="radio" name="editInputType" id="editTypeWarning" value="1">
                            <label class="form-check-label" for="editTypeWarning">
                                Warning
                            </label>
                        </div>
                        <div class="form-check ml-2">
                            <input class="form-check-input" type="radio" name="editInputType" id="editTypeDanger" value="2">
                            <label class="form-check-label" for="editTypeDanger">
                                Danger
                            </label>
                        </div>
                        <input type="hidden" name="editIdPesan" id="editId"/>
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

<div class="modal fade mt-2" id="cnfReset" tabindex="-1" aria-labelledby="cnfReset" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
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
                <div class="modal-footer">
                    <input type="text" name="idswapreset" id="idswapreset" style="opacity: 0.0; width: 1px;">
                    <input type="text" name="nipswapreset" id="nipswapreset" style="opacity: 0.0; width: 1px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-warning">RESET USER</button>
                </div>
            </form>
        </div>
    </div>
</div>