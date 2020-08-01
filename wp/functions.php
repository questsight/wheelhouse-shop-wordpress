<?php

show_admin_bar( false );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'excerpt_more', function( $more ) {
  return '...';
});

if ( ! function_exists( 'questsight_setup' ) ) :
	function questsight_setup() {
		load_theme_textdomain( 'questsight', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'header' => esc_html__( 'Header Menu', 'questsight' ),
		) );
    register_nav_menus( array(
			'footer-left' => esc_html__( 'Footer Left Menu', 'questsight' ),
		) );
    register_nav_menus( array(
			'footer-center' => esc_html__( 'Footer Center Menu', 'questsight' ),
		) );
    register_nav_menus( array(
			'footer-right' => esc_html__( 'Footer Right Menu', 'questsight' ),
		) );
    register_nav_menus( array(
			'footer-mobile' => esc_html__( 'Footer Mobile Menu', 'questsight' ),
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-background', apply_filters( 'questsight_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'custom-logo', array(
			'height'      => 30,
			'width'       => 30,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'questsight_setup' );

function questsight_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'questsight_content_width', 640 );
}
add_action( 'after_setup_theme', 'questsight_content_width', 0 );


function questsight_scripts() {
	wp_enqueue_style( 'questsight-style', get_stylesheet_uri() );
  wp_enqueue_style('font-awesome-css', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), null, false);
  wp_enqueue_script( 'jquery' );
  wp_enqueue_style('questsight-common-css', get_template_directory_uri() . '/assets/css/common.min.css', array(), null, false);
  wp_enqueue_script( 'jquery' );
  wp_enqueue_script('questsight-common-js', get_template_directory_uri() . '/assets/js/common.min.js', array( 'jquery' ), null, true);
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'questsight_scripts' );
add_filter('style_loader_tag', 'myplugin_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'myplugin_remove_type_attr', 10, 2);

function myplugin_remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}
//Изображения в формате webp
function webp_upload_mimes( $existing_mimes ) {
    // add webp to the list of mime types
    $existing_mimes['webp'] = 'image/webp';

    // return the array back to the function with our added mime type
    return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );

//Дополнительные поля в настройках
add_action('customize_register', function($customizer){
  $customizer->add_section(
    'example_section_one',
    array(
      'title' => 'Контакты',
      'description' => 'Контакты',
      'priority' => 11,
    )
  );
  $customizer->add_setting(
    'example_phone',
    array('default' => '')
  );
  $customizer->add_control(
    'example_phone',
    array(
      'label' => 'Телефон',
      'section' => 'example_section_one',
      'type' => 'text',
    )
  );
  $customizer->add_setting(
    'example_time',
    array('default' => '')
  );
  $customizer->add_control(
    'example_time',
    array(
      'label' => 'Время работы',
      'section' => 'example_section_one',
      'type' => 'text',
    )
  );
});
//Фильтр
function go_filter() { 
  $args = array();
  $args['meta_query'] = array('relation' => 'AND');
  global $wp_query;
  foreach ($_GET as $key => $value) {
    $type = array('relation' => 'OR');
    if($key != 'cat' && $key != 'v' && $key != 'product_cat' && $key != 'customize_changeset_uuid'  && $key != 'customize_theme' && $key != 'customize_messenger_channel'){
        foreach($value as $val){
            $type[] = array(
			    'key' => $key, 
			    'value' => $val,
          'type' => 'text',
          'compare' => 'LIKE'
		    );
        }
    }
    $args['meta_query'][] = $type;
  }
  query_posts(array_merge($args,$wp_query->query));
}
function go_filter_shop() { 
  $args = array();
  $args['meta_query'] = array('relation' => 'OR');
  global $wp_query;
  foreach ($_GET as $key => $value) {
    $type = array('relation' => 'OR');
    if($key != 'cat' && $key != 'v' && $key != 'product_cat'){
        foreach($value as $val){
            $type[] = array(
			    'key' => $key,
			    'compare_key' => 'LIKE',
			    'value' => $val,
          'type' => 'text',
          'compare' => 'IN'
		    );
        }
    }
    $args['meta_query'][] = $type;
  }
  query_posts(array_merge($args,$wp_query->query));
}

function checkbox($name,$value) {
  if($_REQUEST[$name] && in_array($value,$_REQUEST[$name])){
    echo "checked";
  }
}

