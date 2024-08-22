<?php
/**
 * Enqueue script and styles for child theme
 */
function woodmart_child_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/global.css', array( 'woodmart-style' ), woodmart_get_theme_info( 'Version' ) );
     wp_enqueue_style('woodmart-child-bootstrap-custom', get_stylesheet_directory_uri() . '/styles/global.css', array('woodmart-style'), '1.0.0', 'all');
}
add_action( 'wp_enqueue_scripts', 'woodmart_child_enqueue_styles', 10010 );


// A D D   C A R T   F I E L D S
/*add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_single_loop_add_to_cart_button', 20, 2 ); 
function custom_single_loop_add_to_cart_button( $button_text, $product ) {
    // HERE define your specific product IDs in this array
    $specific_ids = array(9267);

    if( in_array($product->get_id(), $specific_ids) ) {
        $button_text = __("Pre-Order Now", "woocommerce");
    } else {
        $button_text = __('add to cart', 'woocommerce');
    }
    return $button_text;
}*/








//* A D D   S E L E C T   F I E L D   T O   T H E   C H E C K O U T   P A G E
add_action('woocommerce_after_checkout_billing_form', 'wps_add_select_checkout_field');
function wps_add_select_checkout_field( $checkout ) {

	woocommerce_form_field( 'daypart', array(
	    'type'          => 'select',
	    'class'         => array( 'wps-drop' ),
		 'required'     => true,
	    'label'         => __( 'What planet are you on?' ),
	    'options'       => array(
	    	'blank'		=> __( 'Select One', 'wps' ),
	        'option 1'	=> __( 'Mercury', 'wps' ),
			'option 2'	=> __( 'Venus', 'wps' ),
			'option 3'	=> __( 'Earth', 'wps' ),
	        'option 4'	=> __( 'Mars', 'wps' ),
			'option 5'	=> __( 'Jupiter', 'wps' ),
			'option 6'	=> __( 'Saturn', 'wps' ),
	        'option 7' 	=> __( 'Uranus', 'wps' ),
			'option 8' 	=> __( 'Neptune', 'wps' ),
			'option 9' 	=> __( 'Pluto', 'wps' )
	    )
 ),

	$checkout->get_value( 'daypart' ));

}

//* Process the checkout
 add_action('woocommerce_checkout_process', 'wps_select_checkout_field_process');
 function wps_select_checkout_field_process() {
    global $woocommerce;

    // Check if set, if its not set add an error.
    if ($_POST['daypart'] == "blank")
     wc_add_notice( '<strong>Please select a planet</strong>', 'error' );
	 if ($_POST['daypart'] == "option 1")
     wc_add_notice( '<strong>You sure about that planet?</strong>', 'error' );
	 if ($_POST['daypart'] == "option 2")
     wc_add_notice( '<strong>You sure about that planet?</strong>', 'error' );
	 if ($_POST['daypart'] == "option 4")
     wc_add_notice( '<strong>You sure about that planet?</strong>', 'error' );
	 if ($_POST['daypart'] == "option 5")
     wc_add_notice( '<strong>You sure about that planet?</strong>', 'error' );
	 if ($_POST['daypart'] == "option 6")
     wc_add_notice( '<strong>You sure about that planet?</strong>', 'error' );
	 if ($_POST['daypart'] == "option 7")
     wc_add_notice( '<strong>You sure about that planet?</strong>', 'error' );
	 if ($_POST['daypart'] == "option 8")
     wc_add_notice( '<strong>You sure about that planet?</strong>', 'error' );
	 if ($_POST['daypart'] == "option 9")
     wc_add_notice( '<strong>You sure about that planet?</strong>', 'error' );
	 

 }

//* Update the order meta with field value
/* add_action('woocommerce_checkout_update_order_meta', 'wps_select_checkout_field_update_order_meta');
 function wps_select_checkout_field_update_order_meta( $order_id ) {

   if ($_POST['daypart']) update_post_meta( $order_id, 'daypart', esc_attr($_POST['daypart']));

 }*/

//* Display field value on the order edition page
add_action( 'woocommerce_admin_order_data_after_billing_address', 'wps_select_checkout_field_display_admin_order_meta', 10, 1 );
function wps_select_checkout_field_display_admin_order_meta($order){

	echo '<p><strong>'.__('Delivery option').':</strong> ' . get_post_meta( $order->id, 'daypart', true ) . '</p>';

}




