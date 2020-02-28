

<script type="text/javascript">
function replaceAll(str, find, replace)
{
  return str.replace(new RegExp(find, 'g'), replace);
}

function formatNumber(data) 
{
  if(data==null){
    data =0;
  }
  // alert(data);
  return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

}
</script>
<style >

.hr-line-solid{
   border : 0;
  height: 1px; 
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0,0,255,1), rgba(0, 0, 0, 0));
 
}

.btn-merah{
  background-color: #c9302c;
  border-color: #ac2925;
  color: #fff;
}
  #signupForm label.error {
  margin-left: 10px;
  width: auto;
  display: inline;
}
td {
    height: 40px;
  }

#label_form label {
    text-align: right;
  }
#juduldetail{
  background-color: #00a1e4;
  color: white;
  padding: 10px;
  margin-left: 
  /*text-align: center;*/
}
.btn-biru {
    background-color: #00a1e4;
    border-color: white;
    color: #FFFFFF;
}
.btn-biru:hover, .btn-biru:focus, .btn-biru:active, .btn-biru.active, .open .dropdown-toggle.btn-green, .btn-biru:active:focus, .btn-biru:active:hover, .btn-biru.active:hover, .btn-biru.active:focus {
    background-color: #0088c1;
    border-color: white;
    color: #FFFFFF;
}
.bodydetail{
  /*border: 1px solid rgba(0, 0, 0, 0.75);*/
  /*background-color: #d1fffc;*/
  background-color: #ffffff;
  /*color: white;*/
  padding: 10px;
  padding-top: 15px;
  margin-left: -15px;
  margin-top: -15px;
  margin-right: -15px;
  /*text-align: center;*/
}
.marginSelect{
  padding-left: 12px !important;
  padding-bottom: 6px !important;
  border-bottom-width: 1px !important;
  padding-top: 3px !important;

}
hr {
  border : 0;
  height: 1px; 
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
}
label {
  text-align: right;
}
.has-error .select2-selection {
  border: 1px solid #a94442;
  border-radius: 4px;
}
</style>

<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<script type="text/javascript">

    var observe;
    if (window.attachEvent) {
        observe = function (element, event, handler) {
            element.attachEvent('on'+event, handler);
        };
    }
    else {
        observe = function (element, event, handler) {
            element.addEventListener(event, handler, false);
        };
    }
    function init () {
        var text = document.getElementById('remarks');
        function resize () {
            text.style.height = 'auto';
            text.style.height = text.scrollHeight+'px';
        }
        /* 0-timeout to get the already changed text */
        function delayedResize () {
            window.setTimeout(resize, 0);
        }
        observe(text, 'change',  resize);
        observe(text, 'cut',     delayedResize);
        observe(text, 'paste',   delayedResize);
        observe(text, 'drop',    delayedResize);
        observe(text, 'keydown', delayedResize);

        text.focus();
        text.select();
        resize();
    }
</script>

<style type="text/css">
 .tabs-container > .nav > li > a {
    padding: 10px 15px;
    color: #00a1e4;
    background-color: #f2f2f2;
    border-bottom: solid 1px #e7eaec;
}

