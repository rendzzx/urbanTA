      <div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            List Survey
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url()."/dash"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo site_url()."/survey"; ?>">Survey</a></li>
            <li class="active">Show List</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <?php $x=1; foreach ($judul as $jdl) { ?>
              <div class="box">
                <!--  -->
                <div class="box-header">
                  <h3 class="box-title"><?php echo $jdl; ?></h3>
                </div>
                <div class="box-body">
                  <form class="form-horizontal" method="post" action="<?php echo site_url(); ?>/survey/save_survey">
                  <input type="hidden" name="id_survey" value="<?php echo $surveyid ?>" />
                  <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                      <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter">
                            <label><?php echo $isi[$x]; ?></label>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-8">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <?php $j=1; foreach ($jawaban as $jwb => $as) 
                              {
                                  foreach ($as[$x] as $key => $value) 
                                  {
                                      print $value;
                                  }
                                $j++;  
                              } ?>  
                            
                        <!-- <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled="">
                            Option three is disabled
                          </label>
                        </div> -->
                          </div>
                        </div>
                      </div>
                    <!-- </div> -->
                    <div class="col-sm-7">
                      <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        <?php echo $link_paging ?>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                   <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                   <button type="submit" class="btn btn-info pull-left">Save</button>
                 </div><!-- /.box-footer -->
              </form>
              </div><!-- /.box -->

                <?php $x++; }  ?>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>

<script>
var area='';
function myFunction() {
   var txt;
   var r = confirm("Press a button!");
   if (r == true) {
       txt = "You pressed OK!";
   } else {
       txt = "You pressed Cancel!";
   }
   document.getElementById("demo").innerHTML = txt;
}

function check(data)
{
  var areanya = $(data).data('area');
  area = areanya;
  $("textarea").remove();
  $("#oth").append('<textarea id="tbox'+areanya +'"></textarea>');
}

function checkout(data)
{
  var areanya = $(data).data('area');
  area = areanya;
  $("textarea").remove(":contains('#tbox')");
}
</script>