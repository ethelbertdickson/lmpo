<?php
    require('inc/config.php'); 
    $page_title = "Checkout";
    include('page_header.php');
    include ('inc/functions.php');
?>



<section class="checkout-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="exisitng-customer">
                    <h5>Exisitng Customer?<a href="login.php">Click here to login</a></h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="coupon">
                    <h5>Have a Coupon?  <a href="#">Click here to enter your code</a></h5>
                </div>
            </div>
        </div>
        <div class="row">
                            <div class="col-md-12">
                                <div class="create-acc">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ship-same-address">
                                            <span>Create an Account</span>
                                        </label>
                                    </div>  
                                </div>
                            </div>
                       
                        </div>    
                    <
                </div>    
            </div>
            
        </div>
        
        <div class="row bottom">
            <div class="col-lg-6 col-md-6">
                <div class="table">
                    <div class="sec-title-two">
                        <h3>Order Summary</h3>
                    </div>
                    <table class="cart-table">
                        <thead class="cart-header">
                            <tr>
                                <th class="product-column">Your Products</th>
                                <th>&nbsp;</th>
                                <th>Quantity</th>
                                <th class="price">Total</th>
                            </tr>    
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" class="product-column">
                                    <div class="column-box">
                                        <div class="prod-thumb">
                                            <a href="#"><img src="images/shop/11.jpg" alt=""></a>
                                        </div>
                                        <div class="product-title">
                                            <h3>Wooden Chair</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="qty">
                                    <input class="quantity-spinner" type="text" value="1" name="quantity">
                                </td>
                                <td class="price">$34.00</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="product-column">
                                    <div class="column-box">
                                        <div class="prod-thumb">
                                            <a href="#"><img src="images/shop/12.jpg" alt=""></a>
                                        </div>
                                        <div class="product-title">
                                            <h3>Bridcadge Tree</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="qty">
                                    <input class="quantity-spinner" type="text" value="2" name="quantity">
                                </td>
                                <td class="price">$29.00</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="cart-total">
                    <div class="sec-title-two">
                        <h3>Cart Totals</h3>
                    </div>
                    <ul class="cart-total-table">
                        <li class="clearfix">
                            <span class="col col-title">Cart Subtotal</span>
                            <span class="col">$146.00</span>    
                        </li>
                        <li class="clearfix">
                            <span class="col col-title">Shipping and Handling</span>
                            <span class="col">$40.00- <b>Calculate Shipping</b></span>    
                        </li>
                        <li class="clearfix">
                            <span class="col col-title">Order Total</span>
                            <span class="col">$146.00</span>    
                        </li>      
                    </ul>
                    <div class="payment-options">
                        <div class="option-block">
                            <div class="checkbox">
                                <label>
                                    <input name="pay-us" type="checkbox">
                                    <span>Direct Bank Transfer</span>
                                </label>
                            </div>
                            <div class="text">
                                <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                            </div>
                        </div>

                        <div class="option-block">
                            <div class="radio-block">
                                <div class="checkbox">
                                    <label>
                                        <input name="pay-us" type="checkbox">
                                        <span>Paypal <b>What is Paypal</b></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="placeorder-button text-left">
                            <button type="submit" class="thm-btn">Place Order</button>
                        </div>   
                    </div>          
                </div>    
            </div>
             
        </div>
    </div>
</section>



<?php include('footer.php'); ?>