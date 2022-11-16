<?php 

/**
 * Plugin Name:       Related Post
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Tusher Ikbal
 * Author URI:        https://tusherikbal.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       tusher_plugin
 * Domain Path:       /languages
 */

// assets enque


add_action('wp_enqueue_scripts', function(){

    wp_enqueue_style('mainmain', plugins_url('css/style.css', __FILE__));


});




//related post function



function related_post_output($default){

    //related post jate single post a show hoy sei jnno if is_single condition use kora

    if(is_single()){


        $category = get_the_terms(get_the_id(), 'category');

        $categor_in =array();

        $default .= "<hr><h3> Releted post: </h3>";
       
       foreach($category as $term){
        $categor_in[] = $term -> term_id;
       }

        $releated_post = new WP_Query(array(
            'post_type' => 'post',
            'category__in' => $categor_in,
            'post__not_in' => array(
                get_the_id()
            )
        ));
       
        while ($releated_post->have_posts()): $releated_post-> the_post();
            
        
        $default .= "<ul>";
        $default .= '<li class="titlesss" >'.get_the_title(); '</li>';
        $default .= "</ul>";
    
        endwhile;
        return $default;


        // <a href="https://www.w3schools.com" > Visit W3Schools.com! </a>

   
}


    



}

add_filter('the_content', 'related_post_output');