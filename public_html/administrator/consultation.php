
<?php 
require('inc/config.php'); 
$page_title = "Blog";
include('page_header.php');
include ('inc/functions.php');
?>


<section class="consultation sec-padd">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                <div class="img-box">
                    <img src="images/resource/consult.jpg" alt="">
                </div>
                <div class="default-form-area">
                    <div class="section-title center">
                        <h3>Get Free Consultation</h3>
                    </div>
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
                                    <select class="text-capitalize selectpicker" name="form_subject" data-style="g-select" data-width="100%">
                                        <option value="0" selected="">Select Service</option>
                                        <option value="1">servie one</option>
                                        <option value="2">servoce two</option>
                                        <option value="3">single service</option>
                                    </select>
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
        </div>
            
    </div>
</section>

<?php include('footer.php'); ?>