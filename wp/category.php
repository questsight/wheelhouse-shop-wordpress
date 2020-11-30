<?php
get_header();
if ($_REQUEST && !empty($_REQUEST)) {
  $cat="&cat=" . $_REQUEST['cat'];
}
?>
      <div class="content__box">
        <form class="filter hidden_type_min-md" id="filter-materialy">
          <div class="filter__close hidden_type_max-md">&times;</div>
          <input type="hidden" name="cat" value="<?php $category=get_queried_object(); echo $category->term_id;?>">
          <?php
            if (current_user_can('manage_options'))  { ?>
          <div class="filter__title" data-type="producer">Поставщик</div>
          <div class="filter__item hidden_type_min-md" data-type="producer">
            <?php $fields = CFS()->find_fields( array( 'field_name' => 'producer' ))['0']['options']['choices'];
            foreach ($fields as $key => $value) {
            ?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="producer[]" value="<?php echo $key; ?>" id="producer<?php echo $key; ?>" <?php checkbox('producer',$key);?>>
              <label class="filter__label" for="producer<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php } ?>
          </div>
          <?php } ?>
          <div class="filter__title" data-type="price">Ценовая категория</div>
          <div class="filter__item hidden_type_min-md" data-type="price">
            <?php 
            if(get_queried_object()->slug != 'alcantara'){
            $fields = CFS()->find_fields( array( 'field_name' => 'price' ))['0']['options']['choices'];
            foreach ($fields as $key => $value) {
                if($key != 101 && $key != 102){
            ?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="price[]" value="<?php echo $key; ?>" id="price<?php echo $key; ?>" <?php checkbox('price',$key);?>>
              <label class="filter__label" for="price<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }}}else{?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="price[]" value="101" id="price101" <?php checkbox('price','101');?>>
              <label class="filter__label" for="price101">Alcantara Shape</label>
            </div>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="price[]" value="102" id="price102" <?php checkbox('price','102');?>>
              <label class="filter__label" for="price102">Alcantara Custom</label>
            </div>
            <?php } ?>
          </div>
          <div class="filter__title" data-type="collection">Подходит для коллекции</div>
          <div class="filter__item hidden_type_min-md" data-type="collection">
            <?php $fields = CFS()->find_fields( array( 'field_name' => 'collection' ))['0']['options']['choices'];
            foreach ($fields as $key => $value) { if($key != "empty"){
            ?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="collection[]" value="<?php echo $key; ?>" id="collection<?php echo $key; ?>"  <?php checkbox('collection',$key);?>>
              <label class="filter__label" for="collection<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
          </div>
          <div class="filter__title" data-type="marker">Цвет</div>
          <div class="filter__item hidden_type_min-md" data-type="marker">
            <?php $fields = CFS()->find_fields( array( 'field_name' => 'marker' ))['0']['options']['choices'];
            foreach ($fields as $key => $value) {
            ?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="marker[]" value="<?php echo $key; ?>" id="marker<?php echo $key; ?>" <?php checkbox('marker',$key);?>>
              <label class="filter__label" for="marker<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php } ?>
          </div>
          <div class="filter__show hidden_type_max-md">Показать</div>
        </form>
        <div class="filter__call hidden_type_max-md">Открыть фильтр<i class="fa fa-filter" aria-hidden="true"></i></div>
        <div class="listing" id="result-materialy" data-box='box'>
        <?php
        if ($_REQUEST && !empty($_REQUEST)) {
          $cat="&cat=" . $_REQUEST['cat'];
          global $query_string;
          query_posts($query_string.$cat.'&posts_per_page=-1');
          go_filter();
        }
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <a href="<?php the_permalink()?>" class="listing__item">
            <img class="listing__foto" src="<?php the_post_thumbnail_url();?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <div class="listing__title"><?php the_title(); ?></div>
          </a>
          <?php endwhile; endif; ?>
        </div>
      </div>


<?php get_footer();?>