<!-- Join The Society -->
<!-- Card Component -->


<div class="card flex-center align-items">
    <!-- Top Gold Bar -->
    <div class="flex-center align-items bg-gold full gold-title">
        <h2><?php echo $card_title; ?></h2>
    </div>
    <!-- Card Description -->
    <div class="flex-center align-items bg-black full card-details expanded">
        <?php if ( have_rows( 'card_content' ) ) : ?>
            <?php while ( have_rows( 'card_content' ) ) : the_row(); 
                $numrows = count( get_sub_field( 'benefits' ) );
            ?>

            <div class="title full flex-center align-items">
                <h2 class="text-color-gold"><?php the_sub_field( 'card_headline' ); ?></h2>
            </div>
            <?php if(get_sub_field('card_subtitle')) : ?>
                <div class="subtitle full flex-center align-items">
                    <h2 class="text-color-white"><?php the_sub_field( 'card_subtitle' ); ?></h2>
                </div>
            <?php endif; ?>
            <?php if ( have_rows( 'benefits' ) ) : ?>
                <?php while ( have_rows( 'benefits' ) ) : the_row(); 
                     $index = get_row_index();
                ?>
                    <div class="flex-center align-items full benefit">
                        <div class="copy text-center">
                            <h2 class="text-color-white"><?php the_sub_field( 'benefit' ); ?></h2>
                        </div>
                        <?php if ( get_field( 'global_info_icon' ) ) : ?>
                            <div class="info-icon flex-center pops">
                                <img src="<?php the_field( 'global_info_icon' ); ?>" />
                                <div class="pop-box full copy mark"><p>Capital city founded by Hernán Cortés while searching for gold in the region</p></div>
                                <div class="full flex-center pop-container align-items">
                                    <div class="pop"><span class="hero-subtitle bold uppercase">x</span></div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                    <?php if($index != $numrows) : ?>
                    <div class="gold-bar bg-gold"></div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>



<!-- 
<div class="flex-center pins Veracruz-one">
    <div class="pin-box full copy mark"><p>Capital city founded by Hernán Cortés while searching for gold in the region</p></div>
    <div class="full flex-center pin-container align-items">
        <div class="pin pin-bg-blue"><span class="blue hero-subtitle bold uppercase">x</span></div>
    </div>
</div> -->