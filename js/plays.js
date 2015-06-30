var PRODUCT = '';
var ICECREAM_TYPE = [];
var CONE_TYPE = '';
var SODA_TYPE = '';
var MILK_TYPE = '';
var PRODUCT_DATA = '';
var PRICES = '';
var PREVIOUS_PAGE = $('#nav_toggle').text();
var CURRENT_PRICE = 0;
var ICECREAM_TYPE_COUNTER = 0;

function add_order_handler(PRODUCT, ICECREAM_TYPE, CONE_TYPE, SODA_TYPE, MILK_TYPE) {
	if( PRODUCT == 'icecream_cone' ) {
		add_order_icecream(ICECREAM_TYPE, CONE_TYPE);
	}
	if( PRODUCT == 'milkshake' ) {
		add_order_shake(MILK_TYPE, ICECREAM_TYPE);
	}
	if( PRODUCT == 'float' ) {
		add_order_float(SODA_TYPE, ICECREAM_TYPE);
	}
}
function add_order_icecream(ICECREAM_TYPE, CONE_TYPE) {
	var SEND_DATA = {
			product :'icecream_cone',
			icecream_type : ICECREAM_TYPE,
			cone_type : CONE_TYPE,
			vendor : 'UI_send',
			price : CURRENT_PRICE
		};
	submit_order(SEND_DATA);
}
function add_order_shake(MILK_TYPE, ICECREAM_TYPE) {
	var SEND_DATA = {
			product :'milkshake',
			icecream_type : ICECREAM_TYPE,
			milk_type : MILK_TYPE,
			vendor : 'UI_send',
			price : CURRENT_PRICE
		};
	submit_order(SEND_DATA);
}
function add_order_float(SODA_TYPE, ICECREAM_TYPE) {
	var SEND_DATA = {
			product :'float',
			icecream_type : ICECREAM_TYPE,
			soda_type : SODA_TYPE,
			vendor : 'UI_send',
			price : CURRENT_PRICE
		};
	submit_order(SEND_DATA);
}
function submit_order(SEND_DATA) {
	var order_service_url_write = ORDER_SERVICE_URL + '?opt=write';
	$.post(order_service_url_write, SEND_DATA, function(data) {
		var readable_data = JSON.parse(data);
		if( readable_data.code == 1 ) {
			//--success
		} else {
			$('.order_competed').hide();
			$('.error_sending_order').slideDown('ease');
		}
	});
}
function calculate_price(PRODUCT, ICECREAM_TYPE) {
	var product_price = 0;
	var scoop_price = 0;
	if( PRODUCT !== '') {
		product_price = PRICES[PRODUCT];
	}
	if( ICECREAM_TYPE_COUNTER > 0) {
		scoop_price = ICECREAM_TYPE_COUNTER * PRICES.adding_scoops;
	}
	CURRENT_PRICE = product_price + scoop_price;
	if( CURRENT_PRICE > 0 && ( PRODUCT == 'milkshake' || PRODUCT == 'float' ) ) {
		var discount_amount =  1 - PRICES.discount;
		CURRENT_PRICE = CURRENT_PRICE * discount_amount;
	}
	CURRENT_PRICE = CURRENT_PRICE.toFixed(2);
	$('.current_price').html('$'+CURRENT_PRICE);
}
function view_all_orders() {
	var order_service_url_read = ORDER_SERVICE_URL + '?opt=read';
	$.getJSON(order_service_url_read, function(data) {
		if( data ) {
			var output = '';
			$.each(data.data, function(index, val) {
				var readable_product = '';
				var product = val.product;
				if( product == 'icecream_cone') {
					readable_product = product.replace(/_/g, ' ');
				} else {
					readable_product = product;
				}
				var price = val.price;
				var rec_num = val.rec_num;
				output += '<div class="single_record">product: ' + readable_product + '<br>price: $' + price + '<br>';
				$.each(val.ice_cream_type, function(icecream_key, icecream_val) {			
					var icecream = PRODUCT_DATA.icecream[icecream_val];
					output += 'ice cream type: ' + icecream + '<br>';
				});
				if( product == 'icecream_cone' ) {
					var cone = PRODUCT_DATA.cone[val.cone_type];
					output += 'cone: ' + cone + '<br>';
				}
				if( product == 'float' ) {
					var soda = PRODUCT_DATA.soda[val.soda_type];
					output += 'soda: ' + soda + '<br>';
				}
				if( product == 'milkshake' ) {
					var milk = PRODUCT_DATA.milk[val.milk_type];
					if( milk == '2') {
						milk += '%';
					}
					output += 'milk: ' + milk + '<br>';
				}				
				output += 'record number: ' + rec_num + '<br></div>';
			});
			$('.previous_orders_data').html(output);
		}
	});
}
function current_order_display() {
	var this_order_output = '';
	var readable_product = '';
	var product = PRODUCT;
	if( product == 'icecream_cone') {
		readable_product = product.replace(/_/g, ' ');
	} else {
		readable_product = product;
	}
	var price = CURRENT_PRICE;
	this_order_output += '<div class="single_record">product: ' + readable_product + '<br>price: $' + price + '<br>';
	$.each(ICECREAM_TYPE, function(icecream_key, icecream_val) {			
		var icecream = PRODUCT_DATA.icecream[icecream_val];
		this_order_output += 'ice cream type: ' + icecream + '<br>';
	});
	if( product == 'icecream_cone' ) {
		var cone = PRODUCT_DATA.cone[CONE_TYPE];
		this_order_output += 'cone: ' + cone + '<br>';
	}
	if( product == 'float' ) {
		var soda = PRODUCT_DATA.soda[SODA_TYPE];
		this_order_output += 'soda: ' + soda + '<br>';
		$('.discount_applied').fadeIn(1000);
	}
	if( product == 'milkshake' ) {
		var milk = PRODUCT_DATA.milk[MILK_TYPE];
		if( milk == '2') {
			milk += '%';
		}
		this_order_output += 'milk: ' + milk + '<br>';
		$('.discount_applied').fadeIn(1000);
	}
	this_order_output += '</div>';

	$('.order_details_output').html(this_order_output).fadeIn(1000);
}
function change_cone_type(CONE_TYPE) {
	var remove_class = '';
	var add_class = '';
	if( CONE_TYPE == '1' ) {
		remove_class = 'icecream_cone_0';
		add_class = 'icecream_cone_1';
	} 
	if( CONE_TYPE == '0' ) {
		remove_class = 'icecream_cone_1';
		add_class = 'icecream_cone_0';
	}
	if( CONE_TYPE == 'none' ) {
		remove_class = 'icecream_cone_0';
		add_class = '';
	}
	var change_cone = document.getElementsByClassName(remove_class),
    i = change_cone.length;
    while (i--) {
        change_cone[i].className = "icecream_cone "+add_class+"";
    }
}
//--hide everything
function hide_everything() {
	$('.pick_your_fav, .select_cone, .icecream_selected, .complete_icecream_cone, .select_soda_flavor, .select_milk, .complete_milkshake, .complete_float_soda, .order_competed, .add_another_scoop, .just_right, .error_sending_order, .order_details_output').hide();
}
//--get pricing data
$.getJSON("data/prices.json", function(d1) {
	PRICES = $.parseJSON(JSON.stringify(d1));
});
//--get product data
$.getJSON("data/products.json", function(d2) {
	PRODUCT_DATA = $.parseJSON(JSON.stringify(d2));
});
//--selected ice cream
$('.pyf_icecream').on('click', function() {
	hide_everything();
	$('.select_cone, .shopping_cart').slideDown('ease');
	$('#start_new_order').fadeIn(1500);
	PRODUCT = $(this).data('product');
});
//--select cone
$('.position_icecream_cone').on('click', function() {
	hide_everything();
	$('.icecream_selected').slideDown('ease');
	$('#start_new_order').fadeIn(1500);
	CONE_TYPE = $(this).data('conetype');	
	change_cone_type(CONE_TYPE);
});
//--select ice cream flavor
$('.position_icecream').on('click', function() {
	hide_everything();	
	$('#start_new_order').fadeIn(1500);
	ICECREAM_TYPE_COUNTER = ICECREAM_TYPE.length;
	if( PRODUCT == 'icecream_cone' && ICECREAM_TYPE_COUNTER <= 1) {	
		$('.complete_icecream_cone, .just_right').slideDown('ease');	
		if( ICECREAM_TYPE_COUNTER === 0) {
			ICECREAM_TYPE[0] = $(this).data('icecreamflavor');
			$('.position_complete_icecream_cone').prepend('<div class="icecream_top icecream_top_color_'+ICECREAM_TYPE[0]+'"></div>');
			$('.add_another_scoop').slideDown('ease');
		}
		if( ICECREAM_TYPE_COUNTER == 1) {
			ICECREAM_TYPE[1] = $(this).data('icecreamflavor');
			$('.position_complete_icecream_cone').prepend('<div class="icecream_top icecream_top_color_'+ICECREAM_TYPE[1]+'"></div>');
			$('.add_another_scoop').hide();
		}				
	}
	if( PRODUCT == 'milkshake' ) {
		$('.select_milk').slideDown('ease');
		ICECREAM_TYPE[0] = $(this).data('icecreamflavor');	
	}
	if( PRODUCT == 'float' ) {
		$('.complete_float_soda').slideDown('ease');
		var float_scoop_counter = ICECREAM_TYPE.length;
		ICECREAM_TYPE[float_scoop_counter] = $(this).data('icecreamflavor');
		$('.position_complete_float').children('div').prepend('<div class="shake_top icecream_top_color_'+ICECREAM_TYPE[float_scoop_counter]+'"></div>');
		$('.add_another_scoop, .just_right').slideDown('ease');	
	}	
});
//--add another scoop of ice cream
$('.add_another_scoop').on('click', function() {
	hide_everything();
	$('.icecream_selected').slideDown('ease');
	$('#start_new_order').fadeIn(1500);
});
//--selected float
$('.pyf_float').on('click', function() {
	hide_everything();
	$('.select_soda_flavor, .shopping_cart').slideDown('ease');
	$('#start_new_order').fadeIn(1500);
	PRODUCT = $(this).data('product');
});
//--select soda flavor
$('.mug').on('click', function() {
	SODA_TYPE = $(this).data('sodaflavor');
	hide_everything();
	$('.icecream_selected').slideDown('ease');	
	CONE_TYPE = 'none';
	change_cone_type(CONE_TYPE);
	if( SODA_TYPE !== undefined ) {
		$('.position_complete_float').children('div').append('<div class="mug mug_color_'+SODA_TYPE+'"></div>');
	}	
});
//--selected milkshake
$('.pyf_shake').on('click', function() {
	hide_everything();
	$('.icecream_selected, .shopping_cart').slideDown('ease');
	$('#start_new_order').fadeIn(1500);
	PRODUCT = $(this).data('product');
	CONE_TYPE = 'none';
	change_cone_type(CONE_TYPE);
});
//--select milk type
$('.selected_milk').on('click', function() {
	MILK_TYPE = $(this).data('milktype');
	$('.complete_milkshake').children('div').children('div').addClass('icecream_top_color_'+ICECREAM_TYPE[0]);
	hide_everything();
	$('.complete_milkshake, .just_right').slideDown('ease');
});
//--send order to add_order_handler()
$('.just_right').on('click', function() {
	hide_everything();
	if( PRODUCT == 'icecream_cone') {
		$('.complete_icecream_cone').fadeIn(1000);
	}
	if( PRODUCT == 'milkshake') {
		$('.complete_milkshake').fadeIn(1000);
	}
	if( PRODUCT == 'float') {
		$('.complete_float_soda').fadeIn(1000);
	}
	$('.order_competed').fadeIn(1000);
	$('#start_new_order').fadeIn(1200);	
	current_order_display();
	add_order_handler(PRODUCT, ICECREAM_TYPE, CONE_TYPE, SODA_TYPE, MILK_TYPE);
});
//--top floating btn
$('#start_new_order').on('click', function() {
	location.reload();	
});
//--calculate running price
$('.place_new_order').on('click', function() {
	if( PREVIOUS_PAGE == 'View Previous Orders' ) {
		calculate_price(PRODUCT, ICECREAM_TYPE);
	}
});
//--show and hide scroll to top btn
$(document).scroll(function () {
    var y = $(this).scrollTop();   
    if (y > 150) {
       $('#scroll_to_top').fadeIn(500);
    } else {
       $('#scroll_to_top').fadeOut(500);
    }
});
//-- scroll to top btn
$('#scroll_to_top').on('click', function() {
	$('html, body').animate({ scrollTop: 0 }, 'ease');
});
//--toggle button text
$('#nav_toggle').on('click', function() {
	var PREVIOUS_PAGE = $(this).text();
	if( PREVIOUS_PAGE == 'View Previous Orders' ) {
		view_all_orders();
		$('.place_new_order, .shopping_cart').slideUp('ease');
		$('.view_previous_orders').slideDown('ease');
		$(this).text('Create New Order');
	} 
	if( PREVIOUS_PAGE == 'Create New Order' ) {
		$('.view_previous_orders').slideUp('ease');
		$('.place_new_order').slideDown('ease');
		$(this).text('View Previous Orders');
	}
});
$('.view_previous_orders').on('mouseenter', function() {
	$('#start_new_order').fadeIn(600);
});
$('.order_complete_place_new_order').on('click', function() {
	location.reload();
});
//--page ready
$(function() {
	//--fade page in on load
	$(".place_new_order").fadeIn(1200);
});
