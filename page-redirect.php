<?php 
/*
Template Name: Redirect Template
*/

   $redirect_url = get_field('gnu_redirect_url');
   header( 'Location: '.$redirect_url.'' ) ;
?>