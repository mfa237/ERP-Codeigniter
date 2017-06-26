            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEAD-->
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1><?php if(isset($title_page)) echo $title_page;?>
                                <small><?php if(isset($title_page2)) echo $title_page2;?></small>
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                        <!-- END PAGE TOOLBAR -->
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <a href="<?php echo base_url();?>"> Dashboard </a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a href="#"> <?php if(isset($title_page)) echo $title_page;?> </a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span class="active"><?php if(isset($title_page2)) echo $title_page2;?></span>
                        </li>
                    </ul>
                    <!-- END PAGE BREADCRUMB -->
                    <!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit portlet-datatable bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-list font-dark"></i> &nbsp;&nbsp;
                                        <span class="caption-subject font-dark sbold uppercase"><?php if(isset($title_page2)) echo $title_page2;?></span>
                                    </div>
                                </div>
                                <input type="hidden" name="tipe_karyawan" id="tipe_karyawan" value="<?= $tipeKaryawan ?>">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="default-table-kartu-stok" style="width: 50%;">
                                    <thead>
                                        <tr>
                                            <th> Nama Menu </th>
                                            <th width="5%"> Tambah </th>
                                            <th width="5%"> Lihat </th>
                                            <th width="5%"> Edit </th>
                                            <th width="5%"> Hapus </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($parent as $menuParent) {
                                                echo '<tr>';
                                                echo '<td> <input type="hidden" id="jml_'.$menuParent['menu_id'].'" value="0"><b>'.$menuParent['menu_nama'].'</b></td>';
                                                echo '<td></td>';
                                                echo '<td></td>';
                                                echo '<td></td>';
                                                echo '<td></td>';
                                                echo '</tr>';
                                                foreach ($subMenu as $menu) {
                                                    if($menu['menu_parent'] == $menuParent['menu_id'])
                                                    {
                                                        echo '<tr>';
                                                        echo '<input type="hidden" id="jml_'.$menu['menu_id'].'" value="0">';
                                                        echo '<td style="text-align:left;"><input type="checkbox" name="'.$menu['menu_id'].'" id="'.$menu['menu_id'].'" onclick="select_all(this)"> '.$menu['menu_nama'].'</td>';
                                                        echo '<td align="center"><input type="checkbox" name="'.$menu['menu_id'].'[]" class="'.$menu['menu_id'].'" id="create'.$menu['menu_id'].'" onclick="selectOne(this)"></td>';
                                                        echo '<td align="center"><input type="checkbox" name="'.$menu['menu_id'].'[]" class="'.$menu['menu_id'].'" id="read'.$menu['menu_id'].'" onclick="selectOne(this)"></td>';
                                                        echo '<td align="center"><input type="checkbox" name="'.$menu['menu_id'].'[]" class="'.$menu['menu_id'].'" id="update'.$menu['menu_id'].'" onclick="selectOne(this)"></td>';
                                                        echo '<td align="center"><input type="checkbox" name="'.$menu['menu_id'].'[]" class="'.$menu['menu_id'].'" id="delete'.$menu['menu_id'].'" onclick="selectOne(this)"></td>';
                                                        echo '</tr>';
                                                    }
                                                }                                                
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
    <?php $this->load->view('layout/V_footer');?>

<script type="text/javascript">
    $(document).ready(function(){
        searchData();
    });

    function searchData()
    {
        var tipe = document.getElementById("tipe_karyawan").value;
        $.ajax({
            type : "GET",
            url  : '<?php echo base_url();?>Setting/User-Privilege/loadDataWhere/',
            data : {tipe: tipe},
            dataType : "json",
            success:function(data){
                for(var i=0; i<data.val.length;i++){
                    $("#jml_"+data.val[i].menu_id).val("1");
                    $("#jml_"+data.val[i].menu_parent).val("1");
                    if((data.val[i].create == '1') && (data.val[i].read == '1') && (data.val[i].update == '1') && (data.val[i].delete == '1'))
                    {
                        $("#"+data.val[i].menu_id).prop("checked", true);
                    }
                    if(data.val[i].create == '1')
                    {
                        $("#create"+data.val[i].menu_id).prop("checked", true);
                    }
                    else
                    {
                        $("#create"+data.val[i].menu_id).prop("checked", false);
                    }
                    if(data.val[i].read == '1')
                    {
                        $("#read"+data.val[i].menu_id).prop("checked", true);
                    }
                    else
                    {
                        $("#read"+data.val[i].menu_id).prop("checked", false);
                    }
                    if(data.val[i].update == '1')
                    {
                        $("#update"+data.val[i].menu_id).prop("checked", true);
                    }
                    else
                    {
                        $("#update"+data.val[i].menu_id).prop("checked", false);
                    }
                    if(data.val[i].delete == '1')
                    {
                        $("#delete"+data.val[i].menu_id).prop("checked", true);
                    }
                    else
                    {
                        $("#delete"+data.val[i].menu_id).prop("checked", false);
                    }
                  }
            }
        });
    }

    function select_all(element)
    {
        var id = $(element).attr("id");
        var tipe_karyawan = document.getElementById("tipe_karyawan").value;
        var valPost = document.getElementById("jml_"+id).value;
        if(element.checked)
        {
            var tambah = 1;
            var lihat = 1;
            var edit = 1;
            var hapus = 1;
            $.ajax({
                type : "POST",
                url  : '<?php echo base_url();?>Setting/User-Privilege/postData/',
                data : {id: id, tipe_karyawan: tipe_karyawan, valPost: valPost, tambah: tambah, lihat: lihat, edit: edit, hapus: hapus},
                dataType : "json",
                success:function(data){

                    $("#jml_"+id).val("1");
                    $("."+id).prop("checked", true);
                }
            });
        }
        else
        {
            var tambah = 0;
            var lihat = 0;
            var edit = 0;
            var hapus = 0;
            $.ajax({
                type : "POST",
                url  : '<?php echo base_url();?>Setting/User-Privilege/postData/',
                data : {id: id, tipe_karyawan: tipe_karyawan, valPost: valPost, tambah: tambah, lihat: lihat, edit: edit, hapus: hapus},
                dataType : "json",
                success:function(data){
                    $("#jml_"+id).val("1");
                    $("."+id).prop("checked", false);
                }
            });
        }
    }
    function selectOne(element)
    {
        var tambah = 0;
        var lihat = 0;
        var edit = 0;
        var hapus = 0;
        var id = $(element).attr("id");
        var menuId = $(element).attr("class");
        var tipe_karyawan = document.getElementById("tipe_karyawan").value;
        var valPost = document.getElementById("jml_"+menuId).value;
        if(valPost == 0)
        {
            valPost = 1;
            document.getElementById("jml_"+menuId).value = valPost;
        }
        if(element.checked)
        {
            // alert($("#create"+menuId).checked);
            if(document.getElementById("create"+menuId).checked)
            {
                tambah = 1;
            }
            if(document.getElementById("read"+menuId).checked)
            {
                lihat = 1;
            }
            if(document.getElementById("update"+menuId).checked)
            {
                edit = 1;
            }
            if(document.getElementById("delete"+menuId).checked)
            {
                hapus = 1;
            }
            $.ajax({
                type : "POST",
                url  : '<?php echo base_url();?>Setting/User-Privilege/postData/',
                data : {id: menuId, tipe_karyawan: tipe_karyawan, valPost: valPost, tambah: tambah, lihat: lihat, edit: edit, hapus: hapus},
                dataType : "json",
                success:function(data){
                    $("#jml_"+menuId).val("1");
                    $("#"+id).prop("checked", true);
                }
            });
        }
        else
        {
            if(document.getElementById("create"+menuId).checked)
            {
                tambah = 1;
            }
            if(document.getElementById("read"+menuId).checked)
            {
                lihat = 1;
            }
            if(document.getElementById("update"+menuId).checked)
            {
                edit = 1;
            }
            if(document.getElementById("delete"+menuId).checked)
            {
                hapus = 1;
            }
            $.ajax({
                type : "POST",
                url  : '<?php echo base_url();?>Setting/User-Privilege/postData/',
                data : {id: menuId, tipe_karyawan: tipe_karyawan, valPost: valPost, tambah: tambah, lihat: lihat, edit: edit, hapus: hapus},
                dataType : "json",
                success:function(data){
                    $("#jml_"+menuId).val("1");
                    $("#"+id).prop("checked", false);
                }
            });
        }
        if((document.getElementById("create"+menuId).checked) && (document.getElementById("read"+menuId).checked) && (document.getElementById("update"+menuId).checked) && (document.getElementById("delete"+menuId).checked))
        {
            $("#"+menuId).prop("checked", true);
        }
        else
        {
            $("#"+menuId).prop("checked", false);
        }
    }
            
</script>