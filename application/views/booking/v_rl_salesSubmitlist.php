<!-- <link rel="stylesheet" type="text/css" href="<?=base_url('DataTable/media/css/dataTables.bootstrap.min.css');?>">
<link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" /> 
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" /> -->
<!-- <link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" /> -->

<style type="text/css">
  #load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
</style>

<script type="text/javascript">
var project;

var tblnewsfeed;
$(function(){
    $('#modal').one('hidden.bs.modal', function (e) {
        $('#modal').removeData('bs.modal');
        $(".modal-body").html("");
        // alert('432');
        // $('[data-id=' + bussines_id + ']').remove();
    });
    // $('#btnTes').click(function(){
    //     // BootstrapDialog.alert('sdfsdf <br> sdfsdsdf');
    //     window.location.href='<?php echo base_url('submitSales/tesemail');?>';
    // });
// $("#btnSimpan").click(function() {
//  // alert('tesss');
  
// });
   tblnewsfeed = $('#tblnewsfeed').DataTable( 
    {
         // dom: 'Bfrtip',
            responsive: true,
            select: true,
            paging:false,
            filter:false,
            // buttons: [
            //     {
            //         text: ' Add', className: 'fa fa-plus', action: function (e) {
            //             var project = $('#txt_Pl_Project').val();
            //              if (project.length < 1) {
            //                 alert('Please select a Project');
            //                 return;
            //             }
            //             var modalClass = $('#modal').attr('class');
            //             switch (modalClass) {
            //                 case "modal fade bs-example-modal-md":
            //                     $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
            //                     break;
            //                 case "modal fade bs-example-modal-sm":
            //                     $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
            //                     break;
            //                 default:
            //                     $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
            //                     break;
            //             }

            //             var modalDialogClass = $('#modalDialog').attr('class');
            //             switch (modalDialogClass) {
            //                 case "modal-dialog modal-md":
            //                     $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
            //                     break;
            //                 case "modal-dialog modal-sm":
            //                     $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
            //                     break;
            //                 default:
            //                     $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
            //                     break;
            //             }

            //             $('#modalTitle').html('Add Newsfeed');
            //             $('div.modal-body').load("<?php echo base_url("c_newsfeed/addnew");?>"+"/"+$('#txt_Pl_Project').val());
            //             $('#modal').data('id', 0).modal('show');


            //         }
            //     },
            //     {
            //         text: ' Edit', className: 'fa fa-pencil',
            //         action: function () {
            //             var project = $('#txt_Pl_Project').val();
            //              if (project.length < 1) {
            //                 alert('Please select a Project');
            //                 return;
            //             }
            //             var rows = tblnewsfeed.rows('.selected').indexes();
            //             if (rows.length < 1) {
            //                 alert('Please select a row');
            //                 return;
            //             }

            //             var data = tblnewsfeed.rows(rows).data();
            //             var UserID = data[0].id;
                        

            //             var modalClass = $('#modal').attr('class');
            //             switch (modalClass) {
            //                 case "modal fade bs-example-modal-md":
            //                     $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
            //                     break;
            //                 case "modal fade bs-example-modal-sm":
            //                     $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
            //                     break;
            //                 default:
            //                     $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
            //                     break;
            //             }

            //             var modalDialogClass = $('#modalDialog').attr('class');
            //             switch (modalDialogClass) {
            //                 case "modal-dialog modal-md":
            //                     $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
            //                     break;
            //                 case "modal-dialog modal-sm":
            //                     $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
            //                     break;
            //                 default:
            //                     $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
            //                     break;
            //             }

            //             $('#modalTitle').html('Edit Newsfeed');

            //             $('div.modal-body').load("<?php echo base_url("c_newsfeed/addnew");?>"+"/"+$('#txt_Pl_Project').val());

            //             $('#modal').data('id', UserID).modal('show');

            //         }
            //     },
            //     {
            //         text: ' Delete', className: "fa fa-trash",
            //         action: function () {
            //             var project = $('#txt_Pl_Project').val();
            //              if (project.length < 1) {
            //                 alert('Please select a Project');
            //                 return;
            //             }
            //             var rows = tblnewsfeed.rows('.selected').indexes();
            //             if (rows.length < 1) {
            //                 alert('Please select a row');
            //                 return;
            //             }

            //             var data = tblnewsfeed.rows(rows).data();
            //             var UserID = data[0].id;
                        


            //             var modalClass = $('#modal').attr('class');
            //             switch (modalClass) {
            //                 case "modal fade bs-example-modal-lg":
            //                     $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
            //                     break;
            //                 case "modal fade bs-example-modal-md":
            //                     $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
            //                     break;
            //                 default:
            //                     $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
            //                     break;
            //             }

            //             var modalDialogClass = $('#modalDialog').attr('class');
            //             switch (modalDialogClass) {
            //                 case "modal-dialog modal-lg":
            //                     $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
            //                     break;
            //                 case "modal-dialog modal-md":
            //                     $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
            //                     break;
            //                 default:
            //                     $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
            //                     break;
            //             }

            //             $('#modalTitle').html('Delete Newsfeed');

            //             $('div.modal-body').html('Are you sure that you want to delete this item?');

            //             $('div.modal-body').append('<div class="modal-footer"></div>');

            //             var btnYes = $('<input/>')
            //                 .attr({
            //                     id: "btnYes",
            //                     type: "button",
            //                     class: "btn btn-danger",
            //                     onclick: 'Delete();',
            //                     value: 'Yes'
            //                 });

            //             var btnNo = $('<a>No</a>').attr({
            //                 class: "btn btn-default", 'data-dismiss': "modal"
            //             });

            //             $('div.modal-footer').append(btnYes);
            //             $('div.modal-footer').append(btnNo);

            //             $('#modal').data('id', UserID).modal('show');

            //         }
            //     }
            //     ,{
            //         text: ' Attachment', className: 'fa fa-file', action: function (e) {
            //             var project = $('#txt_Pl_Project').val();
            //              if (project.length < 1) {
            //                 alert('Please select a Project');
            //                 return;
            //             }
            //             window.location.href="<?php echo base_url('attachment/prj');?>"+'/'+project;
            //         }
            //     }
            // ],
        "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('submitsales/getTable');?>",             
            "type":"POST"
        },
        "columns": [
            {
                data: "approval_level_rowID",name:"approval_level_rowID",searchable:false,orderable:false ,
                render: function (data, type, row) {
                               return '<input type="checkbox" id="cb_' + data + '" name="cb_' + data + '" onclick="cbclick('+data+')"/>';
                           }
            } ,
            {data:"level_no",name:"level_no"},            
            // {data:"user_id",name:"user_id"},
            {data:"name",name:"name"}
            
            ]
    });
});
function cbclick(data){
    var rows = tblnewsfeed.rows().indexes();
    // alert(rows.length);
    var a=true;
    for (var i = 0; i < rows.length ; i++) {

            var Id = tblnewsfeed.rows(i).data()[0].approval_level_rowID;

            // var a =$('#tblnewsfeed' + ' input[name=cb' + '_' + menuId + ']').prop('checked', val);
            if(document.getElementById('cb_'+Id).checked==false)
            {
                a=false;
            }
        }
    
    if(a){
        $('#cbHeader').prop('checked', a);
    }{
        $('#cbHeader').prop('checked', a);
    }
}
function Delete() {

        var id = $('#modal').data('id');

         $.ajax({
                    url : "<?php echo base_url('c_newsfeed/Delete');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data: { id: id },
                    dataType:"json",
                    success:function(event, data){
                        BootstrapDialog.alert(event.Pesan);
                        
                        $('#modal').modal('hide');
                        tblnewsfeed.ajax.reload(null,true); 
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                      // delete_gagal();
                     BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                     
                    }
                    });
        // $('[data-id=' + id + ']').remove();

        // $('#modal').modal('hide');

        // tblnewsfeed.ajax.reload(null, false);

    }
    function save(){
        // alert('tesssssss');
    
        
        var rows = tblnewsfeed.rows().indexes();
   
   var datatbl = new Array();
   var datatick= new Array();
   var datalevel= new Array();
   var row=0;
   var rr=0;
   var ab=' ';
   var unlevel='';
   var RowsCount = rows.length;
   var status_b= false;
    for (var i = 0; i < RowsCount ; i++) {
            // var status_b= false;
            var Id = tblnewsfeed.rows(i).data()[0].approval_level_rowID;
            var level = tblnewsfeed.rows(i).data()[0].level_no;
            // datalevel.push(level);
            // dataall.push({name:"Level",value:level});
            datalevel.push(level);
            if(document.getElementById('cb_'+Id).checked==true)
            {
                if(unlevel==level){
                    BootstrapDialog.alert('Level '+level+' already Tick!');
                    return;

                }else{
                    datatbl.push({name:'rowID',value:Id});
                    datatick.push(level);
                    unlevel = level;    
                    rr = Id;
                    // console.log(unlevel+' tik '+rr);
                }                
            }

            if(ab!=level){
                if(!status_b && i>1){
                   BootstrapDialog.alert('Please Tick all level 1 Submit '); 
                    return;
                }
                ab=level;
                status_b=false;
             
                row=Id;
            }
            // console.log(rows.length+' count '+i);
            // console.log(level);
            if(ab==level){
                if(document.getElementById('cb_'+Id).checked==true){
                    status_b=true;
                    // console.log(i+' '+level+' tick  '+row+' '+status_b);
                }
                // else{
                //     status_b=false;
                //     console.log(i+' '+level+' untick  '+row+' '+status_b);
                // }
            }
            if(i==(RowsCount-1) && status_b==false){
                console.log('real end')
                BootstrapDialog.alert('Please Tick all level 1 Submit');
                return;

            }
            
            
        }
        // console.log(datatick);
        // console.log(datalevel);
        if(datatbl.length==0){
            BootstrapDialog.alert('Please Tick Before Save');

            return;
        } 

        document.getElementById('load').hidden=false;
        // console.log(datatbl);
        // return;  
        var id = $('#modal').data('id');
        var lot_no = $('#modal').data('lot_no');
        var debtor_acct = $('#modal').data('debtor_acct');
        var from = $('#modal').data('from');
// console.log(id+' '+lot_no+' '+debtor_acct);
        datatbl.push({name:'bussines_id',value:id});
        datatbl.push({name:'lot_no',value:lot_no});
        datatbl.push({name:'debtor_acct',value:debtor_acct});
        $.ajax({
                    url : "<?php echo base_url('submitSales/addSubmitmodal');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data:{dtSubmit:datatbl},
                    dataType:"json",
                    success:function(event, status){
                        var msg = event.Pesan;
                        
                        if(event.PesanSend!='ok'){
                            msg = msg +'<br>'+event.PesanSend;
                        }
                        if(event.PesanEmail!='ok'){
                            msg = msg +'<br>'+ event.PesanEmail;
                        }

                        
                        

                         // console.log(status);
                         document.getElementById('load').hidden=true;

                        // if(status=='success'){
                            BootstrapDialog.alert(msg, function(){
                                $('[data-id=' + id + ']').remove();
                        $('#modal').modal('hide');
                        if(from=='list')
                           { window.location.href='<?php echo base_url('c_rl_sales_list');?>';}
                       else{ window.location.href='<?php echo base_url('c_booking_by_floor');?>';}
                        });
                            // 

                        // }else{
                        //     BootstrapDialog.alert(msg);
                        // }
                        // console.log(event);
                        
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                      // delete_gagal();
                     BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                     
                    }
                    });
    }
    function cbAll(e){
        e = e || event; /* get IE event ( not passed ) */
        e.stopPropagation ? e.stopPropagation() : e.cancelBubble = true;

        var chkSelectAll = $('#cbHeader');
        console.log(chkSelectAll);
        console.log(status);
        console.log(chkSelectAll.is(':checked'));

        if (chkSelectAll.length && chkSelectAll.is(':checked') && !status) {
            SetCheckBox( true);
        }
        else {
            SetCheckBox( false);
        }
    }

      function SetCheckBox(val) {

        var rows = tblnewsfeed.rows().indexes();

        for (var i = 0; i < rows.length ; i++) {

            var menuId = tblnewsfeed.rows(i).data()[0].approval_level_rowID;

            $('#tblnewsfeed' + ' input[name=cb' + '_' + menuId + ']').prop('checked', val);

        }

        $('#cbHeader').prop('checked', val);

    }
</script>
    <div id="load" hidden="true"></div>
    <section class="content" >
        <table id="tblnewsfeed" class="display table-striped table-bordered table-condensed" cellspacing="0" width="100%">
            <thead>            
                <th width="10%"><input type="checkbox" id="cbHeader" onclick='cbAll(event)'/></th> <!--onclick='cbAll("View", event)'-->
                <th width="10%" >Level</th>
                <!-- <th width="10%">User</th> -->
                <th >Name</th>                
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="box-footer">
              <button class="btn btn-primary" type="button" id="btnSimpan" onclick="save()"> Submit</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
              <!-- <button class="btn btn-primary" type="button" id="btnTes"> tes</button> -->
            </div>
    </section>

<!-- <script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script> -->

<!-- <script type="text/javascript">
//End choosen properties      
var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
End choosen properties      
</script> -->

<!-- Bootstrap Modal -->
<!-- <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">

        <div class="modal-content"> -->
            <!-- Modal Header -->
            <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
            </div> -->

            <!-- Modal Body -->
        <!--     <div class="modal-body">
            </div>
        </div>

    </div>
</div>