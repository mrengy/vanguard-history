<?php
# enable automatic updates even if a VCS folder (.git, .hg, .svn etc) was found in the WordPress directory or any of its parent directories
# from https://wordpress.org/support/article/configuring-automatic-background-updates/#core-updates-via-filter

add_filter( 'automatic_updates_is_vcs_checkout', '__return_false', 1 );
?>
