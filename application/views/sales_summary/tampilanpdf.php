<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>NUP Choose Unit Summary</title>
  <!-- <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>"> -->
  <style type="text/css">
      body{color: #333;font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;box-sizing: border-box;font-size: 13px;}
      table{width: 800px;border:solid 1px black; margin-left: 10px; }
      thead{font-size: 15px;font-weight: bold;}

  </style>
</head>
<body class="report">
  <div class="ibox float-e-margins" id="reports">
      <div class="ibox-title" style="margin-left: 340px">
            <div  style="font-size: 14px"><strong>Sales Summary Report </strong></div>
      </div><br>
      <div class="ibox-content" >

        <?php echo $Listdata; ?>

      </div>
  </div>
  <br>  
          
      </div>
</body>
</html>