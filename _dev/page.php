<?php
/**
 * @package  WordPress
 * @subpackage  Preach
 * @since   Preach 1.1.0
 */

$data = Timber::get_context();
$post = new TimberPost();
$data['post'] = $post;
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page.twig' ), $data );