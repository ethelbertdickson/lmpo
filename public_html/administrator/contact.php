<?php 
require('inc/config.php'); 
$page_title = "Contact Us";
include('page_header.php');
include ('inc/functions.php');
?>

<section class="contact_details sec-padd">
    <div class="container">
        <div class="section-title">
            <h3>contact details</h3>
        </div>
        <div class="text">
            <p>Have a general question concerning Little David Expert Advisor, but don't know who to contact? Please find below contact details and contact us today!</p>
        </div>
        <br><br>
        <div class="row">
            <div class="col-md-4 col-sm-8 col-xs-12">
                <div class="default-cinfo">
                    <div class="accordion-box">
                        <!--Start single accordion box-->
                        <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                            <div class="acc-btn active">
                                Corporate Office?
                                <div class="toggle-icon">
                                    <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="acc-content collapsed">
                                <ul class="contact-infos">
                                    <li>
                                        <div class="icon_box">
                                            <i class="fa fa-home"></i>
                                        </div><!-- /.icon-box -->
                                        <div class="text-box">
                                            <p><b>Address:</b> 116 Parliamentary Road, Calabar <br>CRS, Nigeria</p>
                                        </div><!-- /.text-box -->
                                    </li>
                                    <li>
                                        <div class="icon_box">
                                            <i class="fa fa-phone"></i>
                                        </div><!-- /.icon-box -->
                                        <div class="text-box">
                                            <p><b>Call Us:</b> <br>+234 903 3386 320</p>
                                        </div><!-- /.text-box -->
                                    </li>
                                    <li>
                                        <div class="icon_box">
                                            <i class="fa fa-envelope"></i>
                                        </div><!-- /.icon-box -->
                                        <div class="text-box">
                                            <p><b>Mail Us:</b> <br>info@littledavidea.com</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon_box">
                                            <i class="fa fa-clock-o"></i>
                                        </div><!-- /.icon-box -->
                                        <div class="text-box">
                                            <p><b>Opening Time:</b> <br>Mon - Fri: 08.00am to 18.00pm</p>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                            <div class="acc-btn">
                                Regional Office
                                <div class="toggle-icon">
                                    <span class="plus fa fa-angle-right"></span><span class="minus fa fa-angle-down"></span>
                                </div>
                            </div>
                            <div class="acc-content">
                                <ul class="contact-infos">
                                    <li>
                                        <div class="icon_box">
                                            <i class="icon-signs"></i>
                                        </div><!-- /.icon-box -->
                                        <div class="text-box">
                                            <p>Plot 10 Ishie Layout<br>Calabar, CRS, Nigeria 540232</p>
                                        </div><!-- /.text-box -->
                                    </li>
                                    <li>
                                        <div class="icon_box">
                                            <i class="icon-global"></i>
                                        </div><!-- /.icon-box -->
                                        <div class="text-box">
                                            <p>+234 909 2626 555 <br>info@littledavidea.com</p>
                                        </div><!-- /.text-box -->
                                    </li>
                                    <li>
                                        <div class="icon_box">
                                            <i class="icon-clock"></i>
                                        </div><!-- /.icon-box -->
                                        <div class="text-box">
                                            <p>Working Hours <br>Mon - Fri: 09.00am to 18.00pm</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
                    
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="home-google-map">
                    <div 
                        class="google-map" 
                        id="contact-google-map" 
                        data-map-lat="4.982873" 
                        data-map-lng="8.334503" 
                        data-icon-path="images/logo/map-marker.png"
                        data-map-title="Chester"
                        data-map-zoom="11" >

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="border-bottom"></div>
</div>

<section class="contact_us sec-padd">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="section-title">
                    <h3> Message Us</h3>
                </div>
                <div class="default-form-area">
                    <form id="contact-form" name="contact_form" class="default-form" action="inc/sendmail.php" method="post">
                        <div class="row clearfix">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                
                                <div class="form-group">
                                    <input type="text" name="form_name" class="form-control" value="" placeholder="Your Name *" required="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="email" name="form_email" class="form-control required email" value="" placeholder="Your Mail *" required="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="form_phone" class="form-control" value="" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="form_subject" class="form-control" value="" placeholder="Subject">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <textarea name="form_message" class="form-control textarea required" placeholder="Your Message...."></textarea>
                                </div>
                            </div>   
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                                    <button class="thm-btn thm-color" type="submit" data-loading-text="Please wait...">send message</button>
                                </div>
                            </div>   

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-sm-8 col-xs-12">
                <div class="section-title">
                    <h3>Social</h3>
                </div>
                <div class="author-details">
                    <div class="item">
                        <h5>WhatsApp:</h5>
                        <a class="img-box" href="https://api.whatsapp.com/send?phone=2349033386320&text=Hi,%20Little%20DavidEA%20Support%20Team!%20My%20Name%20is%20%5BYour%20Name%5D,%20I%20want%20to%20%5B%20Your%20Message%7D">
                            <img src="images/lgo/whatsapp.jpg" alt="">
                        </a>
                        <div class="content">
                            <h5>Chat With Us</h5>
                            <p><a href="https://api.whatsapp.com/send?phone=2349033386320&text=Hi,%20Little%20DavidEA%20Support%20Team!%20My%20Name%20is%20%5BYour%20Name%5D,%20I%20want%20to%20%5B%20Your%20Message%7D"><i class="fa fa-whatsapp"></i>Chat Now</a></p>
                        </div>
                    </div>
                    <div class="item">
                        <h5>Telegram:</h5>
                        <a class="img-box" href="https://t.me/+okQCtvI2IKQ2OGNk">
                            <img src="images/logo/telgram.png" alt="">
                        </a>
                        <div class="content">
                            <h5>Telegram Channel</h5>
                            
                            <p><a href="https://t.me/+okQCtvI2IKQ2OGNk"><i class="fa fa-telegram"></i>Join Now</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>