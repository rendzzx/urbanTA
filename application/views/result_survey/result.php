
<script src="<?=base_url('js/plugins/pace/pace.min.js')?>" type="text/javascript"></script>


<!-- <div class="ibox-content">
<div class="form-group"> -->
  <!-- <label>Survey Title</label> -->
  <div class="col-12">
        <?php 
          $jumlah[]='';

          $s='';$q='';$k='';$l='';$e='';$r='';
          $no=0;
              
          if ($Responden[0]->cnt == 0) {
            $res = 0;
          } else {
            $res = $Responden[0]->cnt;
          }

          $JDebtor = 0;
          foreach ($dtsurvey as $key) {
                  
            $e=$key->title;
            $o1= '';
            if ($e!= $r) {
              echo '<h2 style=" margin-top: 10px;">'. $o1 = $key->title.'</h2>';
            }
            $r=$e;

            $k=$key->content;
            $z= '';
            if ($k!= $l) {
              echo '<h4>'. $z = $key->content.'</h4>';
            }
            $l=$k;

            $s = $key->options;

            if($s!= $q){
              if($res!=0){
                $JDebtor = ($key->jumlah/$res)*100;
              }else{
                $JDebtor = 0;
              }
               
              $no++;
              echo $key->line_no;
              echo '. '.$key->options.' (Survey Progress '.(int)$JDebtor.'%)
              <div class="progress progress-striped active" style="width:100%">
              <div style="width: '.(int)$JDebtor.'%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="10" role="progressbar" class="progress-bar progress-bar-primary">
                  <span class="sr-only">40% Complete (success)</span>
              </div>
              </div><hr>
              ';
            }
                 
            $q = $s;

          }
           
      ?>
      Total Responden : <?php echo $res ?>

</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#savefrm').hide();
    // document.getElementById('savefrm').style.visibility = 'hidden';
  });

</script>
