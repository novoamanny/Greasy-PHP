<div class="hero-section flex-center align-items" <?php if($hero_content_toggle == 'Image') : ?> style="background-image: url(<?php echo $hero_image; ?>)" <?php endif; ?>>
    <div class="opacity-screen"></div>
    <?php if( $hero_content_toggle == 'Video') : ?>
        <iframe
            src="https://player.vimeo.com/video/<?php echo $hero_video; ?>?autoplay=1&muted=1&controls=0&loop=1"
            class="video"
            allow="autoplay; encrypted-media"
            allowfullscreen
            title="Join The Society"
            width="100%"
            height="100%"
          ></iframe>
    <?php endif; ?>
    <h2 class="header text-color-gold wild-river greasy-font">Join The Society</h2>
</div>