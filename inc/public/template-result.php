<li class="entry product ">
	<a href="<?php echo $link; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link" style="height: 405px;"><img width="300" height="300" src="<?php echo $featured_image; ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" ><h2 class="woocommerce-loop-product__title"><?php echo $headline; ?></h2>
<p><?php echo $content; ?></p></a>
<?php if( class_exists( 'YITH_Woocompare' ) ) { ?>
	<a href="?action=yith-woocompare-add-product&amp;id=<?php echo get_the_ID(); ?>" class="compare  button" data-product_id="<?php echo get_the_ID(); ?>" rel="nofollow">Compare this Product</a>
<?php } ?>
</li>