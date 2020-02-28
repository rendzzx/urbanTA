<!-- 
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>
 -->


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
/*hr {
  border: 0;
  border-top: 3px double #8c8c8c;
}*/
#juduldetail{
  background-color: #00a1e4;
  color: white;
  padding: 10px;
  margin-left: 
  /*text-align: center;*/
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
.hr-line-solid{
   border : 0;
  height: 1px; 
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0,0,255,1), rgba(0, 0, 0, 0));
  /*border-bottom: 1px double;*/
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
  <div class="tittle-top pull-right">Ticket View</div> 
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
              <input type="text" class="form-control " name="ticket_date" id="ticket_date" readonly="true">
              </div>
            </div>
            <div class="form-group" >
               <label class="col-sm-3">Ticket Type  </label>
               <div class="col-sm-7">                
                <input type="text" class="form-control " name="ticket_type" id="ticket_type" readonly="true" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Name </label>
              <div class="col-sm-7">
                <input type="text" class="form-control " name="debtor_name" id="debtor_name" readonly="true">
              </div>
            </div>
            <div class="form-group" >
               <label class="col-sm-3">Requested By </label>
               <div class="col-sm-7">                
                <input type="text" class="form-control " name="serv_req_by" id="serv_req_by" readonly="true">
              </div>
            </div>
            <div class="form-group" >
               <label class="col-sm-3">Contact No. </label>
               <div class="col-sm-7">                
                <input type="text" class="form-control " name="contact_no" id="contact_no" readonly="true">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Lot No. </label>
              <div class="col-sm-7">
                <input type="text" class="form-control " name="lot_no" id="lot_no" readonly="true">
              </div>
            </div>
     
            <div class="form-group">
              <label class="col-sm-3">Floor</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="floor" id="floor" placeholder="-" readonly="true">
              </div>
            </div>
         
            <div class="form-group">
              <label class="col-sm-3">Location  </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="location" id="location" placeholder="-" readonly="true">
              </div>
            </div>
          </div>
          <div class="ibox-content" style="background-color: transparent;padding-left: 16px;padding-right: 16px;padding-top: 25px;">
            <div class="form-group" id="juduldetail">
            <label class="col-sm-3" style="margin-top: 8px"><label id="namadetail">Request</label> Detail</label>
               <div class="col-sm-7"></div> 
             
            </div>
             <div  class="bodydetail">
             <div class="tabs-container" id="tabs">
                <ul class="nav nav-tabs" id="tabstitle">
                    <li class="active"><a data-toggle="tab" href="#tab-1"> Request 1</a></li>
 
                </ul>
                <div class="tab-content" id="options" >
                  <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                      <div class="form-group">
                        <label class="col-sm-3">Category  </label>                
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="category1" id="category1" placeholder="&mdash;" readonly="true"> 
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3">Description  </label>                
                        <div class="col-sm-7">
                            <textarea class="form-control" placeholder="&mdash;" name="work_req1" id="work_req1" style=" height: 50px;" readonly="true"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3">Picture  </label>                
                        <div class="col-sm-7">
                              <div id="logo" class="image" >
                                  <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox1">
                              </div>
                              <br>
              
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
                <input type="hidden" id="batas" name="batas" value="2"/>
               
            </div>

            
          </div>
          <div class="box-footer">
            <br>
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


  var xx = $("#batas").val();
  // alert(xx);
  $("#btnAdd").click(function() 
  {

    console.log(xx);
    for (var i = xx; i <= xx; i++) 
    {
      $("#options").append('<div class="form-group" id="category_div'+i+'"><label class="col-sm-3"><button class="btn btn-danger btn-circle btn-outline pull-left" style="margin-left: 40%" onclick="remove('+i+')"><i class="fa fa-minus"></i></button>Category  </label><div class="col-sm-7"><select class="form-control select2" name="category'+i+'" id="category'+i+'" data-placeholder="Select Category"><option value=""></option></select></div></div>');
      $("#options").append('<div class="form-group" id="desc_div'+i+'"><label class="col-sm-3">Description  </label><div class="col-sm-7"><textarea class="form-control" placeholder="Input Work Request" name="work_req'+i+'" id="work_req'+i+'" style=" height: 50px;"></textarea></div></div>');
      $("#options").append('<div class="form-group" id="pict_div'+i+'"><label class="col-sm-3">Picture  </label><div class="col-sm-7"><div id="logo" class="image" ><img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox'+i+'"></div><br><input type="button" id="picture'+i+'" name="picture'+i+'"  onclick="uploadimage('+i+')" class="btn btn-success" value="Upload Image..." /><p>(* Only Jpg, Png allowed)</p><input type="hidden" id="picturepath'+i+'" value="<?php echo ''?>" readonly="'+i+'"><input type="hidden" id="picturename'+i+'" readonly="1"></div></div>');
      // $('html,body').animate({
      //   scrollTop: $("#category_div"+i).offset().top},
      //   'slow');
    };
    xx = i;
    $('#batas').val(i);
    $('.select2').select2({ width: '100%' });
    
  });




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


   

  
    function loaddata(){
      // alert('wlwl');
      var rowid = "<?php echo $rowid?>";
      $.getJSON("<?php echo base_url('c_ticket_history/getTicketByID');?>" + "/" + rowid, function (data) {
              console.log(data);
              
              var type = '';
              if(data[0].ticket_type=='R'){
                type = 'Request';
                document.getElementById('namadetail').innerHTML = "Request";
              } else {
                type = 'Complain';
                document.getElementById('namadetail').innerHTML = "Complain";
              }
              $('#ticket_date').val(data[0].reported_date_string);
              $('#ticket_type').val(type);
              $('#debtor_name').val(data[0].name);
              $('#serv_req_by').val(data[0].serv_req_by);
              $('#contact_no').val(data[0].contact_no);
              $('#lot_no').val(data[0].lot_no);
              $('#floor').val(data[0].floor);
              $('#location').val(data[0].location);
              $('#category1').val(data[0].category_descs);
              $('#work_req1').val(data[0].work_requested);
              var picname =  data[0].file_attachment.split('.');
              // console.log(picname[1]);
              // $("#picturebox1").attr('src', 'data:image/'+picname[1]+';base64,'+data[0].file_attached);
              console.log(data[0].file_url);
              $("#picturebox1").attr('src', data[0].file_url);
              var a = data.length;
              $('#batas').val(a+1);

              for(var i = 2; i < a+1 ;i++ ){
                
                var urut=i-1;
                // var no = i+1;
                $('#tabstitle').append('<li id="tabsli'+i+'"><a data-toggle="tab" href="#tab-'+i+'"> Request '+i+' </a></li>');
                $('#options').append('<div id="tab-'+i+'" class="tab-pane"><div class="panel-body" id="tabbody-'+i+'"></div></div>');

                $("#tabbody-"+i).append('<div class="form-group" id="category_div'+i+'"><label class="col-sm-3">Category</label><div class="col-sm-7"><input type="text" class="form-control" name="category'+i+'" id="category'+i+'" placeholder="&mdash;" value="'+data[urut].category_descs+'" readonly="true"></div></div>');
                $("#tabbody-"+i).append('<div class="form-group" id="desc_div'+i+'"><label class="col-sm-3">Description  </label><div class="col-sm-7"><textarea class="form-control" placeholder="Input Work Request" name="work_req'+i+'" id="work_req'+i+'" style=" height: 50px;" readonly="true">'+data[urut].work_requested+'</textarea></div></div>');
                $("#tabbody-"+i).append('<div class="form-group" id="pict_div'+i+'"><label class="col-sm-3">Picture  </label><div class="col-sm-7"><div id="logo" class="image" ><img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox'+i+'"></div></p></div></div>');
                if(data[urut].file_attachment!=null){
                   var picname =  data[urut].file_attachment.split('.');
                    // $("#picturebox"+i).attr('src', 'data:image/'+picname[1]+';base64,'+data[urut].file_attached);
                    $("#picturebox"+i).attr('src', data[urut].file_url);
                }

              }
   
            });

    }


  </script> 

</div>
