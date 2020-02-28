<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Create Newsfeed
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url()."/homeadmin"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo site_url()."/newsfeed"; ?>">Newsfeed</a></li>
            <li class="active">Create</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?php if($error !=null){ 
                foreach ($error as $key => $value) {
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
                <form class="form-horizontal" method="post" action="<?php echo site_url(); ?>/newsfeed/save_newsfeed" enctype="multipart/form-data">
                 <div class="box-body">
                    <div class="form-group">
                     <label for="subjectnewsfeed" class="col-sm-2 control-label">Subject </label>
                     <div class="col-sm-10">
                       <input type="text" class="form-control" name="subject" id="subjectnewsfeed" placeholder="Subject newsfeed">
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="contentnewsfeed" class="col-sm-2 control-label">Content </label>
                     <div class="col-sm-10">
                       <!-- <input type="text" class="form-control" name="name" id="contentnewsfeed" placeholder="Content newsfeed"> -->
                       <!-- <div class="box-body pad"> -->
                        <textarea class="textarea" name="content" placeholder="Place content newsfeed here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                       <!-- </div> -->
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="statusnewsfeed" class="col-sm-2 control-label">Status </label>
                     <div class="col-sm-10">
                       <!-- <input type="text" class="form-control" name="name" id="contentnewsfeed" placeholder="Content newsfeed"> -->
                       <select class="form-control" name="status">
                        <option value="1">Information</option>
                        <option value="2">Warning</option>
                      </select>
                     </div>
                    </div>
                    <!-- <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                     <div class="col-sm-10">
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
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
              </div><!-- /.box --
            </div><!--/.col (left) -->
            <!-- right column -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->