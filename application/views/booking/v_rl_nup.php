<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('DataTable/media/css/dataTables.bootstrap.min.css');?>" rel="stylesheet" type="text/css" >
<link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" /> 
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<!-- <script src="<?php echo base_url('plugins/jQueryUI/jquery-ui-1.10.2.min.js')?>" type="text/javascript"></script> -->
<!--
<script src="<?=base_url('plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.iframe-transport.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.fileupload.widget.js')?>" type="text/javascript"></script>
-->
<script type="text/javascript">
function replaceAll(str, find, replace)
{
  return str.replace(new RegExp(find, 'g'), replace);
}

function formatNumber(data) 
{
  return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

}
</script>
<style >
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
</style>
<div class="content-wrapper">
  <section class="content-header">
    <div class="tittle-top pull-left"><b><?php echo $project; ?></b></div>
    <div class="tittle-top pull-right"><b><?php echo 'NUP Entry '.$phase->descs?></b></div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" >
            <div class="box-body">
              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Sales Date</label>
                <div class="col-sm-9">
                  <label class="control-label"><?php echo(date('D, d M Y')); ?></label>
                </div>
              </div> -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <a href="<?php echo base_url("c_cf_business"); ?> " class="btn btn-success btn-xs" ><i class="fa fa-plus"></i> </a>
                <a class="btn btn-success btn-xs" id="edit" type="button"><i class="fa fa-pencil"></i></a>
                <div class="col-sm-8">
                  <select name="customer" class="form-control chosen-select" id="customer" tabindex="2" data-placeholder="Select Customer"><?php echo $comboCs; ?></select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">NUP Type</label>
                <div class="col-sm-8">
                  <select class="form-control chosen-select" name="nuptype" id="nuptype" data-placeholder="Select NUP Type"><?php echo $comboTnup ?></select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-8">
                  <input class="form-control" name="nupdesc" id="nupdesc">
                </div>
              </div>
              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">NUP Number</label>
                <div class="col-sm-8">
                  <input class="form-control" name="nupno" id="nupno">
                </div>
              </div> -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Reserve Date</label>
                <div class="col-sm-8">
                  <input class="form-control" name="rsvdate" id="rsvdate" value="<?php echo($today)?>" disabled="1">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Reserve By</label>
                <div class="col-sm-8">
                  <input class="form-control" value="<?php echo($agent->agent_name)?>" disabled="1"><br>
                  <input class="form-control" value="<?php echo($agent->agentype)?>" disabled="1"><br>
                  <input class="form-control" value="<?php echo($agent->group_name)?>" disabled="1">
                  <input class="form-control" name="rsvby" id="rsvby" type="hidden" value="<?php echo($user)?>" disabled="1">
                  <input class="form-control" name="grpcd" id="grpcd" type="hidden" value="<?php echo($agent->group_cd)?>">
                  <input class="form-control" name="agtype" id="agtype" type="hidden" value="<?php echo($agent->agent_type_cd)?>">
                </div>
              </div>              
              <div class="form-group">
                <label class="col-sm-2 control-label">NUP Amount</label>
                <div class="col-sm-8">
                  <input class="form-control" name="nupamt" id="nupamt">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Type</label>
                <div class="col-sm-8">
                  <select class="form-control chosen-select" name="type" id="type" data-placeholder="Select Type"><?php echo $comboType ?></select>
                </div>
              </div>
              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Comm Amount</label>
                <div class="col-sm-8">
                  <input class="form-control" name="commamt" id="commamt">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Phase</label>
                <div class="col-sm-8">
                  <select class="form-control chosen-select" name="phase" id="phase" data-placeholder="Select Phase"><?php echo $comboPhase ?></select>
                </div>
              </div> -->
              <input type="hidden" name="prefix" id="prefix">
              <input type="hidden" name="phase" value="<?php echo $phase->phase_cd?>">
              <input type="hidden" name="seqno" value="<?php echo $seqno->counter?>" id="seqno">
              
              <div class="form-group">
                <label class="col-sm-2 control-label">Bank Code</label>
                <div class="col-sm-8">
                  <select class="form-control chosen-select" name="bankcd" id="bankcd" data-placeholder="Select Bank"><?php echo $comboTrxType ?></select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Upload File</label>
                <div class="col-sm-8">
                  <!-- <input type="file" name="picture[]" id="picture" multiple="multiple"> -->
                  <table id="tblattach" class="display table-striped table-bordered" cellspacing="0" style="width:100%;">
                    <thead>            
                        <th >No</th>
                        <th width="50%">Criteria</th>
                        <th width="40%">Filename</th>
                        <!-- <th >Action</th> -->
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <i><?php if(!empty($error)) echo $error['error'] ?></i>
                </div>                
              </div>
              <input type="hidden" name="cntfile" id="cntfile" value="<?php echo $cnt?>">
            </div>
            <div class="box-footer">
              <!-- <button class="btn btn-primary" type="button" id="btnSimpan" onClick="validasi()"><i ></i> Save</button> -->
              <input type="button" name="submit" id="submit" value="Save">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
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
  
  <!-- <script src="<?php echo base_url('plugins/jQueryUI/jquery-ui-1.10.2.min.js')?>" type="text/javascript"></script> -->
  <script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>
  <script src="<?=base_url('dist/js/jquery.mask.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('plugins/validation/jquery.validate.min.js')?>" type="text/javascript"></script> 
  
  <script src="<?=base_url('plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>
  
  <script type="text/javascript">
    var table;
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    $(".chosen-select").chosen({ width: '100%'});
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    $(function() {
      table = $('#tblattach').DataTable({
        dom: 'Bfrtip',
        select: true,
        info: false,
        lengthChange: false,
        ordering: false,
        searching: false,
        paging: false,
        processing: true,
        serverSide: true,
        ajax:{
            url:"<?php echo base_url('c_nup/getTable')?>",
            data:{"seqno": function(d){
              var a = $('#seqno').val();
              return a;
            }},
            // "data":{"pl_project": function(d){
            type:"POST"
        },
        buttons:[
          {
            text: ' Upload File Pictures',
            className: 'fa fa-plus',
            action: function(e){
                var rows = table.rows('.selected').indexes();
                if (rows.length < 1) {
                    BootstrapDialog.alert('Please select a row');
                    return;
                }
                var data = table.rows(rows).data();
                var descs = data[0].descs;
                var rowID = data[0].rowID;
                var sn = $('#seqno').val();
                console.log(sn);
                console.log(data);
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
                // alert(rowID);
                $('div.modal-body').load("<?php echo base_url('c_nup/addNew');?>"); //+"/"+descs+"/"+rowID);
                $('#modal').data('descs', descs);
                $('#modal').data('sn', sn);
                $('#modal').data('id', rowID).modal('show');
            }
          }
          // ,
          // {
          //   text: ' Delete',
          //   className: 'fa fa-trash',
          //   action: function() {
          //       var rows = table.rows('.selected').indexes();
          //       if (rows.length < 1) {
          //           alert('Please select a row');
          //           return;
          //       }
          //       var data = table.rows(rows).data();
          //       var rowID = data[0].rowID;
          //       // alert(rowID);
          //       console.log(data);
          //       var modalClass = $('#modal').attr('class');
          //       switch (modalClass) {
          //           case "modal fade bs-example-modal-md":
          //               $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
          //               break;
          //           case "modal fade bs-example-modal-sm":
          //               $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
          //               break;
          //           default:
          //               $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
          //               break;
          //       }

          //       var modalDialogClass = $('#modalDialog').attr('class');
          //       switch (modalDialogClass) {
          //           case "modal-dialog modal-md":
          //               $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
          //               break;
          //           case "modal-dialog modal-sm":
          //               $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
          //               break;
          //           default:
          //               $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
          //               break;
          //       }
          //       $('#modalTitle').html('Delete File');
          //       $('div.modal-body').html('Are you sure that you want to delete this file?');
          //       // $('div.modal-body').load("<?php echo base_url('attachment/addNew');?>"+"/"+$('#project').val());
          //       $('div.modal-body').append('<div class="modal-footer"></div>');
          //       var btnYes = $('<input/>')
          //           .attr({
          //               id: "btnYes",
          //               type: "button",
          //               class: "btn btn-danger",
          //               onclick: 'Delete();',
          //               value: 'Yes'
          //           });
          //       var btnNo = $('<a>No</a>').attr({
          //           class: "btn btn-default", 'data-dismiss': "modal"
          //       });
          //       $('div.modal-footer').append(btnYes);
          //       $('div.modal-footer').append(btnNo);

          //       $('#modal').data('rowID', rowID).modal('show');
          //   }
          // }
        ],
        columns:[
            {data: "row_number", name: "rowID"},
            {data: "document_descs", name: "document_descs"},
            {data: "file_attachment", name: "file_attachment"},
            {data: "rowID", name: "rowID", visible: false}
            // {
            //   data:"descs",name:"descs",sortable: false, searchable:false,
            //     render:function (data,type,row) {
            //     // if(data!=''){
            //     //     return 'Information';
            //     // }else{
            //     //     return 'Warning';
            //     return "<span class='btn btn-success fileinput-button'><span>Select Picture...</span><input type='file' name='"+data+"' accept='image/*'></span>"
            //     }
            // }
        ]
      });

      var lot = $("#nuptype").find(':selected').val();
      $("#nuptype").change();
    });

    // function upfile()
    // {
    //   var id = $('#modal').data('id');
    //   var site_url = "<?php echo base_url('c_nup/saveUpload/')?>";
    //   $.post(
    //     site_url,
    //     {row:id},
    //     function(data, status) {
    //       console.log(data);
    //       table.ajax.reload(null, true);
    //     },
    //     'json'
    //   );
    // }

    // function Delete()
    // {
    //   var id = $('#modal').data('rowID');
    //   alert(id);
    //   $.ajax({
    //       url: "<?php echo base_url('c_nup/remove')?>",
    //       type: "post",
    //       data: {rid: id},
    //       dataType: "json",
    //       success: function(data, status){
    //           alert(data.Pesan);
    //           $('#modal').modal('hide');
    //           table.ajax.reload(null, true);
    //       },
    //       error: function(jqXHR, txtStatus, errorThrown){
    //           alert(txtStatus+' delete : '+errorThrown);
    //       }
    //   });
    // }
    $.validator.addMethod("attached", function (value, element) {
        var isSuccess = false;
        var content = $('#cntfile').val();
        // alert(content);
        // console.log(content);
        if(content < 1) {
          isSuccess = true;
        } else {
          isSuccess = false;
        }
        return isSuccess;
    });
    $.validator.setDefaults(
      { ignore: ":hidden:not(#cntfile)" },
      { ignore: ":hidden:not(.chosen-select)" }
    );
    // $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
    $('#form_nup').validate({
      rules: {
        customer: { required: true},
        nuptype: {required: true},
        nupdesc: {required: true},
        rsvdate: {required: true},
        rsvby: {required: true},
        grpcd: {required: true},
        agtype: {required: true},
        nupamt: {required: true},
        type: {required: true},
        phase: {required: true},
        seqno: {required: true},
        bankcd: {required: true},
        cntfile: {attached: true}
      },
      messages: {cntfile: {attached: "Upload file need to completed"} },
      errorElement: "em",
      errorPlacement: function(error, element){
        error.addClass("help-block");
        element.parents(".col-xs-5").addClass("has-feedback");
        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.parent("label"));
        } else {
            error.insertAfter(element);
        }

        if (!element.next("span")[0]) {
            $("<span class='glyphicon glyphicon-remove form-control-feedback' style = 'left: 90%' ></span>").insertAfter(element);
        }
      },
      success: function(label, element){
        if (!$(element).next("span")[0]) {
            $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 90%'></span>").insertAfter($(element));
        }
      },
      highlight: function(element, errorClass, validClass){
        $(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
        $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
      },
      unhighlight: function(element, errorClass, validClass){
        $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
        $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
      }
    });

    $("#nuptype").trigger('chosen:updated');
    $("#nupamt").mask('#,##0',{reverse:true,maxlength:false});
    $("#nuptype").change(function(){
      var nuptype = $(this).find(':selected').val();
      // console.log(nuptype+'PP');
      if(nuptype!=='') {
        var site_url = '<?php echo base_url("c_nup/setnup") ?>';
        $.post(site_url,
          {tnup:nuptype},
          function(data,status){
            if(data.pesan==1) {
              $("#nupamt").val(formatNumber(data.nup_amt));
              $("#nupdesc").val(data.descs);
              $("#prefix").val(data.pref);
            } else {
              BootstrapDialog.alert('Please define NUP Type for this project');
            }
            
            // $("#txt_debtor").empty();
            // $("#txt_debtor").val(data);
            console.log(data);
          },
          'json'
          );
      } else {
        console.log('nuptype empty');
      }
      // $("#txt_debtor").val(lot);
    });
    
    $('#submit').click(function(){
      if($('#form_nup').valid())
      {
        // alert($('#form_nup').serialize());
        // console.log($('#form_nup').serialize());
        var site_url = "<?php echo base_url('c_nup/savenup')?>";
        $.ajax({
          url: site_url,
          type: "POST",
          data: $('#form_nup').serialize(),
          dataType: "json",
          success: function(data, status){
            BootstrapDialog.alert(data.pesan);
            window.location.href="<?php echo base_url('c_nup/nup_list')?>";
          },
          error: function(jqXHR, textStatus, errorThrown){
            BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
          }
        })
      }
    });
    // $('input[name=txt_aditional_disc]').mask('#,##0',{reverse:true,maxlength:false});
    
    // $('#disc').change(function(){
    //   var discno = $("#disc option:selected").data("level");
    //   var list_price = $("#txt_list_bf_price").text();
    //   var price = replaceAll(list_price, ',','');
    //   var disc = $("#txt_discount").text();
    //   var disc_amt = replaceAll(disc, ',','');
    //   price = price - parseFloat(disc_amt);
    //   if (discno=='') {
    //     var result = 0;
    //     var net_price = price - result;
    //     $("#txt_aditional_disc").val(formatNumber(result));
        
    //   } else { 
    //     // var price = replaceAll(list_price, ',','');
    //     var result = (parseInt(discno) * parseInt(price)) / 100 ;
    //     var net_price = price - result;
    //     $("#txt_aditional_disc").val(formatNumber(result));
    //   }
    //   $('#txt_netprice').text(formatNumber(net_price));
    //   // console.log(formatNumber(net_price));
    // });
    $('#customer').change(function(){
      var select = $("#customer option:selected").val();
      if (select) {
          var editID = document.getElementById('edit');
          var link = '<?php echo base_url('c_cf_business/editCustomer'); ?>/'+ select;
          edit.setAttribute('href', link);
          // console.log(select);
          // alert('You can edit ');
      }else{
          var editID = document.getElementById('edit');
          var link = '';
          edit.setAttribute('href', link);
      }
    });
  </script> 
</div>
