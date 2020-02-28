<!-- <link href="<?=base_url('datatable/media/css/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css" >
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.css')?>" rel="stylesheet" /> -->

 <link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">

<!-- <script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.js')?>" type="text/javascript"></script> -->

    <script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>

      <div class="content-wrapper">
        <section class="row border-bottom white-bg dashboard-header">
          <div class="tittle-top"><?php echo $ProjectDescs; ?></div>
          <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> NUP Detail</a></li>
            <li><a href="#"> NUP</a></li>
          </ol> -->
        </section><br>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="ibox-content">
                <div class="box-body">
                  <?php echo $choosUnit; ?>
                  <!-- <a href="<?php echo base_url("c_nup_unit/index"); ?>/<?=$RowId?>/<?=$LotQty?>/<?=$NupNO?>" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</a> -->
                  <!-- <button class="btn btn-primary" onclick="ChooseUnit(<?=$RowId?>,<?=$LotQty?>,'<?=$NupNO?>')"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</button> -->
                  <!-- <a href="<?php echo base_url("c_nup/index"); ?> " class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a> -->
                  <?php echo $backbtn; ?>
                </div><br>
                <table class="dataTable dtr-inline" border="0">
                  <tr>
                    <td width="55px"><b>Nup No.</b></td>
                    <td >: <?php echo $NupNO; ?> &nbsp;&nbsp;&nbsp; <b>Type</b> : <?php echo $NupDescs; ?></td>
                    <!-- <td >Type : <?php echo $NupDescs; ?></td> -->
                  </tr>
                  <tr>
                    <td width="55px"><b>Name</b></td>
                    <td >: <?php echo $BussName; ?></td>
                  </tr>
                  <tr>
                    <td width="55px"><b>Total</b></td>
                    <td > : <?php echo $LotQty; ?> &nbsp;&nbsp;&nbsp; <b>Choosen</b> : <?php echo $TotQty; ?> &nbsp;&nbsp;&nbsp; <b>Balance</b> : <?php echo $balance; ?></td>
                  </tr>
                </table>                      
                <div class="box-body"> 
                  <div id="example_wrapper" class="dataTables_wrapper">                  
                    <table id="example" class="display table-striped nowrap dataTable dtr-inline" cellspacing="0" width="100%">
                      <thead>
                        <tr role="row">
                          <th class="sorting_asc">Unit</th>
                          <th>Description</th>
                          <th>Remarks</th>
                          <th><center>Action</center></th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php echo $RlSalesList; ?>                  
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>                 
            </div>
          </div>
        </section>
      </div>
    

      <script type="text/javascript">
      
      function ChooseUnit(RowId,balance,NupNO){        

        /*var a = <?php echo $RowId; ?>;
        var b = <?php echo $LotQty; ?>;
        var c = <?php echo $NupNO; ?>;*/
        //alert(RowId +' ' + LotQty + ' ' + NupNO);
        var url ="<?php echo base_url('c_nup_unit/index'); ?>/"+RowId+"/"+NupNO;
        //var url ="<?php echo base_url('c_nup_unit/index'); ?>/"+a+"/"+b+"/"+c;
        window.location.href = url;
      }

      // function delete_1(tes){
      //   $.ajax({  
      //     url : "<?php echo base_url('c_nup_dt/delete')?>",
      //     type:"POST",
      //     data: {LotNumber:lot_no,
      //       rowid:parseRowid,
      //       lotqty:parseLotQty},
      //       dataType:"json",
      //       success:function(event, data){  

      //         swal({
      //           title: "Information",
      //           text: data.pesan,
      //           type: "success",
      //           confirmButtonText: "OK"
      //         },
      //         function(){                    
      //           var a = event.nup;
      //           var b = event.notif;

      //           if(b == 'OK'){
      //             window.location.href="<?=base_url('c_nup_dt/list_dt/')?>"+"/"+a;  
      //           }else{
      //             window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty+"/"+a;  
      //           }
      //         });

      //         $('#modal').modal('hide');
      //       },                    
      //       error: function(jqXHR, textStatus, errorThrown){
      //         console.log('a')
      //         alert(textStatus+' Save : '+errorThrown);
      //       }
      //     });
      // }

      function delete_1(tes){ 
         swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
          },
          function(){
            var site_url = '<?php echo base_url("c_nup_dt/delete")?>';
            $.post(site_url,
                      {rowID:tes},
                      function(data,status) {
                        // console.log(data);
                        // var a = event.nup_no;
                        // alert(a);
                        window.location.href="<?=base_url('c_nup_dt/list_dt/')?>"+"/"+data;
                      }
                    );
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
          });
        
      }

      $(function () {
        
        
        $('#example').DataTable({
          'responsive': true,
          'paging': false,
          'searching': false,
        });
      });
      </script>
    