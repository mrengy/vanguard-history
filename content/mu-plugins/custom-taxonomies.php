<?php
/*
* Plugin Name: Vanguard History Taxonomies
* Description: Adds custom taxonomies used for this site
* Version: 1.0
* Author: Mike Eng
* Author URI: https://mike-eng.com
*/

function register_taxonomy_ensemble() {
     $labels = array(
         'name'              => _x( 'Ensembles', 'taxonomy general name' ),
         'singular_name'     => _x( 'Ensemble', 'taxonomy singular name' ),
         'search_items'      => __( 'Search Ensembles' ),
         'all_items'         => __( 'All Ensembles' ),
         'parent_item'       => __( 'Parent Ensemble' ),
         'parent_item_colon' => __( 'Parent Ensemble:' ),
         'edit_item'         => __( 'Edit Ensemble' ),
         'update_item'       => __( 'Update Ensemble' ),
         'add_new_item'      => __( 'Add New Ensemble' ),
         'new_item_name'     => __( 'New Ensemble Name' ),
         'menu_name'         => __( 'Ensemble' ),
     );
     $args   = array(
         'hierarchical'      => false, // make it hierarchical (like categories)
         'labels'            => $labels,
         'show_ui'           => true,
         'show_admin_column' => true,
         'query_var'         => true,
         'rewrite'           => [ 'slug' => 'ensemble' ],
     );
     register_taxonomy( 'ensemble', array( 'page','attachment', 'year-story' ), $args );
}
function register_taxonomy_vhs_year() {
     $labels = array(
         'name'              => _x( 'Years', 'taxonomy general name' ),
         'singular_name'     => _x( 'Year', 'taxonomy singular name' ),
         'search_items'      => __( 'Search Years' ),
         'all_items'         => __( 'All Years' ),
         'parent_item'       => __( 'Parent Year' ),
         'parent_item_colon' => __( 'Parent Year:' ),
         'edit_item'         => __( 'Edit Year' ),
         'update_item'       => __( 'Update Year' ),
         'add_new_item'      => __( 'Add New Year' ),
         'new_item_name'     => __( 'New Year Name' ),
         'menu_name'         => __( 'Year' ),
     );
     $args   = array(
         'hierarchical'      => false, // make it hierarchical (like categories)
         'labels'            => $labels,
         'show_ui'           => true,
         'show_admin_column' => true,
         'query_var'         => true,
         'rewrite'           => [ 'slug' => 'vhs_year' ],
     );
     register_taxonomy( 'vhs_year', array( 'page','attachment', 'year-story' ), $args );
}
add_action( 'init', 'register_taxonomy_ensemble' );
add_action( 'init', 'register_taxonomy_vhs_year' );
?>