//Изображения к рубрике
add_action( 'category_edit_form_fields', 'mayak_update_category_image' , 10, 2 ); 
function mayak_update_category_image ( $term, $taxonomy ) { 
?>
   <style>
   img{border:3px solid #ccc;}
   .term-group-wrap p{float:left;}
   .term-group-wrap input{font-size:18px;font-weight:bold;width:40px;}
   #bitton_images{font-size:18px;}
   #bitton_images_remove{font-size:18px;margin:5px 5px 0 0;}
   </style>
   <tr class="form-field term-group-wrap">
     <th scope="row">
       <label for="id-cat-images">Изображение</label>
     </th>
     <td>
	   <p><input type="button" class="button bitton_images" id="bitton_images" name="bitton_images" value="+" /></br>
	   <input type="button" class="button bitton_images_remove" id="bitton_images_remove" name="bitton_images_remove" value="&ndash;" /></p>
       <?php $id_images = get_term_meta ( $term -> term_id, 'id-cat-images', true ); ?>
       <input type="hidden" id="id-cat-images" name="id-cat-images" value="<?php echo $id_images; ?>">
       <div id="cat-image-miniature">
         <?php if (empty($id_images )) { ?>
		 <img src="https://wheelhousedesign.ru/wp-content/uploads/2020/05/wp.png" alt="Zaglushka" width="84" height="89"/>
		 <?php } else {?>
           <?php echo wp_get_attachment_image ( $id_images, 'thumbnail' ); ?>
         <?php } ?>
       </div>
     </td>
   </tr>
<?php
}
if(preg_match("#tag_ID=([0-9.]+)#", $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']))
add_action( 'admin_footer', 'mayak_loader'  );
function mayak_loader() { ?>
   <script>
     jQuery(document).ready( function($) {
       function mayak_image_upload(button_class) {
         var mm = true,
         _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var mb = '#'+$(this).attr('id');
           var mt = $(mb);
           mm = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if (mm) {
               $('#id-cat-images').val(attachment.id);
               $('#cat-image-miniature').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $('#cat-image-miniature . custom_media_image') . attr('src',attachment.sizes.thumbnail.url) . css('display','block');
             } else {
               return _orig_send_attachment.apply( mb, [props, attachment] );
             }
            }
         wp.media.editor.open(mt);
         return false;
       });
     }
     mayak_image_upload('.bitton_images.button'); 
     $('body') .on('click',' .bitton_images_remove',function(){
       $('#id-cat-images').val('');
       $('#cat-image-miniature').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
     });
     $(document).ajaxComplete(function(event, xhr, settings) {
       var mk = settings.data.split('&');
       if( $.inArray('action=add-tag', mk) !== -1 ){
         var mh = xhr.responseXML;
         $mr = $(mh).find('term_id').text();
         if($mr!=""){
           $('#cat-image-miniature').html('');
         }
       }
     });
   });
</script>
<?php }
add_action( 'edited_category','mayak_updated_category_image' , 10, 2 );
function mayak_updated_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['id-cat-images'] ) && '' !== $_POST['id-cat-images'] ){
     $image = $_POST['id-cat-images'];
     update_term_meta ( $term_id, 'id-cat-images', $image );
   } else {
     update_term_meta ( $term_id, 'id-cat-images', '' );
   }
}
//WOOCOMMERCE
//подключение wc, отключение стандартных стилей
function woocommerce_support() {
  add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'woocommerce_support' );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );


//страница подкаталога
function woocommerce_template_loop_product_link_open() {
    global $product;
	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
	echo '<a href="' . esc_url( $link ) . '" class="listing__item">';
}
function woocommerce_template_loop_product_link_close() {
	echo '</a>';
}
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

function woocommerce_template_loop_product_title() {
	echo '<div class="listing__title ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</div>';
}
function woocommerce_get_product_thumbnail( $size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0, $attr = array('class' => 'listing__foto')) {
	global $product;
	$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
	return $product ? $product->get_image( $image_size, $attr ) : '';
}
//страница общего каталога
function woocommerce_template_loop_category_link_open( $category ) {
	echo '<a href="' . esc_url( get_term_link( $category, 'product_cat' ) ) . '" class="listing__item">';
}
function woocommerce_subcategory_thumbnail( $category ) {
	$small_thumbnail_size = apply_filters( 'subcategory_archive_thumbnail_size', 'woocommerce_thumbnail' );
	$dimensions           = wc_get_image_size( $small_thumbnail_size );
	$thumbnail_id         = get_term_meta( $category->term_id, 'thumbnail_id', true );
	if ( $thumbnail_id ) {
		$image        = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
		$image        = $image[0];
		$image_srcset = function_exists( 'wp_get_attachment_image_srcset' ) ? wp_get_attachment_image_srcset( $thumbnail_id, $small_thumbnail_size ) : false;
		$image_sizes  = function_exists( 'wp_get_attachment_image_sizes' ) ? wp_get_attachment_image_sizes( $thumbnail_id, $small_thumbnail_size ) : false;
	} else {
		$image        = wc_placeholder_img_src();
		$image_srcset = false;
		$image_sizes  = false;
	}
	if ( $image ) {
		// Prevent esc_url from breaking spaces in urls for image embeds.
		// Ref: https://core.trac.wordpress.org/ticket/23605.
		$image = str_replace( ' ', '%20', $image );
		// Add responsive image markup if available.
		if ( $image_srcset && $image_sizes ) {
			echo '<img class="listing__foto" src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" srcset="' . esc_attr( $image_srcset ) . '" sizes="' . esc_attr( $image_sizes ) . '" />';
		} else {
			echo '<img class="listing__foto" src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
		}
	}
}
function woocommerce_template_loop_category_title( $category ) {
	?>
	<div class="listing__title woocommerce-loop-category__title">
		<?php
		echo esc_html( $category->name );
		?>
	</div>
	<?php
}
function woocommerce_get_product_subcategories( $parent_id = 0 ) {
	$parent_id          = absint( $parent_id );
	$cache_key          = apply_filters( 'woocommerce_get_product_subcategories_cache_key', 'product-category-hierarchy-' . $parent_id, $parent_id );
	$product_categories = $cache_key ? wp_cache_get( $cache_key, 'product_cat' ) : false;
	if ( false === $product_categories ) {
		// NOTE: using child_of instead of parent - this is not ideal but due to a WP bug ( https://core.trac.wordpress.org/ticket/15626 ) pad_counts won't work.
		$product_categories = get_categories(
			apply_filters(
				'woocommerce_product_subcategories_args',
				array(
					'parent'       => $parent_id,
					'hide_empty'   => 1,
					'hierarchical' => 1,
					'taxonomy'     => 'product_cat',
					'pad_counts'   => 1,
          'exclude' => 118,
				)
			)
		);
		if ( $cache_key ) {
			wp_cache_set( $cache_key, $product_categories, 'product_cat' );
		}
	}
	return $product_categories;
}
function woocommerce_breadcrumb( $args = array() ) {
	$args = wp_parse_args(
		$args,
		apply_filters(
			'woocommerce_breadcrumb_defaults',
			array(
				'delimiter'   => '&nbsp;&#47;&nbsp;',
				'wrap_before' => '<nav class="breadcrumb">',
				'wrap_after'  => '</nav>',
				'before'      => '',
				'a
				
				
				fter'       => '',
				'home'        => _x( 'Каталог', 'breadcrumb', 'woocommerce' ),
			)
		)
	);
	$breadcrumbs = new WC_Breadcrumb();
	if ( ! empty( $args['home'] ) && !is_shop()) {
		$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', 'https://wheelhousedesign.ru/katalog' ) );
	}
	$args['breadcrumb'] = $breadcrumbs->generate();
	/**
	 * WooCommerce Breadcrumb hook
	 *
	 * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
	 */
	do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );
		wc_get_template( 'global/breadcrumb.php', $args );
}

