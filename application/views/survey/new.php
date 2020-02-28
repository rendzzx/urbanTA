<script>
  $(function() {
    $( "#datepicker" ).datepicker();
    $( "#datepicker2" ).datepicker();
  });
  </script>
  <style type="text/css">
    //
// Variables
// ----------------------

$gray: #333;
$gray-light: #aaa;
$gray-lighter: #eee;
$space: 40px;
$blue: #428bca;
$blue-dark: darken($blue, 5%);

// Mixin for transition/transform
@mixin translate($x, $y) {
  -webkit-transform: translate($x, $y);
      -ms-transform: translate($x, $y); // IE9+
          transform: translate($x, $y);
}
@mixin transition($transition) {
  -webkit-transition: $transition;
          transition: $transition;
}
@mixin transition-transform($transition) {
  -webkit-transition: -webkit-transform unquote($transition);
     -moz-transition: -moz-transform unquote($transition);
       -o-transition: -o-transform unquote($transition);
          transition: transform unquote($transition);
}

//
// Body
// ----------------------



.wrap{
  padding: $space;
  text-align: center;
}

hr {
  clear: both;
  margin-top: $space;
  margin-bottom: $space;
  border: 0;
  border-top: 1px solid $gray-light;
}



//
// Btn 
// ----------------------

.btn{
  background: $blue;
  border: $blue-dark solid 1px;
  border-radius: 3px;
  color: #fff;
  display: inline-block;
  font-size: 14px;
  padding: 8px 15px;
  text-decoration: none;
  text-align: center;
  min-width: 60px;
  position: relative;
  transition: color .1s ease;
  
  &:hover{
    background: $blue-dark;
  }
  
  &.btn-big{
    font-size: 18px;
    padding: 15px 20px;
    min-width: 100px;
  }
  
}

.btn-close{
  color: $gray-light;
  font-size: 30px;
  text-decoration: none;
  position: absolute; right: 5px; top: 0;
  
  &:hover{
     color: darken($gray-light, 10%);
  }
  
}

//
// Modal
// ----------------------

.modal{
  
  // This is modal bg
  &:before{
    content: ""; 
    /*display: none;*/
    background: rgba(0,0,0,0); 
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0; 
    z-index: -1;
    
  }
  
  &:target{
    
    // Active animate in modal
    &:before{
      @include transition-transform("0.9s ease-out");
    z-index:10;  
    background: rgba(0,0,0,.6); 
      /*display: block;*/
    } 
  }
  
}
.modal:target + .modal-dialog{
      @include translate(0, 0);
      top: 20%;  
    }

// Modal Dialog
// ----------------------

.modal-dialog{
  background: #fefefe;
  border: $gray solid 1px;
  border-radius: 5px;
  margin-left: -200px;
  position: fixed; 
  left: 50%; 
  top: -100%;  
  z-index: 11; 
  width: 360px;
  @include translate(0, -500%);
  @include transition-transform("0.3s ease-out");
}

.modal-body{
  padding: $space/2;
}

.modal-header,
.modal-footer{
  padding: $space/4 $space/2;
}

.modal-header{
  border-bottom: $gray-lighter solid 1px;
  
  h2{
    font-size: 20px;
  }
  
}

