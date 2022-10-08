<?php 
require('inc/config.php'); 
$page_title = "Shop";
include('page_header.php');
include ('inc/functions.php');
?>

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12 hover-effect">
                        <div class="single-shop-item">
                            <div class="img-box">
                                <img src="images/shop/p2.jpg" width="202px" height="255px" alt="Awesome Image">
                                <div class="default-overlay-outer">
                                    <div class="inner">
                                        <div class="content-layer">
                                            <a href="https://flutterwave.com/pay/ldc" class="thm-btn thm-tran-bg">Order Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.img-box -->
                            <div class="content-box">
                                <h4><a href="#">Little David Cent</a></h4>
                                <div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></div>
                                <div class="item-price">$500</div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 hover-effect">
                        <div class="single-shop-item">
                            <div class="img-box">
                                <img src="images/shop/p1.jpg" width="202px" height="255px" alt="Awesome Image">
                                <div class="default-overlay-outer">
                                    <div class="inner">
                                        <div class="content-layer">
                                            <a href="https://flutterwave.com/pay/lds" class="thm-btn thm-tran-bg">Order Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.img-box -->
                            <div class="content-box">
                                <h4><a href="#">Little David Standard</a></h4>
                                <div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></div>
                                <div class="item-price">$1000</div>
                            </div>
                        </div>

                    </div>                 
                 
                 
               
                </div>
                <div class="border-bottom"></div>
                
            </div>

             
        </div>
    </div> 
</div> 


<?php require('footer.php'); ?>