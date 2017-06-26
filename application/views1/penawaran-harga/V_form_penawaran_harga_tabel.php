<table class="table table-striped table-bordered table-hover table-checkable order-column text-center" id="default-table3">
    <thead>
        <tr>
            <th colspan="6" style="vertical-align: middle; text-align: center;"></th>
            <?php
                if ($supplier) {
                    foreach ($supplier->result() as $row) {
                        echo '<th colspan="4" style="vertical-align: middle; text-align: center;">'.$row->partner_nama.'</th>';
                    }
                }
            ?>
        </tr>
        <tr>
            <th colspan="6" style="vertical-align: middle; text-align: center;"></th>
            <?php
                if ($supplier) {
                    $no = 1;
                    foreach ($supplier->result() as $row) {
                        echo '
                            <th colspan="2" style="vertical-align: middle; text-align: center;">
                                Tanggal Kirim
                            </th>
                            <th colspan="2" style="vertical-align: middle; text-align: center;">
                                <input type="hidden" name="t_penawaran_supplier_id[]" value="'.$row->penawaran_supplier_id.'">
                                <div class="input-group date datepicker" data-date-format="dd/mm/yyyy" data-date-start-date="+0d">
                                    <input type="text" class="form-control" name="penawaran_supplier_tanggal_kirim[]" id="penawaran_supplier_tanggal_kirim'.$no.'">
                                    <span class="input-group-addon" style="">
                                        <span class="icon-calendar"></span>
                                    </span>
                                </div>
                            </th>
                        ';
                        $no++;
                    }
                }
            ?>
        </tr>
        <tr>
            <th style="vertical-align: middle; text-align: center;"> No </th>
            <th style="vertical-align: middle; text-align: center;"> Artikel </th>
            <th style="vertical-align: middle; text-align: center;"> Uraian dan Spesifikasi Barang/Jasa </th>
            <th style="vertical-align: middle; text-align: center;"> Qty </th>
            <th style="vertical-align: middle; text-align: center;"> Satuan </th>
            <?php
                if ($supplier) {
                    foreach ($supplier->result() as $row) {
                        echo '
                            <th style="vertical-align: middle; text-align: center;"> Qty Ditawarkan </th>
                            <th style="vertical-align: middle; text-align: center;"> Harga Satuan </th>
                            <th style="vertical-align: middle; text-align: center;"> Diskon </th>
                            <th style="vertical-align: middle; text-align: center;"> Mata Uang </th>
                            <th style="vertical-align: middle; text-align: center;"> PPN </th>
                        ';
                    }
                }
            ?>
        </tr>
    </thead>
    <tbody id="tableTbody3">
        <?php
            if ($barang) {
                $no = 1;
                foreach ($barang->result() as $row) {
                    echo '
                        <tr>
                            <td>
                                <input type="hidden" name="t_penawaran_barang_id[]" value="'.$row->penawaran_barang_id.'">
                                '.$no.'
                            </td>
                            <td>
                                '.$row->barang_nomor.'
                            </td>
                            <td style="width: 20%;">
                                '.$row->barang_nama.'('.$row->barang_nomor.', '.$row->jenis_barang_nama.')'.'
                            </td>
                            <td align="right">
                                '.number_format($row->penawaran_barang_qty,2,'.',',').'
                            </td>
                            <td>
                                '.$row->satuan_nama.'
                            </td>';
                    if ($supplier) {
                        $no2 = 1;
                        foreach ($supplier->result() as $row2) {
                            echo '
                                <td>
                                    <input type="text" class="form-control num2" name="penawaran_harga_qty_ditawarkan[]" value="0" required>
                                </td>
                                <td>
                                    <input type="hidden" name="t_penawaran_barang_id2[]" value="'.$row->penawaran_barang_id.'">
                                    <input type="hidden" name="t_penawaran_supplier_id2[]" value="'.$row2->penawaran_supplier_id.'">
                                    <input type="text" class="form-control money" name="penawaran_harga_nominal[]" id="penawaran_harga_nominal'.$no.''.$no2.'">
                                </td>
                                <td>
                                    <input type="text" class="form-control text-right" name="t_penawaran_barang_diskon_id2[]" value="" >
                                </td>
                                <td>
                                    <select class="form-control" id="m_mata_uang" name="m_mata_uang[]" aria-required="true" aria-describedby="select-error" style="width: 100%">';
                                        foreach ($mata_uang->result() as $row3)
                                        {
                                            if($row3->mata_uang_status_aktif == 'y')
                                            {
                                                echo '<option value="'.$row3->mata_uang_id.'"> '.$row3->mata_uang_nama.' </option>';
                                            }
                                        }
                            echo '
                                    </select>
                                </td>
                                <td>
                                    <label class="mt-radio"> Exclude
                                        <input type="radio" value="0" onchange="ppn(this)" name="penawaran_harga_ppn'.$row->penawaran_barang_id.$row2->penawaran_supplier_id.'" id="penawaran_harga_ppn'.$row->penawaran_barang_id.$no2.'" checked required />
                                        <span></span>
                                    </label>
                                    <!--<label class="mt-radio"> Include
                                        <input type="radio" value="1" onchange="ppn(this)" name="penawaran_harga_ppn'.$row->penawaran_barang_id.$row2->penawaran_supplier_id.'" id="penawaran_harga_ppn'.$row->penawaran_barang_id.$no2.'" />
                                        <span></span>
                                    </label>-->
                                    <label class="mt-radio"> Include
                                        <input type="radio" value="2" onchange="ppn(this)" name="penawaran_harga_ppn'.$row->penawaran_barang_id.$row2->penawaran_supplier_id.'" id="penawaran_harga_ppn'.$row->penawaran_barang_id.$no2.'" />
                                        <span></span>
                                    </label>
                                </td>
                            ';
                            $no2++;
                        }
                    }

                    echo '
                        </tr>
                    ';
                    $no++;
                }
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6" style="vertical-align: middle; text-align: right;"> Diskon : &nbsp;&nbsp;</th>
            <?php
                if ($supplier) {
                    $no = 1;
                    foreach ($supplier->result() as $row) {
                        echo '<th colspan="4">
                                    <div class="input-group">
                                        <input type="text" class="form-control decimal" name="penawaran_supplier_diskon[]"
                                        onkeypress="cekDiskon(this)" id="penawaran_supplier_diskon'.$no.'" value="0">
                                        <span class="input-group-addon" style="">
                                            %
                                        </span>
                                    </div>
                            </th>
                        ';
                        $no++;
                    }
                }
            ?>
        </tr>
        <tr>
            <th colspan="6" style="vertical-align: middle; text-align: right;"> PPN : &nbsp;&nbsp;</th>
            <?php
                if ($supplier) {
                    $no = 1;
                    foreach ($supplier->result() as $row) {
                        echo '<th colspan="4">
                                    <div class="input-group">
                                        <input type="text" class="form-control decimal" name="penawaran_supplier_ppn[]" onkeypress="cekDiskon(this)" id="penawaran_supplier_ppn'.$no.'" value="10">
                                        <span class="input-group-addon" style="">
                                            %
                                        </span>
                                    </div>
                            </th>
                        ';
                        $no++;
                    }
                }
            ?>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
    $(document).ready(function(){
        $('.money').number( true, 2, '.', ',' );
        $('.money').css('text-align', 'right');
        $('.num2').number( true, 2, '.', ',' );
        $('.num2').css('text-align', 'right');
        $('.datepicker').datepicker();
        $(".decimal").keydown(function(event) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A, Command+A
            (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) ||
            // Allow: home, end, left, right, down, up
            (event.keyCode >= 35 && event.keyCode <= 40) || event.keyCode == 190 ) {
            // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                event.preventDefault();
            }
        });
        $(".num").keydown(function(event) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(event.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                 // Allow: Ctrl+A, Command+A
                (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) ||
                 // Allow: home, end, left, right, down, up
                (event.keyCode >= 35 && event.keyCode <= 40)) {
                     // let it happen, don't do anything
                     return;
            }
            // Ensure that it is a number and stop the keypress
            if ((event.shiftKey || (event.keyCode < 48 || event.keyCode > 57)) && (event.keyCode < 96 || event.keyCode > 105)) {
                event.preventDefault();
            }
        });
    });
    function cekDiskon(element)
    {
        var diskon = element.value;
        // alert(diskon);
        if(diskon > 10)
        {
            event.preventDefault();
        }
    }
    function ppn(element)
    {
        var id = element.id;
        var no = id.charAt(id.length-1);
        if(element.value == 0)
        {
            document.getElementById('penawaran_supplier_ppn'+no).readOnly = false;
            document.getElementById('penawaran_supplier_ppn'+no).value = 10;
        }
        else if(element.value == 1)
        {
            document.getElementById('penawaran_supplier_ppn'+no).readOnly = false;
            document.getElementById('penawaran_supplier_ppn'+no).value = 10;
        }
        else if(element.value == 2)
        {
            document.getElementById('penawaran_supplier_ppn'+no).readOnly = true;
            document.getElementById('penawaran_supplier_ppn'+no).value = 0;
        }

    }
</script>
