<footer class="main-footer">
    
    <!--Widgets Section-->
    <div class="widgets-section">
        
     
     <!--Footer Bottom-->
     <section class="footer-bottom">
        <div class="container">
            <div class="pull-left copy-text">
                <p>Copyrights © Like Minds4PeterObi <?php echo Date('Y'); ?>. All Rights Reserved</p>
                
            </div><!-- /.pull-right -->
            <div class="pull-right get-text">
                <ul>
                    <li><a href="#">Disclaimer</a></li>
                    <li><a href="https://likeminds4peterobi.com/privacy%20policy/"> Privacy Policy</a></li>
                </ul>
            </div>
        </div><!--/.container -->
    </section>
     
</footer>

<!-- Scroll Top Button -->
	<button class="scroll-top tran3s color2_bg">
		<span class="fa fa-angle-up"></span>
	</button>
	<!-- pre loader  -->
	<div class="preloader"></div>


	<!-- jQuery js -->
	<script src="js/jquery.js"></script>
	<!-- bootstrap js -->
	<script src="js/bootstrap.min.js"></script>
	<!-- jQuery ui js -->
	<script src="js/jquery-ui.js"></script>
	<!-- owl carousel js -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- jQuery validation -->
	<script src="js/jquery.validate.min.js"></script>
	<!-- google map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRvBPo3-t31YFk588DpMYS6EqKf-oGBSI"></script> 
	<script src="js/gmap.js"></script>
	<!-- mixit up -->
	<script src="js/wow.js"></script>
	<script src="js/jquery.mixitup.min.js"></script>
	<script src="js/jquery.fitvids.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
	<script src="js/menuzord.js"></script>
	
	<!-- revolution slider js -->
	<script src="assets/revolution/js/jquery.themepunch.tools.min.js"></script>
	<script src="assets/revolution/js/jquery.themepunch.revolution.min.js"></script>
	<script src="assets/revolution/js/extensions/revolution.extension.actions.min.js"></script>
	<script src="assets/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
	<script src="assets/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
	<script src="assets/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script src="assets/revolution/js/extensions/revolution.extension.migration.min.js"></script>
	<script src="assets/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
	<script src="assets/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
	<script src="assets/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script src="assets/revolution/js/extensions/revolution.extension.video.min.js"></script>

	<!-- fancy box -->
	<script src="js/jquery.fancybox.pack.js"></script>
	<script src="js/jquery.polyglot.language.switcher.js"></script>
	<script src="js/nouislider.js"></script>
	<script src="js/jquery.bootstrap-touchspin.js"></script>
	<script src="js/SmoothScroll.js"></script>
	<script src="js/jquery.appear.js"></script>
	<script src="js/jquery.countTo.js"></script>
	<script src="js/jquery.flexslider.js"></script>
	<script src="js/imagezoom.js"></script>	
	<script id="map-script" src="js/default-map.js"></script>
    <script src="js/sweetalert.js"></script>
	<script src="js/custom.js"></script>
	<!-- <script src="dist/js/vue.js"></script> -->
</div>

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
    
</script>

	
</body>
</html
<?php
 // Flush the buffered output.
ob_end_flush();
?>