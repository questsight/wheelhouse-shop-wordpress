<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product; 

foreach($product->category_ids as $cat){
  if(CFS()->get( get_term( $cat, 'product_cat' )->slug . '-collection' )){
    $basic_cat = $cat;
    break;
  }
}
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    
<?php if(!$product->is_type('booking')):?>
  <div class="product__gallery">
    <?php
    if($_GET['color']){
      foreach(CFS()->get( 'colors' ) as $key => $value ){
        if($value['color-name']==$_GET['color']){
          $fields = $value['gallery'];
          $materialColor = $value['materials'];
          $noName = $value['no-name'];
          break;
        }
      }
    }else{
        $app_id = get_post_meta($product->get_id(), 'v3d_app_id', true);
        if(empty($app_id) || empty(get_post($app_id))){
            $fields = CFS()->get( 'main-gallery' ); 
        }
    }
    if( !empty($fields) ):
    $itk = 0;
    foreach ( $fields as $key => $field ): if($itk==0): $itk++;?>
      <div class='product__first'>
        <img src="<?php echo $field['img-jpg']; ?>" class="magniflier">
        <img src="<?php echo $field['img-jpg']; ?>" class="product__change">
      </div>
      <div class='product__foto'>
      <?php endif;?>
      <img class="product__img" data-src="<?php echo $field['img-jpg']; ?>" src="<?php echo $field['img-min']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>" data-gallery="gallery">
    <?php endforeach;
      $schemes = CFS()->get( 'schemes' );
      if( ! empty($schemes) ):
      foreach ( $schemes as $scheme ):?>    
      <img class="product__img <?php if(!$scheme['selected']){echo "hidden";}?>" data-scheme="<?php echo $scheme['scheme-size']; ?>" data-src="<?php echo $scheme['scheme-img']; ?>" src="<?php echo $scheme['scheme-mini']; ?>">
        <?php endforeach; endif;?>
      </div>
      <?php elseif(!empty($app_id) && !empty(get_post($app_id))):?>
        <div class='product__first'><?php echo do_shortcode('[verge3d id="'.$app_id.'"]'); ?></div>
      <?php else:?>
    <div class='product__first'>
        <img<?php if(has_term( 'matrasy', 'product_cat' ) || has_term( 'namatrasniki', 'product_cat' )){echo ' class="magniflier"';}?> src="<?php the_post_thumbnail_url(); ?>">
      </div>
    <?php endif;?>
	</div>
    <div class="product__description">
        <h1 class="product__title"><?php 
            $titleProduct = "";
            if(CFS()->get( 'title' )){
                $titleProduct .= CFS()->get( 'title' );
            }else{
                $titleProduct .= get_the_title();
            }
            if($_GET['color']&&!$noName){
                $titleProduct .= ' '.$_GET['color'];
            }
        echo $titleProduct;?></h1>
      <div id="additional">
        <div id="additional-mattress" class="product__additional hidden"><span class="product__add">+ Матрас: </span><span class="product__add-item"></span><span class="product__delete" id="del-mattress">&times;</span></div>
        <div id="additional-namatrasniki" class="product__additional hidden"><span class="product__add">+ Наматрасник: </span><span class="product__add-item"></span><span class="product__delete" id="del-namatrasniki">&times;</span></div>
        <div id="additional-chehly-na-matras" class="product__additional hidden"><span class="product__add">+ Мебельный чехол на матрас: </span><span class="product__add-item"></span><span class="product__delete" id="del-chehly-na-matras">&times;</span></div>
        <div id="additional-pokryvala" class="product__additional hidden"><span class="product__add">+ Покрывало: </span><span class="product__add-item"></span><span class="product__delete" id="del-pokryvala">&times;</span></div>
        <div id="additional-podushki" class="product__additional hidden"><span class="product__add">+ Подушки: </span><span class="product__add-item"></span><span class="product__delete" id="del-podushki">&times;</span></div>
      </div>
	    <div class="summary entry-summary">
        <?php endif;?>
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
            <?php if(!$product->is_type('booking')):?>  
	    </div>  
    </div>
    <?php endif;?>
    <div class="product__popup cloth hidden">
        <div class="cloth__close">&times;</div>
            <form id='filter-cloth'>
                <input type="hidden" data-ids name="ids" value="<?php echo CFS()->get('ids');?>">
                <input type="hidden" data-item name="item" value="">
                <input type="hidden" name="product_cat" value="<? echo get_term( $basic_cat, 'product_cat' )->slug;?>">
                <?php $values = CFS()->get(get_term( $basic_cat, 'product_cat' )->slug.'-collection');
                    foreach ( $values as $key => $label ) {
                        echo '<input type="hidden" name="collection[]" value="'.$key.'">';
                }?>
            </form>
        <div class="listing hidden" id="result-cloth"></div>
    </div>
    <?php $categories = get_the_terms( $post->ID, 'product_cat' );
      $mattress = false;
      $aksessuary = false;
      $services = false;
      $nalichii = false;
      $all = false;
      foreach ($categories as $category) {
        if(strpos($category->slug,'all-')!== false){
          $all = $category->slug;
        }
        if($category->term_id == 23 || $category->term_id == 24){
          $mattress = true;
          break;
        }
        if(get_ancestors($category->term_id,'product_cat')[0] == 33){
          $aksessuary = true;
          break;
        }
        if($category->term_id == 170){
           $services = true;
          break;
        }
        if($category->term_id == 118){
           $nalichii = true;
          break;
        }
      }
  if($mattress && !CFS()->get( 'add-more' )):?>
    <form id='mattress-size'>
      <input type="hidden" name="mattress-size" value="">
      <input type="hidden" name="cloth-price" value="<?php if($_GET['attribute_pa_kategoriya-tkani']){echo $_GET['attribute_pa_kategoriya-tkani'];}?>">
    </form>
    <div class="product__popup mattress hidden">
        <div class="mattress__close">&times;</div>
        <div class="listing hidden" data-size="big" data-flip='flip' id="result-mattress"></div>
    </div>
   <?php endif;?>
   <?php $fields = CFS()->get( 'mattress' ); if(!empty($fields)):?>
    <form id='mattress-size'>
      <input type="hidden" name="mattress-size" value="">
      <?php foreach($fields as $value):?>
      <input type="hidden" name="mattress-fix[]" value="<?php echo $value;?>">
      <?php endforeach;?>
    </form>
    <div class="product__popup mattress hidden">
        <div class="mattress__close">&times;</div>
        <div class="listing hidden" data-size="big" id="result-mattress" style="width:100%;"></div>
    </div>
   <?php endif;?>
   <form id='product-colors'>
      <input type="hidden" name="product-ids" value="<?php the_ID(); ?>">
     <?php if($mattress):?>
      <input type="hidden" name="mattress-size" value="">
     <?php endif;?>
    </form>
    <div class="product__popup colors hidden">
        <div class="colors__close">&times;</div>
        <div class="listing hidden" data-size="big" id="result-colors" style="width:100%;"></div>
    </div>
    <?php if(!$aksessuary && !$services && $category->term_id != 118):?>
    <form id='product-pillar'>
      <?php
        $values = CFS()->get(get_term( $basic_cat, 'product_cat' )->slug.'-collection');
        foreach ( $values as $key => $label ) {
          echo '<input type="hidden" name="collection[]" value="'.$key.'">';
        }
      ?>
    </form>
    <div class="product__popup pillar hidden">
        <div class="pillar__close">&times;</div>
        <div class="listing hidden" data-size="big" id="result-pillar" style="width:100%;"></div>
    </div>
    <?php endif;?>