</style>
<div class="content-wrapper">
  <div class="row border-bottom white-bg dashboard-header"> 
  <div id="loader" class="loader" hidden="true"></div>
  <div class="tittle-top pull-right">Edit Ticket</div> 
    <!-- <div class="form-group"> -->
 <div class="tittle-top pull-left"><?php echo $ProjectDescs; ?></div>
      
  </div>
  <div class="wrapper wrapper-content" >
    <div class="row">
      <div class="col-xs-12">
        <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method="POST" >
          <div class="ibox-content" style="padding-top: 30px;">
            <div class="form-group">
              <label class="col-sm-3">Ticket Date</label>
              <div class="col-sm-7">
              <input type="text" class="form-control " name="ticket_date" id="ticket_date" readonly="1" >
              </div>
            </div>
            <div class="form-group" >
               <label class="col-sm-3">Ticket Type <FONT COLOR="RED">*</FONT></label>
               <div class="col-sm-7">                
                <label class="radio-inline"><input type="radio" name="ticket_type" id="R" value="R" checked> Request</label>&emsp;
                <label class="radio-inline"><input type="radio" name="ticket_type" id="C" value="C"> Complain</label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Name <FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-7">
                <select class="form-control select2" name="debtor_name" id="debtor_name" data-placeholder="Select Debtor." >
                <option value=""></option>
                <?php echo $dtdebtor?>
                </select>
              </div>
            </div>
            <div class="form-group" >
               <label class="col-sm-3">Requested By <FONT COLOR="RED">*</FONT></label>
               <div class="col-sm-7">                
                <input type="text" class="form-control " name="serv_req_by" id="serv_req_by"  >
              </div>
            </div>
            <div class="form-group" >
               <label class="col-sm-3">Contact No. <FONT COLOR="RED">*</FONT></label>
               <div class="col-sm-7">                
                <input type="text" class="form-control " name="contact_no" id="contact_no"  >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Lot No. <FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-7">
                <select class="form-control select2" name="lot_no" id="lot_no" data-placeholder="Select Lot No.">
                <option value=""></option>
                <?php echo $datalot?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Floor</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="floor" id="floor" placeholder="Input Floor" disabled="true" >
              </div>
            </div>
         
            <div class="form-group">
              <label class="col-sm-3">Location  </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="location" id="location" placeholder="Input Location"  >
              </div>
            </div>
            </div>
          <div class="ibox-content" style="background-color: transparent;padding-left: 16px;padding-right: 16px;padding-top: 25px;">
            <div class="form-group" id="juduldetail">
            <label class="col-sm-3" style="margin-top: 8px"><label id="namadetail">Request</label> Detail</label>
               <div class="col-sm-7"><button class="btn btn-biru btn-outline" style="border-color: white!important" id="btnAdd" type="button"><i class="fa fa-plus"></i> Add</button></div> 
             
            </div>
         <!--     <hr class="hr-line-solid" style="margin-bottom: 5px;">
           <hr class="hr-line-solid" style="margin-top: 1px;"> -->
             <div  class="bodydetail">
             <div class="tabs-container" id="tabs">
                <ul class="nav nav-tabs" id="tabstitle">
                    <li class="active"><a data-toggle="tab" href="#tab-1"> Request 1</a></li>
 
                </ul>
                <div class="tab-content" id="options" >
                  <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                <div class="form-group">
                  <label class="col-sm-3">Category <FONT COLOR="RED">*</FONT></label>                
                  <div class="col-sm-7">
                    <select class="form-control select2" name="category[]" id="category1" data-placeholder="Select Category">
                    <option value=""></option>
                    <?php echo $datacategory?></select>   
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3">Description <FONT COLOR="RED">*</FONT></label>                
                  <div class="col-sm-7">
                      <textarea class="form-control" placeholder="Input Work Request" name="work_req[]" id="work_req1" style=" height: 50px;"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3">Picture <FONT COLOR="RED">*</FONT></label>                
                  <div class="col-sm-7">
                        <div id="logo" class="image" >
                            <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox1">
                        </div>
                        <br>
     
                            <!-- <input type="button" id="picture1" name="picture1"  onclick="uploadimage(1,1)" class="btn btn-success" value="Upload Image..." /> -->
                            <span class="btn btn-success fileinput-button">
                                  <span>Select Picture...</span>
                                  <input type="file" id="userfile1" name="userfile" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(1,this)"/>
                              </span>

                        <p>(* Only Jpg, Png allowed)</p><input type="hidden" name="seq_no_detail[]" id="seq_no_detail1" value="1">
                        <input type="hidden" id="picturepath1" value="<?php echo ''?>" readonly="1">
                        <input type="hidden" id="picturename1" name="picturename[]" readonly="1">
                  </div>
                </div>
                </div>
                  </div><!-- div tab 1 -->
      
                </div>
              </div><!-- end of tab -->
              </div><!-- end of bodydetail -->
              <input type="hidden" id="batas" name="batas" value="2"/>
                <input type="hidden" class="form-control " name="complain_no" id="complain_no" value="">
                <input type="hidden" class="form-control " name="report_no" id="report_no">
       

            
          </div>
          <div class="box-footer">
            <br>
            <input type="button" name="btnSave" id="btnSave" value="Save" class="btn btn-primary">
            <input type="button" name="btnback" id="btnback" value="Back" onclick="back()" class="btn btn-default">
          </div>
        </form>
      </div>            
    </div>
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
 
  <script type="text/javascript">
  loaddata();
  function back(){
    window.location.href="<?php echo base_url('c_ticket_history/index')?>";
  }


  // alert(xx);
  $("#btnAdd").click(function() 
  {

    // console.log(xx);
    for (var i = $("#batas").val(); i <= $("#batas").val(); i++) 
    {
      $('#tabstitle').append('<li id="tabsli'+i+'"><a data-toggle="tab" href="#tab-'+i+'"> Request '+i+' <button class="btn btn-danger btn-circle btn-outline" onclick="remove('+i+')" style="width:18px;height:18px;font-size: 10px; padding:0 0;padding-left: 1px;">&nbsp;<i class="fa fa-times"></i></button></a></li>');
      $('#options').append('<div id="tab-'+i+'" class="tab-pane"><div class="panel-body" id="tabbody-'+i+'"></div></div>');

      $("#tabbody-"+i).append('<div class="form-group" id="category_div'+i+'"><label class="col-sm-3">Category  </label><div class="col-sm-7"><select class="form-control select2" name="category[]" id="category'+i+'" data-placeholder="Select Category"><option value=""></option><?php echo $datacategory?></select></div></div>');
      $("#tabbody-"+i).append('<div class="form-group" id="desc_div'+i+'"><label class="col-sm-3">Description  </label><div class="col-sm-7"><textarea class="form-control" placeholder="Input Work Request" name="work_req[]" id="work_req'+i+'" style=" height: 50px;"></textarea></div></div>');
      $("#tabbody-"+i).append('<div class="form-group" id="pict_div'+i+'"><label class="col-sm-3">Picture  </label><div class="col-sm-7"><div id="logo" class="image" ><img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox'+i+'"></div><br><span class="btn btn-success fileinput-button"><span>Select Picture...</span><input type="file" id="userfile'+i+'" name="userfile" accept="image/x-png,image/gif,image/jpeg" required onChange="saveImage('+i+',this)"/></span><p>(* Only Jpg, Png allowed) seqno:<input type="hidden" name="seq_no_detail[]" id="seq_no_detail'+i+'" value="'+i+'"></p><input type="hidden" id="picturepath'+i+'" value="<?php echo ''?>" readonly="'+i+'"><input type="hidden" id="picturename'+i+'" name="picturename[]" readonly="1"></div></div>');
      activaTab('tab-'+i);
      // $('html,body').animate({
      //   scrollTop: $("#category_div"+i).offset().top},
      //   'slow');
    };
    // xx = i;
    $('#batas').val(i);
    $('.select2').select2({ width: '100%' });
    
  });

