<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>


<script type="text/javascript">
window.history.forward();
var project;
var x = '<?php echo $kondisi;?>'

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
            "order": [[ 6, 'asc']],
            buttons: [
                {
                    text: ' New', className: "biru-bg fa fa-plus "+x, action: function (e) {

                        var status='I';
                        var site_url = '<?php echo base_url("c_reservation/insert2")?>';
                        // window.location.href= site_url+"/N";
                        window.location.href= site_url;
                         
                       // var url = '<?php echo base_url("c_reservation/cek_agent")?>';
                        // $.post(url,
                        //   {status:status},
                        //   function(data,status) {
                        //     console.log(data);
                        //     if(data ==0){                                
                        //         swal("Information",'Only Agent can Entry NUP',"warning");
                        //         return false;
                        //     }
                        //     window.location.href= site_url+"/N";
                        //   }
                        // );

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
                        console.log(data);
                        var status = data[0].STATUS;
                        var ID = data[0].rowID;                        
                        // alert(ID);
                        var st= new Array('A','N','P','V','R');
                        
                        if((st.indexOf(status)) < 0 ){                            
                            swal("Information",'Only Status New, Approved, Pending ',"warning");
                            return;
                        }
                        var site_url = '<?php echo base_url("c_reservation/edit_rev")?>'+'/'+status+'/'+ID;
               
                        
                        window.location.href= site_url;

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
                        var seqno = data[0].nup_sequence_no;
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
                {
                    text: ' Back ', className: 'biru-bg fa fa-arrow-left', action: function (e) {
                        var project = "<?php echo $project_no?>";
                        var projectName = "<?php echo $ProjectDescs; ?>";
                        var encParam = "<?php echo $encParam ?>";
                        
                         window.location.href="<?php echo base_url('newsfeed/index');?>"+'/';
                    }
                },
                {
                    text: ' Refresh ', className: 'biru-bg fa fa-refresh', action: function (e) {
                       
                       document.getElementById('loader').hidden=false;
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 tblnup.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }
                    }
                }
            ],
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_reservation/getTableHd');?>",  
            "data":{"sSearchHd": function(d){
                var a = $('#txt_search').val();
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
              data: "rowID", name: "rowID",
                            render: function (data, type, row) {
                                var seq_no = row.nup_sequence_no;
                                var status = row.STATUS;


                              // return status;
                               if(status=='N' || status=='R'){
                                return  '<a class="btn btn-success btn-sm" onclick="klikcubmitnon(\''+data+'\',\''+seq_no+'\',\''+status+'\');"" ><i class="fa fa-users fa-fw"></i> Submit</a>';
                               }else{
                                return ' ';
                               }
                                
                                

                            }
            },     
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
                               var aa = day+"/"+month+"/"+year;
                                return aa;

                           }
            },    
            {data:"status_desc",name:"status_desc",},            
            {data:"descs",name:"descs"},
            {data:"columdef", name:"columdef"},
            {data:"business_id",name:"business_id",visible:false},
            {data:"nup_sequence_no",name:"nup_sequence_no",visible:false},
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
     $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        if(a==''){
            tblnup.ajax.reload(null,true);   
        }

        if(event.keyCode == 13){
            
            tblnup.ajax.reload(null,true);   
        }
        
    });

    $('#button').click( function () {
        var data = tblnup.rows('.selected').data();
        for (var i = data.length - 1; i >= 0; i--) {
            data[i];
        };
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
});
function fn_search(){
    var a = $('#txt_search').val();
    tblnup.ajax.reload(null,true); 
}

