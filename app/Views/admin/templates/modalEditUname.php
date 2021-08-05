<div class="modal fade mt-2" id="editUnameModal" tabindex="-1" aria-labelledby="editUnameForm" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Edit Username / Password</h6>
        <button type="button" class="close" data-bs-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>/user/edit/save" method="post">
        <?= csrf_field(); ?>
            <div class="form-check ml-2">
                <input class="form-check-input" type="checkbox" value="1" id="ubahUnameChk" name="ubahUnameChk" checked>
                <label class="form-check-label py-1" for="ubahUnameChk">
                    Ubah Username
                </label>
            </div>
            <div id="editUnameBox">
              <div class="form-group my-0">
                  <label for="inputUnameEdit" class="col-form-label py-0 pt-1">Username Lama :</label>
                  <input type="text" class="form-control" value="<?=session()->get('username')?>" disabled></input>
              </div> 
              <div class="form-group my-0">
                  <label for="inputUnameEdit" class="col-form-label py-0 pt-1">Username Baru :</label>
                  <input type="text" class="form-control" id="inputUnameEdit" name="inputUnameEdit" placeholder="Username Baru" required></input>
              </div> 
              
              <div class="form-group" id="psswdMain">
                  <label for="inputPsswd" class="col-form-label py-0 pt-1">Password :</label>
                  <input type="password" class="form-control" id="inputPsswd" name="inputPsswd" placeholder="masukan password untuk melanjutkan" required></input>
              </div>
            </div>

            <div class="form-check ml-2 mt-3 mb-2">
              <input class="form-check-input" type="checkbox" value="1" id="ubahPsswdChk" name="ubahPsswdChk">
              <label class="form-check-label py-1" for="ubahPsswdChk">
                  Ubah Password
              </label>
            </div>

            <div id="editPsswdBox" hidden>
              <div class="form-group my-0">
                  <label for="inputPsswdLama" class="col-form-label py-0 pt-1">Password Lama :</label>
                  <input type="password" class="form-control" id="inputPsswdLama" name="inputPsswdLama" placeholder="Masukan Password Lama"></input>
              </div>
              <div class="form-group">
                  <label for="inputPsswdBaru" class="col-form-label py-0 pt-1">Password Baru :</label>
                  <input type="password" class="form-control" id="inputPsswdBaru" name="inputPsswdBaru" placeholder="Masukan Password Baru" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Minimal 6 Karakter' : ''); if(this.checkValidity()) form.inputPsswdCnfrm.pattern = this.value;"></input>
                  <input type="password" class="form-control mt-1" id="inputPsswdCnfrm" name="inputPsswdCnfrm" placeholder="Konfirmasi Password Baru" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Masukkan Password Yang Sama' : '');"></input>
              </div>
            </div>
            <div class="modal-footer px-0" id="buttonSubmit">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary px-2">Buat Perubahan</button>
            </div>

        </form>
      </div>
    </div>
  </div>
</div>

<script>
    var toogleUname = 1;
    var tooglePsswd = 0;
    $('input[name="ubahUnameChk"]').on('change', function() {
        if(toogleUname == 1){
            document.getElementById("editUnameBox").hidden = true;
            $('#inputUnameEdit').removeAttr('required');
            toogleUname = 0;
        } else {
            document.getElementById("editUnameBox").hidden = false;
            $('#inputUnameEdit').prop('required', true);
            toogleUname = 1;
        }
        if ((toogleUname == 0)&&(tooglePsswd == 0)){
            document.getElementById("buttonSubmit").hidden = true;
        } else {
            document.getElementById("buttonSubmit").hidden = false;
        }
        if ((tooglePsswd == 0) && (toogleUname == 1)){
            $('#inputPsswd').prop('required', true);
        } else {
            $('#inputPsswd').removeAttr('required');
        }
    });
    $('input[name="ubahPsswdChk"]').on('change', function() {
        if(tooglePsswd == 1){
            document.getElementById("editPsswdBox").hidden = true;
            document.getElementById("psswdMain").hidden = false;
            $('#inputPsswd').prop('required', true);
            $('#inputPsswdLama').removeAttr('required');
            $('#inputPsswdBaru').removeAttr('required');
            $('#inputPsswdCnfrm').removeAttr('required');
            $('#inputPsswdLama').val('qwertyui123');
            $('#inputPsswdBaru').val('qwertyui123');
            $('#inputPsswdCnfrm').val('qwertyui123');

            tooglePsswd = 0;
        } else {
            document.getElementById("editPsswdBox").hidden = false;
            document.getElementById("psswdMain").hidden = true;
            $('#inputPsswd').removeAttr('required');
            $('#inputPsswdLama').prop('required', true);
            $('#inputPsswdBaru').prop('required', true);
            $('#inputPsswdCnfrm').prop('required', true);
            $('#inputPsswdLama').val('');
            $('#inputPsswdBaru').val('');
            $('#inputPsswdCnfrm').val('');
            tooglePsswd = 1;
        }
        if ((toogleUname == 0)&&(tooglePsswd == 0)){
            document.getElementById("buttonSubmit").hidden = true;
        } else {
            document.getElementById("buttonSubmit").hidden = false;
        }
    });
</script>