<!-- BEGIN FORM-->
    <form action="#" id="formAdd" class="form-horizontal" method="post">
        <div class="form-body">
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
            <div class="alert alert-success display-hide">
                <button class="close" data-close="alert"></button> Your form validation is successful! </div>
            <input type="hidden" id="url" value="Master-Data/Value-Barang/postData/">
            <div class="form-group">
                <label class="control-label col-md-4">ID Barang (Auto)
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="kode" readonly /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Kode Barang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="barang_kode" required disabled /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Barang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="barang_nama" required disabled /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nama Jenis Barang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="m_jenis_barang_id" name="m_jenis_barang_id" aria-required="true" aria-describedby="select-error" required disabled >
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Minimum Stok
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <input type="text" class="form-control" name="barang_minimum_stok" required disabled /> </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Satuan Barang
                    <span class="required"> * </span>
                </label>
                <div class="col-md-8">
                    <div class="input-icon right">
                        <i class="fa"></i>
                        <select class="form-control" id="barang_satuan" name="barang_satuan" aria-required="true" aria-describedby="select-error" required disabled>
                        </select>
                    </div>
                </div>
            </div>
            <hr>
            <div id="attribut-barang">
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-offset-4 col-md-8 text-right">
                    <button type="submit" class="btn green-jungle">Submit</button>
                    <button type="button" class="btn default reset" onclick="reset()">Reset</button>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM -->
    <script type="text/javascript">
        $(document).ready(function(){
        });
    </script>