/* ADD DELETE MY ACCOUNT */
add_filter ( 'woocommerce_account_menu_items', 'misha_log_history_link', 40 );
function misha_log_history_link( $menu_links ){
	
	$menu_links = array_slice( $menu_links, 0, 6, true ) 
	+ array( 'delete-my-account' => 'Remove My Account' )
	+ array_slice( $menu_links, 6, NULL, true );
	
	$menu_links = array_slice( $menu_links, 0, 6, true )
	+ array( 'apply-for-a-military-discount' => 'Military Discount' )
	+ array_slice( $menu_links, 6, NULL, true );
	
	return $menu_links;

}
// register permalink endpoint
add_action( 'init', 'misha_add_endpoint' );
function misha_add_endpoint() {

	add_rewrite_endpoint( 'log-history', EP_PAGES );

}



// style stripe card fields DON'T DELETE THIS CODE
add_filter( 'wc_stripe_elements_styling', 'woogist_add_stripe_elements_styles' );
function woogist_add_stripe_elements_styles($array) {
	$array = array(
		'base' => array( 
			'color' 	=> '#555'
		),
		'invalid' => array(
			'color'		=> '#d94f4f'
		)
	);
	return $array;
}





add_filter( 'wt_smartcoupon_max_auto_coupons_limit', function( ) { return 21; } );





// Please edit the address and name below.
// Change the From address.
add_filter( 'wp_mail_from', function ( $original_email_address ) {
    return 'hello@greasyhandssociety.com';
} );
 
// Change the From name.
add_filter( 'wp_mail_from_name', function ( $original_email_from ) {
    return 'Greasy Hands Society';
} );






//pulls the stock quantity from the product and adds the inventory which is needed for Facebook shop to synchronize
//
function get_size($product)
{
    $logger = new WC_Logger();

    if ($product->is_type('variation')) {
        $size_slug = $product->get_attribute('size');
        if ($size_slug) {
            return $size_slug;
        }
        $size_slug = $product->get_attribute('pa_size');
       if ($size_slug) {
            return $size_slug;
        }
        // Fetch the specific attributes for this variant
        $variant_attributes = $product->get_variation_attributes();
        // Try fetching the size for this variant
        $size_slug = isset($variant_attributes['attribute_sizes']) ? $variant_attributes['attribute_sizes'] : null;
        // If there's no 'pa_' prefix, try without it
        if (!$size_slug) {
            $logger->add('facebook_sync_issue', 'size_slug not found, trying without pa');
            $size_slug = isset($variant_attributes['attribute_pa_sizes']) ? $variant_attributes['attribute_pa_sizes'] : null;   
        }
        // If we found a size slug, use it
        if ($size_slug) {
            $logger->add('facebook_sync_issue', 'We found size_slug = ' . $size_slug);
            return $size_slug;
        } else {
            return '';
        }
    }
    // Try fetching without the 'pa_' prefix
    $sizes = $product->get_attribute('sizes');
    if (empty($sizes)) {
        // If it's empty, try with the 'pa_' prefix
        $sizes = $product->get_attribute('pa_sizes');
    }
    return $sizes;
}
function facebook_sync_issue( $product_data, $id ) {
$product = wc_get_product($id);
$quantity = $product->get_stock_quantity();
$product_data['quantity_to_sell_on_facebook'] = $quantity;
return $product_data;
}
add_filter( 'facebook_for_woocommerce_integration_prepare_product', 'facebook_sync_issue', 10, 2 );






//assign user in guest order
add_action( 'woocommerce_new_order', 'action_woocommerce_new_order', 10, 1 );
function action_woocommerce_new_order( $order_id ) {
    $order = new WC_Order($order_id);
    $user = $order->get_user();
    
    if( !$user ){
        //guest order
        $userdata = get_user_by( 'email', $order->get_billing_email() );
        if(isset( $userdata->ID )){
            //registered
            update_post_meta($order_id, '_customer_user', $userdata->ID );
        }else{
            //Guest
        }
    }
}

function action_woocommerce_created_customer( $customer_id, $new_customer_data, $password_generated ) {
    // Link past orders to this newly created customer
    wc_update_new_customer_past_orders( $customer_id );
}
add_action( 'woocommerce_created_customer', 'action_woocommerce_created_customer', 10, 3 );









/**
 * Limit the number of times a form can be submitted per a specific time period. You modify this limit to apply to
 * the visitor's IP address, the user's ID, the user's role, a specific form URL, or the value of a specific field.
 * These "limiters" can be combined to create more complex limitations.
 *
 * @version 3.0
 * @author  David Smith <david@gravitywiz.com>
 * @license GPL-2.0+
 * @link    http://gravitywiz.com/better-limit-submission-per-time-period-by-user-or-ip/
 */
class GW_Submission_Limit {

	var $_args;
	var $_notification_event;

	private static $forms_with_individual_settings = array();

