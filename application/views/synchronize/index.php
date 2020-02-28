

   
<script type="text/javascript">
// window.history.forward();
</script>

 <style type="text/css">
  #loader{
    width:80%;
    height:100%;
    position:fixed;
   left: 9%;
    top: 1%;
   z-index: 99999;
    background:url("../img/loading.gif") no-repeat center center     
}
#cek{
    /*width:20%;*/
 

    background:url("../img/Y.png") no-repeat center center
    /*width: 58px;height: 47px;*/
}
#cek2{
/*width: 10px;height: 50px;*/


    background:url("../img/Y.png") no-repeat center center
}

#cek3{
/*width: 10px;height: 50px;*/

 
    background:url("../img/Y.png") no-repeat center center
}
#cek4{
/*width: 10px;height: 50px;*/

 
    background:url("../img/Y.png") no-repeat center center
}
/*#but{

 

    visibility:hidden;
}*/
#eror{

 

    background:url("../img/X.png") no-repeat center center
}
#eror2{


    background:url("../img/X.png") no-repeat center center
}
#eror3{


    background:url("../img/X.png") no-repeat center center
}
#eror4{


    background:url("../img/X.png") no-repeat center center
}
#list{
    background: #f3f3f4;
    border-left: 6px solid #e7eaec;
    border-right: 6px solid #e7eaec;
    border-radius: 4px;
    color: inherit;
    margin-bottom: 2px;
    padding: 10px;
    /*position: relative;*/
    height: 40px;
    list-style: none outside none;
font-size: 11px;
text-align: left;


}

#list .cek{
    background: #f3f3f4;
    
    color: inherit;
    margin-bottom: 2px;
    padding: 10px;
    /*height: 20px;*/
    list-style: none outside none;
    font-size: 11px;
    background:url("../img/Y.png") no-repeat center center

}

#list .cek2{
    background: #f3f3f4;
    
    color: inherit;
    margin-bottom: 2px;
    padding: 10px;
    /*height: 20px;*/
    list-style: none outside none;
font-size: 11px;
   background:url("../img/Y.png") no-repeat center center


}

#list .cek3{
    background: #f3f3f4;
    
    color: inherit;
    margin-bottom: 2px;
    padding: 10px;
    /*height: 20px;*/
    list-style: none outside none;
font-size: 11px;
   background:url("../img/Y.png") no-repeat center center


}

#list .cek4{
    background: #f3f3f4;
    
    color: inherit;
    margin-bottom: 2px;
    padding: 10px;
    /*height: 20px;*/
    list-style: none outside none;
font-size: 11px;
   background:url("../img/Y.png") no-repeat center center


}

#list .eror{
    background: #f3f3f4;
    
    color: inherit;
    margin-bottom: 2px;
    padding: 10px;
    /*height: 20px;*/
    list-style: none outside none;
font-size: 11px;
   background:url("../img/X.png") no-repeat center center


}

#list .eror2{
    background: #f3f3f4;
    
    color: inherit;
    margin-bottom: 2px;
    padding: 10px;
    /*height: 20px;*/
    list-style: none outside none;
font-size: 11px;
   background:url("../img/X.png") no-repeat center center


}

#list .eror3{
    background: #f3f3f4;
    
    color: inherit;
    margin-bottom: 2px;
    padding: 10px;
    /*height: 20px;*/
    list-style: none outside none;
font-size: 11px;
   background:url("../img/X.png") no-repeat center center


}
#list .eror4{
    background: #f3f3f4;
    
    color: inherit;
    margin-bottom: 2px;
    padding: 10px;
    /*height: 20px;*/
    list-style: none outside none;
font-size: 11px;
   background:url("../img/X.png") no-repeat center center


}

label img{
    pointer-events: none;
}
label{
    display: inline-block;
}


</style>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>


