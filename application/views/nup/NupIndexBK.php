<!-- <link rel="stylesheet" type="text/css" href="<?=base_url('DataTable/media/css/dataTables.bootstrap.min.css');?>"> -->
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />
<script type="text/javascript">
window.history.forward();
var project;
var x = '<?php echo $kondisi;?>';

var tblnup;
$(function(){


   tblnup = $('#tblnup').DataTable( 
    {
         dom: 'Bfrtip',
            responsive: true,
            select: true,
            buttons: [
                {
                    text: ' New', className: "fa fa-plus "+x, action: function (e) {

                        var status='I';
                        var site_url = '<?php echo base_url("c_nup/insert")?>';
                         
                        // $.post(site_url,
                        //   {status:status},
                        //   function(data,status){
                        //     console.log(data);
                        //     // alert(data);
                        //      // var url = '<?php echo base_url("c_nup/Index")?>';
                        //      //  window.location.href=url;
                        //   },
                        //   'json'
                        //   );
                        window.location.href= site_url+"/"+status;
                        // var modalClass = $('#modal').attr('class');
                        // switch (modalClass) {
                        //     case "modal fade bs-example-modal-md":
                        //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                        //         break;
                        //     case "modal fade bs-example-modal-sm":
                        //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                        //         break;
                        //     default:
                        //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                        //         break;
                        // }

                        // var modalDialogClass = $('#modalDialog').attr('class');
                        // switch (modalDialogClass) {
                        //     case "modal-dialog modal-md":
                        //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                        //         break;
                        //     case "modal-dialog modal-sm":
                        //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                        //         break;
                        //     default:
                        //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                        //         break;
                        // }

                        // $('#modalTitle').html('Add NUP');
                        // $('div.modal-body').load("<?php echo base_url("c_nup/goto_form");?>");
                        
                        // $('#modal').data('id', 0).modal('show');


                    }
                },
                {
                    text: ' Edit/Revisi', className: 'fa fa-pencil',
                    action: function () {
                      
                        var rows = tblnup.rows('.selected').indexes();
                        if (rows.length < 1) {
                            alert('Please select a row');
                            return;
                        }

                        var data = tblnup.rows(rows).data();
                        var status = data[0].STATUS;
                        var ID = data[0].rowID;                        
                        
                        var st= new Array('A','I','U');
                        
                        if((st.indexOf(status)) < 0 ){
                            alert('Only Status New, Approve, UnApprove ');
                            return;
                        }
// alert(ID);
// alert(status);
                        var site_url = '<?php echo base_url("c_nup/edit_rev")?>'+'/'+status+'/'+ID;
                        // $.post(site_url,
                        //   {status:status,ID:ID},
                        //   function(data,status){
                        //     // console.log(data);
                        //     // alert(data);
                        //      // var url = '<?php echo base_url("c_nup/Index")?>';
                        //      //  window.location.href=url;
                        //   }
                        //   );
                        
                        window.location.href= site_url;
                        // var modalClass = $('#modal').attr('class');
                        // switch (modalClass) {
                        //     case "modal fade bs-example-modal-md":
                        //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                        //         break;
                        //     case "modal fade bs-example-modal-sm":
                        //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                        //         break;
                        //     default:
                        //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                        //         break;
                        // }

                        // var modalDialogClass = $('#modalDialog').attr('class');
                        // switch (modalDialogClass) {
                        //     case "modal-dialog modal-md":
                        //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                        //         break;
                        //     case "modal-dialog modal-sm":
                        //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                        //         break;
                        //     default:
                        //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                        //         break;
                        // }

                        // $('#modalTitle').html('Edit Newsfeed');

                        // $('div.modal-body').load("<?php echo base_url("c_newsfeed/addnew");?>"+"/"+$('#txt_Pl_Project').val());

                        // $('#modal').data('id', ID).modal('show');

                    }
                },
                {
                    text: ' Delete', className: "fa fa-trash",
                    action: function () {
                      
                        var rows = tblnup.rows('.selected').indexes();
                        if (rows.length < 1) {
                            alert('Please select a row');
                            return;
                        }

                        var data = tblnup.rows(rows).data();
                        var UserID = data[0].rowID;
                        var status = data[0].STATUS;
                        var seqno = data[0].nup_sequence_no;
                        var business_id = data[0].business_id;
                        
                        if(status !='I'){
                            alert('Only Delete Status New');
                            return;
                        }


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

                        $('#modalTitle').html('Delete NUP');

                        $('div.modal-body').html('Are you sure that you want to delete this item?');

                        $('div.modal-body').append('<div class="modal-footer"></div>');

                        var btnYes = $('<input/>')
                            .attr({
                                id: "btnYes",
                                type: "button",
                                class: "btn btn-danger",
                                onclick: 'Delete();',
                                value: 'Yes'
                            });

                        var btnNo = $('<a>No</a>').attr({
                            class: "btn btn-default", 'data-dismiss': "modal"
                        });

                        $('div.modal-footer').append(btnYes);
                        $('div.modal-footer').append(btnNo);

                        $('#modal').data('id', UserID).modal('show');
                        $('#modal').data('seqno', seqno);
                        $('#modal').data('business_id', business_id);

                    }
                }
                ,{
                    text: ' Submit', className: 'fa fa-file', action: function (e) {
                            var rows = tblnup.rows('.selected').indexes();
                        if (rows.length < 1) {
                            alert('Please select a row');
                            return;
                        }

                        var data = tblnup.rows(rows).data();
                        var UserID = data[0].rowID;
                        var status = data[0].STATUS;
                        var st= new Array('R','I');

                        if((st.indexOf(status)) < 0 ){
                            alert('Only Status New and Revisi ');
                            return;
                        }

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

                        $('#modalTitle').html('Submit NUP');

                        $('div.modal-body').html('Are you sure you want Submit this NUP?');

                        $('div.modal-body').append('<div class="modal-footer"></div>');

                        var btnYes = $('<input/>')
                            .attr({
                                id: "btnYes",
                                type: "button",
                                class: "btn btn-danger",
                                onclick: 'Submit();',
                                value: 'Yes'
                            });

                        var btnNo = $('<a>No</a>').attr({
                            class: "btn btn-default", 'data-dismiss': "modal"
                        });

                        $('div.modal-footer').append(btnYes);
                        $('div.modal-footer').append(btnNo);

                        $('#modal').data('id', UserID).modal('show');
                        $('#modal').data('status', status);
                    }
                }                 
                ,{
                    

                    text: ' Unit', className: 'fa fa-pencil',
                    action: function () {
                      
                        var rows = tblnup.rows('.selected').indexes();
                        if (rows.length < 1) {
                            alert('Please select a row');
                            return;
                        }

                        var data = tblnup.rows(rows).data();
                        var a = data[0].nup_no;
                        var status = data[0].STATUS;
                        
                        
                        if(status != 'A'){
                            alert('NUP Still not Approved');
                        }else{
                            var site_url = '<?php echo base_url("c_nup_dt/list_dt")?>'+'/'+a;
                        
                            window.location.href= site_url;    
                        }
                    }
                }
                ,{
                    text: ' Send Invitation', className: 'fa fa-file', action: function (e) {
                          var rows = tblnup.rows('.selected').indexes();
                        if (rows.length < 1) {
                            alert('Please select a row');
                            return;
                        }

                        var data = tblnup.rows(rows).data();
                        var Email = data[0].Email;
                        var status = data[0].STATUS;
                        
                        
                        if(status != 'A'){
                            alert('NUP Still not Approved');
                        }else{
                            var site_url = '<?php echo base_url("c_nup_dt/list_dt")?>'+'/'+Email;
                        
                            window.location.href= site_url;    
                        }
                    }
                }
                ,{
                    text: ' Back ', className: 'fa fa-arrow-lef', action: function (e) {
                        var project = "<?php echo $project_no?>";
                        // alert(project);
                         window.location.href="<?php echo base_url('newsfeed/index');?>"+'/'+project;
                    }
                }
            ],
        "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_nup/getTable');?>",             
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number",searchable:false,orderable:false } ,
            {data:"nup_no",name:"nup_no"},
            {data:"NAME",name:"NAME"},
            {data:"Handphone",name:"Handphone"},
            {data:"Email",name:"Email"},
            {
                data:"reserve_date",name:"reserve_date",
                render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               
                               // alert(data);
                               // var aa=date.getDate() + "/" + (month.length > 1 ? month : "0" + month) + "/" + date.getFullYear();
                               var aa = day+"/"+month+"/"+year;
                                return aa;
                               
                               
                               // return <?php echo date('d-m-Y',strtotime(" ?>+data+ <?php "))?>;
                               // return <?php echo date('d-m-Y',strtotime("2016-09-04 12:00:45"))?>;

                           }
            },            
            {
                data:"STATUS",name:"STATUS", searchable:false,
                render:function (data,type,row) {
                    if(data=='I'){
                        return 'New';
                    }else if(data=='S'){
                        return 'Submit';
                    }else if(data=='A'){
                        return 'Approve';
                    }else if(data=='U'){
                        return 'UnApprove';
                    }else if(data=='R'){
                        return 'Revisi';
                    }else if(data=='T'){
                        return 'Revisi Submit';
                    }else if(data=='C'){
                        return 'Cancel';
                    }else{
                        return '';
                    }
                    
                }
            },
            {data:"descs",name:"descs"},
            {data:"business_id",name:"business_id",visible:false},
            {data:"nup_sequence_no",name:"nup_sequence_no",visible:false}
            
            ]
    });
});
function Delete() {

        var id = $('#modal').data('id');
        var seqno = $('#modal').data('seqno');
        var business_id = $('#modal').data('business_id');
        
         $.ajax({
                    url : "<?php echo base_url('c_nup/Delete');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data: { id: id,seqno:seqno,business_id:business_id },
                    dataType:"json",
                    success:function(event, data){
                        alert(event.Pesan);
                        
                        $('#modal').modal('hide');
                        tblnup.ajax.reload(null,true); 
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                      // delete_gagal();
                     alert(textStatus+' Save : '+errorThrown);
                     
                    }
                    });
        // $('[data-id=' + id + ']').remove();

        // $('#modal').modal('hide');

        // tblnup.ajax.reload(null, false);

    }
    function Submit(){
          var id = $('#modal').data('id');
        var status = $('#modal').data('status');
        
        
         $.ajax({
                    url : "<?php echo base_url('c_nup/SubmitStatus');?>",
                    type:"POST",
                    data: { id: id,status:status},
                    dataType:"json",
                    success:function(event, data){
                        alert(event.Pesan);
                        
                        $('#modal').modal('hide');
                        tblnup.ajax.reload(null,true); 
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                      // delete_gagal();
                     alert(textStatus+' Save : '+errorThrown);
                     
                    }
                    });

    }
</script>
<div class="content-wrapper">
    <section class="content-header">
    <div class="form-group">        
        <div class="tittle-top pull-left"><b><?php echo $ProjectDescs; ?></b></div>
        <div class="tittle-top pull-right"><b>Surat Pemesanan</b></div>
    </div>
    </section>
    <section class="content" >
        <table id="tblnup" class="display table-striped table-bordered table-condensed" cellspacing="0" width="100%">
            <thead>    
                <th>No</th>        
                <th>NUP. No</th>
                <th>Name</th>
                <th>Handphone</th>
                <th>Email</th>
                <th>Reserve Date</th>
                <th>Status</th>
                <th>Type</th>                
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>
</div>
<!-- <script src="<?=base_url('choosen/jquery.min.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<!-- <script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.min.js')?>" type="text/javascript"></script> 
<!-- <link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />  -->

<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
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
//End choosen properties      
</script>

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
<div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modal2Dialog" class="modal-dialog">

        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modal2Title"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>