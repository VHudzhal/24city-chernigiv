<?php

bizov_input(array(
    'label'     => __('Price Min', 'bizov'),
    'id'        => 'price_min',
    'type'      => 'number',
    'required'  => 1
));

bizov_input(array(
    'label'     => __('Price Max', 'bizov'),
    'id'        => 'price_max',
    'type'      => 'number',
    'required'  => 1
));

bizov_input(array(
    'label'     => __('Image', 'bizov'),
    'id'        => 'image',
    'type'      => 'image',
    'multiple'  => 0,
    'required'  => 0
));

bizov_input(array(
    'label'     => __('Category', 'bizov'),
    'id'        => 'franchises-categories',
    'type'      => 'select',
    'options'   => get_terms(array( 'taxonomy' => 'franchises_categories', 'hide_empty' => 0 )),
    'value'     => wp_get_post_terms($post->ID, 'franchises_categories', array( 'fields' => 'ids' ))[0],
    'required'  => 0
));
//print_r(wp_get_post_terms( $post->ID, 'category', array( 'fields' => 'ids' ) ));
bizov_input(array(
    'label'     => __('Franchise Owner', 'bizov'),
    'id'        => 'franchise_owner',
    'type'      => 'select',
    'value'     => get_post_meta($post->ID, 'franchise_owner', 1),
    'optgroup'  => array(
        array(
            'label'     => __('Author', 'bizov'),
            'options'   => get_users(array( 'role' => 'author' ))
        ),
        array(
            'label'     => __('Administrator', 'bizov'),
            'options'   => get_users(array( 'role' => 'administrator' ))
        ),
        array(
            'label'     => __('Contributor', 'bizov'),
            'options'   => get_users(array( 'role' => 'contributor' ))
        ),
    ),
    'required'  => 0
));

bizov_input(array(
    'label'     => __('Slider', 'bizov'),
    'id'        => 'slider',
    'type'      => 'image',
    'multiple'  => 1,
    'required'  => 0
));
