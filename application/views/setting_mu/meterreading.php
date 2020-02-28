<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<style type="text/css">
   
</style>
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
                                <div class="nav-vertical p-2">
                                    <div class="tab-content px-1">
                                        <div id="tabmeterreading" role="tabpanel" class="tab-pane active" aria-expanded="true">
                                            <table id="tblmeterreading" class="table table-hover table-bordered width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Level No</th>
                                                        <th>Level Description</th>
                                                        <th>Meter Type</th>
                                                        <th>Document Date</th>
                                                        <th>Meter Reading Date</th>
                                                        <th>Currency Rate</th>
                                                        <th>Detail</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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

    // meterreading
    var tblmeterreading = $('#tblmeterreading').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Mu/gettablemeterreading');?>",
            "type": "POST"
        },
        "columns": [
            { data: "level_no" },
            { data: "descs" },
            // { data: "meter_type" },
            { data: null,
                    "searchable" : false,
                    "orderable":false,
                    "render": function (data, type, row) {
                      var metertype = row.meter_type;
                        if (metertype == 'E'){
                            return 'ELECTRICITY';
                        } else if (metertype == 'G'){
                            return 'GAS';
                        } else if (metertype == 'W'){
                            return 'WATER';
                        }
                    }
            },
            { data: "doc_date" },
            { data: "read_date" },
            { data: "currency_rate" },
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
        "dom": '<"toolbar meterreading">frtip'
    });
    $("div.meterreading").html(
        '<button id="addmeterreading" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="deletemeterreading" class="btn btn-danger pull-up">Delete</button>&nbsp;'+
        '<button id="importmeterreading" class="btn btn-danger pull-up">Import</button>'
    );
    tblmeterreading.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblmeterreading.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        

    });
    $('#tblmeterreading').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tblmeterreading.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( formatreading(row.data()) ).show();
            tr.addClass('shown');
            // $('.th').removeClass('table th');
            $('td').css("padding","");
            $('th').css("padding","");
           
            // $.css("background-color", "");

            var style = window.getComputedStyle($('.table td').get(0),null);
             // console.log(style);
        }

    } );
    $('#addmeterreading').click(function(){
        var rows = tblmeterreading.rows().data()
        // if (rows.length > 0) {
        //     swal("Information",'Can\'t Add this Rows, just only one',"warning");
        //     return;
        // } 
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Section');
        $('#modalbody').load("<?php echo base_url("C_Setting_Mu/addmeterreading")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
        alert(project_no);
    })
    $('#editmeterreading').click(function(){
        var rows = tblmeterreading.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblmeterreading.rows(rows).data();
        var id = data.length;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Section');
        $('#modalbody').load("<?php echo base_url("C_Setting_Mu/addmeterreading")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletemeterreading').click(function(){
        var rows = tblmeterreading.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblmeterreading.rows(rows).data();
        var id = data.length;

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
                Delete(id,'pm_meter',tblmeterreading)
            }
        })
    })

    $('#importmeterreading').click(function(){
        $.getJSON("<?php echo base_url('C_Setting_Mu/getpm_meter_epcon_view/');?>", function (data) {
            $.each(data, function( index, value){
                var entity_cd = value.entity_cd;
                var project_no = value.project_no;
                var type = value.type;
                var level_no = value.level_no;
                var descs = value.descs;
                var read_date = value.read_date;
                $.getJSON("<?php echo base_url('C_Setting_Mu/save_pm_meter_hdrh/');?>"+entity_cd+"/"+project_no+"/"+type+"/"+level_no+"/"+descs+"/"+read_date, function (data2){
                    window.location.reload();
                })
            })
        })
    })

    function formatNumber(data) {
      if(data==null || data==0){
        data = '-';
      }
      return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    }

    function formatreading ( d ) {

        $.getJSON("<?php echo base_url('C_Setting_Mu/getdetailreading');?>" + "/" + d.level_no + "/" + d.meter_type, function (data) {

            $.each(data, function( index, value)
            {
                $("#"+d.row_number).append(
                    '<tr>'+

                    '<td>'+value.meter_id+'</td>'+

                    '<td>'+value.level_no+'</td>'+

                    '<td hidden><input style="border:none" type="text" name="calmet'+value.rowID+'" id="calmet'+value.rowID+'" value="'+value.calculation_method+'"></td>'+

                    '<td hidden><input style="border:none" type="text" name="entity_cd'+value.rowID+'" id="entity_cd'+value.rowID+'" value="'+value.entity_cd+'"></td>'+

                    '<td hidden><input style="border:none" type="text" name="project_no'+value.rowID+'" id="project_no'+value.rowID+'" value="'+value.project_no+'"></td>'+

                    '<td hidden><input style="border:none" type="text" name="category_cd'+value.rowID+'" id="category_cd'+value.rowID+'" value="'+value.category_cd+'"></td>'+

                    '<td>'+metertypedescs(value.meter_type)+'</td>'+

                    '<td>'+value.debtor_acct+'</td>'+

                    '<td>'+value.lot_no+'</td>'+

                    '<td><input type="text" name="capacity'+value.rowID+'" id="capacity'+value.rowID+'" value="'+Commas3(value.capacity)+'" style="border:none" readonly></td>'+

                    '<td><input type="text" name="curr_read'+value.rowID+'" id="curr_read'+value.rowID+'" value="'+numberWithCommas(value.curr_read)+'"onchange="computeTrxAmt('+value.rowID+')"></td>'+

                    '<td hidden><input style="border:none" type="text" name="calmet'+value.rowID+'" id="calmet'+value.rowID+'" value="'+value.calculation_method+'"></td>'+

                    '<td><input type="text" name="last_read'+value.rowID+'" id="last_read'+value.rowID+'" value="'+numberWithCommas(value.last_read)+'" style="border:none" readonly></td>'+

                    '<td><label name="usage'+value.rowID+'" id="usage'+value.rowID+'">'+numberWithCommas(value.usage)+'</td>'+

                    '<td><input type="text" name="curr_read_high'+value.rowID+'" id="curr_read_high'+value.rowID+'" value="'+numberWithCommas(value.curr_read_high)+'"onchange="computeTrxAmt('+value.rowID+')"></td>'+

                    '<td>'+numberWithCommas(value.last_read_high)+'</td>'+

                    '<td hidden><input type="text" name="multiplier'+value.rowID+'" id="multiplier'+value.rowID+'" value="'+numberWithCommas(value.multiplier)+'"></td>'+

                    '<td hidden><input type="text" name="usage_high'+value.rowID+'" id="usage_high'+value.rowID+'" value="'+numberWithCommas(value.usage_high)+'"></td>'+

                    '<td hidden><input type="text" name="meter_cd'+value.rowID+'" id="meter_cd'+value.rowID+'" value="'+value.meter_cd+'"></td>'+

                    '<td hidden><input type="text" name="capacity_rate'+value.rowID+'" id="capacity_rate'+value.rowID+'" value="'+value.capacity_rate+'"></td>'+

                    '<td hidden><input type="text" name="capacity_limit'+value.rowID+'" id="capacity_limit'+value.rowID+'" value="'+Commas3(value.capacity_limit)+'"></td>'+

                    '<td hidden><input type="text" name="disc_rate1'+value.rowID+'" id="disc_rate1'+value.rowID+'" value="'+value.disc_rate1+'"></td>'+

                    '<td hidden><input type="text" name="gen_rate'+value.rowID+'" id="gen_rate'+value.rowID+'" value="'+value.gen_rate+'"></td>'+

                    '<td hidden><input type="text" name="dem_rate'+value.rowID+'" id="dem_rate'+value.rowID+'" value="'+value.dem_rate+'"></td>'+

                    '<td hidden><input type="text" name="opr_rate1'+value.rowID+'" id="opr_rate1'+value.rowID+'" value="'+value.opr_rate1+'"></td>'+

                    '<td hidden><input type="text" name="tax_cd'+value.rowID+'" id="tax_cd'+value.rowID+'" value="'+value.tax_cd+'"></td>'+

                    '<td hidden><input type="text" name="stamp_amt1'+value.rowID+'" id="stamp_amt1'+value.rowID+'" value="'+value.stamp_amt1+'"></td>'+

                    '<td hidden><input type="text" name="opr_tax_cd'+value.rowID+'" id="opr_tax_cd'+value.rowID+'" value="'+value.opr_tax_cd+'"></td>'+

                    '<td id="capacity_rate'+value.rowID+'" hidden>'+numberWithCommas(value.capacity_rate)+'</td>'+

                    '<td>'+numberWithCommas(value.usage_high)+'</td>'+

                    '<td><label name="TrxAmount'+value.rowID+'" id="TrxAmount'+value.rowID+'">'+numberWithCommas(value.trx_amt)+'</td>'+

                    '</tr>'
                )
            })
        })

        var html = 
        '<div class="col-md-12">'+
            '<div>'+
                '<table width="100%" id="'+d.row_number+'">'+
                    '<tr>'+
                        '<th>Meter ID</th>'+
                        '<th>Level No</th>'+
                        '<th>Ref no</th>'+
                        '<th>Debtor A/C</th>'+
                        '<th>Lot No</th>'+
                        '<th>Capacity (KVA)</th>'+
                        '<th>Current Read</th>'+
                        '<th>Previous Read</th>'+
                        '<th>Usage</th>'+
                        '<th>Current Read High</th>'+
                        '<th>Previous Read High</th>'+
                        '<th>Usage High</th>'+
                        '<th>Trx Amount</th>'+
                    '</tr>'+
                '</table>'+
            '</div>'+
            // '<button id="importmeterreading" class="btn btn-danger pull-up" value="'+d.meter_type+'" onclick="opentab(this.value)">Import Button</button>'+
            // '<button id="bukapagemeter" class="btn btn-danger pull-up" onclick="bukapage()">Reload Button</button>'+
        '</div>'+
        '<br>'+

        
                
            
        '<br>';
        return html
    }

    function opentab(type){
        $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter_epcon/')?>"+type, function( data ){
            $.each(data, function( index, value){
                $.getJSON( "<?php echo base_url('C_Setting_Mu/update_pm_meter_dtl/')?>"+type+"/"+value.meter_id+"/"+value.curr_read, function( data2 ){
                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter_dtl/')?>"+type+"/"+value.meter_id, function( data3 ){
                        $.each(data3, function( index3, value3){
                            var calmet = value3.calculation_method;
                            var curr_read = value3.curr_read;
                            var last_read = value3.last_read;
                            var multiplier = value3.multiplier;
                            var usage_high = value3.usage_high;
                            var meter_cd = value3.meter_cd;
                            var capacity = value3.capacity;
                            var disc_rate1 = value3.disc_rate1;
                            var gen_rate = value3.gen_rate;
                            var dem_rate = value3.dem_rate;
                            var opr_rate1  = value3.opr_rate1;
                            var tax_cd = value3.tax_cd;
                            var opr_tax_cd = value3.opr_tax_cd;
                            var rowID = value3.rowID;
                            var capacity_limit = value3.capacity_limit;
                            var stamp_amt1 = value3.stamp_amt1;
                            if (calmet == 3){
                                var usage = (+curr_read  - +last_read) * +multiplier;
                                var usage_total = +usage - +usage_high;
                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter/')?>"+meter_cd, function( data4 ){
                                    var max_reading = numberWithCommas(data4.Data[0].max_reading);
                                    var min_amt = numberWithCommas(data4.Data[0].min_amt);
                                    var multiplier = numberWithCommas(data4.Data[0].multiplier);
                                    var other_chrg = data4.Data[0].other_chrg;
                                    var trx_type = data4.Data[0].trx_type;
                                    var add_min = data4.Data[0].add_min;
                                    var category_cd = data4.Data[0].category_cd;
                                    var stamp_duty = data4.Data[0].stamp_duty;
                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter_category/')?>"+category_cd, function( data5 ){
                                        var capacity_rate_rep = numberWithCommas(data5.Data[0].capacity_rate);
                                        var capacity_rate = capacity_rate_rep.replace(/,/g, "");
                                        var capacity_given_flag = data5.Data[0].capacity_given_flag;
                                        var limit_usage_flag = data5.Data[0].limit_usage_flag;
                                        var min_usage_hour = numberWithCommas(data5.Data[0].min_usage_hour);
                                        var usage_hour_noround = +usage_total / +capacity;
                                        var usage_hour = addpoint(usage_hour_noround, 2);
                                        var beban_noround = +capacity * +capacity_rate;
                                        var beban = addpoint(beban_noround, 2);
                                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter_category_dtl/')?>"+category_cd, function( data6 ){
                                            var capacity_multiplier = numberWithCommas(data6.Data[0].capacity_multiplier);
                                            var low_rate_rep = numberWithCommas(data6.Data[0].low_rate);
                                            var high_rate_rep  = numberWithCommas(data6.Data[0].high_rate);
                                            var high_rate = high_rate_rep.replace(/,/g, "");
                                            var low_rate = low_rate_rep.replace(/,/g, "");
                                            if (usage_hour < min_usage_hour){
                                                var usage21 = +capacity * +min_usage_hour * +low_rate;
                                                var usage11 = '0';
                                                var base_amt1 = +usage11 + +usage21;
                                            } else {
                                                var usage11 = +high_rate * +usage_high;
                                                var usage21 = +low_rate * +usage ;
                                                var base_amt1 = +beban + +usage11 + +usage21;
                                            }
                                            var disc_amt = +base_amt1 * (+disc_rate1/100);
                                            if (other_chrg = 'Y') {
                                                if (gen_rate > 0 ) {
                                                    var genrate_noround = +gen_rate /100;
                                                    var genrate_round = addpoint(genrate_noround,2);
                                                    var gen_amt1_noround = (+base_amt1 - +disc_amt) * +genrate_round;
                                                    var gen_amt1 = addpoint(gen_amt1_noround,2);
                                                } else {
                                                    var gen_amt1 = '0';
                                                }
                                                if (dem_rate > 0 ) {
                                                    var dem_rate_noround = +dem_rate/100;
                                                    var dem_rate_round = addpoint(dem_rate_noround,2);
                                                    var dem_amt1 = +dem_rate_round * (+base_amt1 + +gen_amt1);
                                                } else {
                                                    var dem_amt1 = '0';
                                                }
                                            } else {
                                                gen_amt1 = '0';
                                                dem_amt1 = '0';
                                            }
                                            //lanjut
                                            var opr_amt = (+base_amt1 - +disc_amt + +gen_amt1) * (+opr_rate1/100);
                                            // console.log(opr_amt);
                                            if (stamp_duty == 'N'){
                                                var stamp_amt1 = '0';
                                                var trx_amt = +base_amt1 + +gen_amt1 + +dem_amt1 + +stamp_amt1 + +disc_amt + +opr_amt;
                                                if (add_min == 'Y') {
                                                    var trx_amt = +trx_amt + +min_amt;
                                                }
                                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+tax_cd, function( data7 ){
                                                    var incl_excl = data7.Data[0].incl_excl;
                                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data8 ){
                                                        var tax_rate = data8.Data[0].tax_rate;
                                                        // console.log("MERDEKA");
                                                        if (incl_excl == 'I') {
                                                            var tax_amt_noround = (+trx_amt - +stamp_amt1) * (100/(100+ +tax_rate));
                                                            var tax_amt_round = addpoint(tax_amt_noround,2);
                                                            var tax_amt_hasil = (+trx_amt - +stamp_amt1) - tax_amt_round;
                                                            var tax_amt = addpoint(tax_amt_hasil,2);
                                                            
                                                        } else if (incl_excl == 'E'){
                                                            var tax_amt_noround = (+tax_rate/100) * (+trx_amt - +stamp_amt1);
                                                            var tax_amt = addpoint(tax_amt_noround,2);
                                                        }
                                                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+opr_tax_cd, function( data9 ){
                                                            var incl_excl_opr = data9.Data.incl_excl;
                                                            $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+opr_tax_cd, function( data9 ){
                                                                var tax_rate_opr = data9.Data.tax_rate;
                                                                if (incl_excl_opr == 'I'){
                                                                    var opr_tax_amt_noround = +opr_amt * (100/(100 + +tax_rate_opr));
                                                                    var opr_tax_amt_round = addpoint(opr_tax_amt_noround,2);
                                                                    var opr_tax_amt_hasil = +opr_amt - +opr_tax_amt_round;
                                                                    var opr_tax_amt = addpoint(tax_amt_hasil,2);
                                                                } else if (incl_excl_opr == 'E'){
                                                                    var opr_tax_amt_noround = (+tax_rate_opr/100) * +opr_amt;
                                                                    var opr_tax_amt = addpoint(opr_tax_amt_noround,2);
                                                                }
                                                                var new_usage = usage.toFixed(3);
                                                                var new_trx_amt = trx_amt.toFixed(3);
                                                                var trx_amt_view = numberWithCommas(new_trx_amt);
                                                                var usage_range1 = '0';
                                                                var disc_amt2 = '0';
                                                                var opr_amt2 = '0';                                                                
                                                                high_rate_eze = addpoint(data6.Data[0].high_rate, 0);
                                                                low_rate_eze = addpoint(data6.Data[0].low_rate, 0);
                                                                $('#curr_read'+rowID+'').val(curr_read);
                                                                document.getElementById('TrxAmount'+rowID+'').innerHTML = trx_amt_view;
                                                                document.getElementById('usage'+rowID+'').innerHTML = new_usage;
                                                                $.getJSON( "<?php echo base_url('C_Setting_Mu/save_pm_meter_dtl2/')?>"+usage+"/"+capacity+"/"+usage11+"/"+usage21+"/"+usage_range1+"/"+high_rate_eze+"/"+low_rate_eze+"/"+base_amt1+"/"+trx_amt+"/"+tax_amt+"/"+disc_amt+"/"+disc_amt2+"/"+opr_amt+"/"+opr_amt2+"/"+rowID, function( data99 ){

                                                                })
                                                            })
                                                        })
                                                        // location.reload();
                                                    })
                                                })
                                            } 
                                            else if (stamp_duty == 'Y') {
                                                var invoice = (+base_amt1 - +disc_amt + +opr_amt + +gen_amt1);
                                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_stamp/')?>"+invoice, function( data7 ){
                                                    var stamp_amt1 = data7.stamp_duty;
                                                    var trx_amt = +base_amt1 + +gen_amt1 + +dem_amt1 + +stamp_amt1 + +disc_amt + +opr_amt;
                                                    if (add_min == 'Y') {
                                                        var trx_amt = +trx_amt + +min_amt;
                                                    }
                                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+tax_cd, function( data8 ){
                                                        var incl_excl = data8.Data[0].incl_excl;
                                                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data9 ){
                                                            var tax_rate = data9.Data[0].tax_rate;
                                                            if (incl_excl == 'I') {
                                                                var tax_amt_noround = (+trx_amt - +stamp_amt1) * (100/(100+ +tax_rate));
                                                                // var tax_amt_round = Math.ceil(tax_amt_noround*100)/100;
                                                                var tax_amt_round = addpoint(tax_amt_noround,2);
                                                                var tax_amt_hasil = (+trx_amt - +stamp_amt1) - tax_amt_round;
                                                                var tax_amt = addpoint(tax_amt_hasil,2);
                                                                
                                                            } else if (incl_excl == 'E'){
                                                                var tax_amt_noround = (+tax_rate/100) * (+trx_amt - +stamp_amt1);
                                                                // var tax_amt = Math.ceil(tax_amt_noround*100)/100;
                                                                var tax_amt = addpoint(tax_amt_noround,2);
                                                            }
                                                            $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+opr_tax_cd, function( data10 ){
                                                                var incl_excl_opr = data10.Data[0].incl_excl;
                                                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+opr_tax_cd, function( data11 ){
                                                                    var tax_rate_opr = data11.Data[0].tax_rate;
                                                                    if (incl_excl_opr == 'I') {
                                                                        var opr_tax_amt_noround = +opr_amt * (100/(100 + +tax_rate_opr));
                                                                        // var opr_tax_amt_round = Math.ceil(opr_tax_amt_noround*100)/100;
                                                                        var opr_tax_amt_round = addpoint(opr_tax_amt_noround,2);
                                                                        var opr_tax_amt_hasil = +opr_amt - +opr_tax_amt_round;
                                                                        var opr_tax_amt = addpoint(tax_amt_hasil,2);
                                                                    } else if (incl_excl_opr == 'E'){
                                                                        var opr_tax_amt_noround = (+tax_rate_opr/100) * +opr_amt;
                                                                        // var opr_tax_amt = Math.ceil(opr_tax_amt_noround*100)/100;
                                                                        var opr_tax_amt = addpoint(opr_tax_amt_noround,2);
                                                                    }
                                                                    var new_usage = usage.toFixed(3);
                                                                    var new_trx_amt = trx_amt.toFixed(3);
                                                                    var trx_amt_view = numberWithCommas(new_trx_amt);
                                                                    var usage_range1 = '0';
                                                                    var disc_amt2 = '0';
                                                                    var opr_amt2 = '0';                                                                
                                                                    high_rate_eze = addpoint(data6.Data[0].high_rate, 0);
                                                                    low_rate_eze = addpoint(data6.Data[0].low_rate, 0);
                                                                    $('#curr_read'+rowID+'').val(curr_read);
                                                                    document.getElementById('TrxAmount'+rowID+'').innerHTML = trx_amt_view;
                                                                    document.getElementById('usage'+rowID+'').innerHTML = new_usage;
                                                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/save_pm_meter_dtl_cal3/')?>"+usage+"/"+capacity+"/"+usage11+"/"+usage21+"/"+usage_range1+"/"+high_rate_eze+"/"+low_rate_eze+"/"+base_amt1+"/"+trx_amt+"/"+tax_amt+"/"+disc_amt+"/"+disc_amt2+"/"+opr_amt+"/"+opr_amt2+"/"+rowID, function( data99 ){

                                                                    })
                                                                })
                                                            })
                                                        })
                                                    })
                                                })
                                            }
                                        })
                                    })
                                })
                                // alert(usage11);
                                
                            }// 
                            else if (calmet == 1){
                                var usage = (+curr_read  - +last_read)
                                var usage_total = +usage - +usage_high;
                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter/')?>"+meter_cd, function( data4 ){
                                    var max_reading = numberWithCommas(data4.Data[0].max_reading);
                                    var min_amt = numberWithCommas(data4.Data[0].min_amt);
                                    var multiplier = numberWithCommas(data4.Data[0].multiplier);
                                    var other_chrg = data4.Data[0].other_chrg;
                                    var trx_type = data4.Data[0].trx_type;
                                    var add_min = data4.Data[0].add_min;
                                    var category_cd = data4.Data[0].category_cd;
                                    var stamp_duty = data4.Data[0].stamp_duty;
                                    var sewage_flag = data4.Data[0].sewage_flaq;
                                    var sewage_percent = numberWithCommas(data4.Data[0].sewage_percent);
                                    var sewage_amt = numberWithCommas(data4.Data[0].sewage_amt);
                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter_category/')?>"+category_cd, function( data5 ){
                                        var capacity_rate = numberWithCommas(data5.Data[0].capacity_rate);
                                        var capacity_flag = data5.Data[0].capacity_given_flag;
                                        var limit_flag = data5.Data[0].limit_usage_flag;
                                        if (capacity_flag == 'N' && limit_flag == 'N') {
                                            var beban = +capacity * +capacity_rate;
                                        } else if (capacity_flag == 'Y') {
                                            if (capacity <= 0) {
                                                 alert("Capacity cannot be 0");
                                                 var beban = '0';
                                                 var usage = '0';
                                            } else {
                                                var usage = ((+capacity - +capacity_limit)/ +capacity) * +usage ;
                                                var beban = (+capacity - +capacity_limit) * +capacity_rate;
                                            }
                                        }
                                        var pass = '1';
                                        var pemakaian = '0';
                                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter_category_dtl/')?>"+category_cd, function( data6 ){
                                            var line = data6.Data[0].line_no;
                                            var start_range = data6.Data[0].start_range;
                                            var end_range = data6.Data[0].end_range;
                                            var low_rate = data6.Data[0].low_rate;
                                            var high_rate = data6.Data[0].high_rate;
                                            if (start_range == 0) {
                                                var range = +end_range;
                                            } else {
                                                var range = (+end_range - +start_range) +1
                                            }
                                            if (usage_total <= range) {
                                                if (pass == 1 ) {
                                                    var usage11 = +usage * +low_rate;
                                                    var usage21 = '0.00';
                                                    var usage31 = '0.00';
                                                    var usage_range1 = end_range;
                                                    var usage_rate1 = low_rate;
                                                }
                                                if (pass == 2 ) {
                                                    var usage21 = +usage * +low_rate;
                                                    var usage11 = '0.00';
                                                    var usage31 = '0.00';
                                                    var usage_range2 = end_range;
                                                    var usage_rate2 = low_rate;
                                                }
                                                if (pass == 3 ) {
                                                    var usage31 = +usage * +low_rate;
                                                    var usage21 = '0.00';
                                                    var usage11 = '0.00';
                                                    var usage_range3 = end_range;
                                                    var usage_rate3 = low_rate;
                                                }
                                                var pemakaian2 = +pemakaian + (+usage_total * +low_rate)
                                                var usage2 = '0';
                                            } else {
                                                if (pass == 1) {
                                                    var usage11 = +range * +low_rate;
                                                    var usage21 = '0.00';
                                                    var usage31 = '0.00';
                                                    var usage_range1 = end_range;
                                                    var usage_rate1 = low_rate;
                                                }
                                                if (pass == 2) {
                                                    var usage21 = +range * +low_rate;
                                                    var usage11 = '0.00';
                                                    var usage31 = '0.00';
                                                    var usage_range2 = end_range;
                                                    var usage_rate2 = low_rate;
                                                }
                                                if (pass == 3) {
                                                    var usage31 = +range * +low_rate;
                                                    var usage21 = '0.00';
                                                    var usage11 = '0.00';
                                                    var usage_range3 = end_range;
                                                    var usage_rate3 = low_rate;
                                                }
                                            }
                                            pass++;
                                            var base_amt1 = +beban + +pemakaian2;
                                            var disc_amt = +base_amt1 * (+disc_rate1 / 100);
                                            if (other_chrg == 'Y') {
                                                if (gen_rate > 0) {
                                                    var gen_amt1 = (+base_amt1 - +disc_amt) * (+gen_rate/100);
                                                } else {
                                                    var gen_amt1 ='0';
                                                }
                                                if (dem_rate > 0) {
                                                    var dem_amt1 = (+dem_rate/100) * (+base_amt1 + +gen_amt1);
                                                } else {
                                                    var dem_amt1 ='0';
                                                }
                                            } else {
                                                var gen_amt1 = '0';
                                                var dem_amt1 = '0';
                                            }
                                            if (stamp_duty == 'Y') {
                                                var invoice = (+base_amt1 - +disc_amt + +opr_amt + +gen_amt1);
                                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_stamp/')?>"+invoice, function( data7 ){
                                                    var stamp_amt1 = data8.stamp_duty;
                                                    if (sewage_flag == 'Y') {
                                                        var trx_amt = +trx_amt + ((+sewage_percent/100) * +pemakaian2 * +sewage_amt);
                                                        //ini gimana aturannya
                                                    }
                                                    if (add_min == 'Y') {
                                                        var trx_amt = +trx_amt + +min_amt;
                                                        //ini gimana aturannya
                                                    }
                                                    var disc_amt2 ='0';
                                                    var opr_amt2 ='0';
                                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+tax_cd, function( data8 ){
                                                        var incl_excl = data4.Data[0].incl_excl;
                                                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data9 ){
                                                            var tax_rate = data9.Data[0].tax_rate;
                                                            if (incl_excl == "E"){
                                                                var tax_amt = (+tax_rate/100) * (+trx_amt - +stamp_amt1);
                                                            } else {
                                                                var tax_amt = (+trx_amt - +stamp_amt1) - ((+trx_amt - +stamp_amt1) * (100/(100 + +tax_rate)));
                                                            }
                                                            if (opr_rate1 == 0){
                                                                var opr_amt = '0';
                                                            } else {
                                                                var opr_amt = ((+base_amt1 + +gen_amt1 + +dem_amt1) * +opr_rate/100);
                                                            }
                                                            var trx_amt_new = +trx_amt + + opr_amt;
                                                            $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+opr_tax_cd, function( data10 ){
                                                                var incl_excl_opr = data10.Data[0].incl_excl;
                                                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data11 ){
                                                                    var tax_rate_opr = data11.Data[0].tax_rate;
                                                                    if (incl_excl_opr == 'E') {
                                                                        var opr_tax_amt = (+tax_rate_opr/100) * +opr_amt;
                                                                    } else {
                                                                        var opr_tax_amt = +opr_amt - (+opr_amt * (100/(100 + +tax_rate_opr)));
                                                                    }
                                                                    var new_trx_amt = trx_amt.toFixed(2);
                                                                    var trx_amt_view = numberWithCommas(new_trx_amt);
                                                                    var current_read = +curr_read+'.000';
                                                                    var usage11_new = usage11.toFixed(2);
                                                                    var low_rate_new = numberWithCommas(low_rate);
                                                                    var high_rate_new = numberWithCommas(high_rate); 
                                                                    document.getElementById('TrxAmount'+rowID+'').innerHTML = trx_amt_view;
                                                                    document.getElementById('usage'+rowID+'').innerHTML = usage_total;      
                                                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/save_pm_meter_dtl_cal1/')?>"+usage_total+"/"+trx_amt+"/"+usage_range1+"/"+low_rate+"/"+high_rate+"/"+base_amt1+"/"+tax_amt+"/"+disc_amt+"/"+disc_amt2+"/"+opr_amt+"/"+opr_amt2+"/"+rowID, function( data99 ){

                                                                    })
                                                                })
                                                            })
                                                        })
                                                    })
                                                })
                                            } else if (stamp_duty == 'N'){
                                                var stamp_amt1 = '0';
                                                var trx_amt = +base_amt1 + +gen_amt1 + +dem_amt1;
                                            }
                                            if (sewage_flag == 'Y') {
                                                var trx_amt = trx_amt + ((+sewage_percent/100) * +pemakaian2 * +sewage_amt);
                                                //ini gimana aturannya
                                            }
                                            if (add_min == 'Y') {
                                                var trx_amt = trx_amt + +min_amt;
                                                //ini gimana aturannya
                                            }
                                            var disc_amt2 ='0';
                                            var opr_amt2 ='0';
                                            $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+tax_cd, function( data7 ){
                                                var incl_excl = data7.Data[0].incl_excl;
                                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data8 ){
                                                    var tax_rate = data8.Data[0].tax_rate;
                                                    if (incl_excl == "E"){
                                                        var tax_amt = (+tax_rate/100) * (+trx_amt - +stamp_amt1);
                                                    } else {
                                                        var tax_amt = (+trx_amt - +stamp_amt1) - ((+trx_amt - +stamp_amt1) * (100/(100 + +tax_rate)));
                                                    }
                                                    if (opr_rate1 == 0){
                                                        var opr_amt = '0';
                                                    } else {
                                                        var opr_amt = ((+base_amt1 + +gen_amt1 + +dem_amt1) * +opr_rate/100);
                                                    }
                                                    var trx_amt_new = +trx_amt + + opr_amt;
                                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+opr_tax_cd, function( data9 ){
                                                        var incl_excl_opr = data9.Data[0].incl_excl;
                                                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data10 ){
                                                            var tax_rate_opr = data7.Data[0].tax_rate;
                                                            if (incl_excl_opr == 'E') {
                                                                var opr_tax_amt = (+tax_rate_opr/100) * +opr_amt;
                                                            } else {
                                                                var opr_tax_amt = +opr_amt - (+opr_amt * (100/(100 + +tax_rate_opr)));
                                                                // var gigi = (100/100 + +tax_rate_opr);
                                                            }
                                                            var new_trx_amt = trx_amt.toFixed(2);
                                                            var trx_amt_view = numberWithCommas(new_trx_amt);
                                                            var current_read = +curr_read+'.000';
                                                            var usage11_new = usage11.toFixed(2);
                                                            var low_rate_new = numberWithCommas(low_rate);
                                                            var high_rate_new = numberWithCommas(high_rate);
                                                            var usage_view = usage_total+'.000';
                                                            var usage_21 = '0';
                                                            $('#curr_read'+rowID+'').val(curr_read);
                                                            document.getElementById('TrxAmount'+rowID+'').innerHTML = trx_amt_view;
                                                            document.getElementById('usage'+rowID+'').innerHTML = usage_view;
                                                            $.getJSON( "<?php echo base_url('C_Setting_Mu/save_pm_meter_dtl_cal1/')?>"+usage_total+"/"+trx_amt+"/"+usage_range1+"/"+low_rate+"/"+high_rate+"/"+base_amt1+"/"+tax_amt+"/"+disc_amt+"/"+disc_amt2+"/"+opr_amt+"/"+opr_amt2+"/"+rowID, function( data99 ){

                                                            })
                                                        })
                                                    })
                                                })
                                            })
                                        })
                                    })
                                })
                            }
                            // location.reload();
                        })
                    })
                })
            })
        })
    }

    function bukapage(){
        location.reload();
    }

    function metertypedescs(mt) {
        if (mt=='E' || mt=='e') {
            return 'ELECTRICITY'
        } else if (mt=='W' || mt=='w'){
            return 'WATER'
        } else {
            return 'GAS'
        }
    }

    function numberWithCommas(x) {
        if (x==null || x=='' || x=='.000' || x=='.00') {
            return '0.000'
        }
        else{
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
        }
    }

    function Commas3(x) {
        if (x==null || x=='' || x=='.000' || x=='.00') {
            return '0.00'
        }
        else{
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
        }
    }

    function WithCommas(x) {
        if (x==null || x=='' || x=='.000' || x=='.00') {
            return '0000'
        }
        else{
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
        }
    }

    function addZeroes(num) {
        var value = Number(num);
        var res = num.split(".");
        if(res.length == 1 || (res[1].length < 3)) {
            value = value.toFixed(2);
        }
        return value
    }

    function addpoint(num, places) { 
        return +(Math.round(num + "e+" + places)  + "e-" + places);
    }

    function computeTrxAmt(d){
        var calmet = document.getElementById('calmet'+d+'').value;
        var entity_cd = document.getElementById('entity_cd'+d+'').value;
        var project_no = document.getElementById('project_no'+d+'').value;
        var category_cd = document.getElementById('category_cd'+d+'').value;
        var meter_cd = document.getElementById('meter_cd'+d+'').value;
        var capacity = document.getElementById('capacity'+d+'').value;
        var capacity_limit = document.getElementById('capacity_limit'+d+'').value;
        var gen_rate = document.getElementById('gen_rate'+d+'').value;
        var dem_rate = document.getElementById('dem_rate'+d+'').value;
        var tax_cd = document.getElementById('tax_cd'+d+'').value;
        var curr_read = document.getElementById('curr_read'+d+'').value;
        var last_read = document.getElementById('last_read'+d+'').value;
        var multiplier = document.getElementById('multiplier'+d+'').value;
        var usage_high = document.getElementById('usage_high'+d+'').value;
        var capacity_rate = document.getElementById('capacity_rate'+d+'').value;
        var disc_rate1 = document.getElementById('disc_rate1'+d+'').value;
        var opr_rate1 = document.getElementById('opr_rate1'+d+'').value;
        var usagenya = document.getElementById('usage'+d+'').value;
        var usage = numberWithCommas(usagenya);
        var stamp_amt1 = document.getElementById('stamp_amt1'+d+'').value;
        var opr_tax_cd = document.getElementById('opr_tax_cd'+d+'').value;
        if (curr_read < last_read) {
            window.alert ("Current Reading must be Greater than the last meter reading");
        } else if (curr_read >= last_read) {
            if (calmet == '3'){
                var usage = (+curr_read  - +last_read) * +multiplier;
                var usage_total = +usage - +usage_high;
                $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter/')?>"+meter_cd, function( data ) {
                    var max_reading = numberWithCommas(data.Data[0].max_reading);
                    var min_amt = numberWithCommas(data.Data[0].min_amt);
                    var multiplier = numberWithCommas(data.Data[0].multiplier);
                    var other_chrg = data.Data[0].other_chrg;
                    var trx_type = data.Data[0].trx_type;
                    var add_min = data.Data[0].add_min;
                    var category_cd = data.Data[0].category_cd;
                    var stamp_duty = data.Data[0].stamp_duty;
                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter_category/')?>"+category_cd, function( data2 ) {
                        var capacity_rate_rep = numberWithCommas(data2.Data[0].capacity_rate);
                        var capacity_rate = capacity_rate_rep.replace(/,/g, "");
                        var capacity_given_flag = data2.Data[0].capacity_given_flag;
                        var limit_usage_flag = data2.Data[0].limit_usage_flag;
                        var min_usage_hour = numberWithCommas(data2.Data[0].min_usage_hour);
                        var usage_hour_noround = +usage_total / +capacity;
                        // var usage_hour = Math.ceil(usage_hour_noround*100)/100;
                        var usage_hour = addpoint(usage_hour_noround, 2);
                        var beban_noround = +capacity * +capacity_rate;
                        // var beban = Math.ceil(beban_noround*100)/100;
                        var beban = addpoint(beban_noround, 2);
                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter_category_dtl/')?>"+category_cd, function( data3 ) {
                            var capacity_multiplier = numberWithCommas(data3.Data[0].capacity_multiplier);
                            var low_rate_rep = numberWithCommas(data3.Data[0].low_rate);
                            var high_rate_rep  = numberWithCommas(data3.Data[0].high_rate);
                            var high_rate = high_rate_rep.replace(/,/g, "");
                            var low_rate = low_rate_rep.replace(/,/g, "");
                            if (usage_hour < min_usage_hour){
                                var usage21 = +capacity * +min_usage_hour * +low_rate;
                                var usage11 = '0';
                                var base_amt1 = +usage11 + +usage21;
                            } else {
                                var usage11 = +high_rate * +usage_high;
                                var usage21 = +low_rate * +usage ;
                                var base_amt1 = +beban + +usage11 + +usage21;
                            }
                            var disc_amt = +base_amt1 * (+disc_rate1/100);
                            if (other_chrg = 'Y') {
                                if (gen_rate > 0 ) {
                                    var genrate_noround = +gen_rate /100;
                                    // var genrate_round = Math.ceil(genrate_noround*100)/100;
                                    var genrate_round = addpoint(genrate_noround,2);
                                    var gen_amt1_noround = (+base_amt1 - +disc_amt) * +genrate_round;
                                    // var gen_amt1 = Math.ceil(gen_amt1_noround*100)/100;
                                    var gen_amt1 = addpoint(gen_amt1_noround,2);
                                } else {
                                    var gen_amt1 = '0';
                                }
                                if (dem_rate > 0 ) {
                                    var dem_rate_noround = +dem_rate/100;
                                    // var dem_rate_round = Math.ceil(dem_rate_noround*100)/100;
                                    var dem_rate_round = addpoint(dem_rate_noround,2);
                                    var dem_amt1 = +dem_rate_round * (+base_amt1 + +gen_amt1);
                                } else {
                                    var dem_amt1 = '0';
                                }
                            } else {
                                gen_amt1 = '0';
                                dem_amt1 = '0';
                            }
                            var opr_amt = (+base_amt1 - +disc_amt + +gen_amt1) * (+opr_rate1/100);
                            if (stamp_duty == 'N') {
                                var stamp_amt1 = '0';
                                var trx_amt = +base_amt1 + +gen_amt1 + +dem_amt1 + +stamp_amt1 + +disc_amt + +opr_amt;
                                if (add_min == 'Y') {
                                    var trx_amt = +trx_amt + +min_amt;
                                }
                                // console.log(tax_cd);
                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+tax_cd, function( data6 ){
                                    var incl_excl = data6.Data[0].incl_excl;
                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data7 ){
                                        var tax_rate = data7.Data[0].tax_rate;
                                        if (incl_excl == 'I') {
                                            var tax_amt_noround = (+trx_amt - +stamp_amt1) * (100/(100+ +tax_rate));
                                            // var tax_amt_round = Math.ceil(tax_amt_noround*100)/100;
                                            var tax_amt_round = addpoint(tax_amt_noround,2);
                                            var tax_amt_hasil = (+trx_amt - +stamp_amt1) - tax_amt_round;
                                            var tax_amt = addpoint(tax_amt_hasil,2);
                                            
                                        } else if (incl_excl == 'E'){
                                            var tax_amt_noround = (+tax_rate/100) * (+trx_amt - +stamp_amt1);
                                            // var tax_amt = Math.ceil(tax_amt_noround*100)/100;
                                            var tax_amt = addpoint(tax_amt_noround,2);
                                        }
                                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+opr_tax_cd, function( data8 ){
                                            var incl_excl_opr = data8.Data.incl_excl;
                                            $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+opr_tax_cd, function( data9 ) {
                                                var tax_rate_opr = data9.Data.tax_rate;
                                                if (incl_excl_opr == 'I'){
                                                    var opr_tax_amt_noround = +opr_amt * (100/(100 + +tax_rate_opr));
                                                    // var opr_tax_amt_round = Math.ceil(opr_tax_amt_noround*100)/100;
                                                    var opr_tax_amt_round = addpoint(opr_tax_amt_noround,2);
                                                    var opr_tax_amt_hasil = +opr_amt - +opr_tax_amt_round;
                                                    var opr_tax_amt = addpoint(tax_amt_hasil,2);
                                                } else if (incl_excl_opr == 'E'){
                                                    var opr_tax_amt_noround = (+tax_rate_opr/100) * +opr_amt;
                                                    // var opr_tax_amt = Math.ceil(opr_tax_amt_noround*100)/100;
                                                    var opr_tax_amt = addpoint(opr_tax_amt_noround,2);
                                                }
                                                var new_usage = usage.toFixed(3);
                                                var new_trx_amt = trx_amt.toFixed(3);
                                                var trx_amt_view = numberWithCommas(new_trx_amt);
                                                document.getElementById('TrxAmount'+d+'').innerHTML = trx_amt_view;
                                                document.getElementById('usage'+d+'').innerHTML = new_usage;
                                                var current_read = +curr_read+'.000';
                                                var usage21_new = usage21.toFixed(2);
                                                var baseamt_new = base_amt1.toFixed(2);
                                                var trx_amt_new = trx_amt.toFixed(2);
                                                var disc_amt_new = disc_amt.toFixed(2);
                                                var opr_amt_new = opr_amt.toFixed(2);
                                                var usage_range1 = '0.00';
                                                var disc_amt2 = '0.00';
                                                var opr_amt2 = '0.00';
                                                $.ajax({
                                                    url : "<?php echo base_url('C_Setting_Mu/save_meterreading_detail');?>/",
                                                    method : 'POST',
                                                    data: {'curr_read': current_read, 'usage': new_usage,  'capacity': capacity, 'capacity_limit': capacity_limit, 'usage11' : usage11, 'usage21': usage21_new, 'usage_range1': usage_range1, 'usage_rate1': high_rate, 'usage_rate2': low_rate, 'base_amt1': baseamt_new, 'trx_amt': trx_amt_new, 'tax_amt': tax_amt, 'disc_amt1': disc_amt,'disc_amt2': disc_amt2, 'opr_amt1': opr_amt,'opr_amt2': opr_amt2, 'rowID': d},
                                                    success:function(event, data){
                                                        // alert ("Database Update");
                                                    }
                                                });
                                            });  
                                        });
                                    });
                                });
                            }
                            else if (stamp_duty == 'Y') {
                                var invoice = (+base_amt1 - +disc_amt + +opr_amt + +gen_amt1);
                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_stamp/')?>"+invoice, function( data5 ){
                                    var stamp_amt1 = data5.stamp_duty;
                                    var trx_amt = +base_amt1 + +gen_amt1 + +dem_amt1 + +stamp_amt1 + +disc_amt + +opr_amt;
                                    if (add_min == 'Y') {
                                        var trx_amt = +trx_amt + +min_amt;
                                    }
                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+tax_cd, function( data6 ){
                                        var incl_excl = data6.Data[0].incl_excl;
                                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data7 ){
                                            var tax_rate = data7.Data[0].tax_rate;
                                            if (incl_excl == 'I') {
                                                var tax_amt_noround = (+trx_amt - +stamp_amt1) * (100/(100+ +tax_rate));
                                                // var tax_amt_round = Math.ceil(tax_amt_noround*100)/100;
                                                var tax_amt_round = addpoint(tax_amt_noround,2);
                                                var tax_amt_hasil = (+trx_amt - +stamp_amt1) - tax_amt_round;
                                                var tax_amt = addpoint(tax_amt_hasil,2);
                                                
                                            } else if (incl_excl == 'E'){
                                                var tax_amt_noround = (+tax_rate/100) * (+trx_amt - +stamp_amt1);
                                                // var tax_amt = Math.ceil(tax_amt_noround*100)/100;
                                                var tax_amt = addpoint(tax_amt_noround,2);
                                            }
                                            $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+opr_tax_cd, function( data8 ){
                                                var incl_excl_opr = data6.Data[0].incl_excl;
                                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+opr_tax_cd, function( data9 ){
                                                    var tax_rate_opr = data9.Data[0].tax_rate;
                                                    if (incl_excl_opr == 'I') {
                                                        var opr_tax_amt_noround = +opr_amt * (100/(100 + +tax_rate_opr));
                                                        // var opr_tax_amt_round = Math.ceil(opr_tax_amt_noround*100)/100;
                                                        var opr_tax_amt_round = addpoint(opr_tax_amt_noround,2);
                                                        var opr_tax_amt_hasil = +opr_amt - +opr_tax_amt_round;
                                                        var opr_tax_amt = addpoint(tax_amt_hasil,2);
                                                    } else if (incl_excl_opr == 'E'){
                                                        var opr_tax_amt_noround = (+tax_rate_opr/100) * +opr_amt;
                                                        // var opr_tax_amt = Math.ceil(opr_tax_amt_noround*100)/100;
                                                        var opr_tax_amt = addpoint(opr_tax_amt_noround,2);
                                                    }
                                                    var new_usage = usage.toFixed(3);
                                                    var new_trx_amt = trx_amt.toFixed(3);
                                                    var trx_amt_view = numberWithCommas(new_trx_amt);
                                                    document.getElementById('TrxAmount'+d+'').innerHTML = trx_amt_view;
                                                    document.getElementById('usage'+d+'').innerHTML = new_usage;
                                                    var current_read = +curr_read+'.000';
                                                    var usage21_new = usage21.toFixed(2);
                                                    var baseamt_new = base_amt1.toFixed(2);
                                                    var trx_amt_new = trx_amt.toFixed(2);
                                                    var disc_amt_new = disc_amt.toFixed(2);
                                                    var opr_amt_new = opr_amt.toFixed(2);
                                                    var usage_range1 = '0.00';
                                                    var disc_amt2 = '0.00';
                                                    var opr_amt2 = '0.00';
                                                    $.ajax({
                                                        url : "<?php echo base_url('C_Setting_Mu/save_meterreading_detail');?>/",
                                                        method : 'POST',
                                                        data: {'curr_read': current_read, 'usage': new_usage,  'capacity': capacity, 'capacity_limit': capacity_limit, 'usage11' : usage11, 'usage21': usage21_new, 'usage_range1': usage_range1, 'usage_rate1': high_rate, 'usage_rate2': low_rate, 'base_amt1': baseamt_new, 'trx_amt': trx_amt_new, 'tax_amt': tax_amt, 'disc_amt1': disc_amt,'disc_amt2': disc_amt2, 'opr_amt1': opr_amt,'opr_amt2': opr_amt2, 'rowID': d},
                                                        success:function(event, data){
                                                            // alert ("Database Update");
                                                        }
                                                    });
                                                }); // ini batas
                                            });
                                        });
                                    });
                                });
                            }
                        });
                    });
                });
            } //if (calmet == '3')
            else if (calmet == '1'){
                var usage = (+curr_read  - +last_read)
                var usage_total = +usage - +usage_high;
                $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter/')?>"+meter_cd, function( data ) {
                    var max_reading = numberWithCommas(data.Data[0].max_reading);
                    var min_amt = numberWithCommas(data.Data[0].min_amt);
                    var multiplier = numberWithCommas(data.Data[0].multiplier);
                    var other_chrg = data.Data[0].other_chrg;
                    var trx_type = data.Data[0].trx_type;
                    var add_min = data.Data[0].add_min;
                    var category_cd = data.Data[0].category_cd;
                    var stamp_duty = data.Data[0].stamp_duty;
                    var sewage_flag = data.Data[0].sewage_flaq;
                    var sewage_percent = numberWithCommas(data.Data[0].sewage_percent);
                    var sewage_amt = numberWithCommas(data.Data[0].sewage_amt);
                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter_category/')?>"+category_cd, function( data2 ) {
                        var capacity_rate = numberWithCommas(data2.Data[0].capacity_rate);
                        var capacity_flag = data2.Data[0].capacity_given_flag;
                        var limit_flag = data2.Data[0].limit_usage_flag;
                        if (capacity_flag == 'N' && limit_flag == 'N') {
                            var beban = +capacity * +capacity_rate;
                        } else if (capacity_flag == 'Y') {
                            if (capacity <= 0) {
                                 alert("Capacity cannot be 0");
                                 var beban = '0';
                                 var usage = '0';
                            } else {
                                var usage = ((+capacity - +capacity_limit)/ +capacity) * +usage ;
                                var beban = (+capacity - +capacity_limit) * +capacity_rate;
                            }
                        }
                        var pass = '1';
                        var pemakaian = '0';
                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getpm_meter_category_dtl/')?>"+category_cd, function( data3 ) {
                            var line = data3.Data[0].line_no;
                            var start_range = data3.Data[0].start_range;
                            var end_range = data3.Data[0].end_range;
                            var low_rate = data3.Data[0].low_rate;
                            var high_rate = data3.Data[0].high_rate;
                            if (start_range == 0) {
                                var range = +end_range;
                            } else {
                                var range = (+end_range - +start_range) +1
                            }
                            // console.log(usage_total);
                            // console.log(range);
                            if (usage_total <= range) {
                                alert("MASUK")
                                if (pass == 1 ) {
                                    var usage11 = +usage * +low_rate;
                                    var usage21 = '0.00';
                                    var usage31 = '0.00';
                                    var usage_range1 = end_range;
                                    var usage_rate1 = low_rate;
                                }
                                if (pass == 2 ) {
                                    var usage21 = +usage * +low_rate;
                                    var usage11 = '0.00';
                                    var usage31 = '0.00';
                                    var usage_range2 = end_range;
                                    var usage_rate2 = low_rate;
                                }
                                if (pass == 3 ) {
                                    var usage31 = +usage * +low_rate;
                                    var usage21 = '0.00';
                                    var usage11 = '0.00';
                                    var usage_range3 = end_range;
                                    var usage_rate3 = low_rate;
                                }
                                var pemakaian2 = +pemakaian + (+usage_total * +low_rate)
                                var usage2 = '0';
                                alert(pemakaian2);
                            } else {
                                 if (pass == 1) {
                                    var usage11 = +range * +low_rate;
                                    var usage21 = '0.00';
                                    var usage31 = '0.00';
                                    var usage_range1 = end_range;
                                    var usage_rate1 = low_rate;
                                 }
                                 if (pass == 2) {
                                    var usage21 = +range * +low_rate;
                                    var usage11 = '0.00';
                                    var usage31 = '0.00';
                                    var usage_range2 = end_range;
                                    var usage_rate2 = low_rate;
                                 }
                                 if (pass == 3) {
                                    var usage31 = +range * +low_rate;
                                    var usage21 = '0.00';
                                    var usage11 = '0.00';
                                    var usage_range3 = end_range;
                                    var usage_rate3 = low_rate;
                                 }
                            }
                            pass++;
                            var base_amt1 = +beban + +pemakaian2;
                            var disc_amt = +base_amt1 * (+disc_rate1 / 100);
                            if (other_chrg == 'Y') {
                                if (gen_rate > 0) {
                                    var gen_amt1 = (+base_amt1 - +disc_amt) * (+gen_rate/100);
                                } else {
                                    var gen_amt1 ='0';
                                }
                                if (dem_rate > 0) {
                                    var dem_amt1 = (+dem_rate/100) * (+base_amt1 + +gen_amt1);
                                } else {
                                    var dem_amt1 ='0';
                                }
                            } else {
                                var gen_amt1 = '0';
                                var dem_amt1 = '0';
                            }
                            if (stamp_duty == 'Y') { //04 Maret 2019
                                var invoice = (+base_amt1 - +disc_amt + +opr_amt + +gen_amt1);
                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_stamp/')?>"+invoice, function( data8 ) {
                                    var stamp_amt1 = data5.stamp_duty;
                                    if (sewage_flag == 'Y') {
                                        var trx_amt = +trx_amt + ((+sewage_percent/100) * +pemakaian2 * +sewage_amt);
                                        //ini gimana aturannya
                                    }
                                    if (add_min == 'Y') {
                                        var trx_amt = +trx_amt + +min_amt;
                                        //ini gimana aturannya
                                    }
                                    var disc_amt2 ='0';
                                    var opr_amt2 ='0';
                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+tax_cd, function( data4 ) {
                                        var incl_excl = data4.Data[0].incl_excl;
                                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data5 ) {
                                            var tax_rate = data5.Data[0].tax_rate;
                                            if (incl_excl == "E"){
                                                var tax_amt = (+tax_rate/100) * (+trx_amt - +stamp_amt1);
                                            } else {
                                                var tax_amt = (+trx_amt - +stamp_amt1) - ((+trx_amt - +stamp_amt1) * (100/(100 + +tax_rate)));
                                            }
                                            if (opr_rate1 == 0){
                                                var opr_amt = '0';
                                            } else {
                                                var opr_amt = ((+base_amt1 + +gen_amt1 + +dem_amt1) * +opr_rate/100);
                                            }
                                            var trx_amt_new = +trx_amt + + opr_amt;
                                            $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+opr_tax_cd, function( data6 ) {
                                                var incl_excl_opr = data6.Data[0].incl_excl;
                                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data7 ) {
                                                    var tax_rate_opr = data7.Data[0].tax_rate;
                                                    if (incl_excl_opr == 'E') {
                                                        alert("MERDEKA");
                                                        var opr_tax_amt = (+tax_rate_opr/100) * +opr_amt;
                                                    } else {
                                                        var opr_tax_amt = +opr_amt - (+opr_amt * (100/(100 + +tax_rate_opr)));
                                                        // var gigi = (100/100 + +tax_rate_opr);
                                                    }
                                                    var new_trx_amt = trx_amt.toFixed(2);
                                                    var trx_amt_view = numberWithCommas(new_trx_amt);
                                                    var current_read = +curr_read+'.000';
                                                    var usage11_new = usage11.toFixed(2);
                                                    var low_rate_new = numberWithCommas(low_rate);
                                                    var high_rate_new = numberWithCommas(high_rate);
                                                    document.getElementById('TrxAmount'+d+'').innerHTML = trx_amt_view;
                                                    document.getElementById('usage'+d+'').innerHTML = usage_total;
                                                    alert("disisisisi");
                                                    $.ajax({
                                                        url : "<?php echo base_url('C_Setting_Mu/save_meterreading_detail');?>/",
                                                        method : 'POST',
                                                        data: {'curr_read': current_read, 'usage': usage_total, 'capacity': capacity, 'capacity_limit': capacity_limit, 'usage11': usage11_new, 'usage21': usage21, 'usage_range1': usage_range1, 'usage_rate1': low_rate, 'usage_rate2': high_rate, 'base_amt1': base_amt1, 'trx_amt': new_trx_amt, 'tax_amt': tax_amt, 'disc_amt1': disc_amt,'disc_amt2': disc_amt2, 'opr_amt1': opr_amt,'opr_amt2': opr_amt2, 'rowID': d},
                                                        success:function(event, data){
                                                            // alert ("Database Update");
                                                        }
                                                    });
                                                });
                                            });
                                        });
                                    });
                                }); // 04 Maret 2019
                            } else {
                                var stamp_amt1 = '0';
                                var trx_amt = +base_amt1 + +gen_amt1 + +dem_amt1;
                                // alert(base_amt1);
                                // alert(gen_amt1);
                                // alert(dem_amt1);
                            }
                            if (sewage_flag == 'Y') {
                                var trx_amt = trx_amt + ((+sewage_percent/100) * +pemakaian2 * +sewage_amt);
                                //ini gimana aturannya
                            }
                            if (add_min == 'Y') {
                                var trx_amt = trx_amt + +min_amt;
                                //ini gimana aturannya
                            }
                            var disc_amt2 ='0';
                            var opr_amt2 ='0';
                            $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+tax_cd, function( data4 ) {
                                var incl_excl = data4.Data[0].incl_excl;
                                $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data5 ) {
                                    var tax_rate = data5.Data[0].tax_rate;
                                    if (incl_excl == "E"){
                                        var tax_amt = (+tax_rate/100) * (+trx_amt - +stamp_amt1);
                                    } else {
                                        var tax_amt = (+trx_amt - +stamp_amt1) - ((+trx_amt - +stamp_amt1) * (100/(100 + +tax_rate)));
                                    }
                                    if (opr_rate1 == 0){
                                        var opr_amt = '0';
                                    } else {
                                        var opr_amt = ((+base_amt1 + +gen_amt1 + +dem_amt1) * +opr_rate/100);
                                    }
                                    var trx_amt_new = +trx_amt + + opr_amt;
                                    $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_hd/')?>"+opr_tax_cd, function( data6 ) {
                                        var incl_excl_opr = data6.Data[0].incl_excl;
                                        $.getJSON( "<?php echo base_url('C_Setting_Mu/getcf_tax_sch_dt/')?>"+tax_cd, function( data7 ) {
                                            var tax_rate_opr = data7.Data[0].tax_rate;
                                            if (incl_excl_opr == 'E') {
                                                alert("MERDEKA");
                                                var opr_tax_amt = (+tax_rate_opr/100) * +opr_amt;
                                            } else {
                                                var opr_tax_amt = +opr_amt - (+opr_amt * (100/(100 + +tax_rate_opr)));
                                                // var gigi = (100/100 + +tax_rate_opr);
                                            }
                                            var new_trx_amt = trx_amt.toFixed(2);
                                            var trx_amt_view = numberWithCommas(new_trx_amt);
                                            var current_read = +curr_read+'.000';
                                            var usage11_new = usage11.toFixed(2);
                                            var low_rate_new = numberWithCommas(low_rate);
                                            var high_rate_new = numberWithCommas(high_rate);
                                            document.getElementById('TrxAmount'+d+'').innerHTML = trx_amt_view;
                                            document.getElementById('usage'+d+'').innerHTML = usage_total;
                                            $.ajax({
                                                url : "<?php echo base_url('C_Setting_Mu/save_meterreading_detail');?>/",
                                                method : 'POST',
                                                data: {'curr_read': current_read, 'usage': usage_total, 'capacity': capacity, 'capacity_limit': capacity_limit, 'usage11': usage11_new, 'usage21': usage21, 'usage_range1': usage_range1, 'usage_rate1': low_rate, 'usage_rate2': high_rate, 'base_amt1': base_amt1, 'trx_amt': new_trx_amt, 'tax_amt': tax_amt, 'disc_amt1': disc_amt,'disc_amt2': disc_amt2, 'opr_amt1': opr_amt,'opr_amt2': opr_amt2, 'rowID': d},
                                                success:function(event, data){
                                                    // alert ("Database Update");
                                                }
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            } //batas if (calmet == '1')
        }
    }
</script>

