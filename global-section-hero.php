<div class="hero-section flex-center align-items" <?php if($hero_content_toggle == 'Image') : ?> style="background-image: url(<?php echo $hero_image; ?>)" <?php else : ?> style="aspect-ratio: 16 / 9;)" <?php endif; ?>>
    <div class="opacity-screen"></div>
    <?php if( $hero_content_toggle == 'Video') : ?>
        <div class="video-container">
            <iframe
                src="https://player.vimeo.com/video/<?php echo $hero_video; ?>?autoplay=1&muted=1&controls=0&loop=1"
                class="video"
                allow="autoplay; encrypted-media"
                allowfullscreen
                title="Join The Society"
            ></iframe>
        </div>
    <?php endif; ?>
    <h2 class="header text-color-gold wild-river greasy-font">Join The Society</h2>
    <div class="full flex-center align-items">
        <a href="#join" title="" class="btn btn-color-white btn-style-default btn-style-rectangle btn-size-extra-large wd-open-popup ">SIGN UP</a>
    </div>
</div>