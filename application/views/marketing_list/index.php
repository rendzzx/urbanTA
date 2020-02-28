<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">


<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <h3 class="content-header-title"><?php echo $ProjectDescs; ?></h3>
        <h4 class="content-header-title"><?php echo $OfficeName;?> - Executive Marketing List</h4>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      </div>
    </div>
    <div id="loader" class="loader" hidden="true"></div>
    <div class="content-body"> 
      <div class="row">      
        <div class="col-lg-12">
           <div class="card">
              <div class="card-header">
                <div class="card-content">
                  <div class="table-responsive">
                        <table id="tblmarketing" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                <thead>    
                                    <th>No</th>                               
                                    <th>Agent Name</th>
                                    <th>ID No.</th>
                                    <th>NPWP</th>
                                    <th>Home Address</th>
                                    <th>City</th>
                                    <th>Email Address</th>
                                    <th>Mobile 1</th>
                                    <th>Mobile 2</th>       
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

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/jquery-1.12.3.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>


<!-- Bootstrap Modal -->
<!--     <div id="modal" class="modal fade" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">

        <div class="modal-content"> -->
            <!-- Modal Header -->
        <!--     <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
            </div> -->

            <!-- Modal Body -->
  <!--           <div class="modal-body">
            </div>
        </div>

    </div>
	</div> -->

<!--  <div id="modal" class="modal hide fade" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h3 id="myModalLabel">Panel</h3>
    </div>
    <div class="modal-body" style="max-height: 800px">
    </div>
  </div> -->
	<!-- Bootstrap Modal -->


<script type="text/javascript">

var tblmarketing = $('#tblmarketing').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_marketing_list/getTable');?>",
            "type": "POST"
        },
        lengthMenu: [[25, 50,100, -1], [25, 50,100, "All"]],
        "pageLength": -1,
    //     buttons:[
    //     'excelHtml5',
    //  ],
        buttons: [

        {
        extend: 'collection',
        className: 'btn  fa fa-star pull-right',
        text: ' Download',
        buttons: [
        
            {
                    extend: "csv",
                    text: "CSV",
                    exportOptions: {
                        modifier: {
                            search: 'applied',
                            order: 'applied',

                        },
                        columns: [ 0,9,1,10,11,17,6,2,3,4,5,12,13,7,14,15,16],
                        format: {
                            header: function ( data, row, column ) {
                               
                                    if(row==9){
                                        return 'Agent Code';
                                    }else if(row==10){
                                        return 'Agent Type';
                                    }else if(row==11){
                                        return 'Principal Code';
                                    }else if(row==12){
                                        return 'Province';
                                    }else if(row==13){
                                        return 'Post Code';
                                    }else if(row==14){
                                        return 'Transfer Bank Name';
                                    } else if(row==15){
                                        return 'Transfer Account No';
                                    } else if(row==16){
                                        return 'Status';
                                    } else if(row==7) {
                                        return 'Handphone';
                                    } else if(row==17) {
                                        return 'Principal Name';
                                    } else {
                                        return data;
                                    }
                            }
                        }
                    }

                    
            },
            // {
            //         extend: "pdf",
            //         text: "PDF",
            //         exportOptions: {
            //             modifier: {
            //                 search: 'applied',
            //                 order: 'applied'
            //             },
            //                 columns: [ 0,1,2,3,4,5,6,7]
            //         }

                    
            // }
            // ,
            // {
            //       extend: "print",
            //       text: "Print",
            //       exportOptions: {
            //             modifier: {
            //                 search: 'applied',
            //                 order: 'applied'
            //             },
            //                 columns: [ 0,1,2,3,4,5,6,7]
            //         }

                    
            // }
            // 'csv',
            // 'pdf',
            // 'print'
                    ]           
        },   
        {
            text: ' Back ', className: 'btn biru-bg fa fa-arrow-left hidden', action: function (e) {
                
            }
        }
        
        ],
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"agent_name"},
            {data:"id_no"},
            {data:"npwp"},
            {data:"home_address"},
            {data:"city"},            
            {data:"email_add"},
            {data:"handphone1"},
            {data:"handphone2"},
            {data: "agent_cd", name:"agent_cd",visible: false},
            {data: "agent_type_cd", name:"agent_type_cd",visible: false},
            {data: "group_cd", name:"group_cd",visible: false},
            {data: "province", name:"province",visible: false},
            {data: "post_cd", name:"post_cd",visible: false},
            {data: "transfer_bank_name", name:"transfer_bank_name",visible: false},
            {data: "transfer_acct_no", name:"transfer_acct_no",visible: false},
            {data: "status_approval", name:"status_approval",visible: false},
            {data: "group_name", name:"group_name",visible: false},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section">Bfrtip'
    });
    

// var tblmarketing;
// $(function(){
    
//    tblmarketing = $('#tblmarketing').DataTable( 
//     {
//             dom: '<"toolbar dataTables_filter">Bfrtip',
//             // responsive: true,
//             responsive: {
//                     details: {
//                         type: 'column',
//                         target: 9
//                     }
//                 },
//             select: true,
//             filter: false,
//             paging:false,
//             // info:false,  
//             buttons: [
//             	{
//                     text: ' Edit', className: "btn biru-bg fa fa-pencil",
//                     action: function () {
                      
//                         var rows = tblmarketing.rows('.selected').indexes();
//                         if (rows.length < 1) {                            
//                             swal("Information",'Please select a row',"warning");
//                             return;
//                         }

//                         var data = tblmarketing.rows(rows).data();
//                         var rowID = data[0].rowID;
//                         var UserID  = data[0].agent_cd;
//                         // alert(UserID);
                        