<script type="text/javascript">


 function proses2() {
     // body...

               var datafrm = 'ar_,';
               $.ajax({

                url : "<?php echo base_url('c_synchronize/sinkron');?>",
                type:"POST",
                data: {models:datafrm},
                dataType:"json",
                success:function(event, data){
                        // console.log('2');

                        if(event.Status=='OK') //sukses ar
                        {
                            alert('masuk ar');
                            $({property: 0}).animate({property: 105}, {
                                duration: 4000,
                                step: function() {
                                    var _percent = Math.round(this.property);
                                    $('#progress').css('width',  _percent+"%");
                                    if(_percent == 105) {
                                        $("#progress").addClass("done");
                                    }
                                  
                                    
                                },
                                complete: function() {

                                }
                            });
                            $('#progres').fadeIn();
                            $('#cek').fadeIn();
                            $('#but').hide(); 
                            var datafrm = 'rl_,';
                                $.ajax({
                                    url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                    type:"POST",
                                    data: {models:datafrm},
                                    dataType:"json",
                                    success:function(event, data){
                                        // console.log('2');

                                        if(event.Status2=='OK'){ //sukses rl

                                          alert('masuk sales');
                                          $({property: 0}).animate({property: 105}, {
                                                duration: 4000,
                                                step: function() {
                                                    var _percent = Math.round(this.property);
                                                    $('#progress').css('width',  _percent+"%");
                                                    if(_percent == 105) {
                                                        $("#progress").addClass("done");
                                                    }
                                                },
                                                complete: function() {
                                                    
                                                }
                                                });
                                          $('#cek2').fadeIn();
                                          $('#but2').hide(); 
                                            var datafrm = 'cf_,cfs_,cb_,next_,pl_,security_,cm_,pm_,gl_,ap_,sv_,';
                                                        $.ajax({
                                                            url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                            type:"POST",
                                                            data: {models:datafrm},
                                                            dataType:"json",
                                                            success:function(event, data){
                                                                // console.log('2');

                                                                if(event.Status3=='OK'){

                                                                  alert('masuk master');
                                                                  
                                                                  $({property: 0}).animate({property: 105}, {
                                                                    duration: 4000,
                                                                    step: function() {
                                                                        var _percent = Math.round(this.property);
                                                                        $('#progress').css('width',  _percent+"%");
                                                                        if(_percent == 105) {
                                                                            $("#progress").addClass("done");
                                                                        }
                                                                    },
                                                                    complete: function() {
                                                                        alert('complete');
                                                                    }
                                                                });
                                                                $('#cek3').fadeIn();
                                                                $('#but3').hide(); 
                                                                var datafrm = 'pm_,';
                                                                    $.ajax({
                                                                        url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                                        type:"POST",
                                                                        data: {models:datafrm},
                                                                        dataType:"json",
                                                                        success:function(event, data){
                                                                            // console.log('2');

                                                                            if(event.Status4=='OK'){

                                                                              alert('masuk tenancy');
                                                                              
                                                                              $({property: 0}).animate({property: 105}, {
                                                                                duration: 4000,
                                                                                step: function() {
                                                                                    var _percent = Math.round(this.property);
                                                                                    $('#progress').css('width',  _percent+"%");
                                                                                    if(_percent == 105) {
                                                                                        $("#progress").addClass("done");
                                                                                    }
                                                                                },
                                                                                complete: function() {
                                                                                    alert('complete');
                                                                                }
                                                                            });
                                                                            $('#cek4').fadeIn();
                                                                            $('#but4').hide(); 
                                                                            } else {
                                                                              alert('no tenancy');
                                                                              $('#eror4').fadeIn();
                                                                              $('#but4').hide(); 
                                                                          }
                                                            
                                                                        },                    
                                                                        error: function(jqXHR, textStatus, errorThrown){
                                                                              alert('eror tenancy');
                                                                         
                                                                        }
                                                                    });
                                                                } else {
                                                                  alert('no master');
                                                                  $('#eror3').fadeIn();
                                                                  $('#but3').hide(); 
                                                                  var datafrm = 'pm_,';
                                                                    $.ajax({
                                                                        url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                                        type:"POST",
                                                                        data: {models:datafrm},
                                                                        dataType:"json",
                                                                        success:function(event, data){
                                                                            // console.log('2');

                                                                            if(event.Status4=='OK'){

                                                                              alert('masuk tenancy');
                                                                              
                                                                              $({property: 0}).animate({property: 105}, {
                                                                                duration: 4000,
                                                                                step: function() {
                                                                                    var _percent = Math.round(this.property);
                                                                                    $('#progress').css('width',  _percent+"%");
                                                                                    if(_percent == 105) {
                                                                                        $("#progress").addClass("done");
                                                                                    }
                                                                                },
                                                                                complete: function() {
                                                                                    alert('complete');
                                                                                }
                                                                            });
                                                                            $('#cek4').fadeIn();
                                                                            $('#but4').hide(); 
                                                                            } else {
                                                                              alert('no tenancy');
                                                                              $('#eror4').fadeIn();
                                                                              $('#but4').hide(); 
                                                                          }
                                                            
                                                                        },                    
                                                                        error: function(jqXHR, textStatus, errorThrown){
                                                                              alert('eror tenancy');
                                                                         
                                                                        }
                                                                    });
                                                              }
                                                
                                                            },                    
                                                            error: function(jqXHR, textStatus, errorThrown){
                                                                  alert('eror master');
                                                             
                                                            }
                                                        });
                                              
                                        } else { //eror rl
                                          alert('no sales');
                                          $('#eror2').fadeIn();
                                          $('#but2').hide(); 
                                          var datafrm = 'cf_,cfs_,cb_,next_,pl_,security_,cm_,pm_,gl_,ap_,sv_,';
                                                        $.ajax({
                                                            url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                            type:"POST",
                                                            data: {models:datafrm},
                                                            dataType:"json",
                                                            success:function(event, data){
                                                                // console.log('2');

                                                                if(event.Status3=='OK'){

                                                                  alert('masuk master');
                                                                  
                                                                  $({property: 0}).animate({property: 105}, {
                                                                    duration: 4000,
                                                                    step: function() {
                                                                        var _percent = Math.round(this.property);
                                                                        $('#progress').css('width',  _percent+"%");
                                                                        if(_percent == 105) {
                                                                            $("#progress").addClass("done");
                                                                        }
                                                                    },
                                                                    complete: function() {
                                                                        alert('complete');
                                                                    }
                                                                });
                                                                $('#cek3').fadeIn();
                                                                $('#but3').hide(); 
                                                                var datafrm = 'pm_,';
                                                                    $.ajax({
                                                                        url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                                        type:"POST",
                                                                        data: {models:datafrm},
                                                                        dataType:"json",
                                                                        success:function(event, data){
                                                                            // console.log('2');

                                                                            if(event.Status4=='OK'){

                                                                              alert('masuk tenancy');
                                                                              
                                                                              $({property: 0}).animate({property: 105}, {
                                                                                duration: 4000,
                                                                                step: function() {
                                                                                    var _percent = Math.round(this.property);
                                                                                    $('#progress').css('width',  _percent+"%");
                                                                                    if(_percent == 105) {
                                                                                        $("#progress").addClass("done");
                                                                                    }
                                                                                },
                                                                                complete: function() {
                                                                                    alert('complete');
                                                                                }
                                                                            });
                                                                            $('#cek4').fadeIn();
                                                                            $('#but4').hide(); 
                                                                            } else {
                                                                              alert('no tenancy');
                                                                              $('#eror4').fadeIn();
                                                                              $('#but4').hide(); 
                                                                          }
                                                            
                                                                        },                    
                                                                        error: function(jqXHR, textStatus, errorThrown){
                                                                              alert('eror tenancy');
                                                                         
                                                                        }
                                                                    });
                                                                } else {
                                                                  alert('no master');
                                                                  $('#eror3').fadeIn();
                                                                  $('#but3').hide(); 
                                                                  var datafrm = 'pm_,';
                                                                    $.ajax({
                                                                        url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                                        type:"POST",
                                                                        data: {models:datafrm},
                                                                        dataType:"json",
                                                                        success:function(event, data){
                                                                            // console.log('2');

                                                                            if(event.Status4=='OK'){

                                                                              alert('masuk tenancy');
                                                                              
                                                                              $({property: 0}).animate({property: 105}, {
                                                                                duration: 4000,
                                                                                step: function() {
                                                                                    var _percent = Math.round(this.property);
                                                                                    $('#progress').css('width',  _percent+"%");
                                                                                    if(_percent == 105) {
                                                                                        $("#progress").addClass("done");
                                                                                    }
                                                                                },
                                                                                complete: function() {
                                                                                    alert('complete');
                                                                                }
                                                                            });
                                                                            $('#cek4').fadeIn();
                                                                            $('#but4').hide(); 
                                                                            } else {
                                                                              alert('no tenancy');
                                                                              $('#eror4').fadeIn();
                                                                              $('#but4').hide(); 
                                                                          }
                                                            
                                                                        },                    
                                                                        error: function(jqXHR, textStatus, errorThrown){
                                                                              alert('eror tenancy');
                                                                         
                                                                        }
                                                                    });
                                                              }
                                                
                                                            },                    
                                                            error: function(jqXHR, textStatus, errorThrown){
                                                                  alert('eror master');
                                                             
                                                            }
                                                        });
                                      }
                        
                                    },                    
                                    error: function(jqXHR, textStatus, errorThrown){
                                          alert('eror sales');
                                     
                                    }
                                });

                        } else //eror ar
                        {
                          alert('no ar');
                          $('#eror').fadeIn();
                          var datafrm = 'rl_,';
                                $.ajax({
                                    url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                    type:"POST",
                                    data: {models:datafrm},
                                    dataType:"json",
                                    success:function(event, data){
                                        // console.log('2');

                                        if(event.Status2=='OK'){ //sukses rl

                                          alert('masuk sales');
                                          $({property: 0}).animate({property: 105}, {
                                                duration: 4000,
                                                step: function() {
                                                    var _percent = Math.round(this.property);
                                                    $('#progress').css('width',  _percent+"%");
                                                    if(_percent == 105) {
                                                        $("#progress").addClass("done");
                                                    }
                                                },
                                                complete: function() {
                                                    
                                                }
                                                });
                                          $('#cek2').fadeIn();
                                          $('#but2').hide(); 
                                            var datafrm = 'cf_,cfs_,cb_,next_,pl_,security_,cm_,pm_,gl_,ap_,sv_,';
                                                        $.ajax({
                                                            url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                            type:"POST",
                                                            data: {models:datafrm},
                                                            dataType:"json",
                                                            success:function(event, data){
                                                                // console.log('2');

                                                                if(event.Status3=='OK'){

                                                                  alert('masuk master');
                                                                  
                                                                  $({property: 0}).animate({property: 105}, {
                                                                    duration: 4000,
                                                                    step: function() {
                                                                        var _percent = Math.round(this.property);
                                                                        $('#progress').css('width',  _percent+"%");
                                                                        if(_percent == 105) {
                                                                            $("#progress").addClass("done");
                                                                        }
                                                                    },
                                                                    complete: function() {
                                                                        alert('complete');
                                                                    }
                                                                });
                                                                 $('#cek3').fadeIn();
                                                                 $('#but3').hide(); 
                                                                 var datafrm = 'pm_,';
                                                                    $.ajax({
                                                                        url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                                        type:"POST",
                                                                        data: {models:datafrm},
                                                                        dataType:"json",
                                                                        success:function(event, data){
                                                                            // console.log('2');

                                                                            if(event.Status4=='OK'){

                                                                              alert('masuk tenancy');
                                                                              
                                                                              $({property: 0}).animate({property: 105}, {
                                                                                duration: 4000,
                                                                                step: function() {
                                                                                    var _percent = Math.round(this.property);
                                                                                    $('#progress').css('width',  _percent+"%");
                                                                                    if(_percent == 105) {
                                                                                        $("#progress").addClass("done");
                                                                                    }
                                                                                },
                                                                                complete: function() {
                                                                                    alert('complete');
                                                                                }
                                                                            });
                                                                            $('#cek4').fadeIn();
                                                                            $('#but4').hide(); 
                                                                            } else {
                                                                              alert('no tenancy');
                                                                              $('#eror4').fadeIn();
                                                                              $('#but4').hide(); 
                                                                          }
                                                            
                                                                        },                    
                                                                        error: function(jqXHR, textStatus, errorThrown){
                                                                              alert('eror master');
                                                                         
                                                                        }
                                                                    });
                                                                } else {
                                                                  alert('no master');
                                                                  $('#eror2').fadeIn();
                                                                  $('#but2').hide(); 
                                                                  var datafrm = 'pm_,';
                                                                    $.ajax({
                                                                        url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                                        type:"POST",
                                                                        data: {models:datafrm},
                                                                        dataType:"json",
                                                                        success:function(event, data){
                                                                            // console.log('2');

                                                                            if(event.Status4=='OK'){

                                                                              alert('masuk tenancy');
                                                                              
                                                                              $({property: 0}).animate({property: 105}, {
                                                                                duration: 4000,
                                                                                step: function() {
                                                                                    var _percent = Math.round(this.property);
                                                                                    $('#progress').css('width',  _percent+"%");
                                                                                    if(_percent == 105) {
                                                                                        $("#progress").addClass("done");
                                                                                    }
                                                                                },
                                                                                complete: function() {
                                                                                    alert('complete');
                                                                                }
                                                                            });
                                                                            $('#cek4').fadeIn();
                                                                            $('#but4').hide(); 
                                                                            } else {
                                                                              alert('no tenancy');
                                                                              $('#eror4').fadeIn();
                                                                              $('#but4').hide(); 
                                                                          }
                                                            
                                                                        },                    
                                                                        error: function(jqXHR, textStatus, errorThrown){
                                                                              alert('eror tenancy');
                                                                         
                                                                        }
                                                                    });
                                                              }
                                                
                                                            },                    
                                                            error: function(jqXHR, textStatus, errorThrown){
                                                                  alert('eror master');
                                                             
                                                            }
                                                        });
                                              
                                        } else { //eror rl
                                          alert('no sales');
                                          $('#eror2').fadeIn();
                                          $('#but2').hide(); 
                                          var datafrm = 'cf_,cfs_,cb_,next_,pl_,security_,cm_,pm_,gl_,ap_,sv_,';
                                                        $.ajax({
                                                            url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                            type:"POST",
                                                            data: {models:datafrm},
                                                            dataType:"json",
                                                            success:function(event, data){
                                                                // console.log('2');

                                                                if(event.Status3=='OK'){

                                                                  alert('masuk master');
                                                                  $('#cek3').animate({
                                                                        height: 'toggle'
                                                                    });
                                                                  $({property: 0}).animate({property: 105}, {
                                                                    duration: 4000,
                                                                    step: function() {
                                                                        var _percent = Math.round(this.property);
                                                                        $('#progress').css('width',  _percent+"%");
                                                                        if(_percent == 105) {
                                                                            $("#progress").addClass("done");
                                                                        }
                                                                    },
                                                                    complete: function() {
                                                                        alert('complete');
                                                                    }
                                                                });
                                                                $('#cek3').fadeIn();
                                                                $('#but3').hide(); 
                                                                var datafrm = 'pm_,';
                                                                    $.ajax({
                                                                        url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                                        type:"POST",
                                                                        data: {models:datafrm},
                                                                        dataType:"json",
                                                                        success:function(event, data){
                                                                            // console.log('2');

                                                                            if(event.Status4=='OK'){

                                                                              alert('masuk tenancy');
                                                                              
                                                                              $({property: 0}).animate({property: 105}, {
                                                                                duration: 4000,
                                                                                step: function() {
                                                                                    var _percent = Math.round(this.property);
                                                                                    $('#progress').css('width',  _percent+"%");
                                                                                    if(_percent == 105) {
                                                                                        $("#progress").addClass("done");
                                                                                    }
                                                                                },
                                                                                complete: function() {
                                                                                    alert('complete');
                                                                                }
                                                                            });
                                                                            $('#cek4').fadeIn();
                                                                            $('#but4').hide(); 
                                                                            } else {
                                                                              alert('no tenancy');
                                                                              $('#eror4').fadeIn();
                                                                              $('#but4').hide(); 
                                                                          }
                                                            
                                                                        },                    
                                                                        error: function(jqXHR, textStatus, errorThrown){
                                                                              alert('eror master');
                                                                         
                                                                        }
                                                                    });
                                                                } else {
                                                                  alert('no master');
                                                                  $('#eror3').fadeIn();
                                                                  $('#but3').hide(); 
                                                                  var datafrm = 'pm_,';
                                                                    $.ajax({
                                                                        url : "<?php echo base_url('c_synchronize/sinkron');?>",
                                                                        type:"POST",
                                                                        data: {models:datafrm},
                                                                        dataType:"json",
                                                                        success:function(event, data){
                                                                            // console.log('2');

                                                                            if(event.Status4=='OK'){

                                                                              alert('masuk tenancy');
                                                                              
                                                                              $({property: 0}).animate({property: 105}, {
                                                                                duration: 4000,
                                                                                step: function() {
                                                                                    var _percent = Math.round(this.property);
                                                                                    $('#progress').css('width',  _percent+"%");
                                                                                    if(_percent == 105) {
                                                                                        $("#progress").addClass("done");
                                                                                    }
                                                                                },
                                                                                complete: function() {
                                                                                    alert('complete');
                                                                                }
                                                                            });
                                                                            $('#cek4').fadeIn();
                                                                            $('#but4').hide(); 
                                                                            } else {
                                                                              alert('no tenancy');
                                                                              $('#eror4').fadeIn();
                                                                              $('#but4').hide(); 
                                                                          }
                                                            
                                                                        },                    
                                                                        error: function(jqXHR, textStatus, errorThrown){
                                                                              alert('eror tenancy');
                                                                         
                                                                        }
                                                                    });
                                                              }
                                                
                                                            },                    
                                                            error: function(jqXHR, textStatus, errorThrown){
                                                                  alert('eror master');
                                                             
                                                            }
                                                        });
                                      }
                        
                                    },                    
                                    error: function(jqXHR, textStatus, errorThrown){
                                          alert('eror sales');
                                     
                                    }
                                });
                          
                      }

                  },                    
                  error: function(jqXHR, textStatus, errorThrown){
                      alert('eror ar');

                  }
              });
                       
            // });
             }


