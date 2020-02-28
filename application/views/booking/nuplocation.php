<link href="<?=base_url('plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
<div class="content-wrapper">
    <section class="content-header">
        <div class="form-group">        
            <label class="col-sm-12 control-label"><?php echo $entityname;?></label>
        </div>
        
    </section>
    <section class="content" >
        <form enctype="multipart/form-data" method="post" action="<?php echo base_url('c_nup_loc/save')?>">
            <div class="form-group">
                <label for="pl_project" class="col-sm-1 control-label">Project</label>
                <div class="col-sm-10">
                    <select name="pl_project" id="pl_project" data-placeholder="Choose a Project..." class="chosen-select" style="width:250px;" tabindex="2">
                        <?php echo $comboPrj?>
                    </select>
                </div>
                <br>
            </div>
            <div class="form-group">
                <label for="location" class="col-sm-1 control-label">Location</label>
                <div class="col-sm-10">
                    <select name="location" id="location" data-placeholder="Choose a Location..." class="chosen-select" style="width:250px;" tabindex="2">
                        <?php echo $comboLoc?>
                    </select>
                </div>
                <br>
            </div>
            <div class="form-group">
                <label for="userfile" class="col-sm-1 control-label">Upload</label>
                <div class="col-sm-10">
                    <span class="btn btn-success fileinput-button">
                        <span>Select File...</span>
                        <input type="file" id="userfile" name="userfile" accept="image/*" />
                    </span>
                    <input type="hidden" id="Picture" name="Picture"  readonly="readonly" />
                </div>
                <br>
            </div>
        </form>
    </section>
</div>
<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>
<script type="text/javascript">
//End choosen properties      
var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"90%"}
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