function activaTab(tab){
    $('.nav-tabs li a[href="#' + tab + '"]').tab('show');
    // alert(tab);
};
  function remove(no){
    var complain_no = $('#complain_no').val();

    swal({
      title: "Are you sure?",
      text: "This request detail will be lost.",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: '#c9302c',
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: true
    },
    function(){
    var site_url = '<?php echo base_url("c_ticket_history/deletedetail")?>';
                $.post(site_url,
                  {complain_no:complain_no,seqno:no},

                  function(data,event) {
                    console.log(data);
                    var hasil = JSON.parse(data);

                    console.log(hasil.status);
                    if(hasil.status=='OK'){
                      swal('Information',hasil.pesan,'success');
                      console.log(no);
                      $('li').remove("#tabsli"+no);
                      $("#tab-"+no).remove();
                      if ($('li').hasClass('active')) {
                        $('li').removeClass('active')
                      }
                      if ($('div').hasClass('active')) {
                        $('div').removeClass('active')
                      }
                      
                      $('#tabsli-1').attr("class","active");
                      $('#tab-1').attr("class","tab-pane active");

                      if($("#batas").val()>1) {
                        $("#batas").val()--;
                        $("#batas").val($("#batas").val());  
                      }
                    } else {
                      swal('Information',hasil.pesan,'error');
                    }
                  }
                );
       

    });
    return false;
  }

  var debtor = $('#debtor_name').find(':selected');
  var no = ''; 
  if(debtor){
    no = debtor.data('telp');
  } else {
    no = '';
  }

  $('#contact_no').val(no);
  $('.select2').select2({ width: '100%' });