function cekAR() {

    var datafrm = 'ar_,';
        $.ajax({
            url : "<?php echo base_url('c_synchronize/sinkron');?>",
            type:"POST",
            data: {models:datafrm},
            dataType:"json",
            success:function(event, data){
                // console.log('2');

                if(event.Status=='OK'){

                  alert('masuk ar');
                  
                  $({property: 0}).animate({property: 105}, {
                    duration: 4000,
                    step: function() {
                        var _percent = Math.round(this.property);
                        $('#progress').css('width',  _percent+"%");
                        if(_percent == 105) {
                            $("#progress").addClass("done");
                        }
                    },
                    complete: function() {
                        alert('complete');
                    }
                });
                 
                $('#cek').fadeIn();
                 $('#but').hide(); 
                } else {
                  alert('no tenancy');
                  $('#eror').fadeIn();
                  $('#but').hide(); 
              }

            },                    
            error: function(jqXHR, textStatus, errorThrown){
                  alert('eror master');
             
            }
        });
}

function cekSales() {
    var datafrm = 'rl_,';
        $.ajax({
            url : "<?php echo base_url('c_synchronize/sinkron');?>",
            type:"POST",
            data: {models:datafrm},
            dataType:"json",
            success:function(event, data){
                // console.log('2');

                if(event.Status2=='OK'){

                  alert('masuk sales');
                  
                  $({property: 0}).animate({property: 105}, {
                    duration: 4000,
                    step: function() {
                        var _percent = Math.round(this.property);
                        $('#progress').css('width',  _percent+"%");
                        if(_percent == 105) {
                            $("#progress").addClass("done");
                        }
                    },
                    complete: function() {
                        alert('complete');
                    }
                });
                $('#cek2').fadeIn();
                $('#but2').hide(); 
                } else {
                  alert('no sales');
                  $('#eror2').fadeIn();
                  $('#but2').hide(); 
              }

            },                    
            error: function(jqXHR, textStatus, errorThrown){
                  alert('eror master');
             
            }
        });
}

