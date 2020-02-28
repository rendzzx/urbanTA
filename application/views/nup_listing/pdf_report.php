<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>NUP Listing</title>
   <!-- <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>"> -->
  <style type="text/css">
    .text-center{text-align:center}#outtable{padding:20px;border:1px solid #e3e3e3;width:600px;border-radius:5px}.short{width:15px}.normal{width:180px}.extra{width:200px}.sign{width:20px;text-align:left}.money{width:100px;text-align:right}.today{margin-left:30px}.signed{text-align:center;width:150px}.ft{height:50px;vertical-align:bottom}.t01{border-bottom: 1px solid black;border-top: 1px solid black; border-collapse: collapse;}.colheader{background-color: #f5f5f6;border: 1px solid #ddd;}.space{border-right: 10px solid transparent;}.tblbordered{border: 1px solid #ddd;}
  </style>
</head>
<body class="report">
  <div class="ibox float-e-margins" id="reports" >
        <div class="ibox-title" align="center" >
          <div style="font-size: 14px"><strong><?php echo $nama_project?></strong></div>
          <div><strong><u>NUP Listing</u></strong></div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox-content">
              <table class="table" style="width:800px;" align="center">
                <?php echo $isi_table?>
              </table>
            </div>
          </div>
        </div>
      </div>
</body>
</html>