	public function __construct( $args ) {

		// make sure we're running the required minimum version of Gravity Forms
		if ( ! property_exists( 'GFCommon', 'version' ) || ! version_compare( GFCommon::$version, '1.8', '>=' ) ) {
			return;
		}

		$this->_args = wp_parse_args( $args, array(
			'form_id'              => false,
			'form_ids'             => array(),
			'limit'                => 1,
			'limit_by'             => 'ip', // 'ip', 'user_id', 'role', 'embed_url', 'field_value'
			'time_period'          => 60 * 60 * 24, // integer in seconds or 'day', 'month', 'year' to limit to current day, month, or year respectively
			'limit_message'        => __( 'Sorry, you have reached the submission limit for this form.' ),
			'apply_limit_per_form' => true,
			'enable_notifications' => false,
		) );

		if ( ! is_array( $this->_args['limit_by'] ) ) {
			$this->_args['limit_by'] = array( $this->_args['limit_by'] );
		}

		if ( empty( $this->_args['form_ids'] ) ) {
			if ( $this->_args['form_id'] === false ) {
				$this->_args['form_ids'] = false;
			} elseif ( ! is_array( $this->_args['form_id'] ) ) {
				$this->_args['form_ids'] = array( $this->_args['form_id'] );
			} else {
				$this->_args['form_ids'] = $this->_args['form_id'];
			}
		}

		if ( $this->_args['form_ids'] ) {
			foreach ( $this->_args['form_ids'] as $form_id ) {
				self::$forms_with_individual_settings[] = $form_id;
			}
		}

		add_action( 'init', array( $this, 'init' ) );

	}

	public function init() {

		add_filter( 'gform_pre_render', array( $this, 'pre_render' ) );
		add_filter( 'gform_validation', array( $this, 'validate' ) );

		if ( $this->_args['enable_notifications'] ) {

			$this->enable_notifications();

			add_action( 'gform_after_submission', array( $this, 'maybe_send_limit_reached_notifications' ), 10, 2 );

		}

	}

	public function pre_render( $form ) {

		if ( ! $this->is_applicable_form( $form ) || ! $this->is_limit_reached( $form['id'] ) ) {
			return $form;
		}

		$submission_info = rgar( GFFormDisplay::$submission, $form['id'] );

		// if no submission, hide form
		// if submission and not valid, hide form
		// unless 'field_value' limiter is applied
		if ( ( ! $submission_info || ! rgar( $submission_info, 'is_valid' ) ) && ! $this->is_limited_by_field_value() ) {
			add_filter( 'gform_get_form_filter_' . $form['id'], array( $this, 'get_limit_message' ), 10, 2 );
		}

		return $form;

	}

	public function get_limit_message() {
		ob_start();
		?>
		<div class="limit-message">
			<?php echo do_shortcode( $this->_args['limit_message'] ); ?>
		</div>
		<?php
		return ob_get_clean();
	}

	public function validate( $validation_result ) {

		if ( ! $this->is_applicable_form( $validation_result['form'] ) || ! $this->is_limit_reached( $validation_result['form']['id'] ) ) {
			return $validation_result;
		}

		$validation_result['is_valid'] = false;

		if ( $this->is_limited_by_field_value() ) {
			$field_ids = array_map( 'intval', $this->get_limit_field_ids() );
			foreach ( $validation_result['form']['fields'] as &$field ) {
				if ( in_array( $field['id'], $field_ids ) ) {
					$field['failed_validation']  = true;
					$field['validation_message'] = do_shortcode( $this->_args['limit_message'] );
				}
			}
		}

		return $validation_result;
	}

	public function is_limit_reached( $form_id ) {
		return $this->get_entry_count( $form_id ) >= $this->get_limit();
	}