function cekMaster() {
    var datafrm = 'cf_,cfs_,cb_,next_,pl_,security_,cm_,pm_,gl_,ap_,sv_,';
        $.ajax({
            url : "<?php echo base_url('c_synchronize/sinkron');?>",
            type:"POST",
            data: {models:datafrm},
            dataType:"json",
            success:function(event, data){
                // console.log('2');

                if(event.Status3=='OK'){

                  alert('masuk master');
                  
                  $({property: 0}).animate({property: 105}, {
                    duration: 4000,
                    step: function() {
                        var _percent = Math.round(this.property);
                        $('#progress').css('width',  _percent+"%");
                        if(_percent == 105) {
                            $("#progress").addClass("done");
                        }
                    },
                    complete: function() {
                        alert('complete');
                    }
                });
                $('#cek3').fadeIn();
                $('#but3').hide(); 
                } else {
                  alert('no master');
                  $('#eror3').fadeIn();
                  $('#but3').hide(); 
              }

            },                    
            error: function(jqXHR, textStatus, errorThrown){
                  alert('eror master');
             
            }
        });
}

function cekTenancy() {
    var datafrm = 'pm_,';
        $.ajax({
            url : "<?php echo base_url('c_synchronize/sinkron');?>",
            type:"POST",
            data: {models:datafrm},
            dataType:"json",
            success:function(event, data){
                // console.log('2');

                if(event.Status4=='OK'){

                  alert('masuk tenancy');
                  
                  $({property: 0}).animate({property: 105}, {
                    duration: 4000,
                    step: function() {
                        var _percent = Math.round(this.property);
                        $('#progress').css('width',  _percent+"%");
                        if(_percent == 105) {
                            $("#progress").addClass("done");
                        }
                    },
                    complete: function() {
                        alert('complete');
                    }
                });
                $('#cek4').fadeIn();
                $('#but4').hide(); 
                } else {
                  alert('no tenancy');
                  $('#eror4').fadeIn();
                  $('#but4').hide(); 
              }

            },                    
            error: function(jqXHR, textStatus, errorThrown){
                  alert('eror master');
             
            }
        });
}

