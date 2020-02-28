<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>

<style type="text/css">
    
</style>

<script type="text/javascript">
window.history.forward();
var project;
var x = '<?php echo $kondisi;?>';

function showUp(nupno)
{
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

    $('#modalTitle').html('Ticket NUP');
    $('div.modal-body').html('Choose action for Ticket NUP :<br>');
    $('div.modal-body').append('<div class="modal-footer"></div>');

    var btnView = $('<input/>')
        .attr({
            id: "btnView",
            type: "button",
            class: "btn btn-primary pull-left",
            onclick: 'at(\''+nupno+'\');',
            value: 'View'
        });

    var btnMail = $('<input/>')
        .attr({
            id: "btnMail",
            type: "button",
            class: "btn btn-danger pull-right",
            onclick: 'mt(\''+nupno+'\');',
            value: 'Email'
        });
 
    $('div.modal-footer').append(btnView);
    $('div.modal-footer').append(btnMail);
    $('#modal').data('id', nupno).modal('show');
}

var tblnup;
var tblapprove;
$(function(){
   tblnup = $('#tblnup').DataTable({
            dom: '<"toolbarHd dataTables_filter">Bfrtip',
            // responsive: true,
            responsive: {
                    details: {
                        type: 'column',
                        target: 8
                    }
                },
            select: true,
            filter:false,
            "order": [[ 2, 'asc']],
            // "paging": false,
            buttons: [
                // {
                //      text: ' New', className: "biru-bg fa fa-plus "+x, action: function (e) {

                //         var status='I';
                //         var site_url = '<?php echo base_url("c_nup/insert")?>';
                         
                //        var url = '<?php echo base_url("c_nup/cek_agent")?>';
                //         $.post(url,
                //           {status:status},
                //           function(data,status) {
                //             // console.log(data);
                //             if(data ==0){                                
                //                 swal("Information",'Only Agent can Entry NUP',"warning");
                //                 return false;
                //             }
                //             window.location.href= site_url+"/N";
                //           // if(data=='FAIL'){

                //           // }
                //           }
                //         );
                        
                //         // var modalClass = $('#modal').attr('class');
                //         // switch (modalClass) {
                //         //     case "modal fade bs-example-modal-md":
                //         //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                //         //         break;
                //         //     case "modal fade bs-example-modal-sm":
                //         //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                //         //         break;
                //         //     default:
                //         //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                //         //         break;
                //         // }

                //         // var modalDialogClass = $('#modalDialog').attr('class');
                //         // switch (modalDialogClass) {
                //         //     case "modal-dialog modal-md":
                //         //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                //         //         break;
                //         //     case "modal-dialog modal-sm":
                //         //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                //         //         break;
                //         //     default:
                //         //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                //         //         break;
                //         // }

                //         // $('#modalTitle').html('Add NUP');
                //         // $('div.modal-body').load("<?php echo base_url("c_nup/goto_form");?>");
                        
                //         // $('#modal').data('id', 0).modal('show');


                //     }
                // },
                {
                    text: ' New Reguler', className: "biru-bg fa fa-plus "+x, action: function (e) {

                       //  var status='I';
                        var site_url = '<?php echo base_url("c_mobile_cfld/index")?>';
                         
                       // var url = '<?php echo base_url("c_nup/cek_agent")?>';
                       //  $.post(url,
                       //    {status:status},
                       //    function(data,status) {
                       //      // console.log(data);
                       //      if(data ==0){                                
                       //          swal("Information",'Only Agent can Entry NUP',"warning");
                       //          return false;
                       //      }
                       //      window.location.href= site_url+"/N";
                            window.location.href= site_url;
                       //    // if(data=='FAIL'){

                       //    // }
                       //    }
                       //  );
                        
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
                    text: ' New Prioritas', className: "biru-bg fa fa-plus "+x, action: function (e) {
                        var site_url = '<?php echo base_url("c_mobile_cfld/indexPrior")?>';
                            window.location.href= site_url;
                    }
                },
                {
                    text: ' Edit/Revise', className: 'biru-bg fa fa-pencil',
                    action: function () {
                      
                        var rows = tblnup.rows('.selected').indexes();
                        if (rows.length < 1) {                            
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblnup.rows(rows).data();
                        var status = data[0].STATUS;
                        var ID = data[0].rowID;
                        var HeaderID = data[0].HeaderID
                        var Type = data[0].nup_type

                        if(Type=='ROI '){
                            Type ='R';
                        }else{
                            Type ='P';
                        }
                        // alert(Type);
                        // return;
                        
                        // console.log(data);
                        var st= new Array('A','N','P','V','R');
                        
                        if((st.indexOf(status)) < 0 ){                            
                            swal("Information",'Only Status New, Approved, Pending ',"warning");
                            return;
                        }
// BootstrapDialog.alert(ID);
// BootstrapDialog.alert(status);
                        // var site_url = '<?php echo base_url("c_nup_cfld/edit_rev_mobile")?>'+'/'+status+'/'+ID+'/'+Type;
                        var site_url = '<?php echo base_url("c_nup_cfld/edit_rev")?>'+'/'+status+'/'+ID+'/'+HeaderID+'/'+Type+'/M';
    
                        // var site_url = '<?php echo base_url("c_nup_landed_cfld/index")?>'+'/'+HeaderID  
               
                        
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
                    text: ' Delete', className: "biru-bg fa fa-trash",
                    action: function () {
                      
                        var rows = tblnup.rows('.selected').indexes();
                        if (rows.length < 1) {                            
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblnup.rows(rows).data();
                        var UserID = data[0].rowID;
                        var status = data[0].STATUS;
                        var seqno = data[0].Header_sequence_no;
                        var business_id = data[0].business_id;
                        
                        if(status !='N'){                            
                            swal("Information",'Only Status NEW Can Delete',"warning");
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
                ,
                // {
                //     text: ' Submit', className: 'btn-success fa fa-pencil-square-o', action: function (e) {
                //             var rows = tblnup.rows('.selected').indexes();
                //         if (rows.length < 1) {
                //             BootstrapDialog.alert('Please select a row');
                //             return;
                //         }

                //         var data = tblnup.rows(rows).data();
                //         var UserID = data[0].rowID;
                //         var status_nup = data[0].STATUS;
                //         var seqno = data[0].nup_sequence_no;
                //         var st= new Array('R','N','V');

                //         if((st.indexOf(status_nup)) < 0 ){
                //             BootstrapDialog.alert('Only Status New and Revised ');
                //             return;
                //         }
                //         // var status_attach = cek_attach(seqno,'');
                //         // BootstrapDialog.alert('submit '+status_attach);
                //         // if(status_attach!='OK'){
                //         //     BootstrapDialog.alert('Please Compelete NUP attachment ');
                //         //     return;
                //         // }

                //         var site_url = '<?php echo base_url("c_nup/check_attachment")?>';
                //             $.post(site_url,
                //                  {seqno:seqno,from:'out'},
                //              function(data,status) {
                //             console.log(data);
                            
                //                 // hasil = data;
                //                 // BootstrapDialog.alert(data);
                //                 if(data!='OK'){
                //                 BootstrapDialog.alert('Please Complete NUP attachment ');
                //                 return;
                //                 }else{
                               
                //                     var modalClass = $('#modal').attr('class');
                //                     switch (modalClass) {
                //                         case "modal fade bs-example-modal-lg":
                //                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                //                             break;
                //                         case "modal fade bs-example-modal-md":
                //                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                //                             break;
                //                         default:
                //                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                //                             break;
                //                     }

                //                     var modalDialogClass = $('#modalDialog').attr('class');
                //                     switch (modalDialogClass) {
                //                         case "modal-dialog modal-lg":
                //                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                //                             break;
                //                         case "modal-dialog modal-md":
                //                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                //                             break;
                //                         default:
                //                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                //                             break;
                //                     }

                //                     $('#modalTitle').html('Submit NUP');

                //                     $('div.modal-body').html('Are you sure want to Submit this NUP?');

                //                     $('div.modal-body').append('<div class="modal-footer"></div>');

                //                     var btnYes = $('<input/>')
                //                         .attr({
                //                             id: "btnYes",
                //                             type: "button",
                //                             class: "btn btn-danger",
                //                             onclick: 'Submit();',
                //                             value: 'Yes'
                //                         });

                //                     var btnNo = $('<a>No</a>').attr({
                //                         class: "btn btn-default", 'data-dismiss': "modal"
                //                     });

                //                     $('div.modal-footer').append(btnYes);
                //                     $('div.modal-footer').append(btnNo);

                //                     $('#modal').data('id', UserID).modal('show');
                //                     $('#modal').data('status', status_nup);
                //                     $('#modal').data('seqno', seqno);
                //                      }
                                
                //             });
                //     }
                // },
                // {
                    

                //     text: ' Unit', className: 'btn-danger fa fa-pencil',
                //     action: function () {
                      
                //         var rows = tblnup.rows('.selected').indexes();
                //         if (rows.length < 1) {
                //             BootstrapDialog.alert('Please select a row');
                //             return;
                //         }

                //         var data = tblnup.rows(rows).data();
                //         var a = data[0].nup_no;
                //         var status = data[0].STATUS;
                        
                        
                //         // if(status != 'A' && a != ' '){
                //         //     BootstrapDialog.alert('Only Status Approved can choose Unit');
                //         // }else{
                //         //     var site_url = '<?php echo base_url("c_nup_dt/list_dt")?>'+'/'+a;
                        
                //         //     window.location.href= site_url;    
                //         // }

                //         if(a == ' '){
                //             BootstrapDialog.alert('Only Status Approved can choose Unit');
                //         }else if(status != 'A'){
                //             BootstrapDialog.alert('Only Status Approved can choose Unit');
                //         }else{
                //             var site_url = '<?php echo base_url("c_nup_dt/list_dt")?>'+'/'+a;
                        
                //             window.location.href= site_url;    
                //         }
                //     }
                // },
                // {
                //     text: ' Send Invitation', className: 'bg-purple fa fa-file', action: function (e) {
                //           var rows = tblnup.rows('.selected').indexes();
                //         if (rows.length < 1) {
                //             BootstrapDialog.alert('Please select a row');
                //             return;
                //         }

                //         var data = tblnup.rows(rows).data();
                //         var rowid = data[0].rowID;
                //         var Email = data[0].Email;
                //         var status = data[0].STATUS;
                        
                        
                //         if(status != 'A'){
                //             BootstrapDialog.alert('Only Status Approved Can Send Invitation');
                //             return;
                //         }else{
                //             // var site_url = '<?php echo base_url("c_nup_dt/list_dt")?>'+'/'+Email;
                //             // window.location.href= site_url;
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
                //             $('#modalTitle').html('Submit NUP');
                //             $('div.modal-body').html('Are you sure you want Send this Invitation?');
                //             $('div.modal-body').append('<div class="modal-footer"></div>');

                //             var btnYes = $('<input/>')
                //                 .attr({
                //                     id: "btnYes",
                //                     type: "button",
                //                     class: "btn btn-danger",
                //                     onclick: 'invitation();',
                //                     value: 'Yes'
                //                 });

                //             var btnNo = $('<a>No</a>').attr({
                //                 class: "btn btn-default", 'data-dismiss': "modal"
                //             });

                //             $('div.modal-footer').append(btnYes);
                //             $('div.modal-footer').append(btnNo);
                //             $('#modal').data('id', rowid).modal('show');
                //         }
                //     }
                // },
                {
                    text: ' Back ', className: 'biru-bg fa fa-arrow-left', action: function (e) {
                        var project = "<?php echo $project_no?>";
                        var projectName = "<?php echo $ProjectDescs; ?>";
                        var paramEnc = "<?php echo $paramEnc ?>";
                        // BootstrapDialog.alert(projectName);
                         // window.location.href="<?php echo base_url('newsfeed/index');?>"+'/'+project+'-'+projectName;
                         window.location.href="<?php echo base_url('newsfeed/index/');?>"+paramEnc;
                    }
                },
                {
                    text: ' Refresh ', className: 'biru-bg fa fa-refresh', action: function (e) {
                       
                       document.getElementById('loader').hidden=false;
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 // document.getElementById('load').style.visibility="hidden";
                                 tblnup.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }

                       // document.getElementById('loader').hidden=false;
                       // tblnup.ajax.reload(null,true);
                       // document.getElementById('loader').hidden=true;
                    }
                }
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_nup_cfld/getTableHd');?>",  
            "data":{"sSearchHd": function(d){
                var a = $('#txt_search').val();
                // console.log(a);
                // console.log('HD');
                var b ="";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
             }},           
            "type":"POST"
        },
        "columns": [
            // {data: "row_number",name:"row_number",searchable:false,orderable:false }, 
            {
              // data: "rowID", name: "rowID", visible: false
              data: "rowID", name: "rowID",
                            render: function (data, type, row) {
                                var seq_no = row.Header_sequence_no;
                                var status = row.STATUS;
                                var headerID = row.HeaderID;
                                var ID = row.rowID;
                                var Type = row.nup_type;
// console.log(Type);
                              // return status; <i class="fa fa-users fa-fw"></i> 
                               // if(status=='N' || status=='R'){
                               //  return  '<a class="btn btn-success btn-sm" onclick="klikcubmitnon(\''+data+'\',\''+seq_no+'\',\''+status+'\',\''+headerID+'\');"" >Submit</a>';
                               //  // return  '<a class="btn btn-sm" style="width: 100px;background:red;" onclick="klikcubmitnon(\''+data+'\',\''+seq_no+'\',\''+status+'\',\''+headerID+'\');"" >Submit</a>';
                               // }else{
                               //  return ' ';
                               // }
                                
                            if(status=='N' || status=='R'){
                                return  '<a class="btn btn-success btn-sm" onclick="klikcubmitnon(\''+data+'\',\''+seq_no+'\',\''+status+'\',\''+headerID+'\',\''+Type+'\');"" ><i class="fa fa-users fa-fw"></i> Submit</a> ';
                                // if(status == 'P'){
                                //     return  '<a class="btn btn-success btn-sm" onclick="klikcubmitnon(\''+data+'\',\''+seq_no+'\',\''+status+'\',\''+headerID+'\');"" ><i class="fa fa-users fa-fw"></i> Edit</a> ';
                                // }else{
                                //     return ' ';
                                // }
                               }else if (status == 'P'){
                                return '<a class="btn btn-success btn-sm" onclick="edit_revise(\''+status+'\',\''+ID+'\',\''+headerID+'\',\''+Type+'\');"" ><i class="fa fa-pencil fa-fw"></i> Revised</a>';
                               } else {
                                return ' ';
                               }
                                

                            }
            }, 
            {data:"NAME",name:"NAME"},
            {data:"status_desc",name:"status_desc",
                render: function(data, type, row){
                    var stat = row.STATUS;
                    var old_status = row.old_status_desc;
                    if(stat == 'S'){
                      status_merge = data + old_status;
                    }else{
                        status_merge = data;
                    }
                    return status_merge;
                }
            },
            {data:"HeaderID",name:"HeaderID"},
            {data:"nup_type_descs",name:"nup_type_descs"},                        
            {data:"Handphone",name:"Handphone"},
            {data:"Email",name:"Email"},
            // {data:"nup_no",name:"nup_no", render: function(data, type, row){
            //     var stat = row.STATUS;
            //     if(stat=='A') {
            //         // aa ='<a href="<?php echo base_url("c_reports/gt/'+data+'") ?>" target="_blank">'+data+'</a>';
            //         // '<a class="btn btn-primary btn-sm" onclick="Loadfile(\''+data+'\',\''+a+'\');"" ><i class="fa fa-users fa-fw"></i> Upload File</a>'
            //         aa = '<a class="btn btn-primary btn-sm" onclick="showUp(\''+data+'\');" >'+data+'</a>';
            //     } else {
            //         aa = data;
            //     }                
            //     return aa;
            // }},
            {
                data:"reserve_date",name:"reserve_date",
                render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               
                               // BootstrapDialog.alert(data);
                               // var aa=date.getDate() + "/" + (month.length > 1 ? month : "0" + month) + "/" + date.getFullYear();
                               var aa = day+"/"+month+"/"+year;
                                return aa;
                               
                               
                               // return <?php echo date('d-m-Y',strtotime(" ?>+data+ <?php "))?>;
                               // return <?php echo date('d-m-Y',strtotime("2016-09-04 12:00:45"))?>;

                           }
            },                        
            {data:"columdef",name:"columdef"},
            {data:"business_id",name:"business_id",visible:false},
            {data:"Header_sequence_no",name:"Header_sequence_no",visible:false},
            {data:"STATUS",name:"STATUS",visible:false},
            {data:"rowID",name:"rowID",visible:false}
            
            ],
            "columnDefs": [ {
                    className: 'control',
                    orderable: false,
                    targets:   8
                } ]
    });
    $("div.toolbarHd").html('<b>Search :<div class="input-group"><div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >&nbsp;<a class="btn blue-bg btn-sm" onclick="fn_search() style=" width: auto"><i class="fa fa-search"></i></a> </div></div></b>&nbsp;');

    // $('#txt_search').change(function(){
    //     // BootstrapDialog.alert('asdf');
    // });
     $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        if(a==''){
            tblnup.ajax.reload(null,true);   
        }

        if(event.keyCode == 13){
            // $("#id_of_button").click();
            
            tblnup.ajax.reload(null,true);   
        }
        
    });

    $('#button').click( function () {
        var data = tblnup.rows('.selected').data();
        for (var i = data.length - 1; i >= 0; i--) {
            data[i];
            // alert(data[0].row_number);
        };
        // var a = data[0].row_number;
        // var UserID = data[0].rowID;
        // var status_nup = data[0].STATUS;
        // var seqno = data[0].nup_sequence_no;
        // console.log(data);

        // alert(UserID);

        // alert( tblnup.rows('.selected').data().length +' row(s) selected' );
        
        // alert( tblnup.rows('.selected').data();

        // alert( tblnup.rows().data());
      

        // var a = data[0].nup_no;
        // var status = data[0].STATUS;
        // alert(a+' - '+status);
    } );

    $('#tblnup tbody').on( 'click', 'tr.group', function () {
        var currentOrder = tblnup.order()[0];
        if ( currentOrder[0] === 6 && currentOrder[1] === 'asc' ) {
            tblnup.order( [ 6, 'desc' ] ).draw();
        }
        else {
            tblnup.order( [ 6, 'asc' ] ).draw();
        }
    } );

    // $('#tblnup tbody').on( 'click', 'tr', function () {
    //     $(this).toggleClass('selected');
    // } );
});
function fn_search(){
    var a = $('#txt_search').val();
    tblnup.ajax.reload(null,true); 
}

function edit_revise(status,ID,headerID,Ro_type){
    
    if(Ro_type=='ROI '){
        Ro_type='R';
    }else{
        Ro_type='P'
    }
    // alert(Ro_type);return;
    var site_url = '<?php echo base_url("c_nup_cfld/edit_rev")?>'+'/'+status+'/'+ID+'/'+headerID+'/'+Ro_type+'/M';
    window.location.href= site_url;
}

function klikcubmitnon(data,seq_no,status_nup,headerID,Type)
     {
        // alert(Type);
        // return;
        // console.log(data);
        var id = data;
        // console.log(status_nup);
        // alert(id);
        // console.log(id);
        // return;
                            var rows = tblnup.rows('.selected').indexes();
                        // if (rows.length < 1) {
                        //     BootstrapDialog.alert('Please select a row');
                        //     return;
                        // }

                        // var data = tblnup.rows(rows).data();
                        // var UserID = data[0].rowID;
                        // var status_nup = data[0].STATUS;
                        // var seqno = data[0].nup_sequence_no;
                        // var st= new Array('R','N','V');

                        // if((st.indexOf(status_nup)) < 0 ){
                        //     BootstrapDialog.alert('Only Status New and Revised ');
                        //     return;
                        // }
                        
                      var site_url = '<?php echo base_url("c_nup_cfld/check_attachment")?>';
                            $.post(site_url,
                                 {seqno:seq_no,from:'out'},
                             function(data,status) 

                        {
                            console.log(data);
                            
                                // hasil = data;
                                // BootstrapDialog.alert(data);
                                if(data!='OK'){                                
                                swal("Information",'Please Complete ROI attachment & Payment Method',"warning");
                                return;
                                }
                                else
                        {
                               
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

                                    $('#modalTitle').html('Submit ROI');

                                    $('div.modal-body').html('Are you sure want to Submit this ROI?');

                                    $('div.modal-body').append('<div class="modal-footer"></div>');

                                    var btnYes = $('<input/>')
                                        .attr({
                                            id: "btnYes",
                                            type: "button",
                                            class: "btn btn-danger",
                                            onclick: 'Submit()',
                                            value: 'Yes'
                                        });

                                    var btnNo = $('<a>No</a>').attr({
                                        class: "btn btn-default", 'data-dismiss': "modal"
                                    });

                                    $('div.modal-footer').append(btnYes);
                                    $('div.modal-footer').append(btnNo);

                                    $('#modal').data('id', id).modal('show');
                                    $('#modal').data('status', status_nup);
                                    $('#modal').data('seq_no', seq_no);
                                    $('#modal').data('Type', Type);
                                    
                                    $('#modal').data('headerID', headerID);
                            }
                                
                            });
                    

}
function cek_attach(seqno,hasil){
    var ab='';
    // var site_url = '<?php echo base_url("c_nup/check_attachment")?>';
    // $.post(site_url,
    //      {seqno:seqno,from:'out'},
    //  function(data,status) {
    // console.log(data);
    
    //     hasil = data;
    //     // BootstrapDialog.alert(result);
    //     // return result;
    // console.log('11 '+hasil);    
    // // return ab.toString();
    // });
    // var a = result;
    $.ajax({
        url :"<?php echo base_url("c_nup_cfld/check_attachment")?>",
        type:"POST",
                    // data:$('#form_rl_sales').serialize(),
        data: { seqno:seqno,from:'out' },
        dataType:"json",
        success:function(event, data){            
            swal("Information",event.Pesan,"warning");
            ab = event.Pesan;
            console.log(event);
        console.log('12 '+ab);
    return ab;
        },                    
        error: function(jqXHR, textStatus, errorThrown){                             
        }
    });
    
    

}

function at(nupno)
{
    var site_rl = "<?php echo base_url('c_reports/gta/');?>/"+nupno;
    window.open(site_rl);
    // console.log(site_rl);
}

function mt(nupno)
{
    // var site_rl = "<?php echo base_url('c_reports/gtm/');?>";
    // window.open(site_rl);
    document.getElementById("loader").hidden=false;
    $.ajax({
        url: "<?php echo base_url('c_reports/gtm');?>",
        type: "post",
        data: {id: nupno},
        dataType: "json",
        success: function(data, status) {
            document.getElementById('loader').hidden=true;            
            swal("Information",data.Pesan,"warning");
            $('#modal').modal('hide');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            document.getElementById('loader').hidden=true;            
            swal("Information",textStatus+' Save : '+errorThrown,"warning");
        }
    });
}
    function Delete() {

        var id = $('#modal').data('id');
        var seqno = $('#modal').data('seqno');
        var business_id = $('#modal').data('business_id');
        
         $.ajax({
                    url : "<?php echo base_url('c_nup_cfld/Delete');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data: { id: id,seqno:seqno,business_id:business_id },
                    dataType:"json",
                    success:function(event, data){
                        console.log(data);
                        if(data=='success'){                          
                          swal("Information",event.Pesan,"success");                          
                          $('#modal').modal('hide');
                          tblnup.ajax.reload(null,true);
                        } 
                        else {
                            swal({
                                  title: "Are you sure?",
                                  text: event.Pesan,
                                  type: "warning",
                                  showCancelButton: true,
                                  confirmButtonColor: "#DD6B55",
                                  confirmButtonText: "Ok",
                                  closeOnConfirm: false
                                },
                                function(){
                                  swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                });


                        //   BootstrapDialog.show({
                        //   type: BootstrapDialog.TYPE_DANGER,
                        //   title: 'Error',
                        //   message: event.Pesan,
                        //   buttons: [{
                        //     label: 'OK',
                        //     action: function(dialogItself){
                        //     dialogItself.close();
                        //     }
                        //    }]
                        // });
                        }
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){                     
                     
                     swal("Information",textStatus+' Save : '+errorThrown,"warning");
                     
                    }
                    });
        // $('[data-id=' + id + ']').remove();

        // $('#modal').modal('hide');

        // tblnup.ajax.reload(null, false);

    }
    function Submit(){
        // alert('sdf');
        var id = $('#modal').data('id');
        var status = $('#modal').data('status');
        var headerID = $('#modal').data('headerID');
        var Type = $('#modal').data('Type');
        console.log(headerID)
        document.getElementById('loader').hidden=false;
        
         $.ajax({
                    url : "<?php echo base_url('c_nup_cfld/SubmitStatus');?>",
                    type:"POST",
                    data: { id:id,status:status,HeaderID:headerID,Type:Type},
                    dataType:"json",
                    success:function(event, data){
                        document.getElementById('loader').hidden=true;
                        // console.log(event);
                        // console.log(data);
                        if(event.Status!='Fail'){                          
                          swal("Information",event.Pesan,"success");
                          $('#modal').modal('hide');
                          tblnup.ajax.reload(null,true);
                        } else {
                           swal("Information",event.Pesan,"error");

                        //   BootstrapDialog.show({
                        //   type: BootstrapDialog.TYPE_DANGER,
                        //   title: 'Error',
                        //   message: event.Pesan,
                        //   buttons: [{
                        //     label: 'OK',
                        //     action: function(dialogItself){
                        //     dialogItself.close();
                        //     }
                        //    }]
                        // });
                        } 
                        // console.log(tblnup);

                        tblnup.ajax.reload(null,true);  
                        // tblapprove.ajax.reload(null,true);
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                        document.getElementById('loader').hidden=true;
                     swal("Information",textStatus+' Save : '+errorThrown,"warning");
                     
                    }
                    });
    }
    function invitation(){
        var id = $('#modal').data('id');
        $.ajax({
            url: "<?php echo base_url('c_nup_cfld/sendInvitation')?>",
            type: "POST",
            data: {rid: id},
            dataType: "json",
            success: function(data, status){                
                swal("Information",data.pesan,"warning");
                $('#modal').modal('hide');
                tblnup.ajax.reload(null,true); 
            },
            error: function(jqXHR, textStatus, errorThrown){                
                swal("Information",textStatus+' Send : '+errorThrown,"warning");
            }
        });
    }    

//    var count=10;
//         var duration = count;
         
//         var counter=setInterval(timer, 1000);
//         function timer(){
          
//           if (count < 0)
//           {
//             // var property_cd = $('#pl_property').val();   
//             count = duration;
//             // $('#table1').load( "<?php echo base_url('c_booking_by_floor/goto_table_sales');?>"+"/"+property_cd+" #table1");
//             tblnup.ajax.reload(null,true);
            
//           }
//          document.getElementById("time").innerHTML='Reload In : '+count;
//          // display2 = 'Reload In : '+count;
//          count=count-1;
//        }
// //END set Countdown with reload table
// //function stop countdown when modal hide  
//     function stoptime(){
//        clearInterval(counter);
//     }

// $(document).ready(function() {
//     $("#reload").click(function() {
//         // $("#tblnup").dataTable().fnReloadAjax();
//         tblnup.ajax.reload(null,true);
//         // alert('a');
//     });
// });

</script>
<style type="text/css">
    .font-color{
        color: #667;
    }
</style>
<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <div class="tittle-top pull-left"><?php echo $ProjectDescs; ?></div>
            <div class="tittle-top pull-right">ROI</div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        </div>
    </div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">                       
                        <div class="box-body"> 
                        <b>&nbsp; NEW ROI</b>
                        <br>                             
                            <!-- <table id="tblnup" class="table table-striped" cellspacing="0" width="100%" >  -->
                            <table id="tblnup" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >                         

                                <thead>    
                                    <!-- <th>No</th> -->
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>ROI Sequence No.</th>
                                    <th>ROI Type</th>                                                                    
                                    <th>Handphone</th>
                                    <th>Email</th>
                                    <th>Reserve Date</th>                                    
                                     <th></th>
                                </thead>
                                <tbody>
                                </tbody>                            
                            </table>
                        </div>                        
                    </div>
                </div>
            </div>            
        </div><br>
        <?php
                foreach($product as $row)
                {
               
                    $var ='<div class="row">';
                    $var.='<div class="col-xs-12">';
                    $var.='<div class="ibox-content">';
                    $var.='<div class="table-responsive">';                    
                    $var.='<div class="box-body">';
                    $var.='<b>&nbsp; APPROVED ROI '.$row->descs.'</b>';
                    $var.='<br>';                             
                    $var.='<table id="tblapprove'.$row->product_cd.'" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" style="position: ">';
                    $var.='<thead> ';   
                    $var.='<th>No</th>';                                        
                    $var.='<th>Name</th>';                                
                    $var.='<th>Handphone</th>';
                    $var.='<th>Email</th>';
                    $var.='<th>ROI No.</th>';
                    $var.='<th>Unit</th>';
                    $var.='<th>ROI Counter</th>';
                    $var.='<th>Reserve Date</th>';
                    $var.='<th>Status</th>';
                    $var.='<th></th>';                
                    $var.='</thead>';
                    $var.='<tbody>';
                    $var.='</tbody>';
                    $var.='</table>';
                    $var.='<font size="2px"><i>*Please click <b>ROI No.</b> to see "Tanda Terima Sementara" and Ticket ROI</i></font>';
                    $var.='</div>';                        
                    $var.='</div>';
                    $var.='</div>';
                    $var.='</div>';            
                    $var.='</div><br>';
                    echo $var;
                }
                ?>


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


<!-- INI TABLE APPROVE -->
<script type="text/javascript">
window.history.forward();
var project;
var unit = '<?php echo $btnUnit;?>';
// myFunction();

var tblapprove;
<?php 
foreach($product as $row)
    {  $var =' var tblapprove'.$row->product_cd.';';
// var_dump($var);
        echo $var;
    }

?>
//start doc function
$(function(){
    //start looping
<?php
foreach($product as $row){
    
$var ="tblapprove".$row->product_cd." = $('#tblapprove".$row->product_cd."').DataTable({";
                        
$var.='            dom: '."'".'<"toolbar'.$row->product_cd.' dataTables_filter">Bfrtip'."'".',';
// $var.="            responsive: true,";
$var.="            responsive: {details: {type: 'column',target: 9}},";
$var.="            select: true,";
$var.="            filter:false,";
$var.='            "order": [[ 6, "asc"]],';
            // searchDelay:null,
$var.="            buttons: [   ";
                
// $var.="                {    ";
// $var.="                    text: ' Revise', className: 'biru-bg fa fa-pencil',";
// $var.="                    action: function () { ";
                      
// $var.="                        var rows = tblapprove".$row->product_cd.".rows('.selected').indexes();";
// $var.="                        if (rows.length < 1) {";
// $var.="                            swal('Information','Please select a row','warning');";
// $var.="                            return;";
// $var.="                        }";

// $var.="                        var data = tblapprove".$row->product_cd.".rows(rows).data();";
// $var.="                        var status = data[0].STATUS;";
// $var.="                        var ID = data[0].rowID;                        ";
                       
// $var.="                        var st= new Array('A','N','P','V','R');";
                        
// $var.="                        if((st.indexOf(status)) < 0 ){";
// $var.="                            swal('Information','Only Status New, Approved, Pending ','warning');";
// $var.="                            return;";
// $var.="                        }";
// $var.="                        var site_url = '".base_url("c_nup/edit_rev_a")."'+'/'+status+'/'+ID; ";              
                        
// $var.="                        window.location.href= site_url;  ";
// $var.="                    }";
// $var.="                },";
// $var.="                {";
// $var.="                    text: ' Unit', className: 'abu-bg fa fa-pencil '+unit,";
// $var.="                    action: function () {";
                      
// $var.="                        var rows = tblapprove".$row->product_cd.".rows('.selected').indexes();";
// $var.="                        if (rows.length < 1) {";
// $var.="                            swal('Information','Please select a row','warning');";
// $var.="                            return;";
// $var.="                        }";

// $var.="                        var data = tblapprove".$row->product_cd.".rows(rows).data();";
// $var.="                        var a = data[0].nup_no;";
// $var.="                        var status = data[0].STATUS;";
                      

// $var.="                        if(a == ' '){";
// $var.="                            swal('Information','Only Status Approved can choose Unit','warning');";
// $var.="                        }else if(status != 'A'){";
// $var.="                            swal('Information','Only Status Approved can choose Unit','warning');";
// $var.="                        }else{";
// $var.="                            var site_url = '".base_url("c_nup_dt/list_dt")."'+'/'+a;";
                       
// $var.="                            window.location.href= site_url;    ";
// $var.="                        }";
// $var.="                    }";
// $var.="                },";
// $var.="                {";
// $var.="                    text: ' Back ', className: 'biru-bg fa fa-arrow-left', action: function (e) {";
// $var.="                        var project = '".$project_no."' ;";
// $var.="                        var projectName = '".$ProjectDescs."' ;";
// $var.="                        var paramEnc = '".$paramEnc."' ;";
// $var.="                        window.location.href='".base_url("newsfeed/index/")."'+paramEnc;";
// $var.="                    }";
// $var.="                },";
$var.="                {";
$var.="                    text: ' Refresh ', className: 'biru-bg fa fa-refresh', action: function (e) {";
                       
$var.="                       document.getElementById('loader').hidden=false;";
$var.="                       var state = document.readyState;";
$var.="                          if (state == 'complete') {";
$var.="                              setTimeout(function(){";
$var.="                                  document.getElementById('interactive');";
                                 // document.getElementById('load').style.visibility="hidden";
$var.="                                 tblapprove".$row->product_cd.".ajax.reload(null,true);";
$var.="                                 document.getElementById('loader').hidden=true;";
$var.="                              },1000);";
$var.="                          }";
$var.="                    }";
$var.="                }";
$var.="            ],";
        // "processing": true,
$var.='        "serverSide": true,';
$var.='        "ajax":{';

$var.='            "url": "'.base_url("c_nup_cfld/getTable/".$row->product_cd).'",  ';
$var.='            "data":{"sSearch": function(d){';
$var.="                var a = $('#txt_search".$row->product_cd."').val();";
                // console.log(a);
                // console.log('detail');
$var.='                var b ="";';
$var.="                if(a == null){";
$var.="                    return b;";
$var.="                }{";
$var.="                    return a;";
$var.="                }";
                
$var.="             }},           ";
$var.='            "type":"POST"';
$var.="        },";
        // ini ada button submit
$var.='        "columns": [';
$var.='            {data: "row_number",name:"row_number",searchable:false,orderable:false } ,  ';
// $var.="            {";
//               // data: "rowID", name: "rowID", visible: false
// $var.='              data: "rowID", name: "rowID",';
// $var.='                            render: function (data, type, row) {';
// $var.="                                var seq_no = row.nup_sequence_no;";
// $var.="                                var status = row.STATUS;";

//                               // return status;
// $var.="                               if(status=='V'){";
// $var.=" return  '<a class=".'"'."btn btn-success btn-sm".'"'." onclick=".'"'."klikcubmit(\''+data+'\',\''+seq_no+'\',\''+status+'\');".'"'."".'"'." ><i class=".'"'."fa fa-users fa-fw".'"'."></i> Submit</a>';";
// $var.="                               }else{";
// $var.="                                return ' ';";
// $var.="                               }";
// $var.="                            }";
// $var.="            },       ";
$var.='            {data:"NAME",name:"NAME"},            ';
$var.='            {data:"Handphone",name:"Handphone"},';
$var.='            {data:"Email",name:"Email"},';

// $var.='            {data:"nup_no",name:"nup_no", render: function(data, type, row){';
// $var.="                var stat = row.STATUS;";
// $var.="                if(stat=='A') {";
// $var.="        aa = '<a class=".'"'."btn btn-primary btn-sm".'"'." onclick=".'"'."showUp(\''+data+'\');".'"'." >'+data+'</a>';";
// $var.="                } else {";
// $var.="                    aa = data;";
// $var.="                } ";
// $var.="                return aa;";
// $var.="            }},";
$var.='            {data:"nup_no",name:"nup_no"},';
$var.='            {data:"lot_no",name:"lot_no"},';
$var.='            {data:"nup_counter",name:"nup_counter"},';
$var.="            {";
$var.='                data:"reserve_date",name:"reserve_date",';
$var.="                render: function (data, type, row) {";

$var.="                                var date = new Date(parseInt(data.substr(0,10)));";
$var.="                                var year =data.substr(0,4);";
$var.="                                var month=data.substr(5,2);";
$var.="                                var day =data.substr(8,2);";
                               
$var.='                               var aa = day+"/"+month+"/"+year;';
$var.="                                return aa;";
                             

$var.="                           }";
$var.="            },    ";
$var.='            {data:"status_desc",name:"status_desc",';
$var.="                render: function(data, type, row){";
$var.="                    var stat = row.STATUS;";
$var.="                    var old_status = row.old_status_desc;";
$var.="                    if(stat == 'S'){";
$var.="                      status_merge = data + old_status;";
$var.="                    }else{";
$var.="                        status_merge = data;";
$var.="                    }";
$var.="                    return status_merge;";
$var.="                }";
$var.="            },            ";
$var.='            {data:"columdef",name:"columdef"},';
$var.='            {data:"business_id",name:"business_id",visible:false},';
$var.='            {data:"nup_sequence_no",name:"nup_sequence_no",visible:false},';
$var.='            {data:"STATUS",name:"STATUS",visible:false},';
$var.='            {data:"rowID",name:"rowID",visible:false}';
            
$var.="            ],";
$var.='"columnDefs": [ {className: "control",orderable: false,targets:   9} ]';
            
$var.="    });";

 $var.='$("div.toolbar'.$row->product_cd.'").html('."'".'<b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search'.$row->product_cd.'"  name="txt_search'.$row->product_cd.'" > <a class="btn blue-bg btn-sm" onclick="fn_search'.$row->product_cd.'()"><i class="fa fa-search"></i></a> </b>'."'".');';
   
$var.='     $("#txt_search'.$row->product_cd.'").keyup(function(event){';
$var.="        var a = $('#txt_search".$row->product_cd."').val();";
$var.="        if(a==''){";
$var.="            tblapprove".$row->product_cd.".ajax.reload(null,true);   ";
$var.="        }";

$var.="        if(event.keyCode == 13){";
            // $("#id_of_button").click();
            
$var.="            tblapprove".$row->product_cd.".ajax.reload(null,true);   ";
$var.="        }";
        
$var.="    });";

$var.="    $('#button').click( function () {";
$var.="        var data = tblapprove".$row->product_cd.".rows('.selected').data();";
$var.="        for (var i = data.length - 1; i >= 0; i--) {";
$var.="            data[i];";
$var.="            alert(data[0].row_number);";
$var.='        };';
    
$var.='    } );';

$var.="    $('#tblapprove".$row->product_cd." tbody').on( 'click', 'tr.group', function () {";
$var.="        var currentOrder = tblapprove".$row->product_cd.".order()[0];";
$var.="        if ( currentOrder[0] === 6 && currentOrder[1] === 'asc' ) {";
$var.="            tblapprove".$row->product_cd.".order( [ 6, 'desc' ] ).draw();";
$var.='        }';
$var.="        else {";
$var.="            tblapprove".$row->product_cd.".order( [ 6, 'asc' ] ).draw();";
$var.='        }';
$var.='    } );';


echo $var;
    
}
?>
//end looping

 
});
//end doc function   
<?php
foreach ($product as $key ) {
    $var ="function fn_search".$row->product_cd."(){";
    $var.="var a = $('#txt_search".$row->product_cd."').val();";
    $var.="tblapprove".$row->product_cd.".ajax.reload(null,true); ";
    $var.="}";

    echo $var;
}
?>

function klikcubmit(data,seq_no,status_nup)

     {
        var id = data;

                            var rows = tblapprove.rows('.selected').indexes();
                       
                       var site_url = '<?php echo base_url("c_nup_cfld/check_attachment")?>';
                            $.post(site_url,
                                 {seqno:seq_no,from:'out'},
                             function(data,status) 

                        {
                            // console.log(data);
                            
                                // hasil = data;
                                // BootstrapDialog.alert(data);
                                if(data!='OK'){                                
                                swal("Information",'Please Complete NUP attachment ',"warning");
                                return;
                                }
                                else
                        {
                               
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

                                    $('div.modal-body').html('Are you sure want to Submit this NUP?');

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

                                    $('#modal').data('id', id).modal('show');
                                    $('#modal').data('status', status_nup);
                                    $('#modal').data('seq_no', seq_no);
                            }
                                
                            });
                    

}
function cek_attach(seqno,hasil){
    var ab='';

    $.ajax({
        url :"<?php echo base_url("c_nup_cfld/check_attachment")?>",
        type:"POST",
                    // data:$('#form_rl_sales').serialize(),
        data: { seqno:seqno,from:'out' },
        dataType:"json",
        success:function(event, data){            
            swal("Information",event.Pesan,"warning");
            ab = event.Pesan;
            // console.log(event);
        // console.log('12 '+ab);
    return ab;
        },                    
        error: function(jqXHR, textStatus, errorThrown){                             
        }
    });
    
    

}
    // function Delete() {

    //     var id = $('#modal').data('id');
    //     var seqno = $('#modal').data('seqno');
    //     var business_id = $('#modal').data('business_id');
        
    //      $.ajax({
    //                 url : "<?php echo base_url('c_nup/Delete');?>",
    //                 type:"POST",
    //                 // data:$('#form_rl_sales').serialize(),
    //                 data: { id: id,seqno:seqno,business_id:business_id },
    //                 dataType:"json",
    //                 success:function(event, data){                        
    //                     swal("Information",event.Pesan,"success");                        
    //                     $('#modal').modal('hide');
    //                     tblapprove.ajax.reload(null,true); 
    //                 },                    
    //                 error: function(jqXHR, textStatus, errorThrown){
    //                   // delete_gagal();                     
    //                  swal("Information",textStatus+' Save : '+errorThrown,"warning");
                     
    //                 }
    //                 });       

    // }
  
    function invitation(){
        var id = $('#modal').data('id');
        $.ajax({
            url: "<?php echo base_url('c_nup_cfld/sendInvitation')?>",
            type: "POST",
            data: {rid: id},
            dataType: "json",
            success: function(data, status){                
                swal("Information",data.pesan,"warning");
                $('#modal').modal('hide');
                tblapprove.ajax.reload(null,true); 
            },
            error: function(jqXHR, textStatus, errorThrown){                
                swal("Information",textStatus+' Send : '+errorThrown,"warning");
            }
        });
    }   


</script>
<style type="text/css">
    .font-color{
        color: #667;
    }
</style>

<!-- INI UNTUK DATA APPROVE  -->

 
<!-- <script src="<?=base_url('choosen/jquery.min.js')?>" type="text/javascript"></script> -->
 
<!-- <link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />  -->

<script type="text/javascript">
//End choosen properties      
// var config = {
//         '.chosen-select'           : {},
//         '.chosen-select-deselect'  : {allow_single_deselect:true},
//         '.chosen-select-no-single' : {disable_search_threshold:10},
//         '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
//         '.chosen-select-width'     : {width:"95%"}
//       }
//       for (var selector in config) {
//         $(selector).chosen(config[selector]);
//       }
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