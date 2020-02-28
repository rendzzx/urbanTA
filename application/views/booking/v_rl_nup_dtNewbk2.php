<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
    ul#stepForm, ul#stepForm li {
      margin: 0;
      padding: 0;
    }
    ul#stepForm li {
      list-style: none outside none;
    } 
    label{margin-top: 10px;}
    .help-inline-error{color:red;}

    .fieldset-auto-width {
      display: inline-block;
      width:100%;
      height: 500px;
      vertical-align: middle;
    }

</style>

<link rel="icon" type="image/gif/png" href="<?=base_url('img/logo.png')?>">
<title>IFCA</title>

<link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>">   
<link rel="stylesheet" type="text/css" href="<?=base_url('font-awesome/css/font-awesome.min.css')?>"> 
<link href="<?=base_url('css/plugins/iCheck/custom.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet"> 
<link href="<?=base_url('css/animate.css')?>" rel="stylesheet">
<link href="<?=base_url('css/style.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />

<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

<style>

  .wizard > .content > .body  {position: relative; }

</style>

<script src="<?=base_url('js/jquery-2.1.1.js')?>"></script>
<script src="<?=base_url('js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
<script src="<?=base_url('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/sweetalert/sweetalert.min.js')?>"></script>

<!-- Custom and plugin javascript -->
<script src="<?=base_url('js/inspinia.js')?>"></script>
<script src="<?=base_url('js/plugins/pace/pace.min.js')?>"></script>

<!-- Steps -->
<script src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>"></script>
<!-- Jquery Validate -->
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>"></script>

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>

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
</head>
<body>
  <div class="content-wrapper">
    <div class="wrapper wrapper-content" >
      <div class="row">
        <div class="col-xs-12">
          <div class="ibox">
            <div class="ibox-title">
              <h3>Complete this form in quick 3 steps!</h3>
            </div>
            <div class="ibox-content">

              <form id="form" action="#" class="wizard-big wizard clearfix" role="application" novalidate="novalidate">
                <!-- <div class="steps clearfix">
                  <ul role="tablist">
                    <li class="first current" role="tab" aria-disabled="false" aria-selected="true">
                      <a id="form-t-0" href="#form-h0" aria-controls="form-p-0">
                        <span class="current-info audible">current step: </span>
                        <span class="number">1. </span>
                        Choose Unit
                      </a>
                    </li>
                    <li class="disabled" role="tab" aria-disabled="true">
                      <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                        <span class="number">2. </span>
                        Fill The Form
                      </a>
                    </li>
                    <li class="disabled" role="tab" aria-disabled="true">
                      <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                        <span class="number">3. </span>
                        Finish
                      </a>
                    </li>                      
                  </ul>
                </div> -->
              </form>
              <div class=""><br>
                <div class="content" >
                  <div class="panel panel-primary">
                    <!-- <div class="panel-heading">
                      <h3 class="panel-title">Product</h3>
                    </div> -->
                    <div class="panel-body row">
                      <form id="form" action="#" class="wizard-big wizard clearfix" role="application" novalidate="novalidate">
                      <div class="steps clearfix">
                        <ul role="tablist">
                          <li class="first current" role="tab" aria-disabled="false" aria-selected="true">
                            <a id="form-t-0" href="#form-h0" aria-controls="form-p-0">
                              <span class="current-info audible">current step: </span>
                              <span class="number">1. </span>
                              Choose Unit
                            </a>
                          </li>
                          <li class="disabled" role="tab" aria-disabled="true">
                            <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                              <span class="number">2. </span>
                              Fill The Form
                            </a>
                          </li>
                          <li class="disabled" role="tab" aria-disabled="true">
                            <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                              <span class="number">3. </span>
                              Finish
                            </a>
                          </li>                      
                        </ul>
                      </div>
                      <div class="steps clearfix"></div>
                        <fieldset id="form-p-1">
                          <h3>&nbsp;&nbsp;&nbsp;Step 1 of 3</h3>
                          <div class="">
                            <section class="content-header">
                              <div class="tittle-top">&nbsp;&nbsp;&nbsp;<?php echo $ProjectDescs; ?></div>              
                            </section>
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="ibox-content">
                                    <!-- <div class="table-responsive"> -->
                                      <br>
                                      <table border="0" width="100%">
                                        <tr>
                                          <td width="10%"><b>Nup No.</b></td>
                                          <td >: <?php echo $NupNO; ?></td>
                                          <td></td>
                                          <td ></td>
                                        </tr>
                                        <tr>
                                          <td width="10%"><b>Product</b></td>
                                          <td >: <?php echo $ProductDescs; ?> &emsp;&emsp;&emsp;<b>Nup Type</b> : <?php echo $NupTypeDescs; ?>&emsp;&emsp;&emsp;<b>Property</b> : <?php echo $PropertyDescs; ?></td>
                                          <td width="5%"></td>
                                          <td ></td>
                                        </tr>

                                        <tr>
                                          <td width="10%"><b>Name</b></td>
                                          <td >: <?php echo $BussName; ?></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>
                                        <tr>
                                          <td width="10%"><b>Total</b></td>
                                          <td >: <?php echo $LotQty; ?>&emsp;&emsp;&emsp;<b>Choosen</b> : <?php echo $TotQty; ?>&emsp;&emsp;&emsp;<b>Balance</b>: <?php echo $balance; ?></td>

                                          <td width="5%"></td>
                                          <td></td>
                                        </tr>
                                      </table>
                                      <div class="box-body">
                                        <?php echo $choosUnit; ?>                              
                                      </div>                      
                                      <div class="box-body"> 
                                        <div id="example_wrapper" class="dataTables_wrapper">                  
                                          <table id="example" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
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
                                    <!-- </div>  -->
                                  </div>                
                                </div>
                              </div>
                          </div>
                        </fieldset>
                      </form>     

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
    <!-- End of Bootstrap Modal -->
