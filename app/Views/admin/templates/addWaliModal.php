<div class="modal fade mt-2" id="addWaliModal" tabindex="-1" aria-labelledby="addWaliForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Data Wali Kelas</h5>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <?php 
            $guru = $this->db->table('users')->select('nama,id')
            ->where('level','2')
            ->orderBy('nama','asc')
            ->get()->getResultArray();
            ?>
                <div class="form-group my-1 fs-5">
                    <label for="namaWali" class="col-form-label">Nama Wali Kelas : </label>
                    <select name="namaWali" class="col custom-select mr-3" id="inputWali" required>
                      <option value="-">-</option>
                      <?php foreach ($guru as $g) :?>
                        <option value="<?=$g['id']?>"><?=$g['nama']?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group my-1 fs-4">
                    <label for="kelas" class="col-form-label">Kelas</label>
                    <input type="text" id="inputKelas" class="form-control" name="inputKelas" disabled>
                </div>
                <input type="hidden" id="idKelas">
                <div class="modal-footer px-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button id="addbtn" type="submit" class="btn btn-primary" onclick="savedata(0)">Simpan Data</button>
                    <button id="editbtn" type="submit" class="btn btn-primary" onclick="savedata(1)">Simpan Data</button>
                </div>
      </div>
    </div>
  </div>
</div>
<script>
    var modalAdd = new bootstrap.Modal(document.getElementById('addWaliModal'));
    function savedata(edit){
      if($('#inputWali').val() != '-'){
        var kelas = "kelas="+$('#inputKelas').val();
        var id_kelas = $('#idKelas').val();
        var guru = "&guru="+$('#inputWali').val();
        var edited = "&edit="+edit;
        console.log(kelas+guru+edit);
        $.ajax({
			    type: 'POST',
			    url: "<?=base_url()?>/admin/wali/savewali",
			    data: kelas+guru+edited,
			    success: function(hasil) {
			    	$("#guruwali"+id_kelas).html(hasil);
            $('#current-wali'+id_kelas).val($('#inputWali').val());
			    }
    	  });
        if(edit == 0){
        document.getElementById("btn-add"+id_kelas).className="btn btn-primary px-0 py-0 hide-mapel width-zero";
        document.getElementById("btn-edit"+id_kelas).className="btn btn-primary px-2 py-0 mr-1";
        }
        modalAdd.toggle();
        }
    };
</script>