<!-- Join The Society -->
<!-- Card Section -->

<div class="card-section flex-center align-items">
    <div class="main-headline-container flex-left align-items">
        <!-- Greasy Hand Logo -->
        <div class="global-greasy-hand-logo">
            <?php if ( $GREASY_HAND_LOGO ) : ?>
                <img src="<?php echo $GREASY_HAND_LOGO; ?>" />
            <?php endif ?>
        </div>
        <h2 class="main-headline">| These are our Three Levels</h2>
    </div>
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
            benefitsArray[index].classList.remove('expanded')
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
var pastNode = null;

infoPopsArray.forEach((currentNode, index) => {
    currentNode.addEventListener("click", () => {
        console.log('hello')
    if (currentNode.classList.contains('expanded')) {
        pastNode = null;
        currentNode.classList.remove('expanded');
    }
    else{
        if(pastNode){
        pastNode.classList.remove('expanded');
        }
        currentNode.classList.add('expanded');
        pastNode = currentNode;
    }
    });
})
</script>