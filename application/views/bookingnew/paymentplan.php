<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<!-- 
<script src="<?=base_url('js/plugins/inputmask/jquery.inputmask.bundle.min.js')?>"></script> -->


<script type="text/javascript">
function replaceAll(str, find, replace)
{
  return str.replace(new RegExp(find, 'g'), replace);
}

function formatNumber(data) 
{
  if(data==null){
    data =0;
  }
  // alert(data);
  return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

}
</script>
<style >
 #hahaload{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("<?php echo base_url('img/loading.gif')?>") no-repeat center center;
  }

  #signupForm label.error {
  margin-left: 10px;
  width: auto;
  display: inline;
}
td {
    height: 40px;
  }

#label_form label {
    text-align: right;
  }

.marginSelect{
  padding-left: 12px !important;
  padding-bottom: 6px !important;
  border-bottom-width: 1px !important;
  padding-top: 3px !important;

}
</style>


<div id="hahaload" class="hahaload" hidden="true"></div>
<div class="content-wrapper">
  <div class="row border-bottom white-bg dashboard-header"> 
  
    <div class="form-group">
      <div class="tittle-top pull-left">            
      <?php echo $project; ?><br>
        <?php echo($agent)?>
      </div>
      <div class="tittle-top pull-right">Sales Booking Entry</div>
    </div>        
  </div>
<div class="row">
    <div class="col-md-12">
    <div>
        <div class="col-md-6">
            <div class="ibox-content ">
                <div class="carousel slide" id="carousel2">
                                
                                <ol class="carousel-indicators ">
                                    <li data-slide-to="0" data-target="#carousel2"  class="active"></li>
                                    <li data-slide-to="1" data-target="#carousel2"></li>
                                    <li data-slide-to="2" data-target="#carousel2" class=""></li>
                                </ol>
                                

                                <div class="carousel-inner" style="cursor: pointer;" >
                                    <?php foreach ($galery as $key) { ?>
                                    <img src="<?php echo $key->gallery_url; ?>">
                                     <?php  } ?>
                                </div>
                                    
                              

                                <a data-slide="prev" href="#carousel2" class="left carousel-control">
                                    <span class="icon-prev"></span>
                                </a>
                                <a data-slide="next" href="#carousel2" class="right carousel-control">
                                    <span class="icon-next"></span>
                                </a>
                               
                            </div>
                            </div>
                            <div style="font-size: 14px; font-weight: bold">
                            </div>
                    </div>
                    </div>
        <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
            <!-- <div id="tbl_infoapt" style="font-size:14px;padding: 0px 5px 5px;"> -->
            <div class="col-lg-11">
            <div id="tbl_infoapt" class="ibox float-e-margins">
                <h3 id="nama_tipe"><?php echo $project;?></h3>
                        <div class="ibox-content">
                        <table class="table table-striped">
                           <tbody><tr>
                                      <td><span id="no_tower"><?php echo $data[0]->property_descs." | " .$data[0]->level_descs." | <b>".$data[0]->lot_no;?></span></td>
                                  </tr>
                                  <tr>
                                       <td><span id="no_tower"><?php echo $data[0]->build_up_area ." ".$data[0]->area_uom;?></span></td>
                                  </tr>
                                  <tr>
                                       <td><span id="no_tower"><?php echo $data[0]->lot_type_descs;?></span></td>
                                  </tr>
                                  <tr>
                                       <td><span id="no_tower"><?php echo $data[0]->direction_descs;?></span></td>
                                  </tr>
                                </tbody>
                            </table>
                      </div>
                <!-- </div> -->
            </div>
            </div>
            <div class="col-lg-11">
              <b>Choose Payment Boking</b>
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                          <?php foreach ($Data as $key) { ?>
                            <button onclick="landinfo('<?php echo $data[0]->lot_no;?>','<?php echo $data[0]->lot_type;?>','<?php echo $key->payment_cd ?>','<?php echo $key->descs ?>','<?php echo $key->trx_amt ?>')" type="button" class="btn btn-block btn-success">
                            <table>
                            <tr>
                            <td class="col-sm-10"><?php echo $key->descs?></td>
                            <th>IDR. <span><?php echo $key->trx_amt; ?></span></th>
                            </tr>
                            </table>
                            </button>
                            <br>
                                <?php } ?>
                        </div>
                    </div>
                </div>
    </div>
</div> 
</div>     
</div>

 <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">          
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="padding-left: 10px !important;padding-right: 10px !important;">
            
            </div>
        </div>
        

    </div>
</div>
<div id="modalimg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialogimg" class="modal-dialog2">
        <div id="content" class="modal-content">
            <!-- Modal Header -->
            <div id="header2" class="modal-header2">
                <button type="button" class="close"  data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <!-- <h5 class="modal-title" id="modalTitleimg"></h5> -->
            </div>

            <!-- Modal Body -->
            <div class="modal-body1" id="modalBodyimg">
            <img src="" class="imagepop" alt="image" style="width:100%">
            </div>
        </div>

    </div>
</div>



<script type="text/javascript">
//   $('#btnOk').click(function (e){
//     var lot_no = '<?php echo $data[0]->lot_no;?>';
//     var type = '<?php echo $data[0]->lot_type;?>';
//     // var type = '<?php echo $data[0]->lot_type;?>';

//     landinfo(lot_no,type);
    
// });

  function landinfo(lot_no,type,payment_cd,descs,trx)
  { 

        var descs = descs;
        // console.log(descs);
        var trx = trx;
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
                        
                        $('#modalTitle').html('Unit Detail Information');
                        // alert(data);
                        // alert(property_type);
                        // alert(pcd);
                        $('div.modal-body').load("<?php echo base_url("booking/getPayDetail/");?>"+lot_no+"/"+type+"/"+payment_cd);
                        // $('#modal').data('balance',balance);
                        $('#modal').modal('show');

                        $('#modal').data('descs', descs);
                        $('#modal').data('trx', trx);

                        // var data = [];
                        // data.push({name: "descs", value: descs},{name: "trx", value: trx});
                        // $.ajax({
                        // url: "<?php echo base_url("booking/getPayDetail/");?>"+lot_no+"/"+type+"/"+payment_cd,
                        // type: "POST",
                        // data: data,
                        // dataType: "JSON"
                        // })
                       
                        // $('#modal').data('Id',data);
    
   
  }
</script>

