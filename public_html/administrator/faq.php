<?php 
require('inc/config.php'); 
$page_title = "Frequently Asked Question";
include('page_header.php');
include ('inc/functions.php');
?>

 
<section class="about-faq">
    <div class="container">
        <div class="row">
            
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="sec-padd">
                <div class="accordion-box">
                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">What is the profitability of Little David Bot?</p>
                            <div class="toggle-icon">
                                <span class="plus fa fa-angle-right"></span><span class="minus fa fa-angle-down"></span>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p>The Bot delivers a monthly profit of 5% -10% of account equity, depending on the volatility of the market and currency pair(s) traded. 
                            </p></div>
                        </div>
                    </div>
                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn active">
                            <p class="title">What Risk Management measures does the Little David forex trading bot have?</p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content collapsed">
                            <div class="text"><p>The Little David bot comes with 3 risk management modules: 10%, 15% and 20%.  These are user defined, depending on the risk appetite of the trader. On reaching the required equity drawdown, the bot will stop opening further trades until the market reverses to give profit  

                            </p></div>
                        </div>
                    </div>
                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title"> What is the minimum account equity required to trade the Little David bot?</p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p>
                            $500 (50,000C) for Cent Accounts, and $50,000 for Standard Accounts 
                            </p></div>
                        </div>
                    </div>
                    <!--Start single accordion box-->
                    <div class="accordion animated out" data-delay="0" data-animation="fadeInUp">
                        <div class="acc-btn">
                            <p class="title">Can the Little David Bot be customized?</p>
                            <div class="toggle-icon">
                                <i class="plus fa fa-angle-right"></i><i class="minus fa fa-angle-down"></i>
                            </div>
                        </div>
                        <div class="acc-content">
                            <div class="text"><p>
                                Yes, we can customize the bot in your chosen name, and give you full ownership/licensing rights
                            </p></div>
                        </div>
                    </div>


                </div>
            </div>
                    
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="default-form-area sec-padd-top single-faq-bg">
                    <h3>Ask Your Questions</h3>
                    <form id="contact_form" name="contact_form" class="default-form" action="inc/sendmail.php" method="post">
                        <div class="row clearfix">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                
                                <div class="form-group">
                                    <input type="text" name="form_name" class="form-control" value="" placeholder="Name *" required="">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="email" name="form_email" class="form-control required email" value="" placeholder="Mail *" required="">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="form_subject" class="form-control" value="" placeholder="Subject">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <textarea name="form_message" class="form-control textarea required" placeholder="Your questions...."></textarea>
                                </div>
                            </div>   
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
                                    <button class="thm-btn thm-color" type="submit" data-loading-text="Please wait...">submit now</button>
                                </div>
                            </div>   

                        </div>
                    </form>
                    <br><br>
                </div>

            </div>

        </div>
    </div>
</section>








<?php require('footer.php'); ?>