<?php  
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 4,
        'product_cat'    => 'podushki,pokryvala',
        'orderby'        => 'rand'
    );

    $loop = new WP_Query( $args );
    woocommerce_product_loop_start(); echo '<div class="product__subtitle">С этим товаром покупают:</div>';
    while ( $loop->have_posts() ) : $loop->the_post();
        global $product;
        wc_get_template_part( 'content', 'product' );
    endwhile;
    woocommerce_product_loop_end(); 
    wp_reset_query();
?>