</div>
	    <?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	//do_action( 'woocommerce_after_single_product_summary' );
	?>
<?php do_action( 'woocommerce_after_single_product' ); ?>
<?php if(!$services):?>
<div class="text">
  <div class="product__sidebar-selection">
    <?php if($product->post->post_content||!$aksessuary):?>
    <div class="product__sidebar-option active" data-call="description">Описание</div>
    <?php endif;?>
    <?php $fields = CFS()->get( 'specifications' );
    if( ! empty($fields) ):?>
    <div class="product__sidebar-option" data-call="specifications">Технические характеристики</div>
    <?php endif;?>
    <?php $fields = CFS()->get( 'photogallery' );
    if( ! empty($fields) ): ?>
    <div class="product__sidebar-option" data-call="photogallery">Фотогалерея</div>
    <?php endif;?>
  </div>
  <div class="product__sidebar" data-type="description">
  <?php if($basic_cat==24):?>
    <p>Назначение: <a href="<?php echo get_page_link(57);?>/?purpose%5B%5D=home-children">HOME/для детской</a></p>
  <?php elseif($basic_cat==23):?>
    <p>Назначение: <a href="<?php echo get_page_link(57);?>/?purpose%5B%5D=home-bedroom">HOME/для спальни</a></p>
  <?php endif;
    if(!$nalichii&&!$aksessuary):
    $collectionTerm = get_term( $basic_cat, 'product_cat' )->slug.'-collection';
    $collectionKey = array_key_first (CFS()->get($collectionTerm));
    $collectionVal = CFS()->get($collectionTerm)[$collectionKey];
    ?>
    <p>Коллекция: <a href="<?php echo get_page_link(57);?>/?collection%5B%5D=<?php echo $collectionKey;?>" style="text-transform: uppercase;"><?php echo $collectionVal;?></a></p>
    <?php if(!$_GET['color'] || $_GET['color']&&!$noName):?>
    <p>Цвет: <?php
      if($_GET['color']){
        echo '<a href="'. get_page_link(57).get_term( $basic_cat, 'product_cat' )->slug.'/'.$all.'/?category='.$all.'&combination%5B%5D='.$_GET['color'].'">'.$_GET['color'].'</a>';
      }else{
        echo "вы можете выбрать любое сочетание материалов из нашей коллекции тканей.";
      }?>
      <?php endif;?>
    </p>
    <?php endif;?>
    <br>
    <div><?php echo $product->post->post_content; ?></div>
  </div>
  <div class="product__sidebar hidden" data-type="specifications">
    <?php $fields = CFS()->get( 'specifications' );
    if( ! empty($fields) ): 
    foreach ( $fields as $field ):?>
    
    <div class="product__specification">
      <div class="product__specification-name"><?php echo $field['specification-name']; ?></div>
      
      <?php if($field['specification-slug']):?>
      <div data-slug="<?php echo $field['specification-slug'];?>"><?php echo $field['specification-value']; ?></div>
      <?php elseif($field['specification-material']):?><div>
      <?php $materials=CFS()->get( 'materials' );
        $key=0;
        foreach ( $materials as $material ):
      ?>
      <div>
        <span style="text-transform: lowercase;">- <?php echo $material['material_name']?>: </span>
        <?php if($_GET['color']):?>
        <span data-slug="material<?php echo $key;?>" ><?php echo $materialColor[$key]['material']; ?></span>
        <?php elseif($nalichii):?>
        <span data-slug="material<?php echo $key;?>" ><?php echo CFS()->get( 'colors' )[0]['materials'][$key]['material']; ?></span>
        <?php else:?>
        <span data-slug="material<?php echo $key;?>" ><?php echo $field['specification-value']; ?></span>
        <?php endif;?>
      </div>
      <?php $key++; endforeach;?>
      </div>
      <?php else:?>
      <div><?php echo $field['specification-value']; ?></div>
      <?php endif;?>
      
    </div>
    
    <?php endforeach; endif;?>
  </div>
  <div class="product__sidebar hidden listing" data-type="photogallery">
  <?php $fields = CFS()->get( 'photogallery' );
    if( ! empty($fields) ): 
    foreach ( $fields as $field ):?>
    <div class="listing__item">
      <img class="listing__foto" src="<?php echo $field['photogallery-item']; ?>" loading="lazy" alt="<?php echo $titleProduct;?>">
    </div>
    <?php endforeach; endif;?>
  </div>
</div>
<?php endif;?>