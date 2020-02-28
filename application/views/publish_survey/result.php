
<link href="<?=base_url('css/animate.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/inspinia.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/pace/pace.min.js')?>" type="text/javascript"></script>



<div class="content-wrapper">

  <div class="wrapper wrapper-content" >
    <div class="row">
      <div class="col-xs-12">
              <?php 
                   $jumlah[]='';

              $s='';$q='';$k='';$l='';$e='';$r='';
              $no=0;
              $CountDeb =  100/$CountD[0]->count;
              $JDebtor =0;
              foreach ($dtsurvey as $key) {
                    // foreach ($countSurvey as $data ) {
                    //     $jumlah[] =  $data->jumlah;
                    //   }
                      // var_dump($jumlah[$key->line_no]);exit();
                $e=$key->title;
                $o1= '';
              if ($e!= $r) {
                echo '<h2>'. $o1 = $key->title.'</h2>';
              }
              $r=$e;


                $k=$key->content;
                $z= '';
              if ($k!= $l) {
                echo '<h4>'. $z = $key->content.'</h4>';
              }
              $l=$k;


                $s = $key->options;

                     // $c ='';
                     if($s!= $q){

              // if (empty($countSurvey[$key->line_no-1]->jumlah)) {
              //   $nilai = 0;
              // } else{
              //   $nilai = $countSurvey[$key->line_no-1]->jumlah;
              // }
                $JDebtor = $CountDeb * $key->jumlah;
                // echo $JDebtor;
                $no++;
                echo $key->line_no+1;
               echo '. '.$key->options.' (Survey Progress '.(int)$JDebtor.'%)
              <div class="progress progress-striped active" style="width:70%">
              <div style="width: '.(int)$JDebtor.'%" aria-valuemax="5" aria-valuemin="0" aria-valuenow="10" role="progressbar" class="progress-bar progress-bar-primary">
                  <span class="sr-only">40% Complete (success)</span>
              </div>
              </div><hr><br>
              ';
                     }
                      // console.log(q);
                      $q = $s;

                        // return $c;
              }
           
              if ($Responden[0]->cnt == 0) {
                $res = 0;
              } else{
                $res = $Responden[0]->cnt;
              }
            
         ?>
         Total Responden : <?php echo $res ?>
      </div>            
    </div>
  </div>     
</div>

<!-- Bootstrap Modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div id="modalDialog" class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <h5 class="modal-title" id="modalTitle"></h5>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
<!--  <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script> -->
<!-- <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet"> -->
 