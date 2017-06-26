<form id="formLogin" class="form-horizontal" action="#" method="post">
  <div class="modal-header">
  </div>
  <div class="modal-body">
    <input type="hidden" id="url_login" value="<?php echo $action?>">
    <input type="hidden" id="id" value="<?php echo $id?>">
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
      <div class="col-sm-10">
        <input type="text" name="i_username" value="" class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
      <div class="col-sm-10">
        <input type="password" name="i_password" value="" class="form-control">
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" name="button" class="btn btn-primary">OK</button>
    <button type="button" name="button" class="btn btn-danger" data-dismiss="modal" onclick="setDatePicker()">Batal</button>
  </div>
</form>

<script type="text/javascript">
  $(document).ready(function(){
  });

  function setDatePicker() {
      $(".datepickerid").removeClass('datepicker');
  }
</script>