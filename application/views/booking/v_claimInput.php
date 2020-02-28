<div class="content-wrapper">
    <section class="content-header">
      <h1>
      Hand over
      </h1>
    </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <div class="box-body">
            <div class="form-horizontal"> 
            <form action="<?php echo base_url("ClaimCs/saveHand"); ?>" method="POST" id="myform">
            <div class="form-group">
                <!-- <label class="col-sm-2 control-label">Complain No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $complain_no; ?></label> -->
                <div class="col-sm-8">
                <input type="hidden" id="comp" readonly="1" name="comp"  class="form-control" value="<?php echo $complain_no; ?>">
                </div>
              </div>
              <div class="box-body">
               <!-- <p align="center"><span><strong> Informations </strong></span></p> -->
               <!-- <h2><center> Informations </center></h2>
              <hr size="12px"> -->
              <p align="left"><span><strong>Complain No </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<right><?php echo": " .$complain_no; ?> </right></p>
              <p align="left"><span><strong>Unit No </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;<right><?php echo": " .$unit; ?> </right></p>
              <p align="left"><span><strong>CS Name </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;<right><?php echo": " .$name; ?> </right></p>
              <p align="left"><span><strong>Report Date </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;<right><?php echo": " .date('Y-m-d', strtotime($date)); ?> </right></p>
              <p align="left"><span><strong>Sales Agent </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;<right><?php echo": " .$agent; ?> </right></p>
              <p align="left"><span><strong>Contact </strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;<right><?php echo": " .$contact_no; ?> </right></p>
              </div>
              <div class="form-group">
                <!-- <label class="col-sm-2 control-label">Unit No &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;: </label><p class="col-sm-1 control-label"><?php echo $unit; ?></p> -->
                <div class="col-sm-8">
                <input type="hidden" id="lotno" name="unit_no" readonly="1" class="form-control" value="<?php echo $unit; ?>">
                </div>
              </div>
              <div class="form-group">
                <!-- <label class="col-sm-2 control-label">CS Name &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;: </label><p class="col-sm-1 control-label"><?php echo $name; ?></p> -->
                <div class="col-sm-8">
                <input type="hidden" name="status" readonly="1" class="form-control" value="<?php echo $name; ?>">
                </div>
              </div>
              <div class="form-group">
                <!-- <label class="col-sm-2 control-label">Report Date &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;: </label><p class="col-sm-1 control-label"><?php echo date('Y-m-d', strtotime($date)); ?></p> -->
                <div class="col-sm-8">
                <input type="hidden" name="type" readonly="1" class="form-control" value="<?php echo date('Y-m-d', strtotime($date)); ?>">
                </div>
              </div>
              <div class="form-group">
                <!-- <label class="col-sm-2 control-label">Sales Agent &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;: </label><p class="col-sm-1 control-label"><?php echo $agent; ?></p> -->
                <div class="col-sm-8">
                <input type="hidden" name="request" readonly="1" class="form-control" value="<?php echo $agent; ?>">
                </div>
              </div>
              <div>
              <div class="form-group">
                <!-- <label class="col-sm-2 control-label">Contact &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;: </label><p class="col-sm-1 control-label"><?php echo $contact_no; ?></p> -->
                <div class="col-sm-8">
                <input type="hidden" name="contact_no" readonly="1" class="form-control" value="<?php echo $contact_no; ?>">
                </div>
              </div>
              <hr size="12px">
              <div>
                <input type="button" name="addRow" id="addRow" class="btn btn-success" value="Add" onclick="additem(); return false">
              </div>

              <table id="example" class="display table-bordered table-striped nowrap dataTable dtr-inline">
              <thead>
                <tr bgcolor="#4682B4">
                  <th width="20%">Location</th>
                  <th>Description</th>
                  <th width="100px">Estimation</th>
                  <th width="5%">Delete</th>
                </tr>
              </thead>
              <tbody id="itemlist">
                <?php 
                echo $desclist; 
                ?>
              </tbody>
              </table>
              <div>
                <button type="submit" name="save" id="save" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>      
    </div>         
  </section>
</div>
<script>

            var i = 1;
            function additem() {
                var itemlist = document.getElementById('itemlist');
                
                var row = document.createElement('tr');
                var jenis = document.createElement('td');
                var jumlah = document.createElement('td');
                var total = document.createElement('td');
                var aksi = document.createElement('td');
 
                itemlist.appendChild(row);
                row.appendChild(jenis);
                row.appendChild(jumlah);
                row.appendChild(total);
                row.appendChild(aksi);
                
                var jenis_input = document.createElement('input');
                jenis_input.setAttribute('name', 'location[' + i + ']');
                jenis_input.setAttribute('class', 'form-control');
                jenis_input.setAttribute('placeholder', 'Location');

                var jumlah_input = document.createElement('input');
                jumlah_input.setAttribute('name', 'descriptions[' + i + ']');
                jumlah_input.setAttribute('class', 'form-control');
                jumlah_input.setAttribute('placeholder', 'descriptions');

                var total_input = document.createElement('input');
                total_input.setAttribute('name', 'Ket[' + i + ']');
                total_input.setAttribute('class', 'form-control');
                total_input.setAttribute('placeholder', 'Ket');
                total_input.setAttribute('type', 'date');
 
                var hapus = document.createElement('span');
 
                jenis.appendChild(jenis_input);
                jumlah.appendChild(jumlah_input);
                total.appendChild(total_input);
                aksi.appendChild(hapus);
 
                hapus.innerHTML = '<button class="btn btn-danger"><i class="fa fa-times"></i></button>';
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };
 
                i++;
            }

        </script>