//                         var modalClass = $('#modal').attr('class');
//                         switch (modalClass) {
//                           case "modal fade bs-example-modal-md":
//                               $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                               break;
//                           case "modal fade bs-example-modal-sm":
//                               $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                               break;
//                           default:
//                               $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                               break;
// 	                      }

// 	                      var modalDialogClass = $('#modalDialog').attr('class');
// 	                      switch (modalDialogClass) {
// 	                          case "modal-dialog modal-md":
// 	                              $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
// 	                              break;
// 	                          case "modal-dialog modal-sm":
// 	                              $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
// 	                              break;
// 	                          default:
// 	                              $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
// 	                              break;
// 	                      }

//                         $('#modalTitle').html('Edit Executive Marketing');

//                         $('div.modal-body').load("<?php echo base_url("c_marketing_list/edit");?>");
//                         $('#modal').data('id', UserID).modal('show');
//                         $('#modal').data('rowid', rowID);

//                     }
//                 },
//                 {
//                 extend: 'collection',
//                 className: 'btn biru-bg fa fa-star',
//                 text: ' Action',
//                 buttons: [
//                     // 'copy',
//                     'excel',
//                     'csv',
//                     'pdf',
//                     // 'print'
//                             ]           
//                 },
                
//                 {
//                     text: ' Back ', className: 'btn biru-bg fa fa-arrow-left', action: function (e) {
//                         var project = "<?php echo $project_no?>";
//                         var projectName = "<?php echo $ProjectDescs; ?>";
//                         var encParam = "<?php echo $encParam ?>";
//                         // BootstrapDialog.alert(projectName);
//                          // window.location.href="<?php echo base_url('newsfeed/index');?>"+'/'+project+'-'+projectName;
//                          window.location.href="<?php echo base_url('newsfeed/index');?>"+'/'+encParam;
//                     }
//                 },
//                 {
//                     text: ' Refresh ', className: 'btn biru-bg fa fa-refresh', action: function (e) {
                       
//                        document.getElementById('loader').hidden=false;
//                        var state = document.readyState
//                           if (state == 'complete') {
//                               setTimeout(function(){
//                                   document.getElementById('interactive');
//                                  // document.getElementById('load').style.visibility="hidden";
//                                  tblmarketing.ajax.reload(null,true);
//                                  document.getElementById('loader').hidden=true;
//                               },1000);
//                           }

//                        // document.getElementById('loader').hidden=false;
//                        // tblnup.ajax.reload(null,true);
//                        // document.getElementById('loader').hidden=true;
//                     }
//                 }
                
             
                
//             ],
//         "serverSide": true,
//         "ajax":{
//                     "url":"<?php echo base_url('c_marketing_list/getTable');?>",  
//                     "data":{"sSearch": function(d){
// 	                var a = $('#txt_search').val();
// 	                // console.log(a);
// 	                var b ="";
// 	                if(a == null){
// 	                    return b;
// 	                }{
// 	                    return a;
// 	                }
	                
// 	             }},          
//                 "type":"POST"
//             },
//         // ini ada button submit
//         "columns": [
//             {data: "row_number",name:"row_number", searchable:false},
//             {data:"agent_name",name:"agent_name"},
//             {data:"id_no",name:"id_no"},
//             {data:"npwp",name:"npwp"},
//             {data:"home_address",name:"home_address"},
//             {data:"city",name:"city"},            
//             {data:"email_add",name:"email_add"},
//             {data:"handphone1",name:"handphone1"},
//             {data:"handphone2",name:"handphone2"},
//             {data:"columdef",name:"columdef"},
//             {data:"group_name",name:"group_name",visible:false},
//             {data:"company_name",name:"company_name",visible:false},
//             {data:"rowID",name:"rowID",visible:false},
//             {data:"agent_cd",name:"agent_cd",visible:false}
//             ],
//             "columnDefs": [ {
//                     className: 'control',
//                     orderable: false,
//                     targets:   9
//                 } ]
//     });
//     $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');

//     $('#tblmarketing tbody').on('dblclick', 'tr', function () {
//                         var rows = tblmarketing.rows('.selected').indexes();
//                         var data = tblmarketing.rows(this).data();
//                         var rowID = data[0].rowID;
//                         var UserID  = data[0].agent_cd;
//                         // alert(UserID);
                        


//                         var modalClass = $('#modal').attr('class');
//                         switch (modalClass) {
//                           case "modal fade bs-example-modal-md":
//                               $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                               break;
//                           case "modal fade bs-example-modal-sm":
//                               $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                               break;
//                           default:
//                               $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                               break;
//                           }

//                           var modalDialogClass = $('#modalDialog').attr('class');
//                           switch (modalDialogClass) {
//                               case "modal-dialog modal-md":
//                                   $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                                   break;
//                               case "modal-dialog modal-sm":
//                                   $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                                   break;
//                               default:
//                                   $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                                   break;
//                           }

//                         $('#modalTitle').html('Edit Executive Marketing');

//                         $('div.modal-body').load("<?php echo base_url("c_marketing_list/edit");?>");

//                         $('#modal').data('id', UserID).modal('show');
//                         $('#modal').data('rowid', rowID);
//     });

//     $("#txt_search").keyup(function(event){
//         var a = $('#txt_search').val();
        
//             if(a==''){
//                 tblmarketing.ajax.reload(null,true);   
//             }
//             if(event.keyCode == 13){
            
//             tblmarketing.ajax.reload(null,true);   
//         }
//     });

// });
// function fn_search(){
//     var a = $('#txt_search').val();
//     tblmarketing.ajax.reload(null,true); 
//     }
</script>
