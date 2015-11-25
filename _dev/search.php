<?php
/**
 * @package  WordPress
 * @subpackage  Preach
 * @since   Preach 1.1.0
 */

$templates = array( 'search.twig', 'archive.twig', 'index.twig' );
$data = Timber::get_context();

$data['title'] = 'Search results for '. get_search_query();
$data['posts'] = Timber::get_posts();

Timber::render( $templates, $data );
