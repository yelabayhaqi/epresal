<div class="modal fade mt-2" id="delMapelModal" tabindex="-1" aria-labelledby="delMapelForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Mata Pelajaran</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/admin/datamapel/editmapel/delmapel" method="post">
        <?= csrf_field(); ?>
        <div class="card px-1 py-1 mt-1 pl-2" style="min-width: 300px; max-height: 560px;">
            <?php 
            $this->db = \Config\Database::connect();
            $mapel = $this->db->table('mapel')->select()->orderBy('kategori','asc')->orderBy('nama_mapel','asc')
            ->get()->getResultArray();
            if($mapel == NULL){?>
                <label class="text-center fs-5">Data Mata Pelajaran Kosong</label>
        </div>
            <?php } else { 
              $kat = "-";
              foreach ($mapel as $mp) :
                  if($mp['kategori'] == $kat){
                      ?>
                      <div class="row">
                          <div class="col">
                          <label class="px-0 py-0 mx-0 my-0 ml-5 hov-mapel">
                              <input class="form-check-input me-2" type="checkbox" name="selMapelDel<?=$mp['id']?>">
                              <span class="ml-2"><?=$mp['nama_mapel']?></span>
                          </label>
                          </div>
                      </div>
                      <?php 
                  } else {
                      $kat = $mp['kategori'];
                      ?>
                      <label class="mx-0 my-0 mt-1 ml-2"><?=$kat?></label>
                      <div class="row">
                          <div class="col">
                          <label class="px-0 py-0 mx-0 my-0 ml-5 hov-mapel">
                              <input class="form-check-input me-2" type="checkbox" name="selMapelDel<?=$mp['id']?>">
                              <span class="ml-2"><?=$mp['nama_mapel']?></span>
                          </label>
                          </div>
                      </div>
                      <?php 
                  }
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