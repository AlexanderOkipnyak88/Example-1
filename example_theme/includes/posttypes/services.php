<?php

/*
 * Services post type
 */

    function create_service_post_type() {  
        register_post_type( 'service',  
            array(  
                'labels' => array(  
                    'name' => __( 'Leistungen' ),  
                    'singular_name' => __( 'Leistungen' )  
                ),  
            'public' => true, 
            'sort' => true,
            'rewrite' => array( 'slug' => 'leistung',  'with_front' => false),
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
	
    add_action( 'init', 'create_service_post_type' ); 

    add_action( 'init', 'create_service_category_taxonomy', 0 );
  
    //create a custom taxonomy name it subjects for your posts
    
    function create_service_category_taxonomy() {
    
        // Add new taxonomy, make it hierarchical like categories
        //first do the translations part for GUI
        
        $labels = array(
            'name' => _x( 'Categories', 'taxonomy general name' ),
            'singular_name' => _x( 'Category', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Categories' ),
            'all_items' => __( 'All Categories' ),
            'parent_item' => __( 'Parent Category' ),
            'parent_item_colon' => __( 'Parent Category:' ),
            'edit_item' => __( 'Edit Category' ), 
            'update_item' => __( 'Update Category' ),
            'add_new_item' => __( 'Add New Category' ),
            'new_item_name' => __( 'New Subject Category' ),
            'menu_name' => __( 'Categories' ),
        );    
        
        // Now register the taxonomy
        register_taxonomy('service_category',array('service'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_in_rest' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'service_category' ),
        ));
    
    }

?>