<script type="text/javascript">
  function delete_1(rowid,lotno){ 
    swal({
      title: "Delete",
      text: "Are you sure to delete this unit ['"+lotno+"']?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Yes",
      closeOnConfirm: false
    },
    function(){
      var site_url = '<?php echo base_url("c_nup_dt/delete")?>';
      $.post(site_url,
        {rowID:rowid},
        function(data,status) {
          window.location.href="<?=base_url('c_nup_dt/list_dtNew/')?>"+"/"+data+"/1/<?php echo $rowid_index?>/<?php echo $status_index?>";
        }
      );
      swal("Deleted!", "Data has been deleted.", "success");
    });
  }

  function ChooseUnit(RowId,balance,NupNO){ 
    var url ="<?php echo base_url('c_nup_unit/index'); ?>/"+RowId+"/"+balance+"/"+NupNO;
    window.location.href = url;
  }

  function nuptypeinfo(status){

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

    if(status == 1){
      $('#modalTitle').html('NUP Type Information');  
    }else{
      $('#modalTitle').html('Preffered launching location');  
    }

    $('div.modal-body').load("<?php echo base_url("c_nup/showinfo");?>/"+ status);

    $('#modal').modal('show');
  }

  $('input:radio[name="product"]').change(function(){

    var prod = $(this).val();
    if(prod !=='') {
      $('#nupamt').val('');
      var site_url = '<?php echo base_url("c_nup/zoom_nuptype")?>';
      $.post(site_url,
        {prod:prod},
        function(data,status) {
          $("#nuptype").empty();
          $("#nuptype").append(data);
          $("#nuptype").trigger('change');
        }
        );
      var site_url2 = '<?php echo base_url("c_nup/zoom_property")?>';
      $.post(site_url2,
        {prod:prod},
        function(data,status) {
          $("#property").empty();
          $("#property").append(data);
          $("#property").trigger('change');
        }
        );
    } else {
      $("#nuptype").empty();
    }          
  });

  $(function () {        
    document.body.style.backgroundImage = "url(<?php echo base_url('img/back.jpg');?>)";
    $('#example').DataTable({
      'responsive': true,
      'paging': false,
      'searching': false,
    });
  });

  function setNUPType(Id,product){  
    var site_url = '<?php echo base_url("c_nup/chosen_nup_type")?>';
    $.post(site_url,
      {Id:Id,product:product},
      function(data,status) {
        $("#nuptype").empty();
        $("#nuptype").append(data);
        $("#nuptype").trigger('change');
      }
      );
  }

  function setProperty(Id,prod){
    var site_url2 = '<?php echo base_url("c_nup/zoom_property_edit")?>';
    $.post(site_url2,
      {prod:prod,Id:Id},
      function(data,status) {
        $("#property").empty();
        $("#property").append(data);
        $("#property").trigger('change');
      }
      );
  }

  function setLocation(Id){  
    var site_url = '<?php echo base_url("c_nup/chosen_location")?>';
    $.post(site_url,
      {Id:Id},
      function(data,status) {
        $("#Location").empty();
        $("#Location").append(data);
        $("#Location").trigger('change');
      }
      );
  }

  function setcity(Id){
    var site_url = '<?php echo base_url("c_nup/chosen_city")?>';
    $.post(site_url,
      {Id:Id},
      function(data,status) {
        $("#city").empty();
        $("#city").append(data);
        $("#city").trigger('change');
      }
      );
  }

  function setnationality(Id){  
    var site_url = '<?php echo base_url("c_nup/chosen_nationality")?>';
    $.post(site_url,
      {Id:Id},
      function(data,status) {
        $("#nationality").empty();
        $("#nationality").append(data);
        $("#nationality").trigger('change');
      }
      );
  }

  function Loadfile(rowID){

    var sn = $('#seqno').val();

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
    $('#modalTitle').html('<b>Add File</b>');
    $('div.modal-body').load("<?php echo base_url('c_nup_dt/addNew');?>"); 
    $('#modal').data('sn', sn);
    $('#modal').data('id', rowID).modal('show');
  }

  function Loaddata() {

    var ID = '<?php echo $rowID;?>';
    var site_url = '<?php echo base_url("c_nup/show_edit_data")?>'+'/'+ID;
    $.getJSON(site_url, function (data) {
      var m_names = new Array("Jan", "Feb", "Mar", 
        "Apr", "May", "Jun", "Jul", "Aug", "Sep", 
        "Oct", "Nov", "Dec");
      var d = new Date(data[0].reserve_date);
      var curr_date = d.getDate();
      var curr_month = d.getMonth();
      var curr_year = d.getFullYear();
      var dt = curr_date + " " + m_names[curr_month]+ " " + curr_year;
      var country_cd = data[0].country_code;
      var nationality = data[0].nationality;
      var Handphone = data[0].Handphone;
      var telp = Handphone.substring(country_cd.length,Handphone.length);

      $('#customer').val(data[0].NAME);                
      $('#HP').val(telp);
      $('#country_cd').val(country_cd).trigger('change');
      setnationality(data[0].nationality);
      $('#Email').val(data[0].Email);
      $('#seqno').val(data[0].nup_sequence_no);
      $('#noktp').val(data[0].Id_No);
      $('#address').val(data[0].ADDRESS);
      setcity(data[0].city);
      $('#npwp').val(data[0].NPWP);
      setNUPType(data[0].nup_type,data[0].product_cd);
      $('#nupdesc').val(data[0].rl_reserve_descs);
      $('#rsvdate').val(dt);
      setProperty(data[0].product_type,data[0].product_cd);
      $('#nuptype').val(data[0].descs);
      $('#property').val(data[0].property_descs);
      document.getElementById(data[0].product_cd).checked = true;
      $('#product').text(data[0].product_descs);
      $('#nupamt').val(formatNumber(data[0].nup_amt));
      setLocation(data[0].location_cd);
      $('#noktp').val(data[0].ic_no);
      $('#address').val(data[0].Address);
    });
}

