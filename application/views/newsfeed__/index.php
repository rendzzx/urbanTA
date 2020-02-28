<div class="content-wrapper">
  <section class="content-header">
    <h1>
      News Feed
    </h1>
  </section>
  <section class="content">
    <?php if($error !=null){ 
      foreach ($error as $key => $value) {
        echo $value ."<br />";
      }
    }
    ?>
    <div class="row">
      <div class="col-md-12">
      	<!-- timeline -->
        <ul class="timeline">
        	<?php echo $list_nf; ?>
        </ul>
      </div>
    </div>
   
    <!-- modal image -->
    <div id="myModal" class="modal_img">
      <span class="close">×</span>
      <img class="modal-content" id="img01">
      <div id="caption"></div>
    </div>
  </section>
</div>

<script type="text/javascript">
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
$("#myImg").onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>