//Товар
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	function wc_dropdown_variation_attribute_options( $args = array() ) {
		$args = wp_parse_args(
			apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ),
			array(
				'options'          => false,
				'attribute'        => false,
				'product'          => false,
				'selected'         => false,
				'name'             => '',
				'id'               => '',
				'class'            => '',
				'show_option_none' => __( 'Choose an option', 'woocommerce' ),
			)
		);

		// Get selected value.
		if ( false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product ) {
			$selected_key     = 'attribute_' . sanitize_title( $args['attribute'] );
			$args['selected'] = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $args['product']->get_variation_default_attribute( $args['attribute'] ); // WPCS: input var ok, CSRF ok, sanitization ok.
		}
        $storage               = $args['storage'];
        $other                 = $args['other'];
		$options               = $args['options'];
		$product               = $args['product'];
		$attribute             = $args['attribute'];
		$name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
		$id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
		$class                 = $args['class'];
		$show_option_none      = (bool) $args['show_option_none'];
		$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' ); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

		if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
			$attributes = $product->get_variation_attributes();
			$options    = $attributes[ $attribute ];
		}
        
	    if(strpos($name, "storage") != false){
	        
	    }
	    if(in_array('false',$options)){
            $checked='';
            if($args['selected']=='true'){$checked='checked ';}
            if($other == 1){
                $html = "";
                if($storage > 0){
                    $html .= '</div></div></div>';    
                }
                $html .= '<div class="product__variation"><div class="product__variation-text"></div><div class="product__variation-choice"><span>Выбрать опции</span><div class="product__variation-select hidden"><div class="product__variation-input"><input data-ids="' . esc_attr( $id ) . ' " id="input_' . esc_attr( $id ) . '"'. $checked .'type="checkbox" name="attribute_pa_dust-free" data-attribute_name="attribute_pa_dust-free" data-show_option_none="yes"><label for="input_' . esc_attr( $id ) . '">' . wc_attribute_label( $attribute )  . '</label></div>';
            }elseif($storage == 1){
                $html = "";
                if($other > 0){
                    $html .= '</div></div></div>';
                }
                $html .= '<div class="product__variation"><div class="product__variation-text"></div><div class="product__variation-choice"><span>Система хранения</span><div class="product__variation-select hidden"><div class="product__variation-input"><input data-ids="' . esc_attr( $id ) . ' " id="input_' . esc_attr( $id ) . '"'. $checked .'type="checkbox" name="attribute_pa_dust-free" data-attribute_name="attribute_pa_dust-free" data-show_option_none="yes"><label for="input_' . esc_attr( $id ) . '">' . wc_attribute_label( $attribute )  . '</label></div>';
            }else{
                $html = '<div class="product__variation-input"><input data-ids="' . esc_attr( $id ) . ' " id="input_' . esc_attr( $id ) . '"'. $checked .' type="checkbox" name="attribute_pa_dust-free" data-attribute_name="attribute_pa_dust-free" data-show_option_none="yes"><label for="input_' . esc_attr( $id ) . '">' . wc_attribute_label( $attribute )  . '</label></div>';
            }
            $html .= '<select class="product__variation-choice hidden" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">'; 
        }elseif($name  == "attribute_pa_kategoriya-tkani"){
            
            if(count($options) == 1){
                $html = '<div class="product__variation-size"><div class="product__variation-text">' . CFS()->get( 'material_name_0' ) . '</div><div class="product__variation-choice">' . CFS()->get( 'material_0' ) . '</div></div><div class="product__variation-size"><div class="product__variation-text">' . CFS()->get( 'material_name_1' ) . '</div><div class="product__variation-choice" data-item="1">' . CFS()->get( 'material_1' ) . '</div></div><div class="product__variation-size"><div class="product__variation-text">' . CFS()->get( 'material_name_2' ) . '</div><div class="product__variation-choice" data-item="2">' . CFS()->get( 'material_2' ) . '</div></div>';
                $html .= '<select class="hidden" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">'; 

            }else{
                $html = '<div class="product__variation"><div class="product__variation-text">' . CFS()->get( 'material_name_0' ) . '</div><div class="product__variation-choice product__cloth">' . CFS()->get( 'material_0' ) . '</div></div><div class="product__variation"><div class="product__variation-text">' . CFS()->get( 'material_name_1' ) . '</div><div class="product__variation-choice product__cloth-add" data-item="1">' . CFS()->get( 'material_1' ) . '</div></div><div class="product__variation"><div class="product__variation-text">' . CFS()->get( 'material_name_2' ) . '</div><div class="product__variation-choice product__cloth-add" data-item="2">' . CFS()->get( 'material_2' ) . '</div></div>';
                $html .= '<select class="hidden" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">'; 
            }
        }elseif(count($options) == 1){
            $terms = wc_get_product_terms(
					$product->get_id(),
					$attribute,
					array(
						'fields' => 'all',
					)
				);
            $html = '<div class="product__variation-size"><div class="product__variation-text"></div><div class="product__variation-choice">' . $terms[0]->name. '</div><select class="hidden" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">'; 
        }else{
            $html = '<div class="product__variation"><div class="product__variation-text"></div><select class="product__variation-choice" id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">'; 
        }
		
		$html .= '<option value="">' . wc_attribute_label( $attribute )  . '</option>';

		if ( ! empty( $options ) ) {
			if ( $product && taxonomy_exists( $attribute ) ) {
				// Get terms if this is a taxonomy - ordered. We need the names too.
				$terms = wc_get_product_terms(
					$product->get_id(),
					$attribute,
					array(
						'fields' => 'all',
					)
				);

				foreach ( $terms as $term ) {
					if ( in_array( $term->slug, $options, true ) ) {
						$html .= '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name, $term, $attribute, $product ) ) . '</option>';
					}
				}
			} else {
				foreach ( $options as $option ) {
				    
					// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
					$selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
					$html    .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option, null, $attribute, $product ) ) . '</option>';
				}
			}
		}

		if(in_array('false',$options) || $name  == "attribute_pa_kategoriya-tkani"){
           $html .= '</select>';
		    
		}else{
           $html .= '</select></div>';
		}

		echo apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', $html, $args ); // WPCS: XSS ok.
	}

