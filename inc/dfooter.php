
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      ObiDatti is Better
    </div>
    <!-- Default to the left -->
  <strong><p>Copyrights © Like Minds4PeterObi <?php echo Date('Y'); ?>. All Rights Reserved</p></strong>
   </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>


<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- <script src="dist/js/vue.js"></script> -->

<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes 
<script src="dist/js/demo.js"></script>-->

<!-- Nigeria MapJS -->
<script src="map/map-config.js"></script>
<script src="map/map-interact.js"></script>
<!-- <script src="map/pins-config.js"></script>
 <script src="map/jquery.min.js"></script> -->


<script>
    $(document).ready(function() {   
    $('#state-dropdown').on('change', function() {
    var state_id = this.value;
    $.ajax({
    url: "ajaxlg.php",
    type: "POST",
    data: {
    state_id: state_id
    },
    cache: false,
    success: function(result){
    $("#lga-dropdown").html(result);
    $('#ward_dropdown').html('<option value="">Select LGA</option>'); 
    }
    });
    });
    $('#lga-dropdown').on('change', function() {
    var lga_id = this.value;
    $.ajax({
    url: "ajaxward.php",
    type: "POST",
    data: {
    lga_id: lga_id
    },
    cache: false,
    success: function(result){
    $("#ward-dropdown").html(result);
    $('#pu_dropdown').html('<option value="">Select Ward</option>'); 
    }
    });
    });    
    $('#ward-dropdown').on('change', function() {
    var ward_id = this.value;
    $.ajax({
    url: "ajaxpu.php",
    type: "POST",
    data: {
    ward_id: ward_id
    },
    cache: false,
    success: function(result){
    $("#pu-dropdown").html(result);
    }
    });
    });
    });
</script>
    
    
<script>
var myChart;
$.ajax({
url:"ajaxgender.php",
method:"GET",
success:function(data) {
//console.log(data);
var gender = JSON.parse(data);
var males =gender.male;
var females = gender.female;

var ctx = document.getElementById("pieChart");
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
      labels: ["Male","Female"],
    datasets: [{
        label: 'Genders',
        data: [males,females],
        backgroundColor: [
          '#f56954', '#00a65a'
        ],
        borderColor: [
            '#f1f1f1',
            '#fafafa'
        ],
        borderWidth: 1
    }]
},

});

},
error:function(data){
    console.log(data);
}
});

</script>


<!-- zonal distribution of member script PieChart -->
<script>
$(document).ready(function() {
var geoZone;
$.ajax({
url:"ajaxregion.php",
method:"GET",
success:function(data){

var gzone =  JSON.parse(data);
var ss = gzone.south_south;
var sw = gzone.south_west;
var se = gzone.south_east;
var nw = gzone.north_west;
var nc = gzone.north_central;
var ne = gzone.north_east;

var ctx = document.getElementById("geoPolZone");
var geoZone = new Chart(ctx, {
  type: 'pie',
  data: {
      labels: ["South South","South West", "South East", "North West", "North Central", "North East"],
    datasets: [{
        label: 'Members',
        data: [ss,sw,se,nw,nc,ne],
        backgroundColor: [
          '#f56954', '#00a65a', '#8e5ea2','#3cba9f','#e8c3b9','#c45850'
        ],
        borderColor: [
            '#f1f1f1',
            '#fafafa',
            '#f1f1f1',
            '#fafafa',
            '#f1f1f1',
            '#fafafa'
        ],
        borderWidth: 1
    }]
},

});

},
error:function(data){
    console.log(data);
}
});
});
</script>


<script>
$.ajax({
url:"ajaxage.php",
method:"GET",
success:function(age) {
//console.log(age);
var agegrade = JSON.parse(age);
var _1st = agegrade._1st;
var _2nd = agegrade._2nd;
var _3rd = agegrade._3rd;
var _4th = agegrade._4th;
var _5th = agegrade._5th;
var _6th = agegrade._6th;
var _7th = agegrade._7th;
var _8th = agegrade._8th;
var _9th = agegrade._9th;
var _10th = agegrade._10th;
var _11th = agegrade._11th;


  
    //-------------
    //- BAR CHART -
    //-------------
   // Bar chart
new Chart(document.getElementById("barChart"), {
    type: 'bar',
    data: {
      labels: ['18-24', '25-30', '31-35', '36-40', '41-45', '46-50', '51-55', '56-60','61-65','66-70', '70+'],
      datasets: [
        {
          label:"Members Age Distribution",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","#3cba9f"],
          data: [1*_1st, 1*_2nd, 1*_3rd, 1*_4th, 1*_5th, 1*_6th, 1*_7th, 1*_8th, 1*_9th, 1*_10th, 1*_11th,0]
        }
      ]
    },
    options: {
      legend: { display: true },
      title: {
        display: false,
        text: 'Members Age Distribution'
      }
    }
});
       
       
},
    error:function(age){
    console.log(age);
}
  });
  </script>


	
</body>
</html>
<?php
 // Flush the buffered output.
ob_end_flush();
?>