	public function get_entry_count( $form_id ) {
		global $wpdb;

		$where = array();
		$join  = array();

		$where[] = 'e.status = "active"';

		foreach ( $this->_args['limit_by'] as $limiter ) {
			switch ( $limiter ) {
				case 'role': // user ID is required when limiting by role
				case 'user_id':
					$where[] = $wpdb->prepare( 'e.created_by = %s', get_current_user_id() );
					break;
				case 'embed_url':
					$where[] = $wpdb->prepare( 'e.source_url = %s', GFFormsModel::get_current_page_url() );
					break;
				case 'field_value':
					$values = $this->get_limit_field_values( $form_id, $this->get_limit_field_ids() );

					// if there is no value submitted for any of our fields, limit is never reached
					if ( empty( $values ) ) {
						return false;
					}

					foreach ( $values as $field_id => $value ) {
						$table_slug = sprintf( 'em%s', str_replace( '.', '_', $field_id ) );
						$join[]     = "INNER JOIN {$wpdb->prefix}gf_entry_meta {$table_slug} ON {$table_slug}.entry_id = e.id";
						// phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
						$where[] = $wpdb->prepare( "\n( ( {$table_slug}.meta_key BETWEEN %s AND %s ) AND {$table_slug}.meta_value = %s )", doubleval( $field_id ) - 0.001, doubleval( $field_id ) + 0.001, $value );
					}

					break;
				default:
					$where[] = $wpdb->prepare( 'ip = %s', GFFormsModel::get_ip() );
			}
		}

		if ( $this->_args['apply_limit_per_form'] || ( ! $this->is_global( $form_id ) && count( $this->_args['form_ids'] ) <= 1 ) ) {
			$where[] = $wpdb->prepare( 'e.form_id = %d', $form_id );
		} else {
			$where[] = $wpdb->prepare( 'e.form_id IN( %s )', implode( ', ', $this->_args['form_ids'] ) );
		}

		$time_period     = $this->_args['time_period'];
		$time_period_sql = false;

		if ( $time_period === false ) {
			// no time period
		} elseif ( intval( $time_period ) > 0 ) {
			$time_period_sql = $wpdb->prepare( 'date_created BETWEEN DATE_SUB(utc_timestamp(), INTERVAL %d SECOND) AND utc_timestamp()', $this->_args['time_period'] );
		} else {

			$gmt_offset  = get_option( 'gmt_offset' );
			$date_func   = $gmt_offset < 0 ? 'DATE_SUB' : 'DATE_ADD';
			$hour_offset = abs( $gmt_offset );

			$date_created_sql  = sprintf( '%s( date_created, INTERVAL %d HOUR )', $date_func, $hour_offset );
			$utc_timestamp_sql = sprintf( '%s( utc_timestamp(), INTERVAL %d HOUR )', $date_func, $hour_offset );

			switch ( $time_period ) {
				case 'per_day':
				case 'day':
					$time_period_sql = "DATE( $date_created_sql ) = DATE( $utc_timestamp_sql )";
					break;
				case 'per_week':
				case 'week':
					$time_period_sql  = "WEEK( $date_created_sql ) = WEEK( $utc_timestamp_sql )";
					$time_period_sql .= "AND YEAR( $date_created_sql ) = YEAR( $utc_timestamp_sql )";
					break;
				case 'per_month':
				case 'month':
					$time_period_sql  = "MONTH( $date_created_sql ) = MONTH( $utc_timestamp_sql )";
					$time_period_sql .= "AND YEAR( $date_created_sql ) = YEAR( $utc_timestamp_sql )";
					break;
				case 'per_year':
				case 'year':
					$time_period_sql = "YEAR( $date_created_sql ) = YEAR( $utc_timestamp_sql )";
					break;
			}
		}

		if ( $time_period_sql ) {
			$where[] = $time_period_sql;
		}

		$where = implode( ' AND ', $where );
		$join  = implode( "\n", $join );

		$sql = "SELECT count( e.id )
                FROM {$wpdb->prefix}gf_entry e
                $join
                WHERE $where";

		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared
		$entry_count = $wpdb->get_var( $sql );

		return $entry_count;
	}

	public function is_limited_by_field_value() {
		return in_array( 'field_value', $this->_args['limit_by'] );
	}

	public function get_limit_field_ids() {

		$limit = $this->_args['limit'];

		if ( is_array( $limit ) ) {
			$field_ids = array_keys( $this->_args['limit'] );
			$field_ids = array( array_shift( $field_ids ) );
		} else {
			$field_ids = $this->_args['fields'];
		}

		return $field_ids;
	}

	public function get_limit_field_values( $form_id, $field_ids ) {

		$form   = GFAPI::get_form( $form_id );
		$values = array();

		foreach ( $field_ids as $field_id ) {

			$field = GFFormsModel::get_field( $form, $field_id );
			if ( ! $field ) {
				continue;
			}

			$input_name = 'input_' . str_replace( '.', '_', $field_id );
			$value      = GFFormsModel::prepare_value( $form, $field, rgpost( $input_name ), $input_name, null );

			if ( ! rgblank( $value ) ) {
				$values[ "$field_id" ] = $value;
			}
		}

		return $values;
	}

	public function get_limit() {

		$limit = $this->_args['limit'];

		if ( $this->is_limited_by_field_value() ) {
			$limit = is_array( $limit ) ? array_shift( $limit ) : intval( $limit );
		} elseif ( in_array( 'role', $this->_args['limit_by'] ) ) {
			$limit = rgar( $limit, $this->get_user_role() );
		}

		return intval( $limit );
	}

	public function get_user_role() {

		$user = wp_get_current_user();
		$role = reset( $user->roles );

		return $role;
	}