/*add_filter('woocommerce_variable_price_html', 'my_woocommerce_variable_price_html', 10, 2); 
function my_woocommerce_variable_price_html( $price, $product ) {
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    // Sale Price
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    if ( $price !== $saleprice && $product->is_on_sale() ) {
        $price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
    }
     return $price; 
}*/
add_action( 'woocommerce_before_single_product', 'move_variations_single_price', 1 );
function move_variations_single_price(){
    global $product, $post;

    if ( $product->is_type( 'variable' ) ) {
        // removing the variations price for variable products
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

        // Change location and inserting back the variations price
        add_action( 'woocommerce_single_product_summary', 'replace_variation_single_price', 10 );
    }
}

function replace_variation_single_price(){
    global $product;

    // Main Price
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $price = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    // Sale Price
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '%1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    if ( $price !== $saleprice && $product->is_on_sale() ) {
        $price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . $product->get_price_suffix() . '</ins>';
    }

    ?>
    <style>
        div.woocommerce-variation-price,
        div.woocommerce-variation-availability,
        div.hidden-variable-price,
        p.availability{
            height: 0px !important;
            overflow:hidden;
            position:relative;
            line-height: 0px !important;
            font-size: 0% !important;
        }
    </style>
    <script>
    jQuery(document).ready(function($) {
        $('.variation_id').change( function(){
            if( '' != $('input.variation_id').val() ){
                if($('p.availability')){
                    $('p.availability').remove();}
                $('p.price').html($('div.woocommerce-variation-price > span.price').html()).append('<p class="availability">'+$('div.woocommerce-variation-availability').html()+'</p>');
            } else {
                $('p.price').html($('div.hidden-variable-price').html());
                if($('p.availability')){
                    $('p.availability').remove();}
            }
        });
    });
    </script>
    <?php
    echo '<p class="product__price price">'.$price.'</p>
    <div class="hidden-variable-price" >'.$price.'</div>';
}


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );


