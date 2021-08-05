<div class="modal fade mt-2" id="editAduanModal" tabindex="-1" aria-labelledby="editAduanForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Edit Data Jurnal Mengajar</h6>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/guru/pengaduan/editaduan" method="post">
        <?= csrf_field(); ?>
        <div class="alert alert-warning px-2 py-2 my-2">
                    <div class="row">
                        <div class="col">
                            <span><b>Tanggal Aduan : </b>
                              <input type="text" class="alert-warning" id="tglAdu" style="border:none;" disabled>
                            </span><br/>
                            <span><b><?="Siswa Yang Dilaporkan : "?></b></span>
                            <div id="datasiswa" class="my-0 ml-3"></div>
                            <input type="text" class="alert-warning row mx-0" id="namakelas" style="border:none;" disabled>
                            Wali Kelas : 
                            <input type="text" class="alert-warning" id="namawali" style="border:none; width: 100% !important;" disabled>
                        </div>
                    </div>
                    <span><b><?="Keterangan Laporan : "?></b></span><br/>
                    <span><textarea class="form-control" id="editAduan" name="editAduan" required></textarea></span><br/>
                </div>
            <div class="modal-footer px-0">
                <input type="text" name="idAduan" id="idAduan" style="opacity: 0.0; width: 1px;">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-2">Buat Perubahan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