function ClearStep1() {
  window.location.href="<?php echo base_url('c_choose_unit_nup/indexNew/')?>";
}

$(document).ready(function(){
  var tableatt;
  $("#wizard").steps();

  $("#form").steps({
    bodyTag: "fieldset",
    onStepChanging: function (event, currentIndex, newIndex){
      var balance = '<?php echo $balance; ?>';
      if(balance>0)
      {
        swal("Warning","You have to use all your balance!","error");
        return false;
      }

      if (currentIndex > newIndex)
      {
        return true;
      }

      if (newIndex === 3 && Number($("#age").val()) < 18)
      {
        return false;
      }

      var form = $(this);

      if (currentIndex < newIndex)
      {

        $(".body:eq(" + newIndex + ") label.error", form).remove();
        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
      }

      form.validate().settings.ignore = ":disabled,:hidden";

      return form.valid();
    },
    onStepChanged: function (event, currentIndex, priorIndex)
    {
      console.log('changed');
      console.log(event,currentIndex,priorIndex);
      if (currentIndex === 2 && Number($("#age").val()) >= 18)
      {
        $(this).steps("next");
      }

      if (currentIndex === 2 && priorIndex === 3)
      {
        $(this).steps("previous");
      }


    },
    onFinished: function (event, currentIndex)
    {
      var form = $(this);


      form.submit();
    },
    onCanceled: function (event) {
      var modalClass = $('#modal').attr('class');
      switch (modalClass) {
        case "modal fade bs-example-modal-lg":
        $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
        break;
        case "modal fade bs-example-modal-md":
        $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
        break;
        default:
        $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
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

      $('#modalTitle').html('Go Back');
      $('div.modal-body').html('Are you sure that you want to reset the data and go back?');
      $('div.modal-body').append('<div class="modal-footer"></div>');

      var btnYes = $('<input/>')
      .attr({
        id: "btnYes",
        type: "button",
        class: "btn btn-danger",
        onclick: 'ClearStep1();',
        value: 'Yes'
      });

      var btnNo = $('<a>No</a>').attr({
        class: "btn btn-default", 'data-dismiss': "modal"
      });

      $('div.modal-footer').append(btnYes);
      $('div.modal-footer').append(btnNo);
      $('#modal').modal('show');
    }}).validate({
      errorPlacement: function (error, element)
      {
        element.before(error);
      },
      rules: {
        confirm: {
          equalTo: "#password"
        }
      }
    });
});
</script>
</body>
</html>

