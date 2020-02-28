<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>



 <style type="text/css">
  #load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    /*background:url("../img/loading.gif") no-repeat center center*/
    background:url("<?=base_url('img/loading.gif') ?>") no-repeat center center
}
</style>

<script type="text/javascript">
window.history.forward();
var project;
var x = '<?php echo $kondisi;?>';

var tblnup;
$(function(){


   tblnup = $('#tblnup').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter:false,
            "order": [[ 11, "desc" ]],
            // searchDelay:null,
            buttons: [
//                 {
//                     text: ' Add', className: "bg-orange fa fa-plus "+x, action: function (e) {

//                         var status='I';
//                         var site_url = '<?php echo base_url("c_nup/insert")?>';
                         
//                        var url = '<?php echo base_url("c_nup/cek_agent")?>';
//                         $.post(url,
//                           {status:status},
//                           function(data,status) {
//                             // console.log(data);
//                             if(data ==0){
//                                 BootstrapDialog.alert('Only Agent can Entry NUP');
//                                 return false;
//                             }
//                             window.location.href= site_url+"/N";
//                           // if(data=='FAIL'){

//                           // }
//                           }
//                         );
                        
//                         // var modalClass = $('#modal').attr('class');
//                         // switch (modalClass) {
//                         //     case "modal fade bs-example-modal-md":
//                         //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                         //         break;
//                         //     case "modal fade bs-example-modal-sm":
//                         //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                         //         break;
//                         //     default:
//                         //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                         //         break;
//                         // }

//                         // var modalDialogClass = $('#modalDialog').attr('class');
//                         // switch (modalDialogClass) {
//                         //     case "modal-dialog modal-md":
//                         //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                         //         break;
//                         //     case "modal-dialog modal-sm":
//                         //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                         //         break;
//                         //     default:
//                         //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                         //         break;
//                         // }

//                         // $('#modalTitle').html('Add NUP');
//                         // $('div.modal-body').load("<?php echo base_url("c_nup/goto_form");?>");
                        
//                         // $('#modal').data('id', 0).modal('show');


//                     }
//                 },
//                 {
//                     text: ' Edit/Revise', className: 'bg-orange fa fa-pencil',
//                     action: function () {
                      
//                         var rows = tblnup.rows('.selected').indexes();
//                         if (rows.length < 1) {
//                             BootstrapDialog.alert('Please select a row');
//                             return;
//                         }

//                         var data = tblnup.rows(rows).data();
//                         var status = data[0].STATUS;
//                         var ID = data[0].rowID;                        
                        
//                         var st= new Array('A','N','P','V','R');
                        
//                         if((st.indexOf(status)) < 0 ){
//                             BootstrapDialog.alert('Only Status New, Approved, Pending ');
//                             return;
//                         }
// // BootstrapDialog.alert(ID);
// // BootstrapDialog.alert(status);
//                         var site_url = '<?php echo base_url("c_nup/edit_rev")?>'+'/'+status+'/'+ID;
               
                        
//                         window.location.href= site_url;
//                         // var modalClass = $('#modal').attr('class');
//                         // switch (modalClass) {
//                         //     case "modal fade bs-example-modal-md":
//                         //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                         //         break;
//                         //     case "modal fade bs-example-modal-sm":
//                         //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                         //         break;
//                         //     default:
//                         //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                         //         break;
//                         // }

//                         // var modalDialogClass = $('#modalDialog').attr('class');
//                         // switch (modalDialogClass) {
//                         //     case "modal-dialog modal-md":
//                         //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                         //         break;
//                         //     case "modal-dialog modal-sm":
//                         //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                         //         break;
//                         //     default:
//                         //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                         //         break;
//                         // }

//                         // $('#modalTitle').html('Edit Newsfeed');

//                         // $('div.modal-body').load("<?php echo base_url("c_newsfeed/addnew");?>"+"/"+$('#txt_Pl_Project').val());

//                         // $('#modal').data('id', ID).modal('show');

//                     }
//                 },
//                 {
//                     text: ' Delete', className: "bg-orange fa fa-trash",
//                     action: function () {
                      
//                         var rows = tblnup.rows('.selected').indexes();
//                         if (rows.length < 1) {
//                             BootstrapDialog.alert('Please select a row');
//                             return;
//                         }

//                         var data = tblnup.rows(rows).data();
//                         var UserID = data[0].rowID;
//                         var status = data[0].STATUS;
//                         var seqno = data[0].nup_sequence_no;
//                         var business_id = data[0].business_id;
                        
//                         if(status !='I'){
//                             BootstrapDialog.alert('Only Status NEW Can Delete');
//                             return;
//                         }


//                         var modalClass = $('#modal').attr('class');
//                         switch (modalClass) {
//                             case "modal fade bs-example-modal-lg":
//                                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                                 break;
//                             case "modal fade bs-example-modal-md":
//                                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                                 break;
//                             default:
//                                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                                 break;
//                         }

//                         var modalDialogClass = $('#modalDialog').attr('class');
//                         switch (modalDialogClass) {
//                             case "modal-dialog modal-lg":
//                                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                                 break;
//                             case "modal-dialog modal-md":
//                                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                                 break;
//                             default:
//                                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                                 break;
//                         }

//                         $('#modalTitle').html('Delete NUP');

//                         $('div.modal-body').html('Are you sure that you want to delete this item?');

//                         $('div.modal-body').append('<div class="modal-footer"></div>');

//                         var btnYes = $('<input/>')
//                             .attr({
//                                 id: "btnYes",
//                                 type: "button",
//                                 class: "btn btn-danger",
//                                 onclick: 'Delete();',
//                                 value: 'Yes'
//                             });

//                         var btnNo = $('<a>No</a>').attr({
//                             class: "btn btn-default", 'data-dismiss': "modal"
//                         });

//                         $('div.modal-footer').append(btnYes);
//                         $('div.modal-footer').append(btnNo);

//                         $('#modal').data('id', UserID).modal('show');
//                         $('#modal').data('seqno', seqno);
//                         $('#modal').data('business_id', business_id);

//                     }
//                 }
//                 ,{
//                     text: ' Submit', className: 'btn-success fa fa-pencil-square-o', action: function (e) {
//                             var rows = tblnup.rows('.selected').indexes();
//                         if (rows.length < 1) {
//                             BootstrapDialog.alert('Please select a row');
//                             return;
//                         }

//                         var data = tblnup.rows(rows).data();
//                         var UserID = data[0].rowID;
//                         var status_nup = data[0].STATUS;
//                         var seqno = data[0].nup_sequence_no;
//                         var st= new Array('R','N','V');

//                         if((st.indexOf(status_nup)) < 0 ){
//                             BootstrapDialog.alert('Only Status New and Revised ');
//                             return;
//                         }
//                         // var status_attach = cek_attach(seqno,'');
//                         // BootstrapDialog.alert('submit '+status_attach);
//                         // if(status_attach!='OK'){
//                         //     BootstrapDialog.alert('Please Compelete NUP attachment ');
//                         //     return;
//                         // }

//                         var site_url = '<?php echo base_url("c_nup/check_attachment")?>';
//                             $.post(site_url,
//                                  {seqno:seqno,from:'out'},
//                              function(data,status) {
//                             console.log(data);
                            
//                                 // hasil = data;
//                                 // BootstrapDialog.alert(data);
//                                 if(data!='OK'){
//                                 BootstrapDialog.alert('Please Complete NUP attachment ');
//                                 return;
//                                 }else{
                               
//                                     var modalClass = $('#modal').attr('class');
//                                     switch (modalClass) {
//                                         case "modal fade bs-example-modal-lg":
//                                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                                             break;
//                                         case "modal fade bs-example-modal-md":
//                                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                                             break;
//                                         default:
//                                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                                             break;
//                                     }

//                                     var modalDialogClass = $('#modalDialog').attr('class');
//                                     switch (modalDialogClass) {
//                                         case "modal-dialog modal-lg":
//                                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                                             break;
//                                         case "modal-dialog modal-md":
//                                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                                             break;
//                                         default:
//                                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                                             break;
//                                     }

//                                     $('#modalTitle').html('Submit NUP');

//                                     $('div.modal-body').html('Are you sure you want Submit this NUP?');

//                                     $('div.modal-body').append('<div class="modal-footer"></div>');

//                                     var btnYes = $('<input/>')
//                                         .attr({
//                                             id: "btnYes",
//                                             type: "button",
//                                             class: "btn btn-danger",
//                                             onclick: 'Submit();',
//                                             value: 'Yes'
//                                         });

//                                     var btnNo = $('<a>No</a>').attr({
//                                         class: "btn btn-default", 'data-dismiss': "modal"
//                                     });

//                                     $('div.modal-footer').append(btnYes);
//                                     $('div.modal-footer').append(btnNo);

//                                     $('#modal').data('id', UserID).modal('show');
//                                     $('#modal').data('status', status_nup);
//                                     $('#modal').data('seqno', seqno);
//                                      }
                                
//                             });
//                     }
//                 },


                // {                 

                //     text: ' Unit', className: 'btn biru-bg fa fa-pencil',
                //     action: function () {
                      
                //         var rows = tblnup.rows('.selected').indexes();
                //         if (rows.length < 1) {
                //             swal("Information", "Please select a row", "warning")
                //             return;
                //         }

                //         var data = tblnup.rows(rows).data();
                //         var a = data[0].nup_no;
                //         var status = data[0].STATUS;
                //         var _rowid = data[0].rowID;
                        
                        
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
                //             // var site_url = '<?php echo base_url("c_nup_dt/list_dt")?>'+'/'+a+'/1';
                //             var site_url = '<?php echo base_url("c_nup_dt/list_dtNew")?>'+'/'+a+'/1'+'/'+_rowid+'/'+status;
                        
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
                    text: ' Back ', className: 'btn biru-bg fa fa-arrow-left', action: function (e) {
                        var project = "<?php echo $project_no?>";
                        var projectName = "<?php echo $ProjectDescs; ?>";
                        var encParam ="<?php echo $encParam ?>";
                        // BootstrapDialog.alert(projectName);
                         // window.location.href="<?php echo base_url('newsfeed/index');?>"+'/'+project+'-'+projectName;
                         window.location.href="<?php echo base_url('newsfeed/index');?>"+'/'+encParam;
                    }
                }
                // ,
                // {
                // extend: 'collection',
                // className: 'btn biru-bg fa fa-star buttons-html5',
                // text: ' Action',
                // buttons: [
                //     // 'copy',
                //     'excel',
                //     'csv',
                //     'pdf',
                //     // 'print'
                //             ]           
                // }
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_choose_unit_nup/getTable');?>",  
            "data":{"sSearch": function(d){
                var a = $('#txt_search').val();
                // console.log(a);
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
            {data: "row_number",name:"row_number",searchable:false,orderable:false } ,
            {
              // data: "rowID", name: "rowID", visible: false
              data: "rowID", name: "rowID",
                            render: function (data, type, row) {
                                var status = row.STATUS;
                                var a = row.nup_no;
                                var cus=row.choose_unit_status;
                                var pcd=row.product_cd;
                                var _rowid = row.rowID;
                                // var site_url = '<?php echo base_url("c_nup_dt/list_dtNew")?>'+'/'+a+'/1'+'/'+_rowid+'/'+status;

                                
                                return  '<a class="btn btn-success btn-sm" onclick="unitsteps(\''+a+'\',\''+_rowid+'\',\''+status+'\',\''+cus+'\',\''+pcd+'\');"><i class="fa fa-pencil fa-fw"></i> Unit</a>';
                           
                        }
           
            }, 
            {data:"choose_unit_status",name:"choose_unit_status",
                            render: function (data, type, row) {
                              if(data=='Y'){
                                return '<button class="btn btn-info btn-rounded btn-outline" type="button"  >&nbsp;&nbsp;<i class="fa fa-check" ></i>&nbsp;&nbsp;</button>';
                              } else {
                                return '<button class="btn btn-danger btn-rounded btn-outline" type="button" width="100px">&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;&nbsp;</button>';
                              }
                           
                        }
            },           
            {data:"NAME",name:"NAME"},            
            {data:"Handphone",name:"Handphone"},
            {data:"Email",name:"Email"},
            {data:"nup_no",name:"nup_no"},
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
            {data:"product_descs",name:"product_descs"}, 
            // {data:"status_desc",name:"status_desc"},             
            {data:"descs",name:"descs"},
            {data:"business_id",name:"business_id",visible:false},
            {data:"nup_sequence_no",name:"nup_sequence_no",visible:false},
            {data:"STATUS",name:"STATUS",visible:false},
            {data:"rowID",name:"rowID",visible:false}
            
            ]
    });
    $("div.toolbar").html('<b>Search : <input type="text" class="form-control" style="width: 150px;" id="txt_search"  name="txt_search" > <a class="btn btn-success btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a> </b>');

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
});
function fn_search(){
    var a = $('#txt_search').val();
    tblnup.ajax.reload(null,true); 
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
        url :"<?php echo base_url("c_nup/check_attachment")?>",
        type:"POST",
                    // data:$('#form_rl_sales').serialize(),
        data: { seqno:seqno,from:'out' },
        dataType:"json",
        success:function(event, data){
            BootstrapDialog.alert(event.pesan);
            ab = event.Pesan;
            // console.log(event);
        // console.log('12 '+ab);
    return ab;
        },                    
        error: function(jqXHR, textStatus, errorThrown){                             
        }
    });
    
    

}
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
                        BootstrapDialog.alert(event.Pesan);
                        
                        $('#modal').modal('hide');
                        tblnup.ajax.reload(null,true); 
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                      // delete_gagal();
                     BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                     
                    }
                    });
        // $('[data-id=' + id + ']').remove();

        // $('#modal').modal('hide');

        // tblnup.ajax.reload(null, false);

    }
    function Submit(){
          var id = $('#modal').data('id');
        var status = $('#modal').data('status');
        
        document.getElementById('load').hidden=false;
        
         $.ajax({
                    url : "<?php echo base_url('c_nup/SubmitStatus');?>",
                    type:"POST",
                    data: { id: id,status:status},
                    dataType:"json",
                    success:function(event, data){
                        BootstrapDialog.alert(event.Pesan);
                        document.getElementById('load').hidden=true;
                        $('#modal').modal('hide');
                        tblnup.ajax.reload(null,true); 
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                      // delete_gagal();
                     BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                     
                    }
                    });
    }
    function unitsteps(a, _rowid, stat, cus,product_cd){
        var procd='<?php echo $property_cd?>';
        var rowhd='';
        var balance='';var site_url='';
        var cuss='N';
        if (cus==''||cus==null){
            cus=='N';
        }
        if(a == ' '){
            swal('Warning','Only Status Approved can choose Unit','warning');
        }else if(stat != 'A'){
            swal('Warning','Only Status Approved can choose Unit','warning');
        }else{
            var site_url = '<?php echo base_url("c_choose_unit_nup/getdataHD")?>';
                $.post(site_url,
                    {nupno:a},
                    function(data,status) {
                        console.log(data);
            
                    if(product_cd=='APT'){
                        if(cus=='Y') {
                                site_url = '<?php echo base_url("c_nup_dt/list_dtNew")?>'+'/'+a+'/1'+'/'+_rowid+'/'+stat;
                                
                            } else {
                                site_url = '<?php echo base_url("c_nup_unit/index")?>'+'/'+data.RowHD+'/'+data.balance+'/'+a+'/';
                                    
                            }
                       
                    }
            // alert(cus);
            // console.log(cus);
            // return;
                        if(product_cd=='LND'){
                            // if(cus=='Y') {
                            if(cus=='Y') {
                                site_url = '<?php echo base_url("c_nup_dt/list_dtNew")?>'+'/'+a+'/1'+'/'+_rowid+'/'+stat;
                                
                            } else {
                                site_url = '<?php echo base_url("c_nup_landed/indextipe")?>'+'/'+a+'/'+procd+'/'+_rowid+'/'+stat+'/'+data.balance+'/'+data.RowHD+'/';
                                    
                                    // kurang balance sama rowid hd
                            }
                                
                        }
                    console.log(site_url);
                    window.location.href = site_url; 
                },
          'json'
          ); //tutup getdataHD
            }//kondisi
    }
    function invitation(){
        var id = $('#modal').data('id');
        $.ajax({
            url: "<?php echo base_url('c_nup/sendInvitation')?>",
            type: "POST",
            data: {rid: id},
            dataType: "json",
            success: function(data, status){
                BootstrapDialog.alert(data.pesan);
                $('#modal').modal('hide');
                tblnup.ajax.reload(null,true); 
            },
            error: function(jqXHR, textStatus, errorThrown){
                BootstrapDialog.alert(textStatus+' Send : '+errorThrown);
            }
        });
    }
</script>
<div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
    <div class="form-group">        
        <div class="tittle-top pull-left"><b><?php echo $ProjectDescs; ?></b></div>
        <div class="tittle-top pull-right"><b>NUP</b></div>
    </div>
    </section><br>
    <div id="load" hidden="true"></div>
    <section class="content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tblnup" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                            <thead>    
                                <th>No</th>
                                <th>Action</th>
                                <th width="20px">Choose Unit Status</th>                                     
                                <th>Name</th>                                
                                <th>Handphone</th>
                                <th>Email</th>
                                <th>NUP. No</th>
                                <th>Reserve Date</th>
                                <th>Product</th>
                                <th>Type</th>                
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
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