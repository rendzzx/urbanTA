<style>

 /* html {
  box-sizing: border-box; }*/

/**, *:before, *:after { 
  box-sizing: inherit; }*/

.row {
  display: flex; 
  justify-content: space-between; }

.square {
  height: 0; }

.square-25 {
  width: 25%;
  padding-bottom: 25%; }

.square-33 {
  width: 33.333333%;
  padding-bottom: 33.333333%; }

.square-50 {
  width: 50%;
  padding-bottom: 50%; }

.square-100 {
  width: 100%;
  padding-bottom: 100%; }



// Styling
.square {
  position: relative;
  display: inline-block;
  vertical-align: top;
  background-color: #eee; }

.grid {
  /*display: block;*/
  display: flex;
  padding: 0;
  margin: 0 -6px 12px;
  text-align: left;
  font-size: 0;
  justify-content: center; }

.grid-cell-1 {
  display: inline-block;
  margin: 0;
  padding: 0 6px;
  text-align: left;
  /*vertical-align: top;*/
  /*align-self: flex-end;*/
  width: 100%;
  font-size: 16px; }

.grid-cell-2 {
  display: inline-block;
  margin: 0;
  padding: 0 6px;
  text-align: left;
  /*vertical-align: top;*/
  width: 100%;
  font-size: 16px; 
  /*align-self: flex-end;*/ }

.grid-20 { width: 14%; }
.grid-25 { width: 25%; }
.grid-33 { width: 33.333333%; }
.grid-50 { width: 50%; }

// Styles that are specific to this demo
body {
  background: #353B6E;
  padding: 5%;
  font-size: 0; }

.square {
  overflow: hidden;
  border-radius: 8px;
  background-size: cover;
  box-shadow: 0 3px 12px rgba(#252243, .9); }
  
.one {
  background-image: url('../../img/gallery/menu/s+.jpg'); }
 
.two {
  background-image: url('../../img/gallery/menu/m+.jpg'); }

.three {
  background-image: url('../../img/gallery/menu/o+.jpg'); }

.four {
  background-image: url('../../img/gallery/menu/cs.jpg'); }

.five {
  background-image: url('../../img/gallery/menu/overtime.jpg'); }

.six {
  background-image: url('../../img/gallery/menu/meter.jpg'); }

.title h2 {
  font-size: 22px;
  font-weight: 700;
  color: #fff;
  text-shadow: 0 1px rgba(black, .6);
  background: linear-gradient(rgba(#252243, 0), rgba(#252243, .8));
  
  margin: 0;
  padding: 36px 12px 12px;
  /*padding: auto;*/
  
  position: relative;
  left: 0;
  bottom: 0;
  right: 0; 
  visibility: hidden; }

.grid-33 figure {
  /*background: #0091dc;*/
  border-radius: 8px;
}

.grid-25 figure {
  /*background: #0091dc;*/
  border-radius: 8px;
}

.grid-20 figure {
  /*background: #0091dc;*/
  border-radius: 8px;
}

.one:hover {
  opacity: .5;
  -webkit-transition: .3s ease-in-out;
  transition: .3s ease-in-out;
}

.one:hover .title h2{
  visibility: visible;
}

.two:hover {
  opacity: .5;
  -webkit-transition: .3s ease-in-out;
  transition: .3s ease-in-out;
}

.two:hover .title h2{
  visibility: visible;
}

.three:hover {
  opacity: .5;
  -webkit-transition: .3s ease-in-out;
  transition: .3s ease-in-out;
}

.three:hover .title h2{
  visibility: visible;
}

.four:hover {
  opacity: .5;
  -webkit-transition: .3s ease-in-out;
  transition: .3s ease-in-out;
}

.four:hover .title h2{
  visibility: visible;
}

.five:hover {
  opacity: .5;
  -webkit-transition: .3s ease-in-out;
  transition: .3s ease-in-out;
}

.five:hover .title h2{
  visibility: visible;
}

.six:hover {
  opacity: .5;
  -webkit-transition: .3s ease-in-out;
  transition: .3s ease-in-out;
}

.six:hover .title h2{
  visibility: visible;
}

    @media(max-width: 1024px){
      .grid-20 { width: 25%; }
    }
    
    @media(max-width: 768px){
      .grid-20 { width: 30%; }

    }

   
    @media(max-width: 480px){
      .grid-20 { width: 30%; }
    }

    @media(max-width: 420px){
      .grid-20 { width: 30%; }
    }

    
    @media(max-width: 412px){
      .grid-20 { width: 30%; }
    }

    
    @media(max-width: 384px){
      .grid-20 { width: 30%; }
    }

    
    @media(max-width: 360px){
      .grid-20 { width: 30%; }
    }

    
    @media(max-width: 320px){
      .grid-20 { width: 30%; }
    }


</style>


<!-- <div class="row border-bottom white-bg dashboard-header">   
    <div class="col-sm-12">
      <h1>
      
      </h1>
      <font color="#00000" face="ARIAL" size="4">
        <CENTER>COMING SOON</CENTER>
      </font>
    </div>      
         
</div>


      <div class="wrapper wrapper-content" style="background-color: #fff !important;">
  
       <center><img src="<?php echo base_url('img/comingsoon.png');?>"><br>
        This menu is still under maintenance. Please comeback later. <a href="<?php echo base_url('administrator/index');?>" class="btn btn-primary">Back</a></center>
        



      </div> -->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before">
           <div class="col-12 d-flex align-items-center justify-content-center">
              <div class="col-md-6 col-10 ">
                  <div class="card card-transparent ">
                      <div class="card-header card-transparent  border-0">
                          <div class="text-center mb-1">
                              <img src="<?php echo base_url('img/comingsoon.png');?>" alt="branding logo">
                          </div>
                          <div class="font-large-1  text-center ">
                              WE ARE COMING SOON !!
                          </div>
                              <div class="col-12 pt-1 text-center">
                                  <p class="card-text lead ">Our website is under construction.</p>
                              </div>
                      </div>
                    
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