add_filter( 'woocommerce_get_price_html', 'custom_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'custom_price_format', 10, 2 );
function custom_price_format( $price, $product ) {

// 1. Variable products
if( $product->is_type('variable') ){
    // Searching for the default variation
   /* $default_attributes = $product->get_default_attributes();
    // Loop through available variations
    foreach($product->get_available_variations() as $variation){
        $found = true; // Initializing
        // Loop through variation attributes
        foreach( $variation['attributes'] as $key => $value ){
            $taxonomy = str_replace( 'attribute_', '', $key );
            // Searching for a matching variation as default
            if( isset($default_attributes[$taxonomy]) && $default_attributes[$taxonomy] != $value ){
                $found = false;
                break;
            }
        }
        // When it's found we set it and we stop the main loop
        if( $found ) {
            $default_variaton = $variation;
            break;
        } // If not we continue
        else {
            continue;
        }
    }
    // Get the default variation prices or if not set the variable product min prices
    
    $regular_price = $default_variaton['display_regular_price'];
    $sale_price = $default_variaton['display_price'];*/
    $regular_price = CFS()->get( 'regular' );
    $sale_price = CFS()->get( 'sale' );
}
// 2. Other products types
else {
    $regular_price = $product->get_regular_price();
    $sale_price    = $product->get_sale_price();
}

// Formatting the price
if ( $regular_price !== $sale_price && $product->is_on_sale()) {
    // Percentage calculation and text
    //$percentage = round( ( $regular_price - $sale_price ) / $regular_price * 100 ).'%';
    //$percentage_txt = __(' Save', 'woocommerce' ).' '.$percentage;
    $price = '<del>' . wc_price($regular_price) . '</del> <ins>' . wc_price($sale_price) . '</ins>';
} else {$price = '<span>' . wc_price($regular_price) . '</span>';}
return $price;
}
//корзина
add_action( 'wp_footer', 'cart_update_qty_script' );
function cart_update_qty_script() {
    if (is_cart()) :
    ?>
    <script>
        jQuery('div.woocommerce').on('change', '.qty', function(){
            jQuery("[name='update_cart']").trigger("click"); 
        });
    </script>
    <?php
    endif;
}
/*
 * Покажет текстовое поле на странице товара
 * @return html
 */
function ctrlv_material(){
    $value = isset( $_POST['_material_0'] ) ? sanitize_text_field( $_POST['_material_0'] ) : '';
    printf( '<label>%s</label><input type="hidden" name="_material_0" value="' . CFS()->get( 'material_0' ) . '" />', __( '', 'ctrlv-plugin-textdomain' ), esc_attr( $value ) );
    $value = isset( $_POST['_material_1'] ) ? sanitize_text_field( $_POST['_material_1'] ) : '';
    printf( '<label>%s</label><input type="hidden" name="_material_1" value="' . CFS()->get( 'material_1' ) . '" />', __( '', 'ctrlv-plugin-textdomain' ), esc_attr( $value ) );
    $value = isset( $_POST['_material_2'] ) ? sanitize_text_field( $_POST['_material_2'] ) : '';
    printf( '<label>%s</label><input type="hidden" name="_material_2" value="' . CFS()->get( 'material_2' ) . '" />', __( '', 'ctrlv-plugin-textdomain' ), esc_attr( $value ) );
}
add_action( 'woocommerce_before_add_to_cart_button', 'ctrlv_material', 10 );
/*
 * Провека данных при клике на "добавить в корзину"
 * @param bool $passed
 * @param int $product_id
 * @param int $quantity
 * @return bool
 */
function ctrlv_add_to_cart_validation($passed, $product_id, $qty){
 
    if( isset( $_POST['_material_0'] ) && sanitize_text_field( $_POST['_material_0'] ) == '' ){
        $product = wc_get_product( $product_id );
        wc_add_notice( sprintf( __( '%s не может быт добавлен в корзину, пока Вы не выберите материал обивки.', 'ctrlv-plugin-textdomain' ), $product->get_title() ), 'error' );
        return false;
    }
    if( isset( $_POST['_material_1'] ) && sanitize_text_field( $_POST['_material_1'] ) == '' ){
        $product = wc_get_product( $product_id );
        wc_add_notice( sprintf( __( '%s не может быт добавлен в корзину, пока Вы не выберите материал обивки.', 'ctrlv-plugin-textdomain' ), $product->get_title() ), 'error' );
        return false;
    }
    if( isset( $_POST['_material_2'] ) && sanitize_text_field( $_POST['_material_2'] ) == '' ){
        $product = wc_get_product( $product_id );
        wc_add_notice( sprintf( __( '%s не может быт добавлен в корзину, , пока Вы не выберите материал обивки.', 'ctrlv-plugin-textdomain' ), $product->get_title() ), 'error' );
        return false;
    }
 
    return $passed;
 
}
add_filter( 'woocommerce_add_to_cart_validation', 'ctrlv_add_to_cart_validation', 10, 3 );
/*
 * Добавит произвольные данные с поля к записи товара в корзине
 * @param array $cart_item
 * @param int $product_id
 * @return array
 */
function ctrlv_add_cart_item_data( $cart_item, $product_id ){
 
    if( isset( $_POST['_material_0'] ) ) {
        $cart_item['material_0'] = sanitize_text_field( $_POST['_material_0'] );
    } else {
        $cart_item['material_0'] = "";
    }
    if( isset( $_POST['_material_1'] ) ) {
        $cart_item['material_1'] = sanitize_text_field( $_POST['_material_1'] );
    } else {
        $cart_item['material_1'] = "";
    }
    if( isset( $_POST['_material_2'] ) ) {
        $cart_item['material_2'] = sanitize_text_field( $_POST['_material_2'] );
    } else {
        $cart_item['material_2'] = "";
    }
 
    return $cart_item;
 
}
add_filter( 'woocommerce_add_cart_item_data', 'ctrlv_add_cart_item_data', 10, 2 );
/*
 * Загрузит данные корзины из сессии
 * @param array $cart_item
 * @param array $other_data
 * @return array
 */
function ctrlv_get_cart_item_from_session( $cart_item, $values ) {

    if ( isset( $values['material_0'] ) ){
        $cart_item['material_0'] = $values['material_0'];
    }
    if ( isset( $values['material_1'] ) ){
        $cart_item['material_1'] = $values['material_1'];
    }
    if ( isset( $values['material_2'] ) ){
        $cart_item['material_2'] = $values['material_2'];
    }

    return $cart_item;

}
add_filter( 'woocommerce_get_cart_item_from_session', 'ctrlv_get_cart_item_from_session', 20, 2 );
/*
 * Сохранит данные произвольного поля в заказе
 * @param int $item_id
 * @param array $values
 * @return void
 */
function ctrlv_add_order_item_meta( $item_id, $values ) {

    if ( ! empty( $values['material_0'] ) ) {
        woocommerce_add_order_item_meta( $item_id, 'material_0', $values['material_0'] );           
    }
    if ( ! empty( $values['material_1'] ) ) {
        woocommerce_add_order_item_meta( $item_id, 'material_1', $values['material_1'] );           
    }
    if ( ! empty( $values['material_2'] ) ) {
        woocommerce_add_order_item_meta( $item_id, 'material_2', $values['material_2'] );           
    }
}
add_action( 'woocommerce_add_order_item_meta', 'ctrlv_add_order_item_meta', 10, 2 );
/*
 * Получим данные о произвольном поле для из последующего показа
 * @param array $other_data
 * @param array $cart_item
 * @return array
 */
function ctrlv_get_item_data( $other_data, $cart_item ) {
 
    if ( isset( $cart_item['material_0'] ) ){
 
        $other_data[] = array(
            'name' => __( 'Базовый материал', 'ctrlv-plugin-textdomain' ),
            'value' => sanitize_text_field( $cart_item['material_0'] )
        );
 
    }
    if ( isset( $cart_item['material_1'] ) ){
 
        $other_data[] = array(
            'name' => __( 'Дополнительная материал №1', 'ctrlv-plugin-textdomain' ),
            'value' => sanitize_text_field( $cart_item['material_1'] )
        );
 
    }
    if ( isset( $cart_item['material_2'] ) ){
 
        $other_data[] = array(
            'name' => __( 'Дополнительный материал №2', 'ctrlv-plugin-textdomain' ),
            'value' => sanitize_text_field( $cart_item['material_2'] )
        );
 
    }
 
    return $other_data;
 
}
add_filter( 'woocommerce_get_item_data', 'ctrlv_get_item_data', 10, 2 );
//Оформление заказа
function sort_fields_billing($fields) {
	$fields["billing"]["billing_first_name"]["priority"] = 2;
	$fields["billing"]["billing_last_name"]["priority"] = 3;
	$fields["billing"]["billing_company"]["priority"] = 6;
	$fields["billing"]["billing_address_1"]["priority"] = 12;
	$fields["billing"]["billing_address_2"]["priority"] = 8;
	$fields["billing"]["billing_city"]["priority"] = 7;
	$fields["billing"]["billing_postcode"]["priority"] = 9;
	$fields["billing"]["billing_country"]["priority"] = 1;
	$fields["billing"]["billing_state"]["priority"] = 11;
	$fields["billing"]["billing_email"]["priority"] = 5;
	$fields["billing"]["billing_phone"]["priority"] = 4;
	return $fields;
}

add_filter("woocommerce_checkout_fields", "sort_fields_billing");

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
  //unset($fields['billing']['billing_first_name']);// имя
  //unset($fields['billing']['billing_last_name']);// фамилия
  unset($fields['billing']['billing_company']); // компания
  //unset($fields['billing']['billing_address_1']);//
  unset($fields['billing']['billing_address_2']);//
  unset($fields['billing']['billing_city']);
  unset($fields['billing']['billing_postcode']);
  //unset($fields['billing']['billing_country']);
  //unset($fields['billing']['billing_state']);
  //unset($fields['billing']['billing_phone']);
  //unset($fields['order']['order_comments']);
  //unset($fields['billing']['billing_email']);
  //unset($fields['account']['account_username']);
  //unset($fields['account']['account_password']);
  //unset($fields['account']['account_password-2']);
    return $fields;
}

