<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/simple-line-icons/style.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/line-awesome/css/line-awesome.min.css')?>">


<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <h3 class="content-header-title"><?php echo $projectName; ?></h3>
        <h4 class="content-header-title">News And Promo</h4>
      </div>
    </div>
    <div class="content-body"> 
      <div class="row">      
        <div class="col-lg-12">
           <div class="card">
              <div class="card-header">
                <div class="card-content">
                  <?php echo $list_nf; ?>
                </div>
              </div>
           </div>
        </div>
      </div>

<!-- end of content -->
    </div>
  </div>
</div>
<div id="imagemodal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body" >
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">x</span></button>
        <img src="" class="imagepreview" style="width:100%">
      </div>
    </div>
  </div>
</div>
<!-- Bootstrap Modal -->
<div id="modalpdf" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
      <div class="modal-bodypdf" align="center">

      </div>

    </div>

  </div>
</div>

<?php
// echo $DataSurvey;
// echo $surveyy;
// if ($DataSurvey == 'ADA' && $name != 'ADMIN') {
//   $exec = 'ADA SURVEY UNTUK ANDA SILAKAN CLICK';
//    $url = 'window.location.href= site_url;';
// } else if ($name == 'ADMIN') {
//  $exec = '';
//   $url='';  
// }else{
//    $exec = '';
//   $url='';
// }


?>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">
   var site_url = '<?php echo base_url("c_survey/index")?>';


  var table;
  var namapdf = '<?php echo $pdfname; ?>';
  $(function() {


    $('.pop').on('click', function() {
      $('.imagepreview').attr('src', $(this).find('img').attr('src'));
      // $('.imagepreview').attr('alt', $(this).find('img').attr('alt'));
      $('#imagemodal').modal('show');   
    });   
  });
  $('#imagemodal').on('shown.bs.modal', function () {
    $(this).find('.modal-dialog').css({width:'auto',
     height:'auto', 
     'max-height':'130%'});
  });

  var data = '';
  function opendownload(data){
    // alert(data);
    // alert('klik');
    var modalClass = $('#modalpdf').attr('class');
    switch (modalClass) {
      case "modal fade bs-example-modal-lg":
      $('#modalpdf').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
      break;
      case "modal fade bs-example-modal-md":
      $('#modalpdf').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
      break;
      default:
      $('#modalpdf').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
      break;
    }

    var modalDialogClass = $('#modalDialog').attr('class');
    switch (modalDialogClass) {
      case "modal-dialog modal-lg":
      $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
      break;
      case "modal-dialog modal-md":
      $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
      break;
      default:
      $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
      break;
    }

    $('#modalTitle').html('Download Pdf');
    $('div.modal-bodypdf').load("<?php echo base_url("newsfeed/pdf");?>"+"/"+data);

    $('#modalpdf').data('namapdf', data).modal('show');

  }
 //end of opendownload

</script>

