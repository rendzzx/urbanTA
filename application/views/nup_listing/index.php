<script src="<?=base_url('js/plugins/pdfjs/pdf.js')?>"></script>
<script type="text/javascript">
window.history.forward();
</script>

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
	<section class="row border-bottom white-bg dashboard-header">
    <div class="form-group">        
        <label for="pl_project" class="control-label pull-left"><?php echo $ProjectDescs;?></label>
        <label for="pl_project" class="control-label pull-right">NUP Listing</label>
    </div><br>
        <div class="form-group">
            <label for="pl_project" class="col-sm-1 control-label" style="padding-left:0px;">Project</label>
            <div class="col-sm-10">
                <select name="txt_Pl_Project" id="txt_Pl_Project" data-placeholder="Choose a Project..." class="select2" style="width:250px;" tabindex="2">
                              <option value=""></option> 
                              <?php 
                                  foreach ($project as $row) 
                                  {
                                      echo '<option value="'.$row->project_no.'">'.$row->descs.'</option>';
                                  }
                              ?>            
                </select>
            </div>
            <br>
        </div>
    </section>
    <div class="wrapper wrapper-content">
            
                    <div class="text-center pdf-toolbar">

                            <div class="btn-group">
                                <button id="prev" class="btn btn-white"><i class="fa fa-long-arrow-left"></i> <span class="hidden-xs">Previous</span></button>
                                <button id="next" class="btn btn-white"><i class="fa fa-long-arrow-right"></i> <span class="hidden-xs">Next</span></button>
                                <button id="download" class="btn btn-white"><i class="fa fa-download"></i> <span class="hidden-xs">Download</span></button>
                                
                                <span class="btn btn-white hidden-xs">Go to Page: </span>

                            <div class="input-group">
                                <input type="text" class="form-control" id="page_num">

                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-white" id="page_count">/ 22</button>
                                </div>
                            </div>

                                </div>
                        </div>


            <div class="text-center m-t-md">
                <canvas id="canvasnya" class="pdfcanvas border-left-right border-top-bottom b-r-md"></canvas>
            </div>


        </div>
</div>
<script type="text/javascript">
var pdf = "MI_2016.pdf";
$(document).ready(function(){
    var url = '';
    
	$('#txt_Pl_Project').select2();
	$('#txt_Pl_Project').on("change",function(e){
        
   		var project = $('#txt_Pl_Project').val();
        // var pdf = 'NUPListing_'+project+'.pdf';

        Create_pdf(project);


	    // var url = '<?php echo base_url("pdf/Reports")?>/'+pdf;
     //    PDFJS.getDocument(url).then(function (pdfDoc_) {
     //        pdfDoc = pdfDoc_;
     //        var documentPagesNumber = pdfDoc.numPages;
     //        document.getElementById('page_count').textContent = '/ ' + documentPagesNumber;

     //        $('#page_num').on('change', function() {
     //            var pageNumber = Number($(this).val());

     //            if(pageNumber > 0 && pageNumber <= documentPagesNumber) {
     //                queueRenderPage(pageNumber, scale);
     //            }

     //        });

     //        // Initial/first page rendering
     //        renderPage(pageNum, scale);
     //    });
      
	});
      $('#download').click(function(){
        var project = $('#txt_Pl_Project').val();
        var pdf = 'NUPListing_'+project+'.pdf';
        if (project == ''){
            swal('Information','Please choose project','warning');
        } else {
            window.location.href="<?php echo base_url('c_nup_listing/download')?>/"+pdf;
        }
        
        });
    
});

   function Create_pdf(project_no){
        var pdf = 'NUPListing_'+project_no+'.pdf';
        var site_url = '<?php echo base_url("c_nup_listing/create_pdf")?>';
            $.post(site_url,
              {project_no:project_no},
              function(data) {
                // console.log(data);
                var url = '<?php echo base_url("pdf/Reports")?>/'+pdf;
                    PDFJS.getDocument(url).then(function (pdfDoc_) {
                        pdfDoc = pdfDoc_;
                        var documentPagesNumber = pdfDoc.numPages;
                        document.getElementById('page_count').textContent = '/ ' + documentPagesNumber;

                        $('#page_num').on('change', function() {
                            var pageNumber = Number($(this).val());

                            if(pageNumber > 0 && pageNumber <= documentPagesNumber) {
                                queueRenderPage(pageNumber, scale);
                            }

                        });

                        // Initial/first page rendering
                        renderPage(pageNum, scale);
                    });
              }
            );
    }          

</script>
<script id="script">
        //
        // If absolute URL from the remote server is provided, configure the CORS
        // header on that server.
        //
        var url = '';


        var pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = 1.5,
                zoomRange = 0.25,
                canvas = document.getElementById('canvasnya'),
                ctx = canvas.getContext('2d');

        function renderPage(num, scale) {
            pageRendering = true;
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
                var viewport = page.getViewport(scale);
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                var renderTask = page.render(renderContext);

                // Wait for rendering to finish
                renderTask.promise.then(function () {
                    pageRendering = false;
                    if (pageNumPending !== null) {
                        // New page rendering is pending
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });

            // Update page counters
            document.getElementById('page_num').value = num;
        }
        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num,scale);
            }
        }
        /**
         * Displays previous page.
         */
        function onPrevPage() {
            if (pageNum <= 1) {
                return;
            }
            pageNum--;
            var scale = pdfDoc.scale;
            queueRenderPage(pageNum, scale);
        }
        document.getElementById('prev').addEventListener('click', onPrevPage);

        /**
         * Displays next page.
         */
        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) {
                return;
            }
            pageNum++;
            var scale = pdfDoc.scale;
            queueRenderPage(pageNum, scale);
        }
        document.getElementById('next').addEventListener('click', onNextPage);
        /**
         * Asynchronously downloads PDF.
         */
        PDFJS.getDocument(url).then(function (pdfDoc_) {
            pdfDoc = pdfDoc_;
            var documentPagesNumber = pdfDoc.numPages;
            document.getElementById('page_count').textContent = '/ ' + documentPagesNumber;

            $('#page_num').on('change', function() {
                var pageNumber = Number($(this).val());

                if(pageNumber > 0 && pageNumber <= documentPagesNumber) {
                    queueRenderPage(pageNumber, scale);
                }

            });

            // Initial/first page rendering
            renderPage(pageNum, scale);
        });

    </script>