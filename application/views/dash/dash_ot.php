<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/pickers/daterange/daterangepicker.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/pickers/daterange/daterange.css')?>">
<!-- <style>
    .nav-link{
        color: #ffffff !important;
    }
    </style> -->
<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>

        <div class="content-header row">
          <div class="content-header-left col-md-6 col-12 mb-2">
            <br><br>

            <h3 class="content-header-title" style="color: #ffffff !important">Overtime Request</h3>
          </div>
          <div class="content-header-right col-md-6 col-12 mb-2">
            <br><br>
            <h3 class="content-header-title" ><span id="txtTime" class="pull-right"></span></h3>
          </div>
        </div>
      
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="nav-vertical p-2">
                            <ul class="nav nav-tabs nav-left flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" id="baseVerticalLeft-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">Open</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="baseVerticalLeft-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Expired</a>
                                </li>
                               
                            </ul>
                            <div class="tab-content px-1">
                                <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" >
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                  
                                            <table id="tblopen" class="table table-responsive table-striped table-bordered base-style table-hover dataTables" cellspacing="0"  width="100%">  
                                                <thead> 
                                                <tr>
                                                    <th>No.</th>          
                                                    <th class="sorting_asc">Action</th>
                                                    <th>Overtime No</th>
                                                    <th>Debtor Acct</th>
                                                    <th>Debtor Name</th>
                                                    <th>Lot No</th>
                                                    <th>Floor</th>
                                                    <th>Start</th>
                                                    <th>End</th>
                                                </tr> 
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                                
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2" >
                                   <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">
                                  
                                            <table id="tblexpired" class="table table-striped table-bordered base-style table-hover dataTables" cellspacing="0" width="100%">  
                                                <thead> 
                                                <tr>
                                                    <th>No.</th>          
                                                    <th>Overtime No</th>
                                                    <th>Debtor Acct</th>
                                                    <th>Debtor Name</th>
                                                    <th>Lot No</th>
                                                    <th>Floor</th>
                                                    <th>Start</th>
                                                    <th>End</th>
                                                </tr> 
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
    </div>
</div>




<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/pickers/daterange/daterangepicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('js/plugins/clockpicker/clockpicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('css/test/jquery.validate.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">

var tblopen,tblexpired;
$(document).ready(function () {
    var tblopen = $('#tblopen').DataTable( {
       "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('overtime/getTableOpen');?>",
            "data":{"sSearch": function(d){
                var search = $('#txt_search').val();
                var b="";
                if(search == null || search==""){
                    return b;
                }{
                    return search;
                }
             },
             "ov_date":function(c){
                var ddd = $('#ov_date').val();
                var b="";
                if(ddd == null || ddd==""){
                    return b;
                }{
                    return ddd;
                }

             }
            },             
            "type":"POST"
        },

        "columns": [
            {data:"row_number",name:"row_number",
                 render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }},

            {
                data: "ot_id",name:"ot_id", searchable:false,
                render: function (data, type, row) {
                    var cnt_start = parseInt(row.cnt_start);
                    if(cnt_start>0){
                        var disable = 'disabled';
                    } else {
                        var disable = '';
                    }
                    var btnedit ='<button class="btn btn-sm btn-info" onclick="approve(\''+data+'\')" '+disable+'><i class="ft-edit-3"></i> Approve</button>';
                    return  btnedit
                    // +'&nbsp;<button class="btn btn-sm btn-danger" onclick="deleteov(\''+data+'\')"  '+disable+'><i class="ft-trash-2"></i> Delete</button>';

                    }

            },
            {data:"ot_id",name:"ot_id", sortable: false},
            {data:"debtor_acct",name:"debtor_acct", sortable: false},
            {data:"debtor_name",name:"debtor_name", sortable: false},
            {data:"lot_no",name:"lot_no", sortable: false},
            {data:"descs_level",name:"descs_level"},
            {data:"start_overtime",name:"start_overtime", sortable: true,
                render: function (data, type, row) {
                    return formatdate(data)
                }
            },
            {data:"end_overtime",name:"end_overtime", sortable: true,
                render: function (data, type, row) {
                            return formatdate(data)
                        }
            }
    
        ], 
 
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        // "dom": '<"toolbar tblopen">frtip'
    });

    tblopen.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblopen.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    var date = new Date();
    date.setDate(date.getDate()+1);



               
    $('#fn_search').click(function(){
        // alert('apalw');
        block(true,'#tblopen');
   
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    tblopen.ajax.reload(null,true);
                    block(false,'#tblopen');
                },1000);
            }  
    });
     $("input[type='search']").keyup(function(event){
        var a = $("input[type='search']").val();
            console.log($("input[type='search']"));
            if(a==''){
                tblopen.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            // alert(a);
            tblopen.ajax.reload(null,true);   
        }
    });
    var tblexpired = $('#tblexpired').DataTable( {
       "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('overtime/getTableExpired');?>",
            "data":{"sSearch": function(d){
                var search = $('#txt_search').val();
                var b="";
                if(search == null || search==""){
                    return b;
                }{
                    return search;
                }
             },
             "ov_date":function(c){
                var ddd = $('#ov_date').val();
                var b="";
                if(ddd == null || ddd==""){
                    return b;
                }{
                    return ddd;
                }

             }
            },             
            "type":"POST"
        },

        "columns": [
            {data:"row_number",name:"row_number",
                 render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }},

            // {
            //     data: "ot_id",name:"ot_id", searchable:false,
            //     render: function (data, type, row) {
            //         var cnt_start = parseInt(row.cnt_start);
            //         if(cnt_start>0){
            //             var disable = 'disabled';
            //         } else {
            //             var disable = '';
            //         }
            //         var btnedit ='<button class="btn btn-sm btn-info" onclick="approve(\''+data+'\')" '+disable+'><i class="ft-edit-3"></i> Approve</button>';
            //         return  btnedit
            //         // +'&nbsp;<button class="btn btn-sm btn-danger" onclick="deleteov(\''+data+'\')"  '+disable+'><i class="ft-trash-2"></i> Delete</button>';

            //         }

            // },
            {data:"ot_id",name:"ot_id", sortable: false},
            {data:"debtor_acct",name:"debtor_acct", sortable: false},
            {data:"debtor_name",name:"debtor_name", sortable: false},
            {data:"lot_no",name:"lot_no", sortable: false},
            {data:"descs_level",name:"descs_level"},
            {data:"start_overtime",name:"start_overtime", sortable: true,
                render: function (data, type, row) {
                    return formatdate(data)
                }
            },
            {data:"end_overtime",name:"end_overtime", sortable: true,
                render: function (data, type, row) {
                            return formatdate(data)
                        }
            }
    
        ], 
 
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        // "dom": '<"toolbar tblopen">frtip'
    });

    tblexpired.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblexpired.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });


});

