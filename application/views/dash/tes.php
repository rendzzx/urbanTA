

<!-- <link href="<?=base_url('css/plugins/c3/c3.min.css')?>" rel="stylesheet">


  <link href="<?=base_url('css/animate.css')?>" rel="stylesheet">
  <link href="<?=base_url('css/style.css')?>" rel="stylesheet"> -->
  <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Pie </h5>

                        </div>
                        <div class="ibox-content">
                            <div>
                                <div id="puppa"></div>
                            </div>
                        </div>
                    </div>
                </div>
 
<script type="text/javascript">
tampil();
function tampil() {



        for (i=5;i<=50;i++) {

            for (j=2;j<i;j++) {

                if (i%j==0) {

                prima=0;

                break;

                }

                else {

                prima=1;

                }

            }

            if (prima) document.write(i+'<br>');

        }

}

// var c = c3.generate({
//                 bindto: '#puppa',
//                 x:'x',
//                 data:{
//                     columns: [
//                         // ['x','Jan','Feb','Mar','Apr','Mei','Jun'],
//                         ['data1', 30,200,100,400,150,250],
//                         ['data2', 50,20,10,40,15,25],
//                         ['data3', 30,200,-100,400,150,250],
//                         ['data4', 50,20,10,40,15,25]
//                     ],
//                     colors:{
//                         data1: '#1ab394',
//                         data2: '#BABABA'
//                     },
//                     type: 'bar',
//                     groups: [
//                         ['data1', 'data2'],
//                         ['data4', 'data3']
//                     ]
//                 },
//                 axis: {
//                     x: {
//                         type: 'timeseries',
//                         tick: {
//                             format: function (x) {
//                                 if (x.getDate() === 1) {
//                                     return x.toLocaleDateString();
//                                 }
//                             }
//                         }
//                     }
//                 }
//             });


// var BarInVeX = c3.generate({
//     bindto: '#puppa',
//     data: {
//             type: 'bar',

//         x: 'x',
//         // xFormat: '%H:%M',
//       columns:[
//           ['x','Jan','Feb','Mar','Apr','Mei','Jun'],
//                         ['data 1', 30,200,100,400,150,250],
//                         ['data 2', 50,20,10,40,15,25],
//                         ['data 3', 30,200,-100,400,150,250],
//                         ['data 4', 50,20,10,40,15,25]
//       ],
//       groups: [
//                         ['data 1', 'data 2'],
//                         ['data 4', 'data 3']
//                     ]
//     },
//     axis: {
//         x: {
//             type: 'category',
//             tick: {
//                 // rotate: 75,
//                 multiline: false
//             },
//             height: 50
//         }
//     }
// });
<?=$IncomeVSExpanse?>
</script>
<!-- <script></script> -->




