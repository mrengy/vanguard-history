<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Vanguard_History
 */

 wp_nav_menu(
   array(
     'theme_location' => 'footer-1',
     'menu_id'        => 'footer-1-menu',
   )
 );
?>
<div id="footer-menu-heading-container">
 <h2 class="footer-menu">Other VMAPA Sites</h2>
</div>
<?php
 wp_nav_menu(
   array(
     'theme_location' => 'footer-2',
     'menu_id'        => 'footer-2-menu',
   )
 );

?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