	public function enable_notifications() {

		if ( ! class_exists( 'GW_Notification_Event' ) ) {

			_doing_it_wrong( 'GW_Inventory::$enable_notifications', __( 'Inventory notifications require the \'GW_Notification_Event\' class.' ), '1.0' );

		} else {

			$event_slug = implode( array_filter( array( 'gw_submission_limit_limit_reached', $this->_args['form_id'] ) ) );
			$event_name = GFForms::get_page() == 'notification_edit' ? __( 'Submission limit reached' ) : __( 'Event name is only populated on Notification Edit view; saves a DB call to get the form on every ' );

			$this->_notification_event = new GW_Notification_Event( array(
				'form_id'    => $this->_args['form_id'],
				'event_name' => $event_name,
				'event_slug' => $event_slug,
				//'trigger'    => array( $this, 'notification_event_listener' )
			) );

		}

	}

	public function maybe_send_limit_reached_notifications( $entry, $form ) {

		if ( $this->is_applicable_form( $form ) && $this->is_limit_reached( $form['id'] ) ) {
			$this->send_limit_reached_notifications( $form, $entry );
		}

	}

	public function send_limit_reached_notifications( $form, $entry ) {

		$this->_notification_event->send_notifications( $this->_notification_event->get_event_slug(), $form, $entry, true );

	}

	public function is_applicable_form( $form ) {

		$form_id          = isset( $form['id'] ) ? $form['id'] : $form;
		$is_specific_form = ! $this->is_global( $form_id ) ? in_array( $form_id, $this->_args['form_ids'] ) : false;

		return $this->is_global( $form_id ) || $is_specific_form;
	}

	public function is_global( $form ) {
		$form_id = isset( $form['id'] ) ? $form['id'] : $form;
		return empty( $this->_args['form_ids'] ) && ! in_array( $form_id, self::$forms_with_individual_settings );
	}

}

class GWSubmissionLimit extends GW_Submission_Limit { }

# Basic Usage
new GW_Submission_Limit( array(
    'form_id' => 9,
	'limit_by' => 'user_id',
    'limit' => 1,
    'limit_message' => 'You have filled out this form, we will be in touch when we have verified your information.',
	'time_period' => 'per_year'
) );








// -- Use product short description for google -- //

add_filter( 'woocommerce_gla_use_short_description', '__return_true' );




// -- remove lazy load for images with .skip-lazy class -- //
add_filter( 'wp_get_attachment_image_attributes', 'fp_no_lazy_featured_image', 10, 3 );
function fp_no_lazy_featured_image( $attr ) {
    if ( false !== strpos( $attr['class'], 'skip-lazy' ) ) {
    	$attr['loading'] = "eager";
    }
    return $attr;
}




// Display the sku below under cart item name in checkout
add_filter( 'woocommerce_checkout_cart_item_quantity', 'display_sku_after_item_qty', 5, 3 );  
function display_sku_after_item_qty( $item_quantity, $cart_item, $cart_item_key ) {
    $product = $cart_item['data']; // The WC_Product Object

    if( $product->get_sku() ) {
        $item_quantity .= '<br><span class="item-sku">'. $product->get_sku() . '</span>';
    }
    return $item_quantity;
}


// WPBakery add column link








// add new user with submission of Gravity Form 
add_action( 'gform_after_submission_17', 'create', 10, 2 );
function create( $entry, $form ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $user_login = wp_slash( $entry[3] );
    $user_email = wp_slash( $entry[3] );
    $user_pass  = substr(str_shuffle($chars),0,12);
    $role = 'society_members';


    $userdata = compact( 'user_login', 'user_email', 'user_pass' );
    return wp_insert_user( $userdata );
}



/* testing woocommerce changing rates */

