<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $query_string;
$cat = $_GET['product_cat'];
query_posts($query_string.'post_type=product&product_cat='.$cat.'&posts_per_page=-1');
if ($_REQUEST && !empty($_REQUEST)) {
go_filter();
}
if ( have_posts() ) : while ( have_posts() ) : the_post();
do_action( 'woocommerce_shop_loop' );
wc_get_template_part( 'content', 'product' );
endwhile; 
else: do_action( 'woocommerce_no_products_found' );
endif; ?>