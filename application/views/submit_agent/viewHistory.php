<!-- style -->
    <style type="text/css">
        .has-error .select2_demo_1-selected {
          border: 1px solid #a94442;
          border-radius: 4px;
          color: red;
        }

        .has-error .checkbox-inline {
          border: 1px solid #a94442;
          border-radius: 4px;
        }

        .has-error .radio-inline {
          border: 1px solid #a94442;
          border-radius: 4px;
        }

        .container {
          padding-left: 50px;
          padding-top: 15px;
        }

        .buttonstl {
          padding-top: 5px;
        }

        label {text-align: right;}
        #loader{
            width:80%;
            height:100%;
            position:fixed;
            z-index:9999;
            background:url("../img/loading.gif") no-repeat center center     
        }
    </style>
<!-- style -->

<!-- content -->
    <div class="box-body">
        <div class="container-fluid">
            <table class="table table-bordered fieldGroup">
                <thead>
                    <tr>
                        <th> Registration Date </th>
                        <th> Project </th>
                        <th> Group Agent </th>
                        <th> Submit Date </th>
                    </tr>
                </thead>

                <tbody>
                  <?php echo $project ?>
                </tbody>
            </table>
        </div>
    </div> 
<!-- content -->

<!-- link -->
    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
    <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<!-- limk -->

<!-- script -->

<!-- script -->