<div class="modal fade mt-2" id="delKelasModal" tabindex="-1" aria-labelledby="delKelasForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Kelas</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/datamapel/editmapel/delkelas" method="post">
        <?= csrf_field(); ?>
        <div class="card px-1 py-1 mt-1 pl-2" style="min-width: 300px; max-height: 560px;">
            <?php 
            $this->db = \Config\Database::connect();
            $kelas = $this->db->table('kelas')->select()->orderBy('nama_kelas','asc')
            ->get()->getResultArray();
            if($kelas == NULL){?>
                <label class="text-center fs-5">Data Kelas Kosong</label>
        </div>
            <?php } else { 
            foreach ($kelas as $k) :
                ?>
                <div class="row">
                    <div class="col">
                        <label class="px-0 py-0 mx-0 my-0 ml-5 hov-mapel">
                            <input class="form-check-input me-2" type="checkbox" name="selKelasDel<?=$k['id']?>">
                            <span class="ml-2"><?=$k['nama_kelas']?></span>
                        </label>
                    </div>
                </div>
                <?php 
            endforeach; ?>
        </div>
        <div class="modal-footer px-0">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
            <button type="submit" class="btn btn-danger">HAPUS DATA</button>
        </div>
        <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>