add_filter( 'woocommerce_states', 'new_rus_woocommerce_states' );
function new_rus_woocommerce_states( $states ) {
$states['RU'] = array(
'MSK' => 'Москва',
'MSKO' => 'Московская область',
/*'SPB' => 'Санкт-Петербург',
'NOV' => 'Новосибирск',
'EKB' => 'Екатеринбург',
'NN' => 'Нижний Новгород',
'KZN' => 'Казань',
'CHL' => 'Челябинск',
'OMSK' => 'Омск',
'SMR' => 'Самара',
'RND' => 'Ростов-на-Дону',
'UFA' => 'Уфа',
'PRM' => 'Пермь',
'KRN' => 'Красноярск',
'VRZH' => 'Воронеж',
'VLG' => 'Волгоград',
'SIMF' => 'Симферополь',
'ABAO' => 'Агинский Бурятский авт.окр.',
'AR' => 'Адыгея Республика',
'ALR' => 'Алтай Республика',
'AK' => 'Алтайский край',
'AMO' => 'Амурская область',
'ARO' => 'Архангельская область',
'ACO' => 'Астраханская область',
'BR' => 'Башкортостан республика',
'BEO' => 'Белгородская область',
'BRO' => 'Брянская область',
'BUR' => 'Бурятия республика',*/
'VLO' => 'Владимирская область',
/*'VOO' => 'Волгоградская область',
'VOLGO' => 'Вологодская область',
'VORO' => 'Воронежская область',
'DR' => 'Дагестан республика',
'EVRAO' => 'Еврейская авт. область',
'IO' => 'Ивановская область',
'IR' => 'Ингушетия республика',
'IRO' => 'Иркутская область',
'KBR' => 'Кабардино-Балкарская республика',
'KNO' => 'Калининградская область',
'KMR' => 'Калмыкия республика',*/
'KLO' => 'Калужская область',
/*'KMO' => 'Камчатская область',
'KCHR' => 'Карачаево-Черкесская республика',
'KR' => 'Карелия республика',
'KEMO' => 'Кемеровская область',
'KIRO' => 'Кировская область',
'KOMI' => 'Коми республика',
'KPAO' => 'Коми-Пермяцкий авт. окр.',
'KRAO' => 'Корякский авт.окр.',
'KOSO' => 'Костромская область',
'KRSO' => 'Краснодарский край',
'KRNO' => 'Красноярский край',
'KRYM' => 'Крым Республика',
'KURGO' => 'Курганская область',
'KURO' => 'Курская область',
'LENO' => 'Ленинградская область',
'LPO' => 'Липецкая область',
'MAGO' => 'Магаданская область',
'MER' => 'Марий Эл республика',
'MOR' => 'Мордовия республика',
'MURO' => 'Мурманская область',
'NAO' => 'Ненецкий авт.окр.',
'NZHO' => 'Нижегородская область',
'NVGO' => 'Новгородская область',
'NVO' => 'Новосибирская область',
'OMO' => 'Омская область',
'OPENO' => 'Оренбургская область',
'OPLO' => 'Орловская область',
'PENO' => 'Пензенская область',
'PERO' => 'Пермский край',
'PRO' => 'Приморский край',
'PSO' => 'Псковская область',
'RSO' => 'Ростовская область',*/
'RZO' => 'Рязанская область',
/*'SMRO' => 'Самарская область',
'SRP' => 'Саратовская область',
'SYAR' => 'Саха(Якутия) республика',
'SKHO' => 'Сахалинская область',
'SVO' => 'Свердловская область',
'SOAR' => 'Северная Осетия - Алания республика',*/
'SMO' => 'Смоленская область',
/*'STK' => 'Ставропольский край',
'TRAO' => 'Таймырский (Долгано-Ненецкий) авт. окр.',
'TMBO' => 'Тамбовская область',
'TTR' => 'Татарстан республика',*/
'TVO' => 'Тверская область',
/*'TMO' => 'Томская область',
'TVR' => 'Тыва республика',*/
'TULO' => 'Тульская область',
/*'TUMO' => 'Тюменская область',
'UDO' => 'Удмуртская республика',
'ULO' => 'Ульяновская область',
'UOBAO' => 'Усть-Ордынский Бурятский авт.окр.',
'KHBK' => 'Хабаровский край',
'KHKR' => 'Хакасия республика',
'KHMAO' => 'Ханты-Мансийский авт.окр.',
'CHLO' => 'Челябинская область',
'CHCHR' => 'Чеченская республика',
'CHTO' => 'Читинская область',
'CHVR' => 'Чувашская республика',
'CHKAO' => 'Чукотский авт.окр.',
'EVAO' => 'Эвенкийский авт.окр.',
'YANO' => 'Ямало-Ненецкий авт.окр.',
'YAO' => 'Ярославская область'*/
);
return $states;
}
add_filter( 'woocommerce_shipping_calculator_enable_postcode', '__return_false' );
add_filter( 'woocommerce_shipping_calculator_enable_city', '__return_false' );

