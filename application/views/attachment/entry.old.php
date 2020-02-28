<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" />
<!-- <link rel="stylesheet" href="<?php echo base_url('plugins/jQueryUI/jquery-ui-1.8.9.css')?>" type="text/css"> -->
<link rel="stylesheet" href="<?php echo base_url('plugins/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css');?>" type="text/css" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<div class="content-wrapper">
    <section class="content-header">
        <form enctype="multipart/form-data" method="post" action="<?php echo base_url('attachment/saveLogo')?>">
            <h1><?php echo $prj?></h1>
            <div class="form-group">
                <label for="logo" class="control-label">Logo :</label> 
                <div id="logo" class="image" >
                    <img class="img-responsive" src="<?php echo(empty($logo) ? base_url('img/PlProject/default.png'): base_url('img/PlProject/'.$logo) );?>" width="120px" id="picturebox">
                </div>
                <br>
                <input type="file" id="picture" name="picture"> <p>(* Only Jpeg, Jpg, Png allowed)</p>
                <input type="hidden" id="picturepath" value="..file path" readonly="1">
            </div>
            <input type="hidden" name="project" id="project" value="<?php echo $project?>">
            <input type="submit" value="Save Logo" />
        <!-- </form> -->
    </section>
    <section class="content" >
            <h3>Attachment Brochure</h3>
        <!-- <form id="form" method="post" action="<?php echo base_url('attachment/saveBrochure')?>"> -->
            <div id="uploader">
                <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
                <?php //echo base_url("plugins/plupload/js/Moxie.swf")?>
            </div>
            <br />
            <input type="submit" value="Save Attachment" />
        </form>
    </section>
</div>
<!--
<script src="<?php echo base_url('plugins/jQueryUI/jquery-1.9.0.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('plugins/jQueryUI/jquery-ui-1.10.2.min.js')?>" type="text/javascript"></script> -->
<script type="text/javascript" src="<?php echo base_url('plugins/plupload/js/plupload.full.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('plugins/plupload/js/jquery.ui.plupload/jquery.ui.plupload.js')?>"></script>
<script type="text/javascript">
// Initialize the widget when the DOM is ready
$(function() {
    $("#uploader").plupload({
        // General settings
        runtimes : 'html5,flash,silverlight,html4',
        url : "<?php echo base_url('attachment/saveBrochure/')?>", //+'/'+$('#project').val(),  //'../upload.php',

        // User can upload no more then 20 files in one go (sets multiple_queues to false)
        max_file_count: 20,
        
        chunk_size: '1mb',

        // Resize images on clientside if we can
        resize : {
            width : 200, 
            height : 120,   
            quality : 90,
            crop: false // crop to exact dimensions
        },
        
        filters : {
            // Maximum file size
            max_file_size : '1000mb',
            // Specify what files to browse for
            mime_types: [
                {title : "Image files", extensions : "jpg,gif,png"},
                {title : "Zip files", extensions : "zip"}
            ]
        },
        multipart_params : {
            "project" : $('#project').val()
        },

        // Rename files by clicking on their titles
        rename: true,
        
        // Sort files
        sortable: true,

        // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
        dragdrop: true,

        // Views to activate
        views: {
            list: true,
            thumbs: true, // Show thumbs
            active: 'thumbs'
        },

        // Flash settings
        flash_swf_url : '<?php echo base_url("plugins/plupload/js/Moxie.swf")?>',

        // Silverlight settings
        silverlight_xap_url : '<?php echo base_url("plugins/plupload/js/Moxie.xap")?>'
    });


    // Handle the case when form was submitted before uploading has finished
    $('#form').submit(function(e) {
        // Files in queue upload them first
        if ($('#uploader').plupload('getFiles').length > 0) {

            // When all files are uploaded submit form
            $('#uploader').on('complete', function() {
                $('#form')[0].submit();
            });

            $('#uploader').plupload('start');
        } else {
            alert("You must have at least one file in the queue.");
        }
        return false; // Keep the form from submitting
    });

    $("#picture").on('change', function() {
        $("#picturepath").val(this.files[0].name);
        readURL(this);
    });

    function readURL(input) {
        if(input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#picturebox").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
});
</script>
