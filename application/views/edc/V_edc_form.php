

    <!-- BEGIN FORM-->

    <!--<div class="modal-header">

      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

     <h4 class="modal-title" id="gridSystemModalLabel">Form Master EDC</h4>

    </div>-->

    <div class="modal-body">

      <form action="#" id="formAdd" class="form-horizontal" method="post">

        <div class="form-body">

            <div class="alert alert-danger display-hide">

                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>

            <div class="alert alert-success display-hide">

                <button class="close" data-close="alert"></button> Your form validation is successful! </div>

            <input type="hidden" id="url" value="Master-Data/EDC/postData/">

            <input type="hidden" id="edc_id" name="edc_id" value="">

            <div class="form-group">

                <label class="control-label col-md-4">Nama Cabang

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <select class="form-control" id="m_cabang_id" name="m_cabang_id" aria-required="true" aria-describedby="select-error" required>

                        </select>

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-md-4">Nama EDC

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <input type="text" class="form-control" id="i_edc" name="i_edc" required /> </div>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-md-4">Nama Bank

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <select class="form-control" id="i_bank" name="i_bank" style="width:100%;" required /></select>

                    </div>

                </div>

            </div>

            <div class="form-group">

                <label class="control-label col-md-4">Status EDC

                    <span class="required"> * </span>

                </label>

                <div class="col-md-8">

                    <div class="input-icon right">

                        <i class="fa"></i>

                        <select class="form-control select2" id="edc_status_aktif" name="edc_status_aktif" aria-required="true" aria-describedby="select-error" required>

                            <option id="aktif" value="y"> Aktif </option>

                            <option id="nonaktif" value="n"> Non Aktif </option>

                        </select>

                    </div>

                </div>

            </div>

    </div>

    <div class="modal-footer">

      <div class="row">

        <div class="col-md-offset-4 col-md-8 text-right">

          <button type="submit" class="btn green-jungle">Submit</button>

          <button type="button" class="btn default reset" data-dismiss="modal">Close</button>

        </div>

      </div>

    </div>

  </form>

