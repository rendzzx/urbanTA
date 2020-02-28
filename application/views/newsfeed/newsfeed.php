<link href="<?=base_url('app-assets/vendors/css/slick/slick.css') ?>" rel="stylesheet">
<link href="<?=base_url('app-assets/vendors/css/slick/slick-theme.css') ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/aset/reset1.css')?>" />
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/aset/style1.css')?>" />
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/aset/elastislide.css')?>" />
<link href="<?=base_url('app-assets/vendors/css/blueimp/css/blueimp-gallery.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
         <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
               <div class="slides"></div>
               <h3 class="title"></h3>
               <a class="prev">‹</a>
               <a class="next">›</a>
               <a class="close">×</a>
               <a class="play-pause"></a>
               <ol class="indicator"></ol>
            </div>

    <noscript>
      <style>
        .es-carousel ul{
          display:block;
        }
        
      </style>
    </noscript>

    <script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">  
      <div class="rg-image-wrapper">
        {{if itemsCount > 1}}
          <div class="rg-image-nav">
            <a href="#" class="rg-image-nav-prev">Previous Image</a>
            <a href="#" class="rg-image-nav-next">Next Image</a>
          </div>
        {{/if}}
        <div class="rg-image"></div>
        <div class="rg-loading"></div>
      </div>
    </script>
    <div class="app-content content">
      <div class="content-wrapper">
      
        <div class="content-wrapper-before" style="height: 150px !Important"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2">
              <br><br>
              <h5 class="content-header-title"><?php echo $projectName; ?></h5>
            </div>

            <div class="content-header-right col-md-4 col-12 mb-2">
             <br><br>
              
              <!-- tes -->
              <div class="row" style="width: 100%">
                <div id="Interested" style="cursor: pointer; padding-right: 10px;" class="col-md-6" align="right">
                  <div class="row">
                    <img class="img-responsive" style="width: 35px; height: 100%;margin-bottom: 5px;" src="<?=base_url('img/icon/im.png')?>">
                    <p style="padding-left: 8px;"><h5 class="content-header-title" style="padding-top: 7px;">I'm Interested</h5></p>
                  </div>
                </div>

                <div class="col-md-6">
                  <a href="<?php echo $brochure ?>" target="_blank">
                    <div class="row">
                      <img class="img-responsive" style="width: 35px; height:100%;>" src="<?=base_url('img/icon/brochure.png')?>">
                      <p style="padding-left: 8px"><h5 class="content-header-title" style="padding-top: 7px;">Brochure</h5></p>
                    </div>
                  </a>
                  
                </div>
              </div>
              
            </div>
        </div>

  <!-- ~~~~~~~~~~~~~~~~~ Project gallery -->
        <div class="content-body">
        
          <div class="row">
             
              <div class="col-md-12 ">
                <div class="card">
                 
                  <div class="card-content">
                    <div class="card-body">
                      
                       <div class="ibox float-e-margins">                                   
                            <div class="ibox" id="ibox">
                                <div class="ibox">
                                  <div class="ibox-content" style="background: #ffffff; padding-left: 30px;padding-right: 30px;">
                                      <h1><span style="line-height: 2.3em;
                                      display: inline-block;border-bottom: #00a1e4 5px solid; font-size:18px;">Project Gallery</span></h1>
                                          <div id="rg-gallery" class="rg-gallery">
                                            <div class="rg-thumbs">
                                              <!-- Elastislide Carousel Thumbnail Viewer -->
                                              <div class="es-carousel-wrapper">
                                                <div class="es-nav">
                                                  <span class="es-nav-prev">Previous</span>
                                                  <span class="es-nav-next">Next</span>
                                                </div>
                                                <div class="es-carousel">
                                                  <ul>
                                                  <?php foreach ($dtNews5 as $key) { ?>
                                                    <li><a href="#"><img data-large="<?php echo $key->gallery_url; ?>" src="<?php echo $key->gallery_url; ?>"></a></li>
                                                    <?php } ?>
                                                  </ul>
                                                </div>
                                              </div>
                                              <!-- End Elastislide Carousel Thumbnail Viewer -->
                                            </div><!-- rg-thumbs -->
                                          </div><!-- rg-gallery -->
                                  </div>
                                </div>
                            </div>
                        </div>

                    </div>
                  </div>
                </div>

                
          </div>
        </div>
        <!-- ~~~~~~~~~~~~~~~~~ Bates -->

 
    <!-- ~~~~~~~~~~~~~~~~~ Project overview -->
          <div class="content-body">
            <div class="row">
                <div class="col-md-12 ">
                  <div class="card">
                    
