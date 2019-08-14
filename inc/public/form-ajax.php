<?php

class Ja_Form_Ajax {

    public function __construct() {
        $this->register_filter_query();
    }

    public function product_filter_query() {

        if( isset( $_POST['cat'] ) ) {
            $cat = $_POST['cat'];
        }

        if( isset( $_POST['tags'] ) ) {
            $tag = $_POST['tags'];
        }

        if( isset( $_POST['pagination'] ) ) {
            $paged = $_POST['pagination'];
        }

        $args = array(
            'post_type'     => 'product',
            'post_status'   => 'publish',
            'posts_per_page' => 6,
            'paged' => $paged
        );
        $tax_query = array('relation' => 'AND');
        if( !empty( $cat ) ) {
            $tax_query[] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $cat
            );
        }
        if( !empty( $tag ) ) {
            $tax_query[] = array(
                'taxonomy' => 'product_tag',
                'field' => 'slug',
                'terms' => $tag
            );
        }
       
        if( !empty( $cat ) || !empty( $tag ) ) {
            $args['tax_query'] = $tax_query;
        }

        $wp_query = new WP_Query( $args );
        if ( $wp_query->have_posts() ) {
            echo '<div class="woocommerce columns-3 ">';
            echo '<ul class="products columns-3">';
                while ( $wp_query->have_posts() ) {
                    $wp_query->the_post();
                    $headline = get_the_title();
                    $content =  wp_filter_nohtml_kses(get_the_content());
                    $content  = stripslashes( $content );
                    $content  = $this->ShortenText( $content, 120 );
                    $link =  get_permalink();
                    $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'full' ); 
                    include( plugin_dir_path( __FILE__ ) . 'template-result.php' );
                }
                wp_reset_postdata();
            echo '</ul>';
            echo '</div>';   
            echo"<div class='paginate-bg'>";
                $big = 999999999; // need an unlikely integer
                echo paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => $paged,
                'total' => $wp_query->max_num_pages,
                'prev_text' => __('Previous'),
                'next_text' => __('Next'),
                ) );    
            echo"</div>"; 
        }
        die();
    }

    public function ShortenText( $text, $chars_limit ) { 
        $chars_text = strlen($text);
        $text = $text." ";
        $text = substr($text,0,$chars_limit);
        $text = substr($text,0,strrpos($text,' '));
        if ( $chars_text > $chars_limit ) { 
            $text = $text."..."; 
        }
        return $text;
    }

    public function register_filter_query() {
        add_action( 'wp_ajax_wsfilter', array( $this, 'product_filter_query' ) ); 
        add_action( 'wp_ajax_nopriv_wsfilter', array( $this, 'product_filter_query' ) );
    }   
}


new Ja_Form_Ajax;