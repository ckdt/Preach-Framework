<?php
/**
 * @package  WordPress
 * @subpackage  Preach
 * @since   Preach 1.1.0
 */

$data = Timber::get_context();
Timber::render( '404.twig', $data );
