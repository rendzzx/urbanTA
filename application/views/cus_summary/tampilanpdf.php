<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>NUP Choose Unit Summary</title>
  <!-- <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>"> -->
  <style type="text/css">
      body{color: #333;font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;box-sizing: border-box;font-size: 13px;}
      table{width: 800px;border:solid 1px black; margin-left: 140px; }
      thead{font-size: 15px;font-weight: bold;}
  </style>
</head>
<body class="report">
  <div class="ibox float-e-margins" id="reports">
      <div class="ibox-title" align="center">
            <div  style="font-size: 15px"><strong>NUP Choose Unit Summary</strong></div><br>
            <div  style="font-size: 14px"><strong>Summary Pass</strong></div><br>
      </div>
      <div class="ibox-content" >

        <?php echo $Listdata; ?>

      </div>
  </div>
  <br>
  <div class="ibox float-e-margins" id="reports">
      <div class="ibox-title" align="center">
          <div style="font-size: 14px"><strong>Summary Stock</strong></div><br>
      </div>
      <div class="ibox-content" >

              <?php echo $Listdata2; ?>

      </div>
        
  </div>
        
          
      </div>
</body>
</html>