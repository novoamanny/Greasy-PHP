<!-- Join The Society -->
<!-- Card Section -->
<?php 
if (current_user_can('society_member_grease') || current_user_can('society_member_grit') || current_user_can('society_member_glory')) {
    		// Get current user
		$user = wp_get_current_user();
		$user_id = get_current_user_id();


		$member_total_spend = wc_get_customer_total_spent($user_id);

		$grit = 300;
		$glory = 600;

		$grit_diff = $grit - $member_total_spend;
		$glory_diff = $glory - $member_total_spend;
}
?>

<div class="card-section flex-center align-items">
    <div class="main-headline-container flex-left align-items">
        <!-- Greasy Hand Logo -->
        <div class="global-greasy-hand-logo">
            <?php if ( $GREASY_HAND_LOGO ) : ?>
                <img src="<?php echo $GREASY_HAND_LOGO; ?>" />
            <?php endif ?>
        </div>
        <h2 class="main-headline">| <?php the_field('main_headline'); ?></h2>
    </div>
    <!--Join The Society-->
    <!-- Need to use page path instead of hero_headline -->
    <?php if($hero_headline == 'Join the Society') : ?>
    <div class="desktop_cards full flex-center align-items-start">
        <?php if( have_rows('card') ): ?>
            <?php while( have_rows('card') ): the_row(); ?>
            <?php
            // Data
                $card_index = get_row_index();
                $card_title=get_sub_field('card_title');
            ?>
                <?php include 'card.php' ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <div class="mobile_cards full flex-center align-items-start">
        <?php if( have_rows('card') ): ?>
            <?php while( have_rows('card') ): the_row(); ?>
            <?php
            // Data
                $card_title=get_sub_field('card_title');
            ?>
                <?php include 'card.php' ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    
    <!--Welcome To The Society-->
    <?php else : ?>
        <div class="full flex-center align-items-start">
            <div class="desktop-welcome welcome-banner flex-center">
                <div class='account flex-center '>
                    <div class="full details">
                        <h2>Your Account</h2>
                        <p><span style="font-weight: bold; color: #000;">Username:</span> greasyemail@greasyhandssociety.com</p>
                    </div>
                    <div class="full coupons">
                        <h2>Available Coupons</h2>
                        <div class="coupon">
                            <div class="inner flex-center align-items">
                                <h2 class="titles text-color-white">10% off your first order!</h2>
                                <p class='text-color-gold full text-center' style="margin: 0;">jointhesociety</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="level grease-welcome flex-center align-items">
    	            <!--<div class="opacity-screen"></div>-->
    	            <div class='full flex-left'>
    	                <h2 class="titles text-color-gold greasy-font"><?php if(current_user_can('society_member_grease')) : ?>Grease<?php elseif(current_user_can('society_member_grit')) : ?>Grit<?php else : ?>Glory<?php endif; ?> Level</h2>
    	            </div>
    	            <?php if ( have_rows( 'welcome_banner' ) ) : ?>
	                    <?php while ( have_rows( 'welcome_banner' ) ) : the_row(); ?>
        	            <div class="full flex-center">
            				<p class="spend-x text-color-white" style="color: #fff;"><?php the_sub_field( 'banner_description' ); ?></p>
        				</div>
        				<div class='full flex-center'>
        				    <?php if ( have_rows( 'benefits' ) ) : 
        				    ?>
			                    <?php while ( have_rows( 'benefits' ) ) : the_row(); ?>
                				    <div class='section border'>
                				        <h2 class="text-color-white"><?php the_sub_field( 'benefit' ); ?></h2>
                				    </div>
        				        <?php endwhile; ?>
        				    <?php endif; ?>
        				</div>
        				<?php endwhile; ?>
                    <?php endif; ?>
    	        </div>
            </div>
            
            <div class="mobile-welcome welcome-banner flex-center">
                <div class='account flex-center '>
                    <div class="full details">
                        <h2>Your Account</h2>
                        <p><span style="font-weight: bold;" class='text-color-black'>Username:</span> greasyemail@greasyhandssociety.com</p>
                    </div>
                    <div class="full coupons">
                        <h2>Available Coupons</h2>
                        <div class="coupon">
                            <div class="inner flex-center align-items">
                                <h2 class="titles text-color-white">10% off your first order!</h2>
                                <p class='text-color-gold full text-center' style="margin: 0;">jointhesociety</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="level grease-welcome flex-center align-items">
    	            <!--<div class="opacity-screen"></div>-->
    	            <div class='full flex-center align-items'>
    	                <h2 class="titles text-color-white"><?php if(current_user_can('society_member_grease')) : ?>GREASE<?php elseif(current_user_can('society_member_grit')) : ?>GRITy<?php else : ?>GLORY<?php endif; ?> LEVEL</h2>
    	            </div>
    	        </div>
            </div>
            <div class="full flex-center align-items exclusive-content">
                <?php echo do_shortcode('[products limit=”8” columns="4" orderby="popularity"]'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<!-- Need to comeback and review -->
<script>
// C A R D S
// Retrieve Data
var cards = document.getElementsByClassName('card');
var benefits = document.getElementsByClassName('card-details');
// Set Expanded style
var set = null;
// Click Check
var firstClick;
var pastNode;

// Cards Array
var cardsArray = [...cards];
// Benefits Array
var benefitsArray = [...benefits];

// INIT
if(!set){
    cardsArray.forEach((card, index) => {
        if (index !== 3){
            benefitsArray[index].classList.remove('expanded');
            pastNode = cardsArray[index];
        }
    })
    set = true;
}
// C A R D S   T O G G L E
cardsArray.forEach((card, index) => {
    card.addEventListener("click", () => {
        // Only Mobile
        if(!firstClick){
            benefitsArray[3].classList.remove('expanded');
            firstClick = true;
        }

        if (benefitsArray[index].classList.contains('expanded')) {
            
            pastNode = null;
            benefitsArray[index].classList.remove('expanded');
        } else {
            if(pastNode){
            pastNode.classList.remove('expanded');
          }
            benefitsArray[index].classList.add('expanded');
            pastNode = benefitsArray[index];
        }
    });
})


// I N F O   P O P S   T O G G L E
var infoPops = document.querySelectorAll('.pops');
var infoPopsArray = [...infoPops];
var pastPop = null;

infoPopsArray.forEach((currentNode, index) => {
    currentNode.addEventListener("click", () => {
    if (currentNode.classList.contains('expanded')) {
        pastPop = null;
        currentNode.classList.remove('expanded');
    }
    else{
        if(pastPop){
        pastPop.classList.remove('expanded');
        }
        currentNode.classList.add('expanded');
        pastPop = currentNode;
    }
    });
})
</script>

<style>
    .desktop-welcome{
        
    }
    .mobile-welcome{
        display: none;
    }
    .mobile-welcome .grease-welcome .titles{
        font-size: 4em;
        text-align: center;
    }
    .mobile-welcome.welcome-banner .account{
        margin-bottom: 20px;     
    }
    .mobile-welcome.welcome-banner .account, .mobile-welcome.welcome-banner .level{
        width: 100%;
    }
    @media(max-width: 1300px){
        .desktop-welcome{
            display: none;
        }
        .mobile-welcome{
            display: flex;
        }
    }
    @media(max-width: 650px){
        .mobile-welcome .grease-welcome .titles{
            font-size: 3.5em;
        }
    }
</style>