$('input[name=ticket_type]').on('click',function(e){
  if (document.getElementById('C').checked) { 
    document.getElementById('namadetail').innerHTML = "Complain";
  }else {
    document.getElementById('namadetail').innerHTML = "Request";
  }
});


   function setcategory(Id,no){
        
        var site_url = '<?php echo base_url("c_ticket_history/zoom_category")?>';
            $.post(site_url,
              {category_cd:Id},
              function(data,status) {
                $("#category"+no).empty();
                $("#category"+no).append(data);
                $("#category"+no).trigger('change');

              }
            );
    }
     function setdebtor(Id,no){
        
        var site_url = '<?php echo base_url("c_ticket_history/zoom_debtor_dd")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#debtor_name").empty();
                $("#debtor_name").append(data);
                $("#debtor_name").trigger('change');

              }
            );
    }
    function setlotno(Id,debtor){
        
        var site_url = '<?php echo base_url("C_customer_service/zoom_lot_no")?>';
            $.post(site_url,
              {Id:Id,debtor_acct:debtor},
              function(data,status) {
          
                $("#lot_no").empty();
                $("#lot_no").append(data);
                $("#lot_no").trigger('change');

              }
              );

    }
$('#lot_no').change(function(){
  // alert('wk');
        var prod = $(this).find(':selected').val();
        if(prod!==''){
           var site_url = '<?php echo base_url("c_customer_service/zoom_floor")?>';
            $.post(site_url,
              {prod:prod},
              function(data,status) {
                console.log(data);
                $("#floor").val(data);
              }
            );

        }
           
    });

 function saveImage(seq, el) {
        var a = el.files[0].size;
        var max = (1024 *1024) * 7;
        
        if (a > max){
  
            
            if (max.toString().length > 6) {
                max = max / 1024 / 1024;
                max = max.toFixed(2);
                max = max + ' mb';
            } else {
                max = max / 1024;
                max = max.toFixed(2);
                max = max + ' kb';
            }
            swal('Please upload less than ' + max);
            return false;
        }

        $.ajax({
                url : "<?php echo base_url('c_cs/savePic2');?>",
                type:"POST",
                data: function () {
                    var data = new FormData();
                    data.append("complain_no", $("#complain_no").val());
                    data.append("seqno", seq);
                    data.append("userfile", $("#userfile"+seq).get(0).files[0]);
                    return data;
                }(),
                processData: false,
                contentType: false,
                dataType:"json",
                success:function(data, status){
                  console.log(data.pesan);
                if(data.status == "OK"){
                      swal({
                        title: "Information",
                        text: data.pesan,
                        type: "success",
                        confirmButtonText: "OK"
                      },
                      function(){
                        // document.getElementById('loader').hidden=true; 

                         // table.ajax.reload(null,true);
                         // alert("HAI");
                         $('#picturebox'+seq).attr('src', data.url);

                      });
                    } else {
                      swal({
                        title: "Error",
                        text: data.pesan,
                        type: "error",
                        confirmButtonText: "OK"
                      });
                      // document.getElementById('loader').hidden=true; 
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                }
            });
      }

  function uploadimage(no,seqno){
    var complain_no =  $("#complain_no").val();

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

                        $('#modalTitle').html('Add Picture');
                        $('div.modal-body').load("<?php echo base_url("c_ticket_history/addpic");?>");
                        $('#modal').data('complain_no', complain_no).modal('show');
                        $('#modal').data('nourut', no);
                        $('#modal').data('seqno', seqno);
  }
  
    function loaddata(){
      // alert('wlwl');

       
      var rowid = "<?php echo $rowid?>";
      $.getJSON("<?php echo base_url('c_ticket_history/getTicketByID');?>" + "/" + rowid, function (data) {
              console.log(data);
              
              var type = '';
              if(data[0].ticket_type=='R'){
                type = 'Request';
                document.getElementById('namadetail').innerHTML = "Request";
                document.getElementById("R").checked = true;
              } else {
                type = 'Complain';
                document.getElementById('namadetail').innerHTML = "Complain";
                document.getElementById("C").checked = true;
              }
              $('#ticket_date').val(data[0].reported_date_string);
              $('#report_no').val(data[0].report_no);
              // $('#ticket_type').val(type);
              $('#debtor_name').val(data[0].name);
              $('#serv_req_by').val(data[0].serv_req_by);
              $('#contact_no').val(data[0].contact_no);
              setlotno(data[0].lot_no,data[0].debtor_acct);
              // $('#floor').val(data[0].floor);
              $('#complain_no').val(data[0].complain_no);
              $('#location').val(data[0].location);
              $('#category1').val(data[0].category_descs);
              $('#work_req1').val(data[0].work_requested);
              setcategory(data[0].category_cd,1);
              setdebtor(data[0].debtor_acct,1);
               if(data[0].file_attachment!=null &&data[0].file_attached!=null ){
                var picname =  data[0].file_attachment.split('.');
                // console.log(picname[1]);
                // $("#picturebox1").attr('src', 'data:image/'+picname[1]+';base64,'+data[0].file_attached);
                $("#picturebox1").attr('src', data[0].file_url);
                $("#picturename").val(data[0].file_attachment);
               }
              // $('select#category1 option[value="'+data[0].category_cd+'"]').attr("selected","selected");
              
              var a = data.length;
              // $('#batas').val(a+1);

              for(var i = 2; i < a+1 ;i++ ){
                var urut=i-1;
                console.log(i+'--'+data[urut].seq_no);
                // if(i == data[urut].seq_no)
                // {
                  // var no = i+1;
                    $('#tabstitle').append('<li id="tabsli'+i+'"><a data-toggle="tab" href="#tab-'+i+'"> Request '+data[urut].seq_no+' <button class="btn btn-danger btn-circle btn-outline" onclick="remove('+i+')" style="width:18px;height:18px;font-size: 10px; padding:0 0;padding-left: 1px;">&nbsp;<i class="fa fa-times"></i></button></a></li>');
                    $('#options').append('<div id="tab-'+i+'" class="tab-pane"><div class="panel-body" id="tabbody-'+i+'"></div></div>');

                    $("#tabbody-"+i).append('<div class="form-group" id="category_div'+i+'"><label class="col-sm-3">Category </label><div class="col-sm-7"><select class="form-control select2" name="category[]" id="category'+i+'" data-placeholder="Select Category"><option value=""></option><?php echo $datacategory?></select></div></div>');
                    $("#tabbody-"+i).append('<div class="form-group" id="desc_div'+i+'"><label class="col-sm-3">Description  </label><div class="col-sm-7"><textarea class="form-control" placeholder="Input Work Request" name="work_req[]" id="work_req'+i+'" style=" height: 50px;"  >'+data[urut].work_requested+'</textarea></div></div>');
                    $("#tabbody-"+i).append('<div class="form-group" id="pict_div'+i+'"><label class="col-sm-3">Picture  </label><div class="col-sm-7"><div id="logo" class="image" ><img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox'+i+'"><br><span class="btn btn-success fileinput-button"><span>Select Picture...</span><input type="file" id="userfile'+data[urut].seq_no+'" name="userfile" accept="image/x-png,image/gif,image/jpeg" required onChange="saveImage('+data[urut].seq_no+',this)"/></span><p>(* Only Jpg, Png allowed)<input type="hidden" name="seq_no_detail[]" id="seq_no_detail'+i+'" value="'+data[urut].seq_no+'"></p><input type="hidden" id="picturepath'+i+'" value="<?php echo ''?>" readonly="1"><input type="hidden" id="picturename'+i+'" name="picturename[]" readonly="1"></div></p></div></div>');
                    // $('#options').append('');
                    if(data[urut].file_attachment!=null &&data[urut].file_url!=null ){
                      // var picname =  data[urut].file_attachment.split('.');
                      // $("#picturebox"+i).attr('src', 'data:image/'+picname[1]+';base64,'+data[urut].file_attached);
                      $("#picturebox"+i).attr('src', data[urut].file_url);
                      $("#picturename"+i).val(data[urut].file_attachment);
                    }
                    $('.select2').select2({ width: '100%' });
                    console.log(i+' : '+data[urut].category_cd);
                    setcategory(data[urut].category_cd,i);
                // }
                

              }
               $('#batas').val(parseInt(data[a-1].seq_no)+1);
            // alert(a+1);
            });
       
    }
 $('#form_nup').validate({
      ignore: "",
      rules: {
        contact_no: { required: true},
        debtor_name: {required: true},
        lotno: {required: true},
        serv_req_by: {required: true},
        // location:{required: true},
        work_req1:{required: true},
        category1:{required:true}
      },
      messages: {cntfile: {attached: "Upload file need to completed"},
                npwp: { cek_npwp: "NPWP is not valid"},
                noktp: {check_noktp: " IC No. Is not valid"},
                HP: {cek_telp: "Handphone number is not valid"} 
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
          } else if (element.hasClass('select2_demo_1') || element.hasClass('select2_demo_2')) {
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }

    });
$('#btnSave').click(function(){
      document.getElementById('loader').hidden=false; 
      var debtor = $('#debtor_name').val();
      var rowid = "<?php echo $rowid?>";
      var unitdescs = $('#lotno').find(":selected").text();
        var datafrm = $('#form_nup').serializeArray();
        datafrm.push(
          {name:"debtor_name",value:debtor},
          {name:"rowid",value:rowid},
          {name:"lotdescs",value:unitdescs}
          );

        console.log(datafrm);

      // if($('#form_nup').valid()){
        
  // alert("WOI");
            $.ajax({
                url : "<?php echo base_url('c_ticket_history/save');?>",
                type:"POST",
                data: datafrm,
                dataType:"json",
                success:function(data, status){
                  
                if(data.status =='OK'){
                      swal({
                        title: "Information",
                        text: data.pesan,
                        type: "success",
                        confirmButtonText: "OK"
                      },
                      function(){
                        document.getElementById('loader').hidden=true; 
                        window.location.href="<?php echo base_url('c_ticket_history/index');?>";
                      });
                    } else {
                      swal({
                        title: "Error",
                        text: data.pesan,
                        type: "error",
                        confirmButtonText: "OK"
                      });
                      document.getElementById('loader').hidden=true; 
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                }
            });

        // }
    });

  </script> 

</div>
