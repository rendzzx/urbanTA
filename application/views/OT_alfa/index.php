<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/pickers/daterange/daterangepicker.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/pickers/daterange/daterange.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>
     <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
           <br><br>
           <h3 class="content-header-title">Overtime Request</h3>
        </div>

        <div class="content-header-right col-md-8 col-12 mb-2">
        <br>
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb"> 
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item active">Overtime
                    </li>
                    <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Survey
                    </li> -->
                    </ol>
                </div>
            </div>
        </div>

        </div>
        <div class="content-body">
           
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                            
                                        <div class="form-group">
                                            <label >Overtime Date</label>
                                            <div class='input-group col-sm-3'>
                                                <input class="form-control singledate" autocomplete="off"  id="ov_date" name="ov_date" type="text" value="<?php 
                                                            // $mydate=date("d-m-Y", strtotime("+1 day"));
                                                            $mydate=date("d-m-Y");
                                                            echo "$mydate";//[mday] / $mydate[month] / $mydate[year]";
                                                      ?>"/>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <span class="la la-calendar"></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>   
                          
                                        <table id="tblovertime" class="table table-striped table-bordered base-style table-hover dataTables" cellspacing="0">  
                                            <thead> 
                                            <tr>
                                                <th>No.</th>          
                                                <!-- <th class="sorting_asc">Action</th> -->
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


 <!-- MODAL BOOTSTRAP -->
<!-- <div class="modal fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="modaltitle" aria-hidden="true">
  <div class="modal-dialog" role="document" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header" id="modalheader">
      <h4 class="modal-title" id="modaltitle">Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalbody">                                          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="savefrm">Save</button>
      </div>
    </div>
  </div>
</div> -->

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

