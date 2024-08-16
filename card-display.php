<!-- Join The Society -->
<!-- Card Section -->

<div class="card-section flex-center align-items">
    <div class="main-headline-container flex-left align-items">
        <h2 class="main-headline">| These are our Three Levels</h2>
    </div>
    <div class="full flex-center align-items-start">
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
</div>