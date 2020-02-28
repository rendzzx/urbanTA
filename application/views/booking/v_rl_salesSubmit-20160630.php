<div class="content-wrapper">
  <section class="content-header">
    <h1>Submit Booking</h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <?php if(!empty($error)) {echo $error;} ?>
          <form role="form" class="form-horizontal cmxform" id="form_rl_sales" method ="POST" action="<?php //echo site_url("C_rl_sales/isi_data_rl_sales"); ?>">
            <div class="box-body">
              <table id="submitList" class="display"> <!-- class="table table-bordered table-striped dataTable" -->
                <thead>
                  <th style="width: 10px;" align="center"><input type="checkbox" name="checkall" id="checkall"></th>
                  <th style="width: 10px;">Level</th>
                  <th>User</th>
                  <th>Name</th>
                </thead>
                <tbody>
                  <?php echo($listSubmit);?>
                </tbody>
              </table>
            <div class="box-footer">
              <button class="btn btn-primary" type="button" id="btnSimpan"> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- <script src="<?=base_url('assets/docsupport/chosen.jquery.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('assets/docsupport/prism.js')?>" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" src="<?=base_url('lainnya/dist/js/jquery.mask.min.js')?>"></script> -->
   
   <script type="text/javascript">
    var table;
    $(function() {
      table = $("#submitList").DataTable({
        columnDefs:[{
          orderable: false,
          className: 'select-checkbox',
          targets: 0
        }],
        column: [
          { name: 'checklist', targets: 0},
          { name: 'level', targets: 1},
          { name: 'userid', targets: 2},
          { name: 'name', targets: 3},
        ],
        "info": false,
        select: {
          style:    'multi',
          selector: 'td:first-child'
        },
        // select: true,
        order: [[ 1, 'asc' ]]
      });
      table
        .on('select', function(e, dt, type, indexes) {
          var rowData = table.rows( indexes ).data().toArray();
          // console.log(rowData);
        })
    });
    // table.rows().select();
    $("#checkall").click(function(event) {
      if(this.checked) {
        table.rows().select();
      } else{
        table.rows().deselect();
      }
    });
    $("#btnSimpan").click(function() {
      var terpilih = table.rows({ selected: true }).data().toArray();
      console.log(Array.isArray(terpilih));
      console.log(terpilih.length);
      // console.log(terpilih);
      var ln = terpilih.length;
      for (var i=0; i< ln; i++) {
        console.log(terpilih[i][2]);
      }
      var site_url = '<?php base_url("submitSales/addSubmit") ?>';
      $.post(site_url,
        {dtSubmit:terpilih},
        function(data,status) {
          console.log(status);
          alert(data);
        });
      // var satu = table.rows('.selected').data();
      // console.log(satu);
    });
    // var config = {
    //   // '.chosen-select'           : {},
    //   '.chosen-select-deselect'  : {allow_single_deselect:true},
    //   '.chosen-select-no-single' : {disable_search_threshold:10},
    //   '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
    //   '.chosen-select-width'     : {width:"95%"}
    // }
    // $(".chosen-select").chosen({ width: '100%'});
    // for (var selector in config) {
    //   $(selector).chosen(config[selector]);
    // }
    // $(function() {
    //   var lot = $("#unit").find(':selected').val();
    //   $("#unit").change();
    // });
    // $("#unit").trigger('chosen:updated');
    // $("#unit").change(function(){
    //   var lot = $(this).find(':selected').val();
    //   if(lot!=='') {
    //     var site_url = '<?php echo base_url("c_rl_sales/check_debtor") ?>';
    //     $.post(site_url,
    //       {debtor:lot},
    //       function(data,status){
    //         $("#txt_debtor").empty();
    //         $("#txt_debtor").val(data);
    //         console.log(data);
    //       });
    //   } else {
    //     console.log('empty lot');
    //   }
    //   // $("#txt_debtor").val(lot);
    // });
    // $('input[name=txt_aditional_disc]').mask('#,##0',{reverse:true,maxlength:false});
    
    // $('#disc').change(function(){
    //   var discno = $("#disc option:selected").data("level");
    //   var list_price = $("#txt_list_bf_price").text();
    //   var price = replaceAll(list_price, ',','');
      
    //   if (discno=='') {
    //     var result = 0;
    //     var net_price = price - result;
    //     $("#txt_aditional_disc").val(formatNumber(result));
        
    //   } else { 
    //     var price = replaceAll(list_price, ',','');
    //     var result = (parseInt(discno) * parseInt(price)) / 100 ;
    //     var net_price = price - result;
    //     $("#txt_aditional_disc").val(formatNumber(result));
    //   }
    //   $('#txt_netprice').text(formatNumber(net_price));
    //   // console.log(formatNumber(net_price));
    // });

   </script>
</div>