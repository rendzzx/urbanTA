<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
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
<form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" >
            <div class="box-body">
             
              <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>                
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="customer" id="customer" placeholder="Input Name">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">HP</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="HP" id="HP" placeholder="08......">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="Email" id="Email" placeholder="Input Email">
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
                <label class="col-sm-2 control-label">Location</label>
                <div class="col-sm-8">
                  <select class="form-control chosen-select" name="type" id="type" data-placeholder="Select Type"><?php echo $comboType ?></select>
                </div>
              </div>
              <input type="hidden" name="prefix" id="prefix">
              <input type="hidden" name="phase" value="<?php echo $phase->phase_cd?>">
              <input type="text" name="seqno" value="<?php echo $seqno;?>" id="seqno">
              
              <div class="form-group">
                <label class="col-sm-2 control-label">Upload File</label>
                <div class="col-sm-8">
                  <!-- <input type="file" name="picture[]" id="picture" multiple="multiple"> -->
                  <table id="tblattach" class="display table-striped table-bordered" cellspacing="0" style="width:100%;">
                    <thead>            
                        <th >No</th>
                        <th width="50%">Criteria</th>
                        <th width="40%">Filename</th>
                        <th >Action</th>
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
<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script> 
<script type="text/javascript">

//start chosen properties
var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:false},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    // $("").chosen({ width: '50%'});
    $(".chosen").chosen({ width: '100%'});
    
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }    
    //end chosen properties
    $(function(){
       $("#nuptype").change(function(){
      var nuptype = $(this).find(':selected').val();
      alert(nuptype);
      // console.log(nuptype+'PP');
      if(nuptype!=='') {
        alert(nuptype);
        var site_url = '<?php echo base_url("c_nup/setnup") ?>';
        $.post(site_url,
          {tnup:nuptype},
          function(data,status){
            if(data.pesan==1) {
              $("#nupamt").val(formatNumber(data.nup_amt));
              $("#nupdesc").val(data.descs);
              $("#prefix").val(data.pref);
            } else {
              alert('Please define NUP Type for this project');
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
            url:"<?php echo base_url('c_nup/getTableAttach')?>",
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
                    alert('Please select a row');
                    return;
                }
                var data = table.rows(rows).data();
                var descs = data[0].descs;
                var rowID = data[0].rowID;
                var sn = $('#seqno').val();
                console.log(sn);
                console.log(data);
                var modalClass = $('#modal2').attr('class');
                switch (modalClass) {
                    case "modal fade bs-example-modal-md":
                        $('#modal2').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                        break;
                    case "modal fade bs-example-modal-sm":
                        $('#modal2').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                        break;
                    default:
                        $('#modal2').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                        break;
                }

                var modalDialogClass = $('#modal2Dialog').attr('class');
                switch (modalDialogClass) {
                    case "modal-dialog modal-md":
                        $('#modal2Dialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                        break;
                    case "modal-dialog modal-sm":
                        $('#modal2Dialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                        break;
                    default:
                        $('#modal2Dialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                        break;
                }
                $('#modal2Title').html('<b>Add File</b>');
                // alert(rowID);
                $('div.modal-body').load("<?php echo base_url('c_nup/addNew');?>"); //+"/"+descs+"/"+rowID);
                $('#modal2').data('descs', descs);
                $('#modal2').data('sn', sn);
                $('#modal2').data('id', rowID).modal('show');
            }
          }
        ],
        columns:[
            {data: "row_number", name: "rowID"},
            {data: "document_descs", name: "document_descs"},
            {data: "file_attachment", name: "file_attachment"},
            {data: "rowID", name: "rowID", visible: false}
        
        ]
      });
    });
</script>          
<div id="modalform" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalformDialog" class="modal-dialog">

        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalformTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>