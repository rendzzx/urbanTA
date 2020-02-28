
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>


<style type="text/css">
    #loader{
        width:80%;
        height:100%;
        position:fixed;
        left: 9%;
        top: 1%;
        z-index: 99999;
        background:url("../img/loading.gif") no-repeat center center     
    }
    /*div.dataTables_wrapper 
    div.dataTables_filter {
        text-align: right;
        float: right;
        padding-bottom: 5px;
    }*/
</style>


<div id="loader" class="loader" hidden="true"></div>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before" style="height: 150px !Important"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <br><br>
                <h3 class="content-header-title">Menu Entry</h3>
            </div>

            <div class="content-header-right col-md-8 col-12 mb-2">
              <br>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h4 class="card-title">Menu Entry</h4> -->
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table id="tblnewsfeed" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                        <thead>            
                                            <th class="sorting_asc">No.</th>
                                            <th>MenuID</th>
                                            <th>Title</th>
                                            <th>URL</th>
                                            <th>Parent Menu ID</th>
                                            <th>Sequence No</th>
                                            <th>Icon Class</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

      <script type="text/javascript">

        function block(boelan){
          var block_ele = $('#frmEditor')
          if (boelan==true) {
            $(block_ele).block({
              message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
              fadeIn: 1000,
              fadeOut: 1000,
              overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: '10px 15px',
                color: '#fff',
                width: 'auto',
                backgroundColor: '#333',
                marginLeft : 'auto'
            }
        });
        }
        else{
            $(block_ele).unblock()
        }
    }
    //GET DATA TABLE
    var tblnewsfeed; 
    var tblnewsfeed = $('#tblnewsfeed').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_menu/getTable');?>",
            "type": "POST"
        },
        "columns": [
        { data: "row_number", width:'1px', searchable:false,
        render: function (data, type, row) {
            var row_number = row.row_number
            return row_number + '.'
        }
    },
    {data:"MenuID" },
    {data:"Title" },
    {data:"URL"},
    {data:"ParentMenuID"},
    {data:"OrderSeq"},
    {data:"IconClass"},
            // {data:"columdef"},

            ],
        // "columnDefs": [ {
        //             className: 'control',
        //             orderable: false,
        //             targets:   8
        //         } ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar newsfeed">frtip',
        "responsive": {
            details: {
                type: 'column',
                target: 8
            }
        }
    });

// ADDING BUTTON
$("div.newsfeed").html(
    '<button id="addnewsfeed" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
    '<button id="editnewsfeed" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'
);


// SELECT ROW
tblnewsfeed.on('click', 'tr', function() {
    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
    } else {

        tblnewsfeed.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
    }
});


$('#addnewsfeed').click(function(){
    // var site_url = '<?php echo base_url("c_menu/addnew/")?>'+0;
    // window.location.href= site_url;
    $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
    $('#modaltitle').addClass('white');
    $('#modaltitle').html('Menu Entry');
    $('#modalbody').load("<?php echo base_url("c_menu/addnew");?>");
        // #('#modalfooter').html('eeeeeeeee');
        $('#modal').data('menuID', 0);
        $('#modal').modal('show');

    })


$('#editnewsfeed').click(function(){
    var rows = tblnewsfeed.rows('.selected').indexes();
    if (rows.length < 1) {
        swal("Information",'Please select a row',"warning");
        return;
    } 
    var data = tblnewsfeed.rows(rows).data();
    var menuID = data[0].MenuID;

    var site_url = '<?php echo base_url("c_menu/addnew/")?>'+menuID;
    // window.location.href= site_url;    

    $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
    $('#modaltitle').addClass('white');
    $('#modaltitle').html('Menu Edit');
    $('#modalbody').load(site_url);

    $('#modal').data('menuID', menuID);
    $('#modal').modal('show');
})
$("#frmEditor").validate({
    rules: {
        txtTitle: {
            required: true
        },
        txtIconClass:{
            required:true
        },
        txtOrderSeq:{
            required:true,
            number:true
        }
    },
    errorElement: "span",
    highlight: function (element, errorClass, validClass) {
            $(element).addClass(errorClass); //.removeClass(errorClass);
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass(errorClass); //.addClass(validClass);
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorPlacement: function (error, element) {
          if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
            error.insertAfter(element.next('span'));
        } else {
            error.insertAfter(element);
        }
    }
});