add_filter('woocommerce_package_rates', 'change_shipping_method_based_on_cart_total', 11, 2);
function change_shipping_method_based_on_cart_total( $rates, $package ) {

    // set the shipping class id to exclude
    //$shipping_class_id = 150;

    // initializes the total cart of products
    $total_cart = 0;

    foreach ( WC()->cart->get_cart() as $cart_item ) {
        $product = $cart_item['data'];
        // if the product has the shipping class id equal to "$shipping_class_id" it is excluded from the count
       // if ( $product->get_shipping_class_id() == $shipping_class_id ) {
       //     continue;
       // }
        $qty = $cart_item['quantity'];
        $price = $cart_item['data']->get_price();
        // add the product line total to the total
        $total_cart += $price * $qty;

    }

    switch ( true ) {
        case $total_cart < 99:
            // removes flat rates that are meant for everything greater than $99 on international orders
            // CA
            unset($rates['flat_rate:50']);
			// NZ
            unset($rates['flat_rate:51']);
			// Australia
            unset($rates['flat_rate:52']);
			// Germany
            unset($rates['flat_rate:56']);
			// Japan
            unset($rates['flat_rate:54']);
			// Austria
            unset($rates['flat_rate:55']);
			// Belgium
            unset($rates['flat_rate:59']);
			// Bulgaria
            unset($rates['flat_rate:57']);
			// Croatia
            unset($rates['flat_rate:61']);
			// Cyprus
            unset($rates['flat_rate:62']);
			// Czech Republic
            unset($rates['flat_rate:63']);
			// Denmark
            unset($rates['flat_rate:64']);
			// Estonia
            unset($rates['flat_rate:65']);
			// Finland
            unset($rates['flat_rate:66']);
			// France
            unset($rates['flat_rate:67']);
			// Greece
            unset($rates['flat_rate:68']);
			// Hungary
            unset($rates['flat_rate:69']);
			// India
            unset($rates['flat_rate:70']);
			// Ireland
            unset($rates['flat_rate:71']);
			// Italy
            unset($rates['flat_rate:72']);
			// Latvia
            unset($rates['flat_rate:73']);
			// Luxembourg
            unset($rates['flat_rate:74']);
			// Netherlands
            unset($rates['flat_rate:75']);
			// Poland
            unset($rates['flat_rate:76']);
			// Portugal
            unset($rates['flat_rate:77']);
			// Romania
            unset($rates['flat_rate:78']);
			// Slovakia
            unset($rates['flat_rate:79']);
			// Slovenia
            unset($rates['flat_rate:80']);
			// Spain
            unset($rates['flat_rate:81']);
			// Sweden
            unset($rates['flat_rate:82']);
			// Switzerland
            unset($rates['flat_rate:83']);
			// UK
            unset($rates['flat_rate:84']);
            break;
        case $total_cart >= 99: 
            // removes flat rates that apply less than $99 on international orders
            // CA
            unset($rates['flat_rate:13']);
			// NZ
            unset($rates['flat_rate:14']);
			// Australia
            unset($rates['flat_rate:15']);
			// Germany
            unset($rates['flat_rate:16']);
			// Japan
            unset($rates['flat_rate:17']);
			// Austria
            unset($rates['flat_rate:18']);
			// Belgium
            unset($rates['flat_rate:19']);
			// Bulgaria
            unset($rates['flat_rate:20']);
			// Croatia
            unset($rates['flat_rate:21']);
			// Cyprus
            unset($rates['flat_rate:22']);
			// Czech Republic
            unset($rates['flat_rate:23']);
			// Denmark
            unset($rates['flat_rate:24']);
			// Estonia
            unset($rates['flat_rate:25']);
			// Finland
            unset($rates['flat_rate:26']);
			// France
            unset($rates['flat_rate:27']);
			// Greece
            unset($rates['flat_rate:28']);
			// Hungary
            unset($rates['flat_rate:29']);
			// India
            unset($rates['flat_rate:30']);
			// Ireland
            unset($rates['flat_rate:31']);
			// Italy
            unset($rates['flat_rate:32']);
			// Latvia
            unset($rates['flat_rate:33']);
			// Luxembourg
            unset($rates['flat_rate:34']);
			// Netherlands
            unset($rates['flat_rate:35']);
			// Poland
            unset($rates['flat_rate:36']);
			// Portugal
            unset($rates['flat_rate:37']);
			// Romania
            unset($rates['flat_rate:38']);
			// Slovakia
            unset($rates['flat_rate:39']);
			// Slovenia
            unset($rates['flat_rate:40']);
			// Spain
            unset($rates['flat_rate:41']);
			// Sweden
            unset($rates['flat_rate:42']);
			// Switzerland
            unset($rates['flat_rate:43']);
			// UK
            unset($rates['flat_rate:44']);
            break;
    }
    
    return $rates;
}


add_filter( 'gform_confirmation_anchor_18', '__return_false' );