var tblovertime;
$(document).ready(function () {
    var tblovertime = $('#tblovertime').DataTable( {
       "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_overtime_a/getTable');?>",
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
         // buttons: [
         //     {
         //        extend: 'collection',
         //        className: 'btn biru-bg ft-activity',
         //        text: ' Action',
         //        buttons: [
         //            // 'copy',
         //            'excel',
         //            'csv',
         //            'pdf',
         //            // 'print'
         //                    ]           
         //        },   
         //        {
         //            text: ' Back ', className: 'btn biru-bg ft-activity hidden', action: function (e) {
                       
         //            }
         //        }
                
         //    ],
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
        "dom": '<"toolbar tblovertime">frtip'
    });
    $("div.tblovertime").html(
        '<button id="addparam" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editparam" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deleteparam" class="btn btn-danger pull-up onclick="deleteov()">Delete</button>'
        // '<button id="editparam" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'
        
    );
    tblovertime.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblovertime.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    var date = new Date();
    date.setDate(date.getDate());
    // date.setDate(date.getDate()+1);


     $('#ov_date').daterangepicker({
        locale: {
              format: 'DD-MM-YYYY',
              cancelLabel: 'Clear'
            },
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        startDate: date,
        minDate:date
    });
     $('#ov_date').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD-MM-YYYY'));
          // console.log(picker);
          tblovertime.ajax.reload(null,true);   
      });
    // $('#ov_date').on('change',function(e){
    //     console.log($(this).val());
    //     tblovertime.ajax.reload(null,true);   
    // });
               
    $('#fn_search').click(function(){
        // alert('apalw');
        block(true,'#tblovertime');
   
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    tblovertime.ajax.reload(null,true);
                    block(false,'#tblovertime');
                },1000);
            }  
    });
     $("input[type='search']").keyup(function(event){
        var a = $("input[type='search']").val();
            console.log($("input[type='search']"));
            if(a==''){
                tblovertime.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            // alert(a);
            tblovertime.ajax.reload(null,true);   
        }
    });
     $('#addparam').click(function(){
        var dd = $('#ov_date').val();
        block(true,'#modalbody');
        $('#modalbody').html("");
        $('#modalheader').addClass('bg-primary white');
        $('#modaldialog').addClass('modal-lg');
        $('#modaltitle').addClass('white');
        $('#modal').modal({backdrop: 'static', keyboard: false})  
        $('#modaltitle').html('Add Overtime');
        $('#modalbody').load("<?php echo base_url("c_overtime_a/add/");?>"+dd);
        
        $('#modal').data('ovdate', dd);
        $('#modal').data('Ot_Id', 0).modal('show');
        $('#modal').modal('show');
    });
    $('#editparam').click(function(){
        // alert('weee');
        var rows = tblovertime.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblovertime.rows(rows).data();
        var id = data[0].ot_id;

        var site_url = '<?php echo base_url("c_overtime_a/cek_startOT/")?>';
        $.post(site_url,
            {ot_id:id},
            function(datacnt,status) {
                if(datacnt == 'true') {
                    swal({
                            title: "Warning",
                            text: "Can't edit ongoing overtime!",
                            type: "error",
                            confirmButtonText: "OK"
                        },
                        function(){
                            tblovertime.ajax.reload(null,true); 
                        });
                    return;
                } else {
                    block(true,'#modalbody');
                    $('#modalbody').html("");
                    $('#modalheader').addClass('bg-primary white');
                    $('#modaldialog').addClass('modal-lg');
                    $('#modaltitle').addClass('white');
                    $('#modal').modal({backdrop: 'static', keyboard: false})  
                    $('#modaltitle').html('Add Overtime');
                    var dd = $('#ov_date').val();
                    $('#modalbody').load("<?php echo base_url("c_overtime_a/add/");?>"+dd);
                    $('#modal').data('ovdate', dd);
                    $('#modal').data('Ot_Id', id).modal('show');
                    $('#modal').modal('show');
                }
            }
        );
    })

    $('#deleteparam').click(function(){
var rows = tblovertime.rows('.selected').indexes();
    if (rows.length < 1) {
        swal("Information",'Please select a row',"warning");
        return;
    } 
    var data = tblovertime.rows(rows).data();
    var id = data[0].ot_id;
var site_url = '<?php echo base_url("c_overtime_a/cek_startOT/")?>';
$.post(site_url,
    {ot_id:id},
    function(datacnt,status) {
        console.log(datacnt);
        if(datacnt == 'true') {
            // swal('Warning',"Can't delete ongoing overtime!","error");
            swal({
                    title: "Warning",
                    text: "Can't delete ongoing overtime!",
                    type: "error",
                    confirmButtonText: "OK"
                },
                function(){
                    // tblovertime.ajax.reload(null,true); 
                    window.location.href="<?php echo base_url('c_overtime_a/index');?>";
                });
            return;
        } else {
            $.ajax({
                url : "<?php echo base_url('c_overtime_a/Delete');?>",
                type:"POST",
                data: { Ot_Id: id },
                dataType:"json",
                success:function(event, data){
                        // BootstrapDialog.alert(event.Pesan);
                        if(event.Status !='OK'){
                            swal("error",event.Pesan,"warning");
                        }else{
                            swal("success",event.Pesan,"success");
                        
                            // tblovertime.ajax.reload(null,true); 
                            window.location.href="<?php echo base_url('c_overtime_a/index');?>";
                        }
                        
                },                    
                error: function(jqXHR, textStatus, errorThrown){        
                        // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                        swal("Information",textStatus+' Save : '+errorThrown,"warning");

                }
            });
        }
    }
); 
})
});

function approve(data){
    block(true,'#tblovertime');
    $.ajax({
        url : "<?php echo base_url('c_overtime_a/approve/');?>"+data,
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
                    window.location.href="<?php echo base_url('c_overtime_a/index');?>";
                    block(false);
                });
            }
            else {
                block(false);
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
            block(false);
        }
    })
}

function editov(data){
var site_url = '<?php echo base_url("c_overtime_a/cek_startOT/")?>';
$.post(site_url,
    {ot_id:data},
    function(datacnt,status) {
        console.log(datacnt);
        if(datacnt == 'true') {
            // swal('Warning',"Can't edit ongoing overtime!","error");
            swal({
                    title: "Warning",
                    text: "Can't edit ongoing overtime!",
                    type: "error",
                    confirmButtonText: "OK"
                },
                function(){
                    tblovertime.ajax.reload(null,true); 
                });
            return;
        } else {
            block(true,'div.modal-body');
            $('div.modal-body').html("");
            $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
            $('#modaltitle').addClass('white');
            $('#modal').modal({backdrop: 'static', keyboard: false})  
            $('#modaltitle').html('Edit Overtime');
            $('div.modal-body').load("<?php echo base_url("c_overtime_a/edit");?>");
            var dd = $('#ov_date').val();
            $('#modal').data('ovdate', dd);
            $('#modal').data('Ot_Id', data).modal('show');
            
            
        }
    }
); 

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