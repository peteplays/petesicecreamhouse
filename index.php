<!DOCTYPE html>
<?php 
/*
http://peteplays.com/petesicecreamhouse
index.php

@author: plays.dev@gmail.com
19 June 2015

REQUIRED:
config.php


Revisions:


*/
include 'config.php';
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Petes Ice Cream House" content="fun">
        <meta name=" plays.dev@gmail.com" content="me">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
        <title>Pete's Ice Cream House</title>
        <link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Source+Code+Pro' rel='stylesheet' type='text/css'>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/plays.css" rel="stylesheet">
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php include_once("service/ga.php"); ?>
        
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a id="nav_toggle">View Previous Orders</a>
                    <div class="shopping_cart nav_font_style hiddenItem">
                        <span class="current_price"></span>
                        <i class="fa fa-shopping-cart"></i>                        
                    </div>
                </div>
            </div>
        </nav>
        
        <h1 class="text-center fontStyle">Pete's Ice Cream House</h1>
        
        <div class="container place_new_order hiddenItem">
            <!-- pick your favorite -->
            <div class="row pick_your_fav fontStyle text-center">
                <div class="col-md-4">
                    <div class="pyf_icecream hover_over_item" data-product="icecream_cone">
                        <div class="icecream_top icecream_top_color_0"></div>
                        <div class="icecream_cone icecream_cone_0"></div>
                        <h2>Ice Cream Cone</h2>
                        <h3><?php echo show_currency_correctly($G_price_data->{icecream_cone}); ?></h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pyf_float hover_over_item" data-product="float">
                        <div class="position_float">
                            <div class="shake_top icecream_top_color_3"></div>
                            <div class="mug mug_color_1"></div>
                        </div>
                        <h2>Ice Cream Float</h2>
                        <h3><?php echo show_currency_correctly($G_price_data->{float}); ?></h3>
                    </div>  
                </div>
                <div class="col-md-4">
                    <div class="pyf_shake hover_over_item position_float" data-product="milkshake">
                        <div class="mug mug_color_0"></div>
                        <h2>Milkshake</h2>
                        <h3><?php echo show_currency_correctly($G_price_data->{milkshake}); ?></h3>
                    </div>  
                </div>
            </div>
            <!-- select cone -->
            <div class="row select_cone hiddenItem">
                <h3 class="text-center fontStyle">Select Your Cone</h3>
                <div class="icecream_cones_selected">
                    <div class="col-md-offset-3 col-md-3">
                        <div class="position_icecream_cone hover_over_item" data-conetype="0">
                            <div class="icecream_cone icecream_cone_0"></div>
                            <h3 class="fontStyle capitalize text-center"><?php echo $G_product_data->{cone}->{0}; ?></h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="position_icecream_cone hover_over_item" data-conetype="1">
                            <div class="icecream_cone icecream_cone_1"></div>
                            <h3 class="fontStyle capitalize text-center"><?php echo $G_product_data->{cone}->{1}; ?></h3>
                        </div>
                    </div>
                </div> 
            </div>
             <!-- select ice cream -->
            <div class="row icecream_selected hiddenItem">
                <h3 class="text-center fontStyle">Select Your Ice Cream Flavor</h3>
                <div class="col-md-2">
                    <div class="position_icecream hover_over_item" data-icecreamflavor="0">
                        <div class="icecream_top icecream_top_color_0"></div>
                        <div class="icecream_cone icecream_cone_0"></div>
                        <h4 class="fontStyle capitalize text-center"><?php echo $G_product_data->{icecream}->{0}; ?></h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="position_icecream hover_over_item" data-icecreamflavor="1">
                        <div class="icecream_top icecream_top_color_1"></div>
                        <div class="icecream_cone icecream_cone_0"></div>
                        <h4 class="fontStyle capitalize text-center"><?php echo $G_product_data->{icecream}->{1}; ?></h4>
                    </div> 
                </div>
                <div class="col-md-2">
                    <div class="position_icecream hover_over_item" data-icecreamflavor="2">
                        <div class="icecream_top icecream_top_color_2"></div>
                        <div class="icecream_cone icecream_cone_0"></div>
                        <h4 class="fontStyle capitalize text-center"><?php echo $G_product_data->{icecream}->{2}; ?></h4>
                    </div>  
                </div>
                <div class="col-md-2">
                    <div class="position_icecream hover_over_item" data-icecreamflavor="3">
                        <div class="icecream_top icecream_top_color_3"></div>
                        <div class="icecream_cone icecream_cone_0"></div>
                        <h4 class="fontStyle capitalize text-center"><?php echo $G_product_data->{icecream}->{3}; ?></h4>
                    </div>  
                </div>
                <div class="col-md-2">
                    <div class="position_icecream hover_over_item" data-icecreamflavor="4">
                        <div class="icecream_top icecream_top_color_4"></div>
                        <div class="icecream_cone icecream_cone_0"></div>
                        <h4 class="fontStyle capitalize text-center"><?php echo $G_product_data->{icecream}->{4}; ?></h4>
                    </div> 
                </div>
                <div class="col-md-2">
                    <div class="position_icecream hover_over_item" data-icecreamflavor="5">
                        <div class="icecream_top icecream_top_color_5"></div>
                        <div class="icecream_cone icecream_cone_0"></div>
                        <h4 class="fontStyle capitalize text-center"><?php echo $G_product_data->{icecream}->{5}; ?></h4>
                    </div>
                </div>
            </div>
            <!-- select milk -->
            <div class="row select_milk text-center capitalize hiddenItem">
                <h3 class="fontStyle">Select Your Milk Type</h3>
                <div class="col-md-offset-3 col-md-2">
                    <div class="selected_milk hover_over_item" data-milktype="0">
                        <div class="milk_cup"></div>
                        <h4 class="fontStyle"><?php echo $G_product_data->{milk}->{0}; ?></h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="selected_milk hover_over_item" data-milktype="1">
                        <div class="milk_cup"></div>
                        <h4 class="fontStyle"><?php echo $G_product_data->{milk}->{1}; ?></h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="selected_milk hover_over_item" data-milktype="2">
                        <div class="milk_cup"></div>
                        <h4 class="fontStyle"><?php echo $G_product_data->{milk}->{2}; ?>&#37;</h4>
                    </div>
                </div>
            </div>
            <!-- select soda float flavor -->
            <div class="row select_soda_flavor text-center hiddenItem">
                <h3 class="fontStyle">Select a Soda Flavor</h3>
                <div class="col-md-4">
                    <div class="mug_position">
                        <div class="mug mug_color_0 hover_over_item" data-sodaflavor="0"></div>
                    </div>                  
                    <h4 class="fontStyle capitalize"><?php echo $G_product_data->{soda}->{0}; ?></h4>
                </div>
                <div class="col-md-4">
                    <div class="mug_position">
                        <div class="mug mug_color_1 hover_over_item" data-sodaflavor="1"></div>
                    </div>
                    <h4 class="fontStyle capitalize"><?php echo $G_product_data->{soda}->{1}; ?></h4>
                </div>
                <div class="col-md-4">
                    <div class="mug_position">
                        <div class="mug mug_color_2 hover_over_item" data-sodaflavor="2"></div>
                    </div>
                    <h4 class="fontStyle capitalize"><?php echo $G_product_data->{soda}->{2}; ?></h4>
                </div>                
            </div>
            <!-- completed order -->
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <!-- completed ice cream cone -->
                    <div class="complete_icecream_cone hiddenItem">
                        <div class="position_complete_icecream_cone">
                            <div class="icecream_cone icecream_cone_0"></div>
                        </div>          
                    </div>
                    <!-- completed milkshake -->
                    <div class="complete_milkshake hiddenItem">
                        <!-- <div class="mug"></div> -->
                        <div style="margin: 0 auto;">
                            <div class="mug"></div>
                        </div>
                        
                    </div> 
                    <!-- completed float -->
                    <div class="complete_float_soda hiddenItem">
                        <div class="position_complete_float notClickable">             
                            <div></div>                            
                        </div>                        
                    </div> 
                </div>
            </div>
             <!-- bottom area completed order -->
            <div class="row">
                <div class="col-md-offset-3 col-md-6 text-center">
                    <!-- add another scoop -->  
                    <div class="fontStyle add_another_scoop hiddenItem">
                        <p class="hover_over_item add_another_scoop_btn">Add another scoop for <?php echo show_currency_correctly($G_price_data->{adding_scoops});?></p>
                    </div>
                    <!-- place order -->
                    <p class="just_right fontStyle hover_over_item hiddenItem">Just Right!</p>
                    <!-- order details -->
                    <div class="order_details_output hiddenItem"></div>
                    <!-- order complete -->
                    <div class="order_competed hiddenItem">
                        <p class="fontStyle">Thank you for your order!  ENJOY!!!</p>
                        <p class="order_complete_place_new_order fontStyle hover_over_item">Place another order!</p>
                    </div>   
                    <!-- error sending order -->
                    <p class="error_sending_order fontStyle hiddenItem">Error sending in your order.  Please try again.</p>
                    <!-- start new order -->
                    <i class="fa fa-file-o hiddenItem floating_btn" id="start_new_order" title="Start a New Order"></i> 
                    <!-- discount -->
                    <div class="discount_applied hiddenItem">
                        <i class="fa fa-certificate discount_logo"></i>
                        <?php  
                            $discount_amount = substr($G_price_data->{discount}, 2);
                            if( strlen($discount_amount) == 1 ) {
                                $discount_amount .= '0';
                            }               
                        ?>
                        <p class="fontStyle discount_text"><?php echo $discount_amount; ?>&#37; <br>off!</p>
                    </div>
                </div>
            </div>
        </div><!-- /.containter .place_new_order-->

        <div class="container view_previous_orders hiddenItem">
            <div class="row">
                 <div class="col-md-offset-3 col-md-6 text-center">
                    <!-- scroll to top of the page -->
                    <i class="fa fa-chevron-circle-up floating_btn hiddenItem" id="scroll_to_top" title="scroll to the top of the page"></i>
                    <!-- previous orders -->                    
                    <h3 class="fontStyle">Previous Orders</h3>
                    <div class="previous_orders_data"></div>                   
                 </div>               
            </div>
        </div><!-- /.containter .view_previous_orders-->

        <div id='push_down'></div>
        <footer>
            <div class="container text-center">
                <a href="<?php echo $base_url; ?>"><img id="plays_footer_logo" src="images/petelogo.png" alt="PetePlays logo" title="Go to PetePlays.com"></a>
            </div>
        </footer>

        <script>
            var ORDER_SERVICE_URL = '<?php echo $order_service_url; ?>';
        </script>

        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plays.js"></script>
    </body>
</html>