function approve(data){
    block(true,'#tblopen');
    swal({
        title: "Are you sure to approve this?",
        animation: false,
        type:"warning",
        text: "Once this is approved it can't be cancelled.",
        showCancelButton: true,
        confirmButtonText: "Yes"
    }).then(function(event){
        console.log(event)
        if(event.value){
            $.ajax({
                url : "<?php echo base_url('c_overtime/approve/');?>"+data,
                type:"POST",
                data: [],
                dataType:"json",
                success:function(event, data){
                    if(event.Error==false){
                        swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                        })
                        .then(function(a){
                            window.location.href="<?php echo base_url('overtime/index');?>";
                            block(false,'#tblopen');
                        });
                    }
                    else {
                        block(false,'#tblopen');
                        swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: 'test',
                            confirmButtonText: "OK"
                        });
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal({
                        title: "Error",
                        animation: false,
                        type:"error",
                        text: textStatus+' Save : '+errorThrown,
                        confirmButtonText: "OK"
                    });
                    block(false,'#tblopen');
                }
            })
        }else{
            block(false,'#tblopen');
        }
    });
    
}
// ini buat jam
window.onload = function() { jam(); }

 function jam() {
  var e = document.getElementById('txtTime'),
  d = new Date(), h, m, s;
  h = d.getHours();
  m = set(d.getMinutes());
  s = set(d.getSeconds());
  em = d.toLocaleDateString("en-en", {month: "long"});

  e.innerHTML = d.getDate() + ' ' + em + ' ' + d.getFullYear() + ' ' + h +':'+ m +':'+ s;

  setTimeout('jam()', 1000);
 }

 function set(e) {
  e = e < 10 ? '0'+ e : e;
  return e;
 }





function block(boelan,div){
        var block_ele = $(div);
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
function formatdate(data){
    if (data==null || data=='') {
      return 'Not Set'
    }
    var date = new Date(data);
    var dd = date.getDate();
    var mm = date.getMonth() + 1
    var yyyy = date.getFullYear();
    var h = date.getHours();
    var m = date.getMinutes();
    if (dd < 10) {
      dd = '0' + dd;
    } 
    if (mm < 10) {
      mm = '0' + mm;
    }
    if (h < 10) {
      h = '0' + h;
    } 
    if (m < 10) {
      m = '0' + m;
    } 

    var newdate = dd + '/' + mm + '/' + yyyy + ' ' + h + ':' + m;

    return newdate
  }

</script>