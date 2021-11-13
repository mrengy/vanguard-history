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
add_action( 'init', 'register_taxonomy_ensemble' );
?>
