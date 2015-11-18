<?php
/**
 * @package  WordPress
 * @subpackage  Preach
 * @since   Preach 0.1
 */

$data = Timber::get_context();
$post = Timber::query_post();
$data['post'] = $post;
$data['comment_form'] = TimberHelper::get_comment_form();

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $data );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $data );
}