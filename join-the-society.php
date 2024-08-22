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
$hero_image = $hero_settings['image'];
$hero_video = $hero_settings['video'];

get_header();

?>
<!-- Join The Society Page -->
<!-- Hero -->
<?php include 'components/global-section-hero.php' ?>
<!-- <?php get_template_part('components/global', 'section', 'hero'); ?> -->
<!-- Card Section (Grease, Grit, Glory) -->
<!-- <?php include 'components/card-display.php' ?> -->
<?php get_template_part('components/card', 'display'); ?>

<?php
get_footer();


