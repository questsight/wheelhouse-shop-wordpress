<?php require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
$category = $_GET['category'];
query_posts('post_type=product&product_cat='.$category.'&posts_per_page=-1');
if(strpos($_GET['category'],'konfigurator')=== false&&strpos($_GET['category'],'all-')=== false&&get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug!='aksessuary'):
  foreach(get_terms( 'product_cat', array( 'search' => $category ) ) as $vcat){
    if(strpos($vcat->slug,'konfigurator')!== false){
      $cat_id = $vcat->term_id;
      break;
    }
  }
  $thumbnail_id=get_woocommerce_term_meta( $cat_id, 'thumbnail_id', true );?>
  <a href="<?php echo esc_url( get_term_link( $category, 'product_cat' ) ).'konfigurator-'.$category;?>" class="listing__item" data-konfigurator="konfigurator-<?php echo get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug;?>"><img src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>" class="listing__foto"></a>
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
      /*$product_addons = WC_Product_Addons_Helper::get_product_addons( $post->ID, $prefix );
      if($_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-mehanizm'] &&  $_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-mehanizm'][0]!='none'){
          foreach($product_addons as $addons){
            if(strpos($addons['field_name'],'vybrat-mehanizm') !== false){
              foreach($addons as $addon){
                if(is_array($addon)){
                  print_r($addon);
                  echo "<br><br>"; 
                  break;
                }
              }
              break;
            }
          }
        }
        
        
    print_r(WC_Product_Addons_Helper::get_product_addons( $post->ID, $prefix ));*/
      setup_postdata($post);
      $colors = CFS()->get( 'colors');
      foreach(get_the_terms( $post->ID, 'product_cat' ) as $cat){
        if($cat->name == "Конфигуратор"){
          $del = '/'.$cat->slug.'/';
          break;
        }
      }
      if(!empty($colors)){
        foreach ( $colors as $key => $value ): if(!$_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'] || $_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'][0]=='false' || array_key_exists($_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'][0], $value['marker'])){?>
          <a href="<?php echo str_replace($del,'/',get_permalink()); echo"?color=".$value['color-name']."&attribute_pa_kategoriya-tkani=kategoriya-".array_key_first(CFS()->get( 'price', $value['material-price'][0]));if($_GET['detskie-krovati-size']){echo "&attribute_pa_size-krd=".$_GET['detskie-krovati-size'][0];}if($_GET['krovati-size']){echo "&attribute_pa_size-krd=".$_GET['krovati-size'][0];}?>" class="listing__item"><img src="<?php echo $value['gallery'][0]['img-jpg'];?>" class="listing__foto"><div class="listing__title woocommerce-loop-product__title"><?php the_title(); if(!$value['no-name']){echo " ".$value['color-name'];}?></div><span class="listing__price"><?php echo number_format(priceColor(CFS()->get( 'price', $value['material-price'][0]),get_the_ID()), 0, ',', ' ').' ₽'; ?></span></a>
        <?php }endforeach;
      } 
    }
  }else{
    $filterProducts = array();
    foreach( $products as $post ){
      setup_postdata($post);
      $colors = CFS()->get( 'colors');
      foreach(get_the_terms( $post->ID, 'product_cat' ) as $cat){
        if($cat->name == "Конфигуратор"){
          $del = '/'.$cat->slug.'/';
          break;
        }
      }
      if(!empty($colors)){
        foreach ( $colors as $key => $value ){
          if(!$_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'] || $_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'][0]=='false' || array_key_exists($_GET[get_term( get_term_by( 'slug', $_GET['category'], 'product_cat')->parent )->slug.'-marker'][0], $value['marker'])){
              
              if($_GET['detskie-krovati-size']){
                $sizePar = "&attribute_pa_size-krd=".$_GET['detskie-krovati-size'][0];
              }else if($_GET['krovati-size']){
                $sizePar = "&attribute_pa_size-krd=".$_GET['krovati-size'][0];
              }else{
                $sizePar = "";  
              }
           if(!$value['no-name']){
                $nameC = get_the_title($post->ID) ." " . $value['color-name'];
              }else{
                $nameC = get_the_title($post->ID);
              }
           $item = array(
			 'link' => str_replace($del,'/',get_permalink())."?color=".$value['color-name']."&attribute_pa_kategoriya-tkani=kategoriya-".array_key_first(CFS()->get( 'price', $value['material-price'][0])).$sizePar, 
			 'price' => priceColor(CFS()->get( 'price', $value['material-price'][0]),get_the_ID()),
             'img' => $value['gallery'][0]['img-jpg'],
             'name' => $nameC,
		    );
            $filterProducts[] = $item;
          }
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
      <a href="<?php echo $filterProduct['link'];?>" class="listing__item"><img src="<?php echo $filterProduct['img'];?>" class="listing__foto"><div class="listing__title woocommerce-loop-product__title"><?php echo $filterProduct['name'];?></div><span class="listing__price"><?php echo number_format($filterProduct['price'], 0, ',', ' ').' ₽';?></span></a>
    <?php endforeach; 
  }
else: do_action( 'woocommerce_no_products_found' );
endif; ?>