add_filter('gettext', 'translate_text');
add_filter('ngettext', 'translate_text');
 
function translate_text($translated) {
$translated = str_ireplace('Подытог', 'Сумма', $translated);
$translated = str_ireplace('Платёжный адрес', 'Адрес доставки', $translated);
$translated = str_ireplace('Примечания к вашему заказу, например, особые пожелания отделу доставки.', 'Примечания к вашему заказу, например, особые пожелания отделу доставки', $translated);
return $translated;
}

	function woocommerce_form_field( $key, $args, $value = null ) {
		$defaults = array(
			'type'              => 'text',
			'label'             => '',
			'description'       => '',
			'placeholder'       => '',
			'maxlength'         => false,
			'required'          => false,
			'autocomplete'      => false,
			'id'                => $key,
			'class'             => array(),
			'label_class'       => array(),
			'input_class'       => array(),
			'return'            => false,
			'options'           => array(),
			'custom_attributes' => array(),
			'validate'          => array(),
			'default'           => '',
			'autofocus'         => '',
			'priority'          => '',
		);

		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

		if ( $args['required'] ) {
			$args['class'][] = 'validate-required';
			$required        = '&nbsp;<abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>';
		} else {
			$required = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
		}

		if ( is_string( $args['label_class'] ) ) {
			$args['label_class'] = array( $args['label_class'] );
		}

		if ( is_null( $value ) ) {
			$value = $args['default'];
		}

		// Custom attribute handling.
		$custom_attributes         = array();
		$args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );

		if ( $args['maxlength'] ) {
			$args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
		}

		if ( ! empty( $args['autocomplete'] ) ) {
			$args['custom_attributes']['autocomplete'] = $args['autocomplete'];
		}

		if ( true === $args['autofocus'] ) {
			$args['custom_attributes']['autofocus'] = 'autofocus';
		}

		if ( $args['description'] ) {
			$args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
		}

		if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
			foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
			}
		}

		if ( ! empty( $args['validate'] ) ) {
			foreach ( $args['validate'] as $validate ) {
				$args['class'][] = 'validate-' . $validate;
			}
		}

		$field           = '';
		$label_id        = $args['id'];
		$sort            = $args['priority'] ? $args['priority'] : '';
		$field_container = '<p class="form-row %1$s" id="%2$s" data-priority="' . esc_attr( $sort ) . '">%3$s</p>';

		switch ( $args['type'] ) {
			case 'country':
				$countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

				if ( 1 === count( $countries ) ) {

					//$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

					$field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" readonly="readonly" />';

				} else {

					$field = '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . '><option value="">' . esc_html__( 'Select a country / region&hellip;', 'woocommerce' ) . '</option>';

					foreach ( $countries as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
					}

					$field .= '</select>';

					$field .= '<noscript><button type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__( 'Update country / region', 'woocommerce' ) . '">' . esc_html__( 'Update country / region', 'woocommerce' ) . '</button></noscript>';

				}

				break;
			case 'state':
				/* Get country this state field is representing */
				$for_country = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );
				$states      = WC()->countries->get_states( $for_country );

				if ( is_array( $states ) && empty( $states ) ) {

					$field_container = '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';

					$field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" readonly="readonly" data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '"/>';

				} elseif ( ! is_null( $for_country ) && is_array( $states ) ) {

					$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ? $args['placeholder'] : esc_html__( 'Select an option&hellip;', 'woocommerce' ) ) . '"  data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '">
						<option value="">' . esc_html__( 'Select an option&hellip;', 'woocommerce' ) . '</option>';

					foreach ( $states as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
					}

					$field .= '</select>';

				} else {

					$field .= '<input type="text" class="input-text checkout__input ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '"/>';

				}

				break;
			case 'textarea':
				$field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text checkout__input' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $value ) . '</textarea>';

				break;
			case 'checkbox':
				$field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
						<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( $value, 1, false ) . ' /> ' . $args['label'] . $required . '</label>';

				break;
			case 'text':
			case 'password':
			case 'datetime':
			case 'datetime-local':
			case 'date':
			case 'month':
			case 'time':
			case 'week':
			case 'number':
			case 'email':
			case 'url':
			case 'tel':
				$field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-text checkout__input ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="'  . $args['label'] .'"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

				break;
			case 'select':
				$field   = '';
				$options = '';

				if ( ! empty( $args['options'] ) ) {
					foreach ( $args['options'] as $option_key => $option_text ) {
						if ( '' === $option_key ) {
							// If we have a blank option, select2 needs a placeholder.
							if ( empty( $args['placeholder'] ) ) {
								$args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'woocommerce' );
							}
							$custom_attributes[] = 'data-allow_clear="true"';
						}
						$options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
					}

					$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="checkout__input select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select>';
				}

				break;
			case 'radio':
				$label_id .= '_' . current( array_keys( $args['options'] ) );

				if ( ! empty( $args['options'] ) ) {
					foreach ( $args['options'] as $option_key => $option_text ) {
						$field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" ' . implode( ' ', $custom_attributes ) . ' id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
						$field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . $option_text . '</label>';
					}
				}

				break;
		}

		if ( ! empty( $field ) ) {
			$field_html = '';

			if ( $args['label'] && 'checkbox' !== $args['type'] ) {
				//$field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] . $required . '</label>';
				
			}

			//$field_html .= '<span class="woocommerce-input-wrapper">' . $field;
			$field_html .= $field;

			//if ( $args['description'] ) {
				//$field_html .= '<span class="description" id="' . esc_attr( $args['id'] ) . '-description" aria-hidden="true">' . wp_kses_post( $args['description'] ) . '</span>';
			//}

			//$field_html .= '</span>';

			$container_class = esc_attr( implode( ' ', $args['class'] ) );
			$container_id    = esc_attr( $args['id'] ) . '_field';
			$field           = sprintf( $field_container, $container_class, $container_id, $field_html );
		}

		/**
		 * Filter by type.
		 */
		$field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

		/**
		 * General filter on form fields.
		 *
		 * @since 3.4.0
		 */
		$field = apply_filters( 'woocommerce_form_field', $field, $key, $args, $value );

		if ( $args['return'] ) {
			return $field;
		} else {
			echo $field; // WPCS: XSS ok.
		}
	}
