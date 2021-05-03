<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
$category = $_GET['category'];
query_posts('post_type=product&product_cat='.$category.'&posts_per_page=-1');

if(strpos(get_queried_object()->slug,'konfigurator')== false && !is_product_category('H') && !is_product_category('services') && !get_term( get_queried_object()->parent )->slug == 'aksessuary'):
  foreach(get_terms( 'product_cat', array( 'search' => $category ) ) as $vcat){
    if(strpos($vcat->slug,'konfigurator')!== false){
      $cat_id = $vcat->term_id;
      break;
    }
  }
  $thumbnail_id=get_woocommerce_term_meta( $cat_id, 'thumbnail_id', true );?>
  <a href="<?php echo esc_url( get_term_link( $category, 'product_cat' ) ).'konfigurator-'.$category;?>" class="listing__item" data-konfigurator="konfigurator-<?php echo $category;?>"><img src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>" class="listing__foto"></a>
<?php endif;

$products = go_filter_shop();
if ( $products ) :
  if(strpos(get_queried_object()->slug,'konfigurator')!== false || get_queried_object()->slug == 'v-nalichii' || get_queried_object()->slug == 'services' || get_term( get_queried_object()->parent )->slug == 'aksessuary'){
    foreach( $products as $post ){
      setup_postdata($post);
      wc_get_template_part( 'content', 'product' );
    }
  }elseif(!$_GET['orderby'] || $_GET['orderby']=='none'){
    foreach( $products as $post ){
      setup_postdata($post);
      $colors = CFS()->get( 'colors');
      foreach(get_the_terms( $post->ID, 'product_cat' ) as $cat){
        if($cat->name == "????????????"){
          $del = '/'.$cat->slug.'/';
          break;
        }
      }
      if(!empty($colors)){
        foreach ( $colors as $key => $value ): ?>
          <a href="<?php echo str_replace($del,'/',get_permalink()); echo"?color=".$value['color-name']."&attribute_pa_kategoriya-tkani=kategoriya-".array_key_first(CFS()->get( 'price', $value['material-price'][0]));?>" class="listing__item"><img src="<?php echo $value['gallery'][0]['img-jpg'];?>" class="listing__foto"><div class="listing__title woocommerce-loop-product__title"><?php the_title(); echo " ".$value['color-name']?></div><span class="listing__price"><?php echo priceColor(CFS()->get( 'price', $value['material-price'][0]),get_the_ID()); ?></span></a>
        <?php endforeach;
      } 
    }
  }else{
    $filterProducts = array();
    foreach( $products as $post ){
      setup_postdata($post);
      $colors = CFS()->get( 'colors');
      foreach(get_the_terms( $post->ID, 'product_cat' ) as $cat){
        if($cat->name == "????????????"){
          $del = '/'.$cat->slug.'/';
          break;
        }
      }
      if(!empty($colors)){
        foreach ( $colors as $key => $value ){
          $item = array(
			    'link' => str_replace($del,'/',get_permalink())."?color=".$value['color-name']."&attribute_pa_kategoriya-tkani=kategoriya-".array_key_first(CFS()->get( 'price', $value['material-price'][0])), 
			    'price' => priceColor(CFS()->get( 'price', $value['material-price'][0]),get_the_ID()),
          'img' => $value['gallery'][0]['img-jpg'],
          'name' => $product->name ." " . $value['color-name'],
		    );
         $filterProducts[] = $item;
        }
      } 
    }
    if($_GET['orderby']=='priced'){
      usort($filterProducts, function($a,$b){
        return ($b['price']-$a['price']);
      }); 
    }else{
      usort($filterProducts, function($a,$b){
        return ($a['price']-$b['price']);
      }); 
    }
    foreach ( $filterProducts as $key => $filterProduct ): ?>
      <a href="<?php echo $filterProduct['link'];?>" class="listing__item"><img src="<?php echo $filterProduct['img'];?>" class="listing__foto"><div class="listing__title woocommerce-loop-product__title"><?php echo $filterProduct['name'];?></div><span class="listing__price"><?php echo $filterProduct['price'];?></span></a>
    <?php endforeach; 
  }
else: do_action( 'woocommerce_no_products_found' );
endif; ?>