</script>

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
   <div class="row border-bottom white-bg dashboard-header">  
       
    </div>
    <div id="load" hidden="true"></div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12"  style="text-align: center">
                <div class="ibox-content">
             <div class="panel panel-warning">
                <div class="panel-heading">
                    
                </div>
                    <div class="table-responsive"> 
                        <div id="progress" class="waiting">
                            <dt></dt>
                            <dd></dd>           
                         </div>
                   
                    
                        <div class="box-body">
                       
                        <!-- <button type="button" id="proses2" style="padding-left:5px; width: 95%;height: 40px;" onclick="proses2()" class="btn biru-bg fa fa-refresh"> Synchronize
                      
                        </button> -->
                      
                        <img src="../img/sinkron.png" style="width: 100px;height: 90px;" class="btn" id="proses2" onclick="proses2()" /><span style="font-size: 28px;">Synchronize All</span>
                       
                        <!-- <img src="../img/sinkron.png" style="width: 600px;height: 100px; position: relative;padding-left: 500px;" class="btn" id="proses2" onclick="proses2()" /><span><br><h2 style="position: absolute;padding-left: 480px;">Synchronize</h2></span> -->
                       
                          <!--  <ul id="list">
                                <li >
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">No.</label> 
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">Table Name</label>
                                    
                                
                               <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">Action</label>
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">Synchronize</label>
                                 
                                </li>
                            </ul>
                            <ul id="list">
                                <li >
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">1</label> 
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">Account Receivable  </label>
                                
                                
                             <button type="button" class="col-xs-6 col-sm-3 btn btn-primary btn-xs" onclick="cekAR()">Synchronize</button>
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;"><img id="eror" class="eror" hidden="true"></label>
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;"><img id="cek" class="cek" hidden="true"></label>

                                </li>
                            </ul>
                            <ul id="list">
                                <li >
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">2</label> 
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">Sales Administration</label>
                                <button type="button" class="col-xs-6 col-sm-3 btn btn-primary btn-xs" onclick="cekSales()">Synchronize</button>
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;"><img id="cek2" class="cek2" hidden="true"></label>
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;"><img id="eror2" class="eror2" hidden="true"></label>
                              
                                </li>
                            </ul>
                            <ul id="list">
                                <li >
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">3</label> 
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">Master Fal         </label>
                                <button type="button" class="col-xs-6 col-sm-3 btn btn-primary btn-xs" onclick="cekMaster()">Synchronize</button>
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;"><img id="cek3" class="cek3" hidden="true"></label>
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;"><img id="eror3" class="eror3" hidden="true"></label>
                              
                                </li>

                            </ul>
                            
                             <ul id="list">
                                <li >
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">4</label> 
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;">Tenancy Management  </label>
                                <button type="button" class="col-xs-6 col-sm-3 btn btn-primary btn-xs" onclick="cekTenancy()">Synchronize</button> 
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;"><img id="cek4" class="cek4" hidden="true"></label>
                                <label class="col-xs-6 col-sm-3" style="padding-left: 40px;"><img id="eror4" class="eror4" hidden="true"></label>
                               
                                </li>

                            </ul> -->
                           <table>
                              <tr>
                                <th>No.</th>
                                <th>Table Name</th>
                                <th>Synchronize</th>
                               
                              </tr>
                              <tr>
                                <td>1</td>
                                <td>Account Receivable</td>
                                <td>
                                    <!-- <button type="button" class="col-xs-6 col-sm-3 btn btn-primary btn-xs" onclick="cekAR()">Synchronize</button> -->
                                    <img src="../img/sinkron.png" id="but" style="width: 38px;height: 38px;padding:0px;" class="but btn" onclick="cekAR()" />
                                    <img src="../img/X.png" alt="" id="eror" class="eror" hidden="true">
                                    <img src="../img/Y.png" alt="" id="cek"  class="cek" hidden="true">
                                    <!--  -->
                                </td>
                                
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>Sales Administration</td>
                                <td>
                                    <img src="../img/sinkron.png" id="but2" style="width: 38px;height: 38px;padding:0px;" class="but2 btn" onclick="cekSales()" />
                                    <img src="../img/X.png" alt="" id="eror2" class="eror2" hidden="true">
                                    <img src="../img/Y.png" alt="" id="cek2" class="cek2" hidden="true">
                                </td>
                               <!--  -->
                              </tr>
                              <tr>
                                <td>3</td>
                                <td>Master File</td>
                                <td>
                                    <img src="../img/sinkron.png" id="but3" style="width: 38px;height: 38px;padding:0px;" class="but3 btn" onclick="cekMaster()" />
                                    <img src="../img/X.png" alt="" id="eror3" class="eror3" hidden="true">
                                    <img src="../img/Y.png" alt="" id="cek3" class="cek3" hidden="true">
                                </td>
                                
                              </tr>
                              <tr>
                                <td>4</td>
                                <td>Tenancy Management</td>
                                <td>
                                    <img src="../img/sinkron.png" id="but4" style="width: 38px;height: 38px;padding:0px;" class="but4 btn" onclick="cekTenancy()" />
                                    <img src="../img/X.png" alt="" id="eror4" class="eror4" hidden="true">
                                    <img src="../img/Y.png" alt="" id="cek4" class="cek4" hidden="true">
                                </td>
                                
                              </tr>
                              
                            </table>
                        </div>

                    
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