add_filter( 'wc_add_to_cart_message', 'custom_add_to_cart_message' );
function custom_add_to_cart_message( $message ) {
    $message = ''; //здесь можно задать свой текст при добавлении товара в корзину, если оставите пустым то уведомление не будет выводиться
    return $message;
}
function woocommerceCustomError($error) {
	return str_replace('для выставления счета', '', $error);
}
add_filter('woocommerce_add_error', 'woocommerceCustomError');
//Личный кабинет
add_filter ( 'woocommerce_account_menu_items', 'misha_remove_my_account_links' );
function misha_remove_my_account_links( $menu_links ){
	unset( $menu_links['edit-address'] ); // Addresses
	unset( $menu_links['dashboard'] ); // Remove Dashboard
	unset( $menu_links['payment-methods'] ); // Remove Payment Methods
	unset( $menu_links['orders'] ); // Remove Orders
	unset( $menu_links['downloads'] ); // Disable Downloads
	unset( $menu_links['edit-account'] ); // Remove Account details tab
	//unset( $menu_links['customer-logout'] ); // Remove Logout link
	return $menu_links;
}
	function wc_display_item_meta( $item, $args = array() ) {
		$strings = array();
		$html    = '';
		$args    = wp_parse_args(
			$args,
			array(
				'before'       => '',
				'after'        => '</span></div>',
				'separator'    => '</span></div>',
				'echo'         => true,
				'autop'        => false,
				'label_before' => '<div class="cart__meta-title wc-item-meta-label">',
				'label_after'  => '<span> ',
			)
		);

		foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
		    if($meta->key != 'pa_kategoriya-tkani' && $meta->value != "false"){
			    $value     = $args['autop'] ? wp_kses_post( $meta->display_value ) : wp_kses_post( make_clickable( trim( $meta->display_value ) ) );
			    if($meta->value == "true"){
			        $strings[] = $args['label_before'] . wp_kses_post( $meta->display_key ) . $args['label_after'];
			    }else{
			        $strings[] = $args['label_before'] . wp_kses_post( $meta->display_key ) . ':'.$args['label_after'] . $value;
			    }
		    }
		}
        
		if ( $strings ) {
			$html = $args['before'] . implode( $args['separator'], $strings ) . $args['after'];
			$html = str_replace("<p>", '', $html);
			$html = str_replace("</p>", '', $html);
			$html = str_replace("Выбрать", '', $html);
			$html = str_replace("выбрать", '', $html);
			$html = str_replace("material_0", 'Базовый материал', $html);
			$html = str_replace("material_1", 'Дополнительная материал №1', $html);
			$html = str_replace("material_2", 'Дополнительный материал №2', $html);
		}

		$html = apply_filters( 'woocommerce_display_item_meta', $html, $item, $args );

		if ( $args['echo'] ) {
			echo $html; // WPCS: XSS ok.
		} else {
			return $html;
		}
	}
	add_filter('woocommerce_get_image_size_thumbnail','add_thumbnail_size',1,10);
function add_thumbnail_size($size){

    $size['width'] = '450';
    $size['height'] = '300';
    $size['crop']   = 0; //0 - не обрезаем, 1 - обрезка
    return $size;
}
function get_gallery_image_html( $attachment_id, $main_image = false ) {
	$flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
	$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
	$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
	$image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
	$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
	$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
	$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
	$alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
	$image             = wp_get_attachment_image(
		$attachment_id,
		$image_size,
		false,
		apply_filters(
			'woocommerce_gallery_image_html_attachment_image_params',
			array(
				'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'data-src'                => esc_url( $full_src[0] ),
				'data-large_image'        => esc_url( $full_src[0] ),
				'data-large_image_width'  => esc_attr( $full_src[1] ),
				'data-large_image_height' => esc_attr( $full_src[2] ),
				'class'                   => esc_attr( $main_image ? 'wp-post-image product_first magniflier' : '' ),
			),
			$attachment_id,
			$image_size,
			$main_image
		)
	);

	return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_src[0] ) . '">' . $image . '</a></div>';
}
/*add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
 function jk_related_products_args( $args ) {
 
$args['posts_per_page'] = 40; // количество "Похожих товаров"
 return $args;
}
function woocommerce_related_products( $args = array() ) {
		global $product;

		if ( ! $product ) {
			return;
		}
		//$value = array_key_first(CFS()->get( get_term( $product->category_ids[0], 'product_cat' )->slug . '-collection' ));
		//if(array_key_exists($value, CFS()->get( get_term( $product->category_ids[0], 'product_cat' )->slug . '-collection' ))){
		$defaults = array(
			'posts_per_page' => 10,
			'columns'        => 2,
			'orderby'        => 'rand', // @codingStandardsIgnoreLine.
			'order'          => 'desc',
		);

		// Get visible related products then sort them at random.
		$args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

		// Handle orderby.
		$args['related_products'] = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

		// Set global loop values.
		wc_set_loop_prop( 'name', 'related' );
		wc_set_loop_prop( 'columns', apply_filters( 'woocommerce_related_products_columns', $args['columns'] ) );
		
		wc_get_template( 'single-product/related.php', $args );
	}*/
function woocommerce_output_related_products() {

		$args = array(
			'posts_per_page' => 40,
			'columns'        => 4,
			'orderby'        => 'rand', // @codingStandardsIgnoreLine.
			//'meta_query' => 
		);

		woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );
	}