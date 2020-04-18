<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">

    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/validation/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD5m2mfHIIB1Zu8nYFJRbwdYuNlsnO3A5w&callback=initMap"async defer></script> -->
    <style type="text/css">
        .has-error .select2 {
            border: 1px solid #a94442;
            border-radius: 4px;
        }
        .has-error .checkbox-inline {
            border: 1px solid #a94442;
            border-radius: 4px;
        }
        .has-error .radio-inline {
            border: 1px solid #a94442;
            border-radius: 4px;
        }
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
<!-- link -->

<!-- content -->
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">

            <div class="form-group">
                <label for="event_id" class="col-xs-8">Event ID</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="event_id" id="event_id" placeholder="Event id will be added automatically" readonly="">
                </div>
            </div>
            
            <div class="form-group">
                <label for="name" class="col-xs-8">Event Name</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Event Name">
                </div>
            </div>

            <div class="form-group">
                <label for="Descs" class="col-xs-8">Description</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="descs" id="descs" placeholder="Event Description">
                </div>
            </div>
            
            <div class="form-group">
                <label for="URL" class="col-xs-8 control-label">Event Date</label>
                <div class="col-xs-8">
                    <input type="date" class="form-control" name="event_date" id="event_date" placeholder="date">
                </div>
            </div>
            
            <div class="form-group">
                <label for="event_location" class="col-xs-8">Event Location</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="event_location" id="event_location" placeholder="Event Location">
                </div>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label for="event_latitude" class="col-xs-8">Latitude</label>
                        <input type="text" class="form-control" name="event_latitude" id="event_latitude" placeholder="Latitude" readonly>
                    </div>
                    <div class="col-6">
                        <label for="event_longitude" class="col-xs-8">Longitude</label>
                        <input type="text" class="form-control" name="event_longitude" id="event_longitude" placeholder="Longitude" readonly>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div id="map"></div>
            </div>
        </div>
    </form>
<!-- content -->

<!-- js -->
    <script type="text/javascript">
        $(document).ready(function () {
            loaddata();
            $("#frmEditor").validate({
                rules: {
                    name: {
                        required: true
                    },
                    descs: {
                        required: true
                    },
                    event_date:{
                        required:true
                    },
                    event_location:{
                        required:true,
                    },
                    event_latitude:{
                        required:true,
                    },
                    event_longitude:{
                        required:true,
                    }
                },
                errorElement: "span",
                highlight: function (element, errorClass, validClass) {
                        $(element).addClass(errorClass); //.removeClass(errorClass);
                        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass(errorClass); //.addClass(validClass);
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } 
                    else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
                        error.insertAfter(element.next('span'));
                    } 
                    else {
                        error.insertAfter(element);
                    }
                }
            });

            $('#savefrm').click(function(event){
                event.preventDefault();
                if (event.handled !== true) {
                    event.handled = true;
                    if ($('#frmEditor').valid()) {
                        block(true);
                        var id = $('#modal').data('rowID');
                        var datafrm = $('#frmEditor').serializeArray();
                        // console.log(datafrm);
                        $.ajax({
                            url : "<?php echo base_url('C_event/save');?>",
                            type:"POST",
                            data: datafrm,
                            dataType:"json",
                            success:function(event, data){
                                if (event.Error == false) {
                                    Swal.fire({
                                        title: "Information",
                                        animation: true,
                                        icon:"success",
                                        text: event.Message,
                                        confirmButtonText: "OK"
                                    });
                                    $('#modal').modal('hide');
                                    tblevent.ajax.reload(null,true);
                                }
                                else{
                                    Swal.fire({
                                        title: "Information",
                                        animation: false,
                                        icon:"error",
                                        text: event.Message,
                                        confirmButtonText: "OK"
                                    });
                                }
                                block(false);
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                Swal.fire({
                                    title: "Error",
                                    animation: false,
                                    type:"error",
                                    text: textStatus+' Save : '+errorThrown,
                                    confirmButtonText: "OK"
                                });
                                block(false);
                            }
                        });
                    }
                    else{
                        block(false);
                    }
                }
            });
        });

        function loaddata(){
            var id = $('#modal').data('id');
            if (id != '' && id != 0) {
                $.getJSON("<?php echo base_url('C_event/getByID');?>" + "/" + id, function (data) {
                    $('#event_id').val(data.event_id);
                    $('#name').val(data.event_name);
                    $('#descs').val(data.event_descs);
                    $('#event_date').val(data.event_date).trigger('click');
                    $('#event_location').val(data.event_location);
                    $('#event_latitude').val(data.event_latitude);
                    $('#event_longitude').val(data.event_longitude);
                    initMap(data.event_latitude, data.event_longitude);
                });
            }
            else{
                initMap('','');
            }
        }

        $('#modal').one('hidden.bs.modal', function (e) {
            $(this).removeData();
        });

        function initMap(Latitude, Longitude) {
            if (Latitude != '' && Longitude != '') {
                var myLatlng = {
                    lat: Number(Latitude), 
                    lng: Number(Longitude)
                };

                var infoWindow = new google.maps.InfoWindow({
                    content: myLatlng.lat.toString() +', '+ myLatlng.lng.toString(),
                    position: myLatlng
                });
            }
            else{
                var myLatlng = {
                    lat: -6.23254782469231, 
                    lng: 106.85078593610478
                };

                var infoWindow = new google.maps.InfoWindow({
                    content: 'Click the map to get Latatitude and Longitude!',
                    position: myLatlng
                });
            }
            var map = new google.maps.Map(document.getElementById('map'), {zoom: 10, center: myLatlng});

            // Create the initial InfoWindow.
            
            infoWindow.open(map);
          
            // Configure the click listener.
            map.addListener('click', function(mapsMouseEvent) {
                // Close the current InfoWindow.
                infoWindow.close();
    
                // Create a new InfoWindow.
                infoWindow = new google.maps.InfoWindow({
                    position: mapsMouseEvent.latLng
                });
                infoWindow.setContent(mapsMouseEvent.latLng.toString());
                infoWindow.open(map);

                $('#event_latitude').val(mapsMouseEvent.latLng.lat());
                $('#event_longitude').val(mapsMouseEvent.latLng.lng());
                console.log(mapsMouseEvent.latLng.toString());
            });
        }
    </script>
<!-- js -->