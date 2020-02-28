<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <!-- <h3 class="content-header-title"><?php // echo $projectName; ?></h3> -->
        <h3 class="content-header-title">Cancel NUP</h3>
      </div>
    </div>
    <div class="content-body"> 
      <div class="row">      
        <div class="col-lg-12">
           <div class="card">
              <div class="card-header">
                <div class="card-content">
                  <div class="table-responsive">
                        <table id="tblCancelNUP" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">            
                            <thead>
                                <th>No.</th>                                     
                                <th>Name</th>                                
                                <th>Handphone</th>
                                <th>Email</th>
                                <th>NUP. No</th>
                                <th>Reserve Date</th>
                                <th>Status</th>
                                <th>Type</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <i>*Please download original cancel form</i>
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

<script type="text/javascript">
 var tblCancelNUP = $('#tblCancelNUP').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_reserve_nup_cancel/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "NAME" },
            { data: "nup_no" },
            { data: "Handphone" },
            { data: "Email" },
            { data: "nup_type" },
            { data: "reserve_date" },
            { data: "STATUS" }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section">frtip'
    });
    // console.log($('#tblCancelNUP'));
    $("div.section").html(
        '<button id="addnup" class="btn btn-primary pull-up">Cancel NUP</button>&nbsp;'+
        '<button id="editsection" class="btn btn-info pull-up">Download NUP</button>&nbsp;'+
        '<button id="deletesection" class="btn btn-warning pull-up">Action</button>&nbsp;'+
        '<button id="deletesection" class="btn btn-danger pull-up">Back</button>'
    );
    tblCancelNUP.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblCancelNUP.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addnup').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Cancel NUP');
        // $('#modalbody').load("<?php// echo base_url("c_reserve_nup_cancel/insert")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editsection').click(function(){
        var rows = tblCancelNUP.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblCancelNUP.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Section');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addsection")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletesection').click(function(){
        var rows = tblCancelNUP.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblCancelNUP.rows(rows).data();
        var id = data[0].rowID;

        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then(function(a){
            if (a.value==true) {
                Delete(id,'sv_section',tblCancelNUP)
            }
        })
    })


$(function(){
    // console.log($('#tblCancelNUP'));
   // tblCancelNUP = $('#tblCancelNUP').DataTable( 
   //  {
   //          dom: '<"toolbar dataTables_filter">Bfrtip',
   //          // responsive: true,
   //          responsive: {
   //                  details: {
   //                      type: 'column',
   //                      target: 8
   //                  }
   //              },
   //          select: true,
   //          filter: false,
   //          buttons: [
   //              {
   //                  text: ' Cancel NUP', className: 'btn biru-bg fa fa-plus btn-sm', action: function (e) {
                       
   //                      window.location.href="<?php echo base_url('c_reserve_nup_cancel/insert')?>";
                        
   //                  }
   //              },                
   //              {
   //                  text: ' Download NUP Cancel Form ', className: 'btn biru-bg fa fa-download', action: function (e) {
                        
   //                       window.location.href="<?php echo base_url('c_reserve_nup_cancel/download')?>/CANCELLATION_FORM.pdf";
   //                  }
   //              },
   //              {
   //              extend: 'collection',
   //              className: 'btn biru-bg fa fa-star buttons-html5',  
   //              text: ' Action',
   //              buttons: [
   //                  // 'copy',
   //                  'excel',
   //                  'csv',
   //                  'pdf',
   //                  // 'print'
   //                          ]           
   //              },
   //              {
   //                  text: ' Back ', className: 'btn biru-bg fa fa-arrow-left', action: function (e) {
   //                      var project = "<?php echo $project_no?>";
   //                      var projectName = "<?php echo $ProjectDescs; ?>";
   //                      var encParam = "<?php echo $encParam ?>";
   //                      // BootstrapDialog.alert(projectName);
   //                       // window.location.href="<?php echo base_url('newsfeed/index');?>"+'/'+project+'-'+projectName;
   //                       window.location.href="<?php echo base_url('newsfeed/index');?>"+'/'+encParam;
   //                  }
   //              }
   //          ],
   //      "serverSide": true,
   //      "ajax":{
   //                  "url":"<?php echo base_url('c_reserve_nup_cancel/getTable');?>",  
   //                  "data":{"sSearch": function(d){
   //                      var a = $('#txt_search').val();
   //                      // console.log(a);
   //                      var b ="";
   //                      if(a == null){
   //                          return b;
   //                      }{
   //                          return a;
   //                      }
   //                  }},           
   //              "type":"POST"
   //          },
   //      // ini ada button submit
   //      "columns": [
   //          {data: "row_number",name:"row_number", searchable:false},
   //          {data:"NAME",name:"NAME"},            
   //          {data:"Handphone",name:"Handphone"},
   //          {data:"Email",name:"Email"},
   //          {data:"nup_no",name:"nup_no"},
   //          {
   //              data:"reserve_date",name:"reserve_date",
   //              render: function (data, type, row) {

   //                              var date = new Date(parseInt(data.substr(0,10)));
   //                              var year =data.substr(0,4);
   //                              var month=data.substr(5,2);
   //                              var day =data.substr(8,2);
                               
   //                             // BootstrapDialog.alert(data);
   //                             // var aa=date.getDate() + "/" + (month.length > 1 ? month : "0" + month) + "/" + date.getFullYear();
   //                             var aa = day+"/"+month+"/"+year;
   //                              return aa;
                               
                               

   //                         }
   //          },    
   //          {data:"status_desc",name:"status_desc"},            
   //          {data:"descs",name:"descs"},
   //          {data:"columdef", name:"columdef"}
   //          ],
   //          "columnDefs": [ {
   //                  className: 'control',
   //                  orderable: false,
   //                  targets:   8
   //              } ]
   //  });
   //  $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');

   //  $("#txt_search").keyup(function(event){
   //      var a = $('#txt_search').val();
        
   //          if(a==''){
   //              tblCancelNUP.ajax.reload(null,true);   
   //          }
   //          if(event.keyCode == 13){
            
   //          tblCancelNUP.ajax.reload(null,true);   
   //      }
   //  });

});

function fn_search(){
    // var project = $('#txt_Pl_Project').val();
    var txt_search = $('#txt_search').val();
    if(txt_search!=''){
        
        tblCancelNUP.ajax.reload(null,true); 
    }
}


</script>


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