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

		if (current_user_can('society_member_grease') || current_user_can('society_member_grit') || current_user_can('society_member_glory')): ?>
	        <div class="grease-welcome flex-center">
	            <!--<div class="opacity-screen"></div>-->
	            <div class="left">
                <p class="welcome">Welcome to the Society, <?php echo $current_user->first_name; ?></p>
    				<h2 class="titles">
    				    <?php if(current_user_can('society_member_grease')) : ?>
    				    <span class="text-color-gold" style="color: #CFA240"><u>Grease</u></span> <span>|</span> Grit <span>|</span> Glory
    				    <?php elseif(current_user_can('society_member_grit')) : ?>
                        Grease <span>|</span> <span class="text-color-gold" style="color: #CFA240"><u>Grit</u></span> <span>|</span> Glory
    				    <?php else : ?>
    			    	Grease <span>|</span> Grit <span>|</span> <span class="text-color-gold" style="color: #CFA240"><u>Glory</u></span>
    				    <?php endif; ?>
    				</h2>
    				<p class="spend-x"><?php if(!current_user_can('society_member_glory')) : ?> Spend <strong><?php if(current_user_can('society_member_grease')) : echo '$' . $grit_diff; elseif(current_user_can('society_member_grit')) : echo '$' . $glory_diff; endif; ?></strong> to reach <?php if(current_user_can('society_member_grease')) : ?>GRIT<?php else : ?>GLORY<?php endif; ?><?php else : ?><strong>You have made it. You are the best!</strong><?php endif; ?></p>
    			</div>
    			<div class="right flex-center">
    			    <p class="welcome">Your Memeber Benefits</p>
    			    <div class="full">
    			        <?php if(have_rows('my_account_benefits', 'option')) : ?>
    			            <?php while (have_rows('my_account_benefits', 'option')) : the_row(); $item = get_sub_field('benefit'); ?>
    			                <?php if(get_row_index() < 4) : ?>
                                    <p class="spend-x full welcome"><?php echo $item; ?></p>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
    			    </div>
    			</div>
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
        background-image: url('https://greasyhandsstg.wpenginepowered.com/wp-content/uploads/2024/08/Society-Banner.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 30px 20px;
    }
    .gform_button{
        background-color: #e51b1b !important;
    }
    .grease-welcome .left{
        width: 60%;
        border-right: 1px solid #fff;
    }
    .grease-welcome .right{
        width: 40%;
        border-left: 1px solid #fff;
        padding: 0 20px;
    }
    .grease-welcome .right p{
        margin-bottom: 0;
    }
    .wd-my-account-links div:hover{
        border-radius: 12px;
    }
</style>



