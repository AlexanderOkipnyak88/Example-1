<?php

/*
 * Vacancies post type
 */

    function create_clients_post_type() {  
        register_post_type( 'vacancy',  
            array(  
                'labels' => array(  
                    'name' => __( 'Jobs' ),  
                    'singular_name' => __( 'Job' )  
                ),  
            'public' => true, 
            'sort' => true,
            'rewrite' => array( 'slug' => 'jobs',  'with_front' => false),
            'menu_position' => 5,             
            'capability_type' => 'page', 
            'show_in_rest' => true,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields')
            )  
        );  
    }  
	
	/*
	 * Add post type
	 */
	
    add_action( 'init', 'create_clients_post_type' ); 

?>