$('#savefrm').click(function(){


        if ($('#frmEditor').valid()) {
         // document.getElementById('loader').hidden=false;
         block(true);
         var id = $('#modal').data('rowID');
         var datafrm = $('#frmEditor').serializeArray();
         $.ajax({
            url : "<?php echo base_url('c_menu/save_menu');?>",
            type:"POST",
            data: datafrm,
            dataType:"json",
            success:function(event, data){
                if (event.ststus == 'NO') {
                    swal({
                        title: "Information",
                        animation: false,
                        type:"success",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                    $('#modal').modal('hide');
                    tblnewsfeed.ajax.reload(null,true);
                }else{
                    swal({
                        title: "Success",
                        animation: false,
                        type:"success",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                     $('#modal').modal('hide');
                    tblnewsfeed.ajax.reload(null,true);
                }
            },error: function(jqXHR, textStatus, errorThrown){
              swal({
                title: "Error",
                animation: false,
                type:"error",
                text: textStatus+' Save : '+errorThrown,
                confirmButtonText: "OK"
            });
              document.getElementById('loader').hidden=true;
          }
      })
     }
 
})


//             var tblnewsfeed;
//             $(function(){
//              tblnewsfeed = $('#tblnewsfeed').DataTable( 
//              {
//                dom: '<"toolbar dataTables_filter">Bfrtip',
//             // responsive: true,
//             responsive: {
//                 details: {
//                     type: 'column',
//                     target: 6
//                 }
//             },
//             select: true,
//             filter: false,
//             buttons: [
//             {
//                 text: ' Add', className: 'biru-bg fa fa-plus ', action: function (e) {
//                     var modalClass = $('#modal').attr('class');
//                     switch (modalClass) {
//                         case "modal fade bs-example-modal-md":
//                         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                         break;
//                         case "modal fade bs-example-modal-sm":
//                         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                         break;
//                         default:
//                         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                         break;
//                     }

//                     var modalDialogClass = $('#modalDialog').attr('class');
//                     switch (modalDialogClass) {
//                         case "modal-dialog modal-md":
//                         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                         break;
//                         case "modal-dialog modal-sm":
//                         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                         break;
//                         default:
//                         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                         break;
//                     }

//                     $('#modalTitle').html('Add Menu');
//                     $('div.modal-body').load("<?php echo base_url("c_menu/addnew");?>");
//                     $('#modal').data('MenuID', 0).modal('show');
//                 }
//             },
//             {
//                 text: ' Edit', className: 'biru-bg fa fa-pencil',
//                 action: function () {                       
//                     var rows = tblnewsfeed.rows('.selected').indexes();
//                     if (rows.length < 1) {
//                         swal("Information",'Please select a row',"warning");
//                         return;
//                     }              

//                     var data = tblnewsfeed.rows(rows).data();
//                     var MenuID = data[0].MenuID;
//                         // alert(MenuID);


//                         var modalClass = $('#modal').attr('class');
//                         switch (modalClass) {
//                             case "modal fade bs-example-modal-md":
//                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                             break;
//                             case "modal fade bs-example-modal-sm":
//                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                             break;
//                             default:
//                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                             break;
//                         }

//                         var modalDialogClass = $('#modalDialog').attr('class');
//                         switch (modalDialogClass) {
//                             case "modal-dialog modal-md":
//                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                             break;
//                             case "modal-dialog modal-sm":
//                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                             break;
//                             default:
//                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                             break;
//                         }

//                         $('#modalTitle').html('Edit Menu');


//                         $('div.modal-body').load("<?php echo base_url("c_menu/addnew");?>");

//                         $('#modal').data('MenuID', MenuID);

//                         $('#modal').modal('show');

//                     }
//                 },
//                 {
//                     text: ' Delete', className: 'biru-bg fa fa-trash', enabled: false,
//                     action: function () {

//                         var rows = tblnewsfeed.rows('.selected').indexes();
//                         if (rows.length < 1) {
//                             swal("Information",'Please select a row',"warning");
//                             return;
//                         }

//                         var data = tblnewsfeed.rows(rows).data();
//                         var MenuID = data[0].MenuID;



//                         var modalClass = $('#modal').attr('class');
//                         switch (modalClass) {
//                             case "modal fade bs-example-modal-lg":
//                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                             break;
//                             case "modal fade bs-example-modal-md":
//                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                             break;
//                             default:
//                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                             break;
//                         }

//                         var modalDialogClass = $('#modalDialog').attr('class');
//                         switch (modalDialogClass) {
//                             case "modal-dialog modal-lg":
//                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                             break;
//                             case "modal-dialog modal-md":
//                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                             break;
//                             default:
//                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                             break;
//                         }

//                         $('#modalTitle').html('Delete Newsfeed');

//                         $('div.modal-body').html('Are you sure that you want to delete this item?');

//                         $('div.modal-body').append('<div class="modal-footer"></div>');

//                         var btnYes = $('<input/>')
//                         .attr({
//                             id: "btnYes",
//                             type: "button",
//                             class: "btn btn-danger",
//                             onclick: 'Delete();',
//                             value: 'Yes'
//                         });

//                         var btnNo = $('<a>No</a>').attr({
//                             class: "btn btn-default", 'data-dismiss': "modal"
//                         });

//                         $('div.modal-footer').append(btnYes);
//                         $('div.modal-footer').append(btnNo);

//                         $('#modal').data('MenuID', MenuID).modal('show');

//                     }
//                 }                    
//                 ],
//                 "processing": false,
//                 "serverSide": true,
//                 "ajax":{
//                     "url":"<?php echo base_url('c_menu/getTable');?>",
//                     "data":{"sSearch": function(d){
//                         var search = $('#txt_search').val();
//                         var b="";
//                         if(search == null || search==""){
//                             return b;
//                         }{
//                             return search;
//                         }
//                     }},             
//                     "type":"POST"
//                 },
//                 "columns": [
//                 {data: "row_number",name:"row_number", searchable:false},
//                 {data:"Title",name:"Title", sortable: false},
//                 {data:"URL",name:"URL"},
//                 {data:"ParentMenuID",name:"ParentMenuID", sortable: true},
//                 {data:"OrderSeq",name:"OrderSeq", sortable: true},
//                 {data:"IconClass",name:"IconClass", sortable: true},
//                 {data:"columdef",name:"columdef"}
//             // {
//             //     data:"status",name:"status",sortable: true, searchable:false,
//             //     render:function (data,type,row) {
//             //         if(data==1){
//             //             return 'Active';
//             //         }else{
//             //             return 'Absolute';
//             //         }
//             //     }
//             // }
//             ],
//             "columnDefs": [ {
//                 className: 'control',
//                 orderable: false,
//                 targets:   6
//             } ]
//         });
//     // $("div.toolbar").html('<b>Search :<div class="input-group"><div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >&nbsp;<a class="btn blue-bg btn-sm" onclick="fn_search()" style=" width: auto;"><i class="fa fa-search"></i></a> </div></div></b>&nbsp;');
//     $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');
//     $("#txt_search").keyup(function(event){

//         var a = $('#txt_search').val();

//         if(a==''){
//             tblnewsfeed.ajax.reload(null,true);   
//         }
//         if(event.keyCode == 13){

//             tblnewsfeed.ajax.reload(null,true);   
//         }
//     });

// });

// function fn_search(){
//     // alert('a');

//     // var project = $('#txt_Pl_Project').val();
//     var txt_search = $('#txt_search').val();
//     if(txt_search!=''){
//         document.getElementById('loader').hidden=false;
//         var state = document.readyState
//         if (state == 'complete') {
//             setTimeout(function(){
//                 document.getElementById('interactive');
//                 tblnewsfeed.ajax.reload(null,true); 
//                 document.getElementById('loader').hidden=true;
//             },1000);
//         }        

//     }
// }

// function Delete() {
//     var MenuID = $('#modal').data('MenuID');
//     // alert(MenuID);
//     $.ajax({
//         url : "<?php echo base_url('c_menu/Delete');?>",
//         type:"POST",
//         data: { MenuID: MenuID },
//         dataType:"json",
//         success:function(event, data){
//                 // BootstrapDialog.alert(event.Pesan);
//                 swal("Information",event.Pesan,"warning");
//                 $('#modal').modal('hide');
//                 tblnewsfeed.ajax.reload(null,true); 
//             },                    
//             error: function(jqXHR, textStatus, errorThrown){        
//                 // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
//                 swal("Information",textStatus+' Save : '+errorThrown,"warning");

//             }
//         });
// }

</script>