<div class="card-content">
                      <div class="card-body">
                          <?php echo $list_nf; ?> 
</div>
</div>
                     
                  </div>
                </div>
            </div>   
          </div>
          <!-- ~~~~~~~~~~~~~~~~~ BATES  -->

           
    <!-- ~~~~~~~~~~~~~~~~~ Project plans -->
          <div class="content-body">
            <div class="row">
                <div class="col-md-12 ">
                  <div class="card">
                    <div class="card-content">
                      <div class="card-body">

                          <h1><span style="line-height: 2.3em;
                            display: inline-block;border-bottom: #00a1e4 5px solid; font-size:18px;">Project Plans</span></h1>

                            <div class="slick_demo_2">
                               <?php foreach ($dtNews6 as $key) { ?>
                                  <a href="<?php echo $key->plan_url; ?>" data-gallery="" title="Project Plans"><img class="img-responsive" src="<?php echo $key->plan_url; ?>"></a>
                               <?php } ?>
                            </div>

                      </div>
                    </div>
                  </div>
                </div>
            </div>   
          </div>
          <!-- ~~~~~~~~~~~~~~~~~ BATES  -->

    <!-- ~~~~~~~~~~~~~~~~~ Amenitis -->
          <div class="content-body">
            <div class="row">
                <div class="col-md-12 ">
                  <div class="card">
                    <div class="card-content">
                      <div class="card-body">

                          <h2><span style="line-height: 2.3em;display: inline-block;border-bottom: #00a1e4 5px solid; font-size:18px;">Amenities</span></h2>
                                      <div class="tabs-container">
                                          <ul class="nav nav-tabs">
                                          <li class="active"><a data-toggle="tab" href="#tab-1" style="color: #676a6c">Infrasturktur</a></li>
                                          <li class=""><a data-toggle="tab" href="#tab-2" style="color: #676a6c">School</a></li>
                                          <li class=""><a data-toggle="tab" href="#tab-3" style="color: #676a6c">Hospital</a></li>
                                          <li class=""><a data-toggle="tab" href="#tab-4" style="color: #676a6c">Other</a></li>
                                          </ul>
                                          <div class="tab-content">
                                          <div id="tab-1" class="tab-pane active">
                                                <div class="panel-body">
                                                  <?php echo $infoi ?>
                                                </div>
                                              </div>
                                          <div id="tab-2" class="tab-pane">
                                                <div class="panel-body">
                                                  <?php echo $infos ?>
                                                </div>
                                              </div>
                                          <div id="tab-3" class="tab-pane ">
                                                <div class="panel-body">
                                                  <?php echo $infoh ?>
                                                </div>
                                              </div>

                                          <div id="tab-4" class="tab-pane ">
                                                <div class="panel-body">
                                                  <?php echo $infoo ?>
                                                </div>
                                              </div>
                                              </div>
                                      </div>

                      </div>
                    </div>
                  </div>
                </div>
            </div>   
          </div>
          <!-- ~~~~~~~~~~~~~~~~~ BATES  -->

    <!-- ~~~~~~~~~~~~~~~~~ Project video -->
          <div class="content-body">
            <div class="row">
                <div class="col-md-12 ">
                  <div class="card">
                    <div class="card-content">
                      <div class="card-body">

                          <span style="line-height: 2.3em;
                            display: inline-block;border-bottom: #00a1e4 5px solid; font-size:18px;">Project Video</span></h2>
                            <br>
                            <div>
                              <br>
                              <?php foreach ($dtNews3 as $key) { ?>
                              <iframe width="100%" height="400"
                              src="<?php echo $key->youtube_link;?>">
                              </iframe>
                            <?php } ?>
                            </div>

                      </div>
                    </div>
                  </div>
                </div>
            </div>   
          </div>
          <!-- ~~~~~~~~~~~~~~~~~ BATES  -->

    <!-- ~~~~~~~~~~~~~~~~~ Project location -->
          <div class="content-body">
            <div class="row">
                <div class="col-md-12 ">
                  <div class="card">
                    <div class="card-content">
                      <div class="card-body">

                          <h2><span style="line-height: 2.3em;
                          display: inline-block;border-bottom: #00a1e4 5px solid; font-size:18px;">Project Location</span></h2>
                            <div class="row">
                              <div class="col-md-7">
                                  <iframe width="100%" height="500px" src="<?php echo $maps ?>"></iframe>
                              </div>
                              <div class="col-md-5">
                                <h3><span style="line-height: 2.3em;
                            display: inline-block;border-bottom: #00a1e4 5px solid; font-size:18px;">Sales Gallery Address</span></h3>
                                <b><?php echo $name ?></b><br>
                                <?php echo $address  ?>
                              </div>
                            </div>

                      </div>
                    </div>
                  </div>
                </div>
            </div>   
          </div>
          <!-- ~~~~~~~~~~~~~~~~~ BATES  -->
        </div>
        </div>

    





