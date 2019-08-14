<?php
class Ja_Custom_Shortcode {

  public function __construct() {
    $this->register_shortcodes();
  }

  public function product_filter_tags_cats( $atts ) {
    $atts = shortcode_atts(
      array(
        'category_heading_label' => 'Product Option',
        'tag_heading_label' => 'Product Tag',
        'per_page' => 5,
      ), 

    $atts, 'product_filter_tags_cats' );

    $category_heading_label = $atts['category_heading_label'];
    $tag_heading_label = $atts['tag_heading_label'];

    ob_start();
       $tags = get_terms( 'product_tag' );
       $cats = get_terms( 'product_cat', $catargs );
        echo '<form id="filterform" action="/wp-admin/admin-ajax.php" method="POST" class="ja-product-form">';
        echo '<input type="hidden" name="action" value="wsfilter">';
        echo '<input type="hidden" name="pagination" value="1" id="pagival">';
        echo '<div class="field-row">';
          echo '<h3>'.$tag_heading_label.'</h3>';
          foreach ( $tags as $tag ) {
            echo '<label><input type="checkbox" name="tags[]" id="tagsfield" class="filter-field" value="'.$tag->slug.'">'.$tag->name.'</label>';
          }
        echo '</div>';
        echo '<div class="field-row">';
          echo '<h3>'.$category_heading_label.'</h3>';  
          foreach ( $cats as $cat ) {
            echo '<label><input type="checkbox" name="cat[]" id="catsfield" class="filter-field" value="'.$cat->slug.'">'.$cat->name.'</label>';
          }
        echo '</div>';          
        echo '</form>';
    return ob_get_clean();
  }

  
  public function product_filter_results( $atts ) {
    ob_start();
      echo '<div class="loader2"></div>';
      echo '<div id="result" class="ja-product-result"></div>';
    return ob_get_clean();
  }

  public function register_shortcodes() {
    add_shortcode( 'product_filter_results', array( $this, 'product_filter_results' ) );
    add_shortcode( 'product_filter_tags', array( $this, 'product_filter_tags_cats' ) );
  }

}

new Ja_Custom_Shortcode;
?>