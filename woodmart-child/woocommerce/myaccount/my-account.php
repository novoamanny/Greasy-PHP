<?php
/*
 *
 * My Account page
 * 
 */

defined('ABSPATH') || exit;


/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_navigation'); ?>

<div class="woocommerce-MyAccount-content">
	<?php
	/**
	 * My Account content.
	 *
	 * @since 2.6.0
	 */


	if (current_user_can('society_member_grease') || current_user_can('society_member_grit') || current_user_can('society_member_glory')) {
		// Get current user
		$user = wp_get_current_user();
		$user_id = get_current_user_id();


		$member_total_spend = wc_get_customer_total_spent($user_id);

		$grit = 300;
		$glory = 600;

		$grit_diff = $grit - $member_total_spend;
		$glory_diff = $glory - $member_total_spend;

		if (current_user_can('society_member_grease')): ?>
	        <div class="grease-welcome">
	            <div class="opacity-screen"></div>
            <p class="welcome">Welcome to the Society, <?php echo $current_user->first_name; ?></p>
				<h2 class="titles"><span><u>Grease</u> |</span> Grit <span>|</span> Glory</h2>
				<p class="spend-x">Spend <strong><?php echo '$' . $grit_diff; ?></strong> to reach GRIT</p>
	        </div>
		<?php elseif (current_user_can('society_member_grit')): ?>
            <div class="grit-welcome">
	        <p class="welcome">Welcome to the Society, <?php echo $current_user->first_name; ?></p>
				<h2 class="titles">Grease <span>| <u>Grit</u> |</span> Glory</h2>
				<p class="spend-x">Spend <strong><?php echo '$' . $glory_diff; ?></strong> to reach GLORY</p>
			</div>
		<?php elseif (current_user_can('society_member_glory')): ?>
	        <div class="glory-welcome">
	        <p class="welcome">Welcome to the Society, <?php echo $current_user->first_name; ?></p>
				<h2 class="titles">Grease <span>|</span> Grit <span>| <u>Glory</u></span></h2>
				<p class="spend-x"><strong>You've done it. You are the best of the best.</strong></p>
	        </div>
		<?php endif;
		

	}
	
	do_action('woocommerce_account_content');
	


	?>
</div>


<style>
    .grease-welcome{
        position: relative;
        background-color: #000;
        background-image: url('https://greasyhandsstg.wpenginepowered.com/wp-content/uploads/2024/08/greasyhandwhite.png');
        background-size: 50%;
        background-position: right;
        background-repeat: no-repeat;
    }
    .gform_button{
        background-color: #e51b1b !important;
    }
</style>



