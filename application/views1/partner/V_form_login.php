<form id="formLogin" class="" action="<?php echo $action?>" method="post">
  <div class="modal-header">

  </div>
  <div class="modal-body">
    <input type="hidden" id="id" name="id" value="<?php echo $id_partner?>">
    <div class="form-group">
      <label for="">Username</label>
      <input type="text" name="i_username" value="" class="form-control">
    </div>
    <div class="form-group">
      <label for="">Password</label>
      <input type="password" name="i_password" value="" class="form-control">
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" name="button" class="btn btn-primary">Ok</button>
    <button type="button" name="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
  </div>
</form>
