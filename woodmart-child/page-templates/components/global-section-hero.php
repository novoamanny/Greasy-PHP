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
    <div class="full flex-center align-items">
        <h2 class="header text-color-gold wild-river greasy-font"><?php echo $hero_headline; ?></h2>
        <?php if($hero_headline == 'Join the Society') : ?>
            <div class="flex-center full">
                <button type="button" class="btn btn-primary btn-color-white btn-style-default btn-style-rectangle btn-size-extra-large wd-open-popup" data-bs-toggle="modal" data-bs-target="#gravityform" style="padding: 5px 40px;">
                  Sign Up
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>


<script>
/* Need to make global style for hero sections! */
.page-template-join-the-society .header,
.page-template-welcome-to-the-society .header{
    font-size: 7.5em;
    position: relative;
    z-index: 5;
}
</script>