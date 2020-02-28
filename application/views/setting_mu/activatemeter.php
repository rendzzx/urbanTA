<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">Setup</h3>
      </div>
    </div>
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Setup</h4>
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
                                <!-- <table id="tbluser" class="table table-hover table-bordered" width="100%"> -->
                                <table id="tblmeteractive" class="table table-hover table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <!-- <th>No</th> -->
                                            <th>Meter Type</th>
                                            <th>Meter ID</th>
                                            <th>Lot No</th>
                                            <th>Debtor Acct</th>
                                            <!-- <th>Debtor Name</th> -->
                                            <th>Status</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
  </div>
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

<script type="text/javascript">

    var tblmeteractive = $('#tblmeteractive').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Mu/gettablemeteractive');?>",
            "type": "POST"
        },
        "columns": [
            { data: "meter_cd" },
            { data: "meter_id" },
            { data: "lot_no" },
            { data: "debtor_acct" },
            // { data: "name" },
            { data: null,
                    "searchable" : false,
                    "orderable":false,
                    "render": function (data, type, row) {
                      var status = row.status;
                      var number = row.rowID
                        if (status == 'Y'){
                            return '<label class="switch"><input type="checkbox" name="myCheck'+number+'" id="'+number+'" checked onclick="myFunction('+number+')" ><span class="slider round"></span></label>';


                        }else{
                            return '<label class="switch"><input type="checkbox" name="myCheck'+number+'" id="'+number+'" onclick="myFunction('+number+')"><span class="slider round"></span></label>';

                        }
                    }
            },
            {
              "className":      'details-control',
              "orderable":      false,
              "data":           null,
              "defaultContent": ''
            }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar meteractive">frtip'
    });
    tblmeteractive.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblmeteractive.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#tblmeteractive').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tblmeteractive.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( formatactive(row.data()) ).show();
            tr.addClass('shown');
            // $('.th').removeClass('table th');
            $('td').css("padding","");
            $('th').css("padding","");
           
            // $.css("background-color", "");

            var style = window.getComputedStyle($('.table td').get(0),null);
        }

    } );

      function myFunction(id)
      {
        // console.log(id)
        if ($('#'+id).is(':checked')) {
          // alert('Nyala')
          $.ajax({
            url : "<?php echo base_url('C_Setting_Mu/updatetoy/');?>"+id,
            type: "POST",
            data: id,
            dataType:"json",
          })
        }else{
          // alert('Mati')
          $.ajax({
            url : "<?php echo base_url('C_Setting_Mu/updateton/');?>"+id,
            type: "POST",
            data: id,
            dataType:"json"
          })
        }
      }

    function formatactive(d){
        var html =
        '<div class="col-md-12">'+
            '<table border="0" id="codeopen" align="center">'+
                '<tr>'+
                    '<td border="0"><button class="bucli1" onclick="bukaqr('+d.rowID+')">QR CODE</button></td>'+
                    '<td border="0"><button class="bucli2" onclick="bukabarcode('+d.rowID+')">BARCODE</button></td>'+
                '</tr>'+
            '</table>'+
        '</div>'
        return html
    }

    window.onclick = function(event){
        if (event.target == modal){
            modal.style.display = "none";
        }
    }

    function closebutton(){
        modal.style.display = "none";
    }

    function bukaqr(id){
        $.ajax(
        {
            url : "<?php echo base_url('C_Setting_Mu/qr/');?>"+id,
            type: "POST",
            data: id,
            dataType:"json",
        })
        .done(function( data ) {
            var sourcing = '<img src=<?php echo base_url('img/qrcode/');?>'+data+'>';
            // $('#modalbody').html('<img src="'+data+'">');
            $('#modalbody').html(sourcing);
            $('#modalheader').hide();
            // $('.modal-footer').hide();
            $('.modal-footer').html('<button class="printqrbar" onclick="printQr()">Print this QR Code</button>');
            $('#modal').modal('show');
        });;
    }

    function bukabarcode(id){
        var source = '<img src=<?php echo base_url('C_Setting_Mu/openbarcode/');?>'+id+'>';
        $('#modalbody').html(source);
        $('#modalheader').hide();
        // $('.modal-footer').hide();
        $('.modal-footer').html('<button class="printqrbar" onclick="printBarcode('+id+')">Print this Barcode</button>');
        $('#modal').modal('show');
    }

    function printBarcode(id)
    {
        var url = 'openbarcode/'+id+'';
        var mywindow = window.open(url);
        mywindow.document.write('<p>' + document.getElementById('modalbody').innerHTML + '</p>');
        mywindow.print();
        mywindow.close();
    }

    function printQr()
    {
        var urlnya = 'https://google.com';
        var mywindow = window.open(urlnya);
        mywindow.document.write('<p>' + document.getElementById('modalbody').innerHTML + '</p>');
        mywindow.print();
        mywindow.close();
    }
</script>