.modal-footer{
  border-top: $gray-lighter solid 1px;
  text-align: right;
}
 
  </style>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Task List
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url()."/homeadmin"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo site_url()."/survey"; ?>">Survey</a></li>
            <li class="active"> New</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?php if($error !=null){ 
                foreach ($error as $key => $value) 
                {
                  echo $value ."<br />";
                }
             }
          
          ?>
          <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" action="<?php echo site_url(); ?>/survey/save_survey" enctype="multipart/form-data">
                 <div class="box-body">
                  <div class="form-group">
                     <label for="ticketnumber" class="col-sm-2 control-label">Ticket Number</label>
                     <div class="col-sm-9">
                       <input type="text" values="<?php echo $helpdeskData[0]->documentnumber; ?>" class="form-control" id="ticketnumber" name="ticketnumber" readonly>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="expireddate" class="col-sm-2 control-label">Expired Date</label>
                     <div class="col-sm-9">
                       <textarea class="textarea" name="desc" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $assignSurveyData[0]->description ?></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                    <a href="<?php echo $this->config->item('tenant_url').'uploads/tenanthelpdesk/'. $assignSurveyData[0]->photo; ?>" target="_blank"><img src="<?php echo $this->config->item('tenant_url').'uploads/tenanthelpdesk/'. $assignSurveyData->photo; ?>" class="user-image" width="40px" height="40px"/ alt="logo"></a>
                  </div>
                    <div class="form-group">
                     <label for="contentsurvey" class="col-sm-2 control-label">Content </label>
                     <div class="col-sm-9">
                       <input type="text" class="form-control" name="isi" id="isi" placeholder="Content Survey">
                     </div>
                    </div>

                    <div class="form-group">
                     <label for="optionsurvey" class="col-sm-2 control-label">Option Value(s)</label>
                     <div class="col-sm-9">
                      <div id="p_opt">
                       <input type="text" class="form-control" name="XoptDetail1" data-option='1' id="Xoptionsurvey" placeholder="Option Survey">
                       <input type="checkbox" data-hide="1" onclick="coba(this)" class="penjelasan"> Ada penjelasannya
                       <input type="hidden" class="sembunyi" id="Xsembun1" name="Xsembunyi1" />
                       <input type="hidden" id="batas" name="batas" />
                     </div>
                       <button type="button" id="addOption" class="btn btn-sm"> + </button>
                       <button type="button" id="remOption" class="btn btn-sm"> - </button>
                     </div>
                    </div>
                    
                    <!-- <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                     <div class="col-sm-9">
                       <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                     </div>
                    </div> -->
                    <!-- <div class="form-group">
                      <label for="exampleInputFile" class="col-sm-2 control-label">File input</label>
                      <div class="col-cm_10">
                      <input type="file" class="form_control" id="exampleInputFile" name="picture">
                    </div>
                  </div> -->
                 </div><!-- /.box-body -->
                 <div class="box-footer">
                    <button type="button" id="simpan" class="btn btn-primary">Save</button>
                  </div>
                </form>
              </div><!-- /.box --
            </div><!--/.col (left) -->
            <!-- right column -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!-- Modal -->




<script type="text/javascript">
var xx = 2;
$("#addOption").click(function() 
{
  for (var i = xx; i <= xx; i++) 
  {
    $("#p_opt").append('<input type="text" class="form-control" name="optDetail'+i+'"'+' id="optionsurvey'+i+'" placeholder="Option Survey">');
    $("#p_opt").append('<label><input type="checkbox" data-hide="'+i+'" onclick="coba(this)" class="penjelasan" name="jelaskan'+i+'" > Ada penjelasannya</label>');
    $("#p_opt").append('<input type="hidden" class="sembunyi" id="sembun'+i+'" name="sembunyi'+i+'" />');
  };
  xx = i;
});
$("#remOption").click(function() 
{
  $("#p_opt #optionsurvey:last").remove();
  $("#p_opt :text:last").not("#Xoptionsurvey").remove();
  $("#p_opt label:last").remove();
});

$(document).ready(function(){
    $("#modalnya").fadeOut();
});

function coba(dt)
{
  if(dt.checked==true)
  {
    $("#sembun"+$(dt).data('hide')).val(true);
  }
  
  if(dt.checked==false)
  {
    $("#sembun"+$(dt).data('hide')).val(false);
  }  
}

$("#simpan").click(function() 
{ 
  var site_url = '<?php echo site_url("/survey/save_survey"); ?>';
    var from = $("#datepicker").val();
    var exp = $("#datepicker2").val();
    var subj = $("#subjectsurvey").val();
    var isi = $("#isi").val();
    var opts=[];
    var opts2=[];
    var batas=xx;
    for (var i = 2; i <= xx; i++) {
      opts[i] = $('#optionsurvey'+i).val();   
      opts2[i] = $('#sembun'+i).val();
    };
    opts[1] = $('#Xoptionsurvey').val();   
    opts2[1] = $('#Xsembun1').val();
    

    $.ajax(
    {
      method: "POST",
      url: site_url,
      data: { from: from, exp: exp, subj:subj,isi:isi,opts:opts, opts2:opts2,batasAkhir:batas }
    })
    .done(function( msg ) 
    {
      alert( "Done");
    });
});



</script>

