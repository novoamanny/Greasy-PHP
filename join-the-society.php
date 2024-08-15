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
get_header();

?>
<!-- Join The Society Page -->
<div id="JTS" class="JTS">
    <!-- Hero -->
    <?php include 'components/global-section-hero.php' ?>

    <?php include 'components/card-display.php' ?>

</div>


<style>

</style>

<?php
get_footer();