<div id="imagemodal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div id="dialogimage" class="modal-dialog" >
    <div class="modal-content" align="center">              
      <div class="modal-body" >
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">x</span></button>
        <img src="" class="imagepreview" id="imagepreview">
      </div>
    </div>
  </div>
</div>

<?php
// echo $DataSurvey;
// echo $surveyy;
if ($DataSurvey == 'ADA' && $name != 'ADMIN') {
  $exec = 'ADA SURVEY UNTUK ANDA SILAKAN CLICK';
   $url = 'window.location.href= site_url;';
} else if ($name == 'ADMIN') {
 $exec = '';
  $url='';  
}else{
   $exec = '';
  $url='';
}


?>
    <!-- slick carousel-->
<script type="text/javascript" src="<?=base_url('app-assets/vendors/js/slick/slick.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('app-assets/vendors/js/aset/jquery.tmpl.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('app-assets/vendors/js/aset/jquery.easing.1.3.js')?>"></script>
<script type="text/javascript" src="<?=base_url('app-assets/vendors/js/aset/jquery.elastislide.js')?>"></script>
<script type="text/javascript" src="<?=base_url('app-assets/vendors/js/aset/gallery.js')?>"></script>
<script type="text/javascript" src="<?=base_url('app-assets/vendors/js/blueimp/jquery.blueimp-gallery.min.js') ?>"></script>

<style>
        .slick_demo_2 .ibox-content {
            margin: 0 10px;
        }
    </style>
<script>
$(document).ready(function(){
  $('.slick_demo_2').slick({
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 4,
                centerMode: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
  });

  $("#wa").click(function(){
    var notlp = '<?php echo $handphone; ?>';
    var text = "Saya tertarik reservasi <?php echo $projectName; ?>";
    $(this).attr("href", "https://api.whatsapp.com/send?phone="+notlp+"&text="+text)
  })

$("#print").click(function(){
    window.print();
})
</script>

<script type="text/javascript">
   var site_url = '<?php echo base_url("c_survey/index")?>';


  var table;
  var namapdf = '<?php echo $pdfname; ?>';
  $(function() {


    $('.pop').on('click', function() {
      $('#imagepreview').attr('src', $(this).find('img').attr('src'));
      // $('.imagepreview').attr('alt', $(this).find('img').attr('alt'));
      $('#imagemodal').modal('show');   
    });   
  });
  $('#imagemodal').on('shown.bs.modal', function () {
    $(this).find('#dialogimage').css({width:'auto',
     height:'auto', 
     'max-height':'130%'});
  });

  var data = '';

  var name = '<?php echo $projectName; ?>'
  $('#Interested').click(function(){
          var modalClass = $('#modal').attr('class');
          switch (modalClass) {
              case "modal fade bs-example-modal-md":
                  $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                  break;
              case "modal fade bs-example-modal-sm":
                  $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                  break;
              default:
                  $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                  break;
          }

          var modalDialogClass = $('#modalDialog').attr('class');
          switch (modalDialogClass) {
              case "modal-dialog modal-md":
                  $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                  break;
              case "modal-dialog modal-sm":
                  $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                  break;
              default:
                  $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                  break;
          }

          $('#modalTitle').html('Whatsapp');
          $('div.modal-body').load("<?php echo base_url("newsfeed/wa");?>")
          $('#modal').data('name', name).modal('show');
  })

</script>
<script type="text/javascript">

var datasurvey = '<?php echo $Surveyy;?>';
// alert(datasurvey);

if (datasurvey == '1') {
  setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'show',
                    timeOut: 4000,
                     onclick: function () { <?php echo $url ?> }
                };
                toastr.success('<?php echo $exec ?> ', 'Welcome <?php echo ucwords($this->session->userdata("Tsuname"));?>');

            }, 1300);
 
}else{
   setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'hidden',
                    timeOut: 4000,
                     onclick: function () { <?php echo $url ?> }
                };
                toastr.success('<?php echo $exec ?> ', 'False <?php echo ucwords($this->session->userdata("Tsuname"));?>');

            }, 1300);
}
  

</script>

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
