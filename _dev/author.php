<?php
/**
 * @package  WordPress
 * @subpackage  Preach
 * @since   Preach 1.1.0
 */

global $wp_query;

$data = Timber::get_context();
$data['posts'] = Timber::get_posts();
if ( isset( $wp_query->query_vars['author'] ) ) {
	$author = new TimberUser( $wp_query->query_vars['author'] );
	$data['author'] = $author;
	$data['title'] = 'Author Archives: ' . $author->name();
}
Timber::render( array( 'author.twig', 'archive.twig' ), $data );
