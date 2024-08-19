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
include 'global.css';
include 'join-the-society.css';
$GREASY_HAND_LOGO = get_field('greasy_hand_logo');
$INFO_ICON = get_field('global_info_icon');

get_header();

?>
<!-- Join The Society Page -->
<!-- Hero -->
<?php include 'components/global-section-hero.php' ?>
<!-- Card Section (Grease, Grit, Glory) -->
<?php include 'components/card-display.php' ?>

<style>

</style>

<?php
get_footer();


