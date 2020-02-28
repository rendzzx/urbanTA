<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Edit Newsfeed
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url()."/homeadmin"; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo site_url()."/newsfeed"; ?>">Newsfeed</a></li>
            <li class="active">Edit</li>
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
                  <!-- 
                    <div class="form-group">
                     <label for="subjectnewsfeed" class="col-sm-2 control-label">Subject </label>
                     <div class="col-sm-10">
                       <input type="text" class="form-control" name="subject" id="subjectnewsfeed" placeholder="Subject newsfeed" value="<?php echo $newsfeeds->subject ?>"><?php echo form_error('subject');?>
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="contentnewsfeed" class="col-sm-2 control-label">Content </label>
                     <div class="col-sm-10">
                       
                        <textarea class="textarea" name="content" placeholder="Place content newsfeed here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $newsfeeds->content;  echo form_error('content');?></textarea>
                       
                     </div>
                    </div> 
                  -->

                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title">Content </h3>
                        <!-- tools box -->
                        <div class="pull-right box-tools">
                          <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                          <button class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div><!-- /. tools -->
                      </div><!-- /.box-header -->
                    <div class="box-body pad">
                      <form>
                        <ul class="wysihtml5-toolbar">
                          <li class="dropdown">
                            <a class="btn btn-default dropdown-toggle " data-toggle="dropdown">
                              <span class="glyphicon glyphicon-font"></span>
                              <span class="current-font">Normal text</span>
                              <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                              <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p" tabindex="-1" href="javascript:;" unselectable="on" class="wysihtml5-command-active">Normal text</a></li>
                              <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" tabindex="-1" href="javascript:;" unselectable="on">Heading 1</a></li>
                              <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" tabindex="-1" href="javascript:;" unselectable="on">Heading 2</a></li>
                              <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h3" tabindex="-1" href="javascript:;" unselectable="on">Heading 3</a></li>
                              <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h4" tabindex="-1" href="javascript:;" unselectable="on">Heading 4</a></li>
                              <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h5" tabindex="-1" href="javascript:;" unselectable="on">Heading 5</a></li>
                              <li><a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h6" tabindex="-1" href="javascript:;" unselectable="on">Heading 6</a></li>
                            </ul>
                          </li>
                          <li>
                            <div class="btn-group">
                              <a class="btn  btn-default" data-wysihtml5-command="bold" title="CTRL+B" tabindex="-1" href="javascript:;" unselectable="on">Bold</a>
                              <a class="btn  btn-default" data-wysihtml5-command="italic" title="CTRL+I" tabindex="-1" href="javascript:;" unselectable="on">Italic</a>
                              <a class="btn  btn-default" data-wysihtml5-command="underline" title="CTRL+U" tabindex="-1" href="javascript:;" unselectable="on">Underline</a>
                              <a class="btn  btn-default" data-wysihtml5-command="small" title="CTRL+S" tabindex="-1" href="javascript:;" unselectable="on">Small</a>
                            </div>
                          </li>
                          <li>
                            <a class="btn  btn-default" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="blockquote" data-wysihtml5-display-format-name="false" tabindex="-1" href="javascript:;" unselectable="on">
                                <span class="glyphicon glyphicon-quote"></span>
                            </a>
                          </li>
                          <li>
                            <div class="btn-group">
                              <a class="btn  btn-default" data-wysihtml5-command="insertUnorderedList" title="Unordered list" tabindex="-1" href="javascript:;" unselectable="on">
                                <span class="glyphicon glyphicon-list"></span>
                              </a>
                              <a class="btn  btn-default" data-wysihtml5-command="insertOrderedList" title="Ordered list" tabindex="-1" href="javascript:;" unselectable="on">
                                <span class="glyphicon glyphicon-th-list"></span>
                              </a>
                              <a class="btn  btn-default" data-wysihtml5-command="Outdent" title="Outdent" tabindex="-1" href="javascript:;" unselectable="on">
                                <span class="glyphicon glyphicon-indent-right"></span>
                              </a>
                              <a class="btn  btn-default" data-wysihtml5-command="Indent" title="Indent" tabindex="-1" href="javascript:;" unselectable="on">
                                <span class="glyphicon glyphicon-indent-left"></span>
                              </a>
                            </div>
                          </li>
                          <li>
                            <div class="bootstrap-wysihtml5-insert-link-modal modal fade" data-wysihtml5-dialog="createLink">
                              <div class="modal-dialog ">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <a class="close" data-dismiss="modal">×</a>
                                    <h3>Insert link</h3>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <input value="http://" class="bootstrap-wysihtml5-insert-link-url form-control" data-wysihtml5-dialog-field="href">
                                    </div> 
                                    <div class="checkbox">
                                      <label> 
                                        <input type="checkbox" class="bootstrap-wysihtml5-insert-link-target" checked="">Open link in new window
                                      </label>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <a class="btn btn-default" data-dismiss="modal" data-wysihtml5-dialog-action="cancel" href="#">Cancel</a>
                                    <a href="#" class="btn btn-primary" data-dismiss="modal" data-wysihtml5-dialog-action="save">Insert link</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <a class="btn  btn-default" data-wysihtml5-command="createLink" title="Insert link" tabindex="-1" href="javascript:;" unselectable="on">
                                <span class="glyphicon glyphicon-share"></span>
                            </a>
                          </li>
                          <li>
                            <div class="bootstrap-wysihtml5-insert-image-modal modal fade" data-wysihtml5-dialog="insertImage">
                              <div class="modal-dialog ">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <a class="close" data-dismiss="modal">×</a>
                                    <h3>Insert image</h3>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <input value="http://" class="bootstrap-wysihtml5-insert-image-url form-control" data-wysihtml5-dialog-field="src">
                                    </div> 
                                  </div>
                                  <div class="modal-footer">
                                    <a class="btn btn-default" data-dismiss="modal" data-wysihtml5-dialog-action="cancel" href="#">Cancel</a>
                                    <a class="btn btn-primary" data-dismiss="modal" data-wysihtml5-dialog-action="save" href="#">Insert image</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <a class="btn  btn-default" data-wysihtml5-command="insertImage" title="Insert image" tabindex="-1" href="javascript:;" unselectable="on">
                                <span class="glyphicon glyphicon-picture"></span>
                            </a>
                          </li>
                        </ul>
                        <textarea class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;" placeholder="Place some text here"></textarea><input type="hidden" name="_wysihtml5_mode" value="1"><iframe class="wysihtml5-sandbox" security="restricted" allowtransparency="true" frameborder="0" width="0" height="0" marginwidth="0" marginheight="0" style="border-collapse: separate; border: 1px solid rgb(221, 221, 221); clear: none; display: inline-block; float: none; margin: 0px; outline: rgb(51, 51, 51) none 0px; outline-offset: 0px; padding: 10px; position: static; top: auto; left: auto; right: auto; bottom: auto; z-index: auto; vertical-align: baseline; text-align: start; box-sizing: border-box; -webkit-box-shadow: none; box-shadow: none; border-radius: 0px; width: 100%; height: 200px; background-color: rgb(255, 255, 255);"></iframe>
                      </form>
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
                 <input type="hidden" id="newsfeed_id" name="id" value="<?php echo $newsfeeds->id ?>"/>
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