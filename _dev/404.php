<?php
/**
 * @package  WordPress
 * @subpackage  Preach
 * @since   Preach 0.1
 */

$data = Timber::get_context();
Timber::render( '404.twig', $data );