add_action('gform_after_submission_18', 'create_society_member', 10, 2);
function create_society_member($entry, $form) {

    // Get form field values
    $first_name = rgar($entry, '21');
    $last_name = rgar($entry, '22');
    $user_name = rgar($entry, '20');
    $email = rgar($entry, '3');
    $password = rgar($entry, '18');
    $confirm_password = rgar($entry, '19');
    $phone = rgar($entry, '4');
    $birthday = rgar($entry, '16');
    $what_drives_you = rgar($entry, '12');
    $role = 'society_member_grease';

    // Create user data array
    $userdata = array(
        'user_login'        => $user_name,
        'user_nicename'     => $first_name,
        'user_email'        => $email,
        'user_pass'         => $password,
        'first_name'        => $first_name,
        'last_name'         => $last_name,
        'role'              => $role
    );

    // Insert the user
    $user_id = wp_insert_user( wp_slash($userdata) );

    if (is_wp_error($user_id)) {
        // There was an error creating the user
        echo $user_id->get_error_message();
    } else {
        // Add user meta data
        add_user_meta($user_id, 'billing_phone', $phone);
        add_user_meta($user_id, 'birthday', $birthday);
        add_user_meta($user_id, 'what_drives_you', $what_drives_you);

        // Log the user in
        $creds = array(
            'user_login'    => $user_name,
            'user_password' => $password,
            'remember'      => true
        );

        $user = wp_signon($creds, false);

        if (is_wp_error($user)) {
            echo $user->get_error_message();
        } else {
            // Redirect or perform other actions after successful login
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true);
            // echo 'User created and logged in with ID: ' . $user_id;
        }
    }
}





// current_user_display_name
function display_current_user_display_name () {
    $user = wp_get_current_user();
    $display_name = $user->user_login;
    return $user->user_login;
}
add_shortcode('current_user_display_name', 'display_current_user_display_name');

// add shortcode for my account
add_shortcode('my_account_section', 'shortcode_my_account_section');
function shortcode_my_account_section($atts) {
extract(shortcode_atts(['section' => ''], $atts));
ob_start();
do_action('woocommerce_account_'.$section.'_endpoint');
return ob_get_clean();
}


// UPDATE SOCIETY MEMBER
add_action('woocommerce_order_status_changed', 'update_society_member');
function update_society_member($order_id) {
    // Get the order
    $order = wc_get_order($order_id);
    // Get the user ID
    $user_id = $order->get_user_id();
    
    if ($user_id) {
        // Get the user object
        $user = get_userdata($user_id);
        // Calculate the total spent by the user
        $total_spent = wc_get_customer_total_spent($user_id);
        
        // Check if the customer has spent over $300 and currently has the role 'society_member_grease'
        if ($total_spent >= 300 && $total_spent < 600 && in_array('society_member_grease', $user->roles)) {
            // Remove 'society_member_grease' role and add 'society_member_grit' role
            $user->remove_role('society_member_grease');
            $user->add_role('society_member_grit');
        }
        
        // Check if the customer has spent over $600 and currently has the role 'society_member_grease' or 'society_member_grit'
        if ($total_spent >= 600 && (in_array('society_member_grease', $user->roles) || in_array('society_member_grit', $user->roles))) {
            $user->remove_role('society_member_grease');
            $user->remove_role('society_member_grit');
            $user->add_role('society_member_glory');
        }
    }
}


add_action( "wt_smart_coupon_before_my_account_coupons", "wt_sc_add_heading_before_my_account_coupons" );
function wt_sc_add_heading_before_my_account_coupons(){

	echo "<p>".__( "<div class='rewards-bar'><h3>Want more rewards?</h3> <button onclick=\"location.href='/join-the-society/'\">Join the Society</button></div>", "wt-smart-coupons-for-woocommerce-pro" )."</p>";
}

add_filter( 'body_class', function( $classes ){
    foreach( (array) wp_get_current_user()->roles as $role ){
        $classes[] = "user-role-$role";
    }
    return $classes;
});

// SET UP $75 SHIPPING FOR SOCIETY MEMBERS
add_filter('woocommerce_package_rates', 'custom_shipping_costs_based_on_user_role', 10, 2);
function custom_shipping_costs_based_on_user_role($rates, $package) {
    // Get the current user role
    $current_user = wp_get_current_user();
    $user_role = $current_user->roles[0];
    // Get the order subtotal without taxes
    $subtotal = WC()->cart->subtotal_ex_tax;
    if (isset($rates['free_shipping:82'])) {
        // Set the shipping costs based on the user role and subtotal
        if ( $user_role == 'society_member_grit' ) {
            if ($subtotal >= 75) {
                // Free shipping
                unset($rates['flat_rate:11']); // remove standard shipping rate
                unset($rates['free_shipping:3']); // remove standard shipping rate
            } else {
                // Add $10 shipping cost
                $rates['flat_rate:11']->cost = 10;
            }
        } else {
            unset($rates['free_shipping:82']); // remove $75 shipping rate for other users
        }
    }
    return $rates;
}
function filter_woocommerce_package_rates( $rates, $package ) {
    // Set the rate IDs in the array
    $glory_rate_ids = array( 'free_shipping:84' );
    
    // NOT the required user role, remove shipping method(s)
    if ( ! current_user_can( 'society_member_glory' ) ) {
        // Loop through
        foreach ( $rates as $glory_rate_id => $rate ) {
            // Checks if a value exists in an array
            if ( in_array( $glory_rate_id, $glory_rate_ids ) ) {
                unset( $rates[$glory_rate_id] );
            }
        }
    }else {
		unset($rates['flat_rate:11']); // remove standard shipping rate
        unset($rates['free_shipping:3']); // remove standard shipping rate
	}
    
    return $rates;
}
add_filter( 'woocommerce_package_rates', 'filter_woocommerce_package_rates', 10, 2 );





