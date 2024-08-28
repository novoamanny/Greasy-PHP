<?php
/**
 * Template Name: Join The Society ACF
 */
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

$GREASY_HAND_LOGO = get_field('greasy_hand_logo');
$INFO_ICON = get_field('global_info_icon');
$card_index = 0;

$hero_settings = get_field('hero_settings');
$hero_content_toggle = $hero_settings['content_toggle'];
$hero_headline = $hero_settings['headline'];
$hero_image = $hero_settings['image'];
$hero_video = $hero_settings['video'];

get_header();

?>
<!-- Join The Society Page -->
<!-- Hero -->
<?php include 'components/global-section-hero.php' ?>

<!-- Card Section (Grease, Grit, Glory) -->
<?php include 'components/card-display.php' ?>
<!-- Join The Society -->
<!-- Modal -->
<div class="modal fade" id="gravityform" tabindex="-1" aria-labelledby="gravityform" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-black">
      
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      
      <div class="modal-body">
        <?php echo do_shortcode('[gravityform id="18" title=“false” description=“false” ajax="true" tabindex=“-1” field_values=“check=First Choice,Second Choice”]') ?>
      </div>
    </div>
  </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
get_footer();


