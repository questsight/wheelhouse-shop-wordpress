<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
$category = $_GET['category'];
query_posts('post_type=product&product_cat='.$category.'&posts_per_page=-1');
$products = go_filter_shop();
if ( $products ) :
		foreach( $products as $post ): setup_postdata($post);
do_action( 'woocommerce_shop_loop' );
wc_get_template_part( 'content', 'product' );
endforeach; 
else: do_action( 'woocommerce_no_products_found' );
endif; ?>