// FREE SHIPPING BAR for $75 society members
function cart_notice() {
	// Get the current user role
    $current_user = wp_get_current_user();
    $user_role = $current_user->roles[0];
	
	// Get the order subtotal without taxes
    $subtotal = WC()->cart->subtotal_ex_tax;
	
  $free_shipping_settings = get_option( 'woocommerce_free_shipping_82_settings' );
  $maximum = $free_shipping_settings['min_amount'];
  $current = WC()->cart->subtotal;
        if ( $user_role == 'society_member_grit' ) {
			if ( $subtotal >= 75 ) {
				echo '<div class="woocommerce-message">You qualify for free shipping!</div>';
			} else {
				echo '<div class="woocommerce-message">Add <strong>$' . (75 - $subtotal) . '</strong> to the cart to get free shipping.</div>';
			}
		}
	elseif ( $user_role == 'society_member_glory' ) {
				echo '<div class="woocommerce-message">You qualify for free shipping!</div>';
		}
}
add_action( 'woocommerce_before_cart', 'cart_notice' );


// add Birthday, what drives you, notifications
function custom_user_profile_fields($user){
    if(is_object($user))
        $birthday = esc_attr( get_the_author_meta( 'birthday', $user->ID ) );
    else
        $birthday = null;
    if(is_object($user))
        $what_drives_you = esc_attr( get_the_author_meta( 'what_drives_you', $user->ID ) );
    else
        $what_drives_you = null;
    ?>
    <h3>Extra profile information</h3>
    <table class="form-table">
        <tr>
            <th><label for="birthday">Birthday</label></th>
            <td>
                <input type="text" class="regular-text" name="birthday" value="<?php echo $birthday; ?>" id="birthday" /><br />
                <span class="description">Birthday (Year-Month-Day)</span>
            </td>
        </tr>
		<tr>
            <th><label for="what_drives_you">What drives you</label></th>
            <td>
                <textarea rows="5" cols="30" type="text" name="what_drives_you" id="what_drives_you" class="regular-text"><?php echo $what_drives_you; ?></textarea>
                <p class="description">Tell us a bit about why you're joining</p>
            </td>
        </tr>
    </table>
<?php
}
add_action( 'show_user_profile', 'custom_user_profile_fields' );
add_action( 'edit_user_profile', 'custom_user_profile_fields' );
add_action( "user_new_form", "custom_user_profile_fields" );

function save_custom_user_profile_fields($user_id){
    if(!current_user_can('manage_options'))
        return false;

    # save my custom field
    update_user_meta($user_id, 'birthday', $_POST['birthday']);
	update_user_meta($user_id, 'what_drives_you', $_POST['what_drives_you']);
}
add_action('user_register', 'save_custom_user_profile_fields');
add_action('profile_update', 'save_custom_user_profile_fields');

/*
// show birthday on my account
// add_action( 'woocommerce_edit_account_form', 'add_custom_fields_to_edit_account_form' );
// function add_custom_fields_to_edit_account_form() {
//     $user = wp_get_current_user();
//         if(is_object($user))
//         $birthday = esc_attr( get_the_author_meta( 'birthday', $user->ID ) );
//     else
//         $birthday = null;
//     ?>
//         <label for="birthday"><?php _e( 'Birthday', 'woocommerce' ); ?></label>
//         <p><?php echo get_user_meta( get_current_user_id(), 'birthday', true ); ?></p>
//     <?php
// }*/



// My Account MODS
add_filter('woocommerce_account_menu_items','wt_removed_un_wanted_my_account_tabs',100,1);
function wt_removed_un_wanted_my_account_tabs( $items ) {
   if( isset($items['wt-store-credit']) ) unset( $items['wt-store-credit'] );
   if( isset($items['edit-address']) ) unset( $items['edit-address'] );
   if( isset($items['upgrade-account']) ) unset( $items['upgrade-account'] );
   if( isset($items['wishlist']) ) unset( $items['wishlist'] );

   return $items;
}


add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items', 22, 1 );
function custom_my_account_menu_items( $items ) {
    $items['wt-smart-coupon'] = __("Membership Benefits", "woocommerce");
    $items['edit-account'] = __("Account Settings", "woocommerce");
    $items['orders'] = __("My Orders", "woocommerce");
    return $items;
}


