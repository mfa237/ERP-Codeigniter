<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">

      body {
        width: 100%;
        font-size: 12px;
        margin: 40px;
      }

      .center,
      td.center
      {
        text-align: center;
        min-height: 200px;
      }

      td {
        height: 100px!important;
      }

      .price
      {
        font-size: 40px;
      }

      @media print{
        body {
          /*width: 100%;*/
          font-size: 12px!important;
          margin: 40px;
        }

        tr, td {
          text-align: center;
        }
        td {
          height: 100px;
        }

        tr.barcode{
          margin: 40px;
        }
      }

    </style>
  </head>
  <body  onload=print()>
    <table>
        <tr class="barcode">
            <div style="margin-top: 10px;margin-bottom: 10px;">
              <?php foreach ($img as $value) {?>
                <tr style="padding-top: 20px;">
                  <td>
                    <img src="<?php echo site_url();?>C_barang/printpricetagbarcode_/<?php echo $value;?>" id="image_barcode">
                  </td>
                </tr>
                <?php  } ?>
            </div>
        </tr>
    </table>
  </body>
</html>