function klikcubmitnon(data,seq_no,status_nup)
     {
        document.getElementById("loader").hidden=false;
        var id = data;
                            var rows = tblnup.rows('.selected').indexes();

                      var site_url = '<?php echo base_url("c_reservation/check_attachment")?>';
                            $.post(site_url,
                                 {seqno:seq_no,from:'out'},
                             function(data,status) 

                        {

                                if(data!='OK'){                                
                                swal("Information",'Please Complete NUP attachment & Payment Method',"warning");
                                document.getElementById("loader").hidden=true;
                                return;
                                }
                                else
                        {
                               
                                    document.getElementById("loader").hidden=true;
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
                            }
                                
                            });
                    

}
function cek_attach(seqno,hasil){
    var ab='';

    $.ajax({
        url :"<?php echo base_url('c_reservation/check_attachment')?>",
        type:"POST",
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
}

function mt(nupno)
{
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
                    url : "<?php echo base_url('c_reservation/Delete');?>",
                    type:"POST",
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
                        }
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){                     
                     
                     swal("Information",textStatus+' Save : '+errorThrown,"warning");
                     
                    }
                    });

    }
    function Submit(){
        var id = $('#modal').data('id');
        var status = $('#modal').data('status');
        
        document.getElementById('loader').hidden=false;
        
         $.ajax({
                    url : "<?php echo base_url('c_reservation/SubmitStatus');?>",
                    type:"POST",
                    data: { id: id,status:status},
                    dataType:"json",
                    success:function(event, data){
                        document.getElementById('loader').hidden=true;
                        
                        if(event.Status=='OK'){                          
                          swal("Information",event.Pesan,"success");
                          $('#modal').modal('hide');
                          tblnup.ajax.reload(null,true);
                        } else {
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

                        } 

                        tblnup.ajax.reload(null,true);  
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
            url: "<?php echo base_url('c_reservation/sendInvitation')?>",
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
            <div class="judulprojek"><?php echo $ProjectDescs; ?></div>
            <div class="tittle-top pull-right">Reservation</div>            
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        </div>
    </div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">                       
                        <div class="box-body"> 
                        <b>&nbsp; NEW NUP</b>
                        <br>                             
                            <table id="tblnup" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >                         

                                <thead>    
                                    <th>No</th>
                                    <th>Action</th>                                        
                                    <th>Name</th>                                
                                    <th>Handphone</th>
                                    <th>Email</th>
                                    <th>Reserve Date</th>
                                    <th>Status</th>
                                    <th>Type</th>  
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
               
        <div class="row">
        <div class="col-xs-12">
        <div class="ibox-content">
        <div class="table-responsive">                
        <div class="box-body">
        <b>&nbsp; APPROVED NUP</b>
        <br>                             
        <table id="tblapprove" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" style="position: ">
        <thead>
        <th>No</th>                                     
        <th>Name</th>                               
        <th>Handphone</th>
        <th>Email</th>
        <th>NUP No.</th>
        <th>Reserve Date</th>
        <th>Status</th>
        <th>Type</th>
        <th></th>
        </thead>
        <tbody>
        </tbody>
        </table>
        <font size="2px"><i>*Please click <b>NUP No.</b> to see "Tanda Terima Sementara" and Ticket NUP</i></font>
        </div>                      
        </div>
        </div>
        </div>          
        </div><br>


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
//start doc function
$(function(){
    //start looping
    
    tblapprove  = $('#tblapprove').DataTable({
                        
             dom: '<"toolbar dataTables_filter">Bfrtip',
             responsive: {details: {type: 'column',target: 8}},
             select: true,
             filter:false,
             "order": [[ 6, "asc"]],
             buttons: [   
                
                 {    
                     text: ' Revise', className: 'biru-bg fa fa-pencil',
                     action: function () { 
                      
                         var rows = tblapprove.rows('.selected').indexes();
                         if (rows.length < 1) {
                             swal('Information','Please select a row','warning');
                             return;
                         }

                         var data = tblapprove.rows(rows).data();
                         var status = data[0].STATUS;
                         var ID = data[0].rowID;                        
                       
                         var st= new Array('A','N','P','V','R');
                        
                         if((st.indexOf(status)) < 0 ){
                             swal('Information','Only Status New, Approved, Pending ','warning');
                             return;
                         }
                         var site_url = '<?php echo base_url("c_reservation/edit_rev_a") ?>'+'/'+status+'/'+ID;            
                        
                         window.location.href= site_url;
                     }
                 },
                 {
                     text: ' Back ', className: 'biru-bg fa fa-arrow-left', action: function (e) {
                         var project = '<?php echo $project_no  ?>' ;
                         var projectName = '<?php echo $ProjectDescs ?>' ;
                        // BootstrapDialog.alert(projectName);
                window.location.href='<?php echo base_url("newsfeed/index") ?>'+'/'+project+'-'+projectName;
                     }
                 },
                 {
                     text: ' Refresh ', className: 'biru-bg fa fa-refresh', action: function (e) {
                       
                        document.getElementById('loader').hidden=false;
                        var state = document.readyState;
                           if (state == 'complete') {
                               setTimeout(function(){
                                   document.getElementById('interactive');
                                 // document.getElementById('load').style.visibility="hidden";
                                  tblapprove.ajax.reload(null,true);
                                  document.getElementById('loader').hidden=true;
                               },1000);
                           }
                     }
                 }
             ],
         "serverSide": true,
         "ajax":{

             "url":"<?php echo base_url('c_reservation/getTable/');?>",
             "data":{"sSearch": function(d){
                 var a = $('#txt_search').val();
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
             {data:"NAME",name:"NAME"},
             {data:"Handphone",name:"Handphone"},
             {data:"Email",name:"Email"},
             {data:"nup_no",name:"nup_no", render: function(data, type, row){
                 var stat = row.STATUS;
                 if(stat=='A') {
         aa = "<a class='btn btn-primary btn-sm' onclick='showUp(data)'>+data+</a>";
                 } else {
                     aa = data;
                 } 
                 return aa;
             }},
             {
                 data:"reserve_date",name:"reserve_date",
                 render: function (data, type, row) {

                                 var date = new Date(parseInt(data.substr(0,10)));
                                 var year =data.substr(0,4);
                                 var month=data.substr(5,2);
                                 var day =data.substr(8,2);
                               
                                var aa = day+"/"+month+"/"+year;
                                 return aa;
                             

                            }
             },
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
             {data:"descs",name:"descs"},
             {data:"columdef",name:"columdef"},
             {data:"business_id",name:"business_id",visible:false},
             {data:"nup_sequence_no",name:"nup_sequence_no",visible:false},
             {data:"STATUS",name:"STATUS",visible:false},
             {data:"rowID",name:"rowID",visible:false}
            
             ],
 "columnDefs": [ {className: "control",orderable: false,targets:   8} ]
            
            
     });

  $("div.toolbar").html('<b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search"  name="txt_search" > <a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a> </b>');
   
      $("#txt_search").keyup(function(event){
         var a = $('#txt_search').val();
         if(a==''){
             tblapprove.ajax.reload(null,true); 
         }

         if(event.keyCode == 13){
            // $("#id_of_button").click();
            
             tblapprove.ajax.reload(null,true);
         }
        
     });

     $('#button').click( function () {
         var data = tblapprove.rows('.selected').data();
         for (var i = data.length - 1; i >= 0; i--) {
             data[i];
             alert(data[0].row_number);
         };
    
     } );

     $('#tblapprove" tbody').on( 'click', 'tr.group', function () {
         var currentOrder = tblapprove.order()[0];
         if ( currentOrder[0] === 6 && currentOrder[1] === 'asc' ) {
             tblapprove.order( [ 6, 'desc' ] ).draw();
         }
         else {
            tblapprove.order( [ 6, 'asc' ] ).draw();
         }
     } );
//end looping

 
});
//end doc function   

    function fn_search(){
    var a = $('#txt_search".$row->product_cd."').val();
    tblapprove.ajax.reload(null,true);
    }


function klikcubmit(data,seq_no,status_nup)

     {
        var id = data;

                            var rows = tblapprove.rows('.selected').indexes();
                       
                       var site_url = '<?php echo base_url("c_reservation/check_attachment")?>';
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
        url :"<?php echo base_url('c_reservation/check_attachment')?>",
        type:"POST",
        data: { seqno:seqno,from:'out' },
        dataType:"json",
        success:function(event, data){            
            swal("Information",event.Pesan,"warning");
            ab = event.Pesan;
    return ab;
        },                    
        error: function(jqXHR, textStatus, errorThrown){                             
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