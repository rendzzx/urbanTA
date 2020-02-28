<link rel="stylesheet" type="text/css" href="<?=base_url('DataTable/media/css/dataTables.bootstrap.min.css');?>">
<link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />

<script type="text/javascript">

var tblnewsfeed;
$(function(){
   tblnewsfeed = $('#tblnewsfeed').DataTable( 
    {
         dom: 'Bfrtip',
            responsive: true,
            select: true,
            buttons: [
                {
                    text: ' Add', className: 'fa fa-plus', action: function (e) {
                        var modalClass = $('#modal').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-md":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            case "modal fade bs-example-modal-sm":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            default:
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            default:
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                        }

                        $('#modalTitle').html('Add NUP Parameter');
                        $('div.modal-body').load("<?php echo base_url("c_nup_parameter/addnew");?>");
                        $('#modal').data('nup_id', 0).modal('show');
                    }
                },
                {
                    text: ' Edit', className: 'fa fa-pencil',
                    action: function () {                       
                        var rows = tblnewsfeed.rows('.selected').indexes();
                        if (rows.length < 1) {
                            alert('Please select a row');
                            return;
                        }

                        var data = tblnewsfeed.rows(rows).data();
                        var UserID = data[0].nup_id;
                        

                        var modalClass = $('#modal').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-md":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            case "modal fade bs-example-modal-sm":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            default:
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            default:
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                        }

                        $('#modalTitle').html('Edit NUP Parameter');

                        $('div.modal-body').load("<?php echo base_url("c_nup_parameter/addnew");?>");

                        $('#modal').data('nup_id', UserID).modal('show');

                    }
                }                
            ],
        "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_nup_parameter/getTable');?>",             
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number" },
            {data:"entity_name",name:"entity_name"},
            {data:"project_descs",name:"descs"},
            {
                data:"start_date",name:"start_date",
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
                data:"end_date",name:"end_date",
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
            {data:"phase_descs",name:"phase_cd"},
            {
                data:"status",name:"status",sortable: false, searchable:false,
                render:function (data,type,row) {
                    if(data==1){
                        return 'Active';
                    }else{
                        return 'Absolute';
                    }
                    
                }
            }
            
            ]
    });
});

    function goToAttachment(){
        
    }
</script>
<div class="content-wrapper">    
    <section class="content" >
        <table id="tblnewsfeed" class="display table-striped table-bordered table-condensed" cellspacing="0" style="width:100%">
            <thead>
                <th>No.</th>
                <th width="30%">Entity Name</th>
                <th width="30%">Project Name</th>
                <th width="10%">Start Date</th>
                <th width="10%">End Date</th>
                <th>Phase Code</th>
                <th>Status</th>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>
</div>
<!-- <script src="<?=base_url('choosen/jquery.min.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.min.js')?>" type="text/javascript"></script> 


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