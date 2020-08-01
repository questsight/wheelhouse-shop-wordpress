<form class="filter hidden_type_min-md" id="filter-product">
          <div class="filter__close hidden_type_max-md">&times;</div>
          
          <input type="hidden" name="product_cat" value="<?php echo get_queried_object()->slug; ?>">
          <?php $fields = CFS()->find_fields( array( 'field_name' => get_queried_object()->slug.'-purpose' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="purpose">Назначение</div>
          <div class="filter__item hidden_type_min-md" data-type="purpose">
            <div class="filter__subtitle" data-type="purpose">HOME - для дома</div>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo get_queried_object()->slug; ?>-purpose[]" value="all" id="purpose-all-home" data-call="data-home">
              <label class="filter__label" for="purpose-all-home">все диваны для дома</label>
            </div>
            <?php foreach ($fields as $key => $value) { if(strpos($key, 'home') !== false){
            $value = str_replace("HOME/", "", $value); ?>
            <div class="filter__one">
              <input data-home class="filter__input" type="checkbox" name="<?php echo get_queried_object()->slug; ?>-purpose[]" value="<?php echo $key; ?>" id="purpose<?php echo $key; ?>"  <?php checkbox(get_queried_object()->slug.'-purpose',$key);?>>
              <label class="filter__label" for="purpose<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
            <div class="filter__subtitle" data-type="purpose">HoReCa</div>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo get_queried_object()->slug; ?>-purpose[]" value="all" id="purpose-all-horeca" data-call="data-horeca">
              <label class="filter__label" for="purpose-all-horeca">все диваны для посетителей</label>
            </div>
            <?php foreach ($fields as $key => $value) { if(strpos($key, 'horeca') !== false){
            $value = str_replace("HoReCa/", "", $value); ?>
            <div class="filter__one">
              <input data-horeca class="filter__input" type="checkbox" name="<?php echo get_queried_object()->slug; ?>-purpose[]" value="<?php echo $key; ?>" id="purpose<?php echo $key; ?>"  <?php checkbox(get_queried_object()->slug.'-purpose',$key);?>>
              <label class="filter__label" for="purpose<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
            <div class="filter__subtitle" data-type="purpose">OFFICE</div>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo get_queried_object()->slug; ?>-purpose[]" value="all" id="purpose-all-office" data-call="data-office">
              <label class="filter__label" for="purpose-all-office">все диваны для рабочего пространства</label>
            </div>
            <?php foreach ($fields as $key => $value) { if(strpos($key, 'office') !== false){
            $value = str_replace("OFFICE/", "", $value); ?>
            <div class="filter__one">
              <input data-office class="filter__input" type="checkbox" name="<?php echo get_queried_object()->slug; ?>-purpose[]" value="<?php echo $key; ?>" id="purpose<?php echo $key; ?>"  <?php checkbox(get_queried_object()->slug.'-purpose',$key);?>>
              <label class="filter__label" for="purpose<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>    
          </div>
          <?php endif; ?>
          
          
          <?php $fields = CFS()->find_fields( array( 'field_name' => get_queried_object()->slug.'-function' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="function">Функция</div>
          <div class="filter__item hidden_type_min-md" data-type="function">
            <?php foreach ($fields as $key => $value) { if($key != "empty"){?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo get_queried_object()->slug; ?>-function[]" value="<?php echo $key; ?>" id="function<?php echo $key; ?>"  <?php checkbox(get_queried_object()->slug.'-function',$key);?>>
              <label class="filter__label" for="function<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
          </div>
          <?php endif; ?>
          
          <?php $fields = CFS()->find_fields( array( 'field_name' => get_queried_object()->slug.'-size' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="size">Размер</div>
          <div class="filter__item hidden_type_min-md" data-type="size">
            <?php foreach ($fields as $key => $value) { if($key != "empty"){?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo get_queried_object()->slug; ?>-size[]" value="<?php echo $key; ?>" id="size<?php echo $key; ?>"  <?php checkbox(get_queried_object()->slug.'-size',$key);?>>
              <label class="filter__label" for="size<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
          </div>
          <?php endif; ?>
          
          <?php $fields = CFS()->find_fields( array( 'field_name' => get_queried_object()->slug.'-collection' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="collection">Коллекция</div>
          <div class="filter__item hidden_type_min-md" data-type="collection">
            <?php foreach ($fields as $key => $value) { if($key != "empty"){?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo get_queried_object()->slug; ?>-collection[]" value="<?php echo $key; ?>" id="collection<?php echo $key; ?>"  <?php checkbox(get_queried_object()->slug.'-collection',$key);?>>
              <label class="filter__label" for="collection<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
          </div>
          <?php endif; ?>
          
          <div class="filter__show hidden_type_max-md">Показать</div>
        </form>
        <div class="filter__call hidden_type_max-md">Открыть фильтр<i class="fa fa-filter" aria-hidden="true"></i></div>