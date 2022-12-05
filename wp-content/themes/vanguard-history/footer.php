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

// Footer menus
 // Only show on pages / posts other than upload material - for building content before MVP launch
 if(! (is_page(12))){
   wp_nav_menu(
     array(
       'theme_location' => 'footer-1',
       'menu_id'        => 'footer-1-menu',
     )
   );
  ?>
  <div id="footer-menu-heading-container">
   <h2 class="footer-menu" id="other-vmapa-sites">Other VMAPA Sites</h2>
  </div>
  <?php
   wp_nav_menu(
     array(
       'theme_location' => 'footer-2',
       'menu_id'        => 'footer-2-menu',
     )
   );
  } // end if
?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
