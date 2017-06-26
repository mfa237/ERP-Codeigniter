
        <!-- MODAL -->
        <div id="modaladd" class="modal fade bs-modal-lg" tabindex="-1" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" style="width: 90%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Form <?php if(isset($title_page2)) echo $title_page2;?></h4>
                    </div>
                    <div class="modal-body">
                      <form action="#" id="formAdd" class="form-horizontal" method="post">
                      </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->

        <div class="modal fade" id="modal_login">
          <div class="modal-dialog">
            <div class="modal-content">
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner">
                <a href="http://www.jasawebsurabaya.com" target="_blank">&copy; Copyright Jasaweb Surabaya <?=date('Y')?></a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/theme/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/theme/global/plugins/excanvas.min.js"></script>
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url();?>assets/theme/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/custom_theme/scripts/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/custom_theme/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/custom_theme/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/global/plugins/sweet-alert/dist/sweetalert.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/theme/global/plugins/numberformat/jquery.number.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/theme/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/custom_theme/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
        <!-- <script src="<?php echo base_url();?>assets/custom_theme/jquery-number/jquery.number.min.js"></script> -->
        <script src="<?php echo base_url();?>assets/theme/global/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/theme/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/pages/scripts/custom.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/custom_theme/scripts/custom.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/theme/global/plugins/dropzone/form-dropzone.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
        <!-- <script src="<?php echo base_url();?>assets/theme/pages/scripts/form-wizard.min.js" type="text/javascript"></script> -->
        <!-- <script src="<?php echo base_url();?>assets/theme/pages/scripts/form-validation.min.js" type="text/javascript"></script> -->
        <!-- <script src="<?php echo base_url();?>assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script> -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url();?>assets/theme/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/theme/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script type="text/javascript">
        $(document).ready(function(){
            $.fn.modal.Constructor.prototype.enforceFocus = function() {};
            $(document).on('mousemove', function() {
              var yourVariable = "<?php echo $this->session->userdata('logged')?>";
              if (yourVariable=="") {
                window.location.reload(true);
              }
            });
        });
      </script>
