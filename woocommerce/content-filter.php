<?php 
if(get_queried_object()->parent != 0 && get_term( get_queried_object()->parent )->slug != 'aksessuary' ){
  $slug = get_term( get_queried_object()->parent )->slug;
}else{
  $slug = get_queried_object()->slug;
}
?>
         <form class="filter hidden_type_min-md" id="filter-product">
          <div class="filter__close hidden_type_max-md">&times;</div>
           <?php if($slug == 'matrasy'): ?>
           <input type="hidden" name="orderby" value="price">
           <?php else: ?>
             <div class="filter__title" data-type="marker">Сортировать:</div>
          <div class="filter__item hidden_type_min-md" data-type="marker">
            <div class="filter__one">
              <input class="filter__input" type="radio" name="orderby" value="price" id="orderprice">
              <label class="filter__label" for="orderprice">По цене (сначала дешевые)</label>
            </div>
            <div class="filter__one">
              <input class="filter__input" type="radio" name="orderby" value="priced" id="orderpriced">
              <label class="filter__label" for="orderpriced">По цене (сначала дорогие)</label>
            </div>
            <div class="filter__one">
              <input class="filter__input" type="radio" name="orderby" value="none" id="ordernone">
              <label class="filter__label" for="ordernone">По умолчанию</label>
            </div>
          </div>
          <?php endif; ?>
        <input type="hidden" name="category" value="<?php echo get_queried_object()->slug; ?>">
        
          <!--?php $fields = CFS()->find_fields( array( 'field_name' => $slug.'-marker' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="marker">Цвет</div>
          <div class="filter__item hidden_type_min-md" data-type="marker">
            <!--?php foreach ($fields as $key => $value) { if($key != "empty"){?>
            <div class="filter__one">
              <input class="filter__input" type="radio" name="<!--?php echo $slug; ?>-marker[]" value="<!--?php echo $key; ?>" id="marker<!--?php echo $key; ?>"  <!--?php checkbox($slug.'-marker',$key);?>>
              <label class="filter__label" for="marker<!--?php echo $key; ?>"><!--?php echo $value; ?></label>
            </div>
            <!--?php }} ?>
          </div>
          <!--?php endif; ?-->
          
          <?php $fields = CFS()->find_fields( array( 'field_name' => $slug.'-purpose' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="purpose">Назначение</div>
          <div class="filter__item hidden_type_min-md" data-type="purpose">
            <div class="filter__subtitle" data-type="purpose">HOME - для дома</div>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo $slug; ?>-purpose[]" value="all" id="purpose-all-home" data-call="data-home">
              <label class="filter__label" for="purpose-all-home">все диваны для дома</label>
            </div>
            <?php foreach ($fields as $key => $value) { if(strpos($key, 'home') !== false){
            $value = str_replace("HOME/", "", $value); ?>
            <div class="filter__one">
              <input data-home class="filter__input" type="checkbox" name="<?php echo $slug; ?>-purpose[]" value="<?php echo $key; ?>" id="purpose<?php echo $key; ?>"  <?php checkbox($slug.'-purpose',$key);?>>
              <label class="filter__label" for="purpose<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
            <div class="filter__subtitle" data-type="purpose">HoReCa</div>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo $slug; ?>-purpose[]" value="all" id="purpose-all-horeca" data-call="data-horeca">
              <label class="filter__label" for="purpose-all-horeca">все диваны для посетителей</label>
            </div>
            <?php foreach ($fields as $key => $value) { if(strpos($key, 'horeca') !== false){
            $value = str_replace("HoReCa/", "", $value); ?>
            <div class="filter__one">
              <input data-horeca class="filter__input" type="checkbox" name="<?php echo $slug; ?>-purpose[]" value="<?php echo $key; ?>" id="purpose<?php echo $key; ?>"  <?php checkbox($slug.'-purpose',$key);?>>
              <label class="filter__label" for="purpose<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
            <div class="filter__subtitle" data-type="purpose">OFFICE</div>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo $slug; ?>-purpose[]" value="all" id="purpose-all-office" data-call="data-office">
              <label class="filter__label" for="purpose-all-office">все диваны для рабочего пространства</label>
            </div>
            <?php foreach ($fields as $key => $value) { if(strpos($key, 'office') !== false){
            $value = str_replace("OFFICE/", "", $value); ?>
            <div class="filter__one">
              <input data-office class="filter__input" type="checkbox" name="<?php echo $slug; ?>-purpose[]" value="<?php echo $key; ?>" id="purpose<?php echo $key; ?>"  <?php checkbox($slug.'-purpose',$key);?>>
              <label class="filter__label" for="purpose<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>    
          </div>
          <?php endif; ?>
          
          
          <?php $fields = CFS()->find_fields( array( 'field_name' => $slug.'-function' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="function">Функция</div>
          <div class="filter__item hidden_type_min-md" data-type="function">
            <?php foreach ($fields as $key => $value) { if($key != "empty"){?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo $slug; ?>-function[]" value="<?php echo $key; ?>" id="function<?php echo $key; ?>"  <?php checkbox($slug.'-function',$key);?>>
              <label class="filter__label" for="function<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
          </div>
          <?php endif; ?>
          
          <?php $fields = CFS()->find_fields( array( 'field_name' => $slug.'-size' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="size">Размер</div>
          <div class="filter__item hidden_type_min-md" data-type="size">
            <?php foreach ($fields as $key => $value) { if($key != "empty"){?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo $slug; ?>-size[]" value="<?php echo $key; ?>" id="size<?php echo $key; ?>"  <?php checkbox($slug.'-size',$key);?>>
              <label class="filter__label" for="size<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
          </div>
          <?php endif; ?>
          
          <?php $fields = CFS()->find_fields( array( 'field_name' => $slug.'-collection' ))['0']['options']['choices']; if($fields): ?>
          <div class="filter__title" data-type="collection">Коллекция</div>
          <div class="filter__item hidden_type_min-md" data-type="collection">
            <?php foreach ($fields as $key => $value) { if($key != "empty"){?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo $slug; ?>-collection[]" value="<?php echo $key; ?>" id="collection<?php echo $key; ?>"  <?php checkbox($slug.'-collection',$key);?>>
              <label class="filter__label" for="collection<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
          </div>
          <?php endif; ?>
          
          <?php $fields = CFS()->find_fields( array( 'field_name' => $slug.'-height' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="height">Высота</div>
          <div class="filter__item hidden_type_min-md" data-type="height">
            <?php foreach ($fields as $key => $value) { if($key != "empty"){?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo $slug; ?>-height[]" value="<?php echo $key; ?>" id="height<?php echo $key; ?>"  <?php checkbox($slug.'-height',$key);?>>
              <label class="filter__label" for="height<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
          </div>
          <?php endif; ?>
          
          <?php $fields = CFS()->find_fields( array( 'field_name' => $slug.'-hardness' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="hardness">Жёсткость</div>
          <div class="filter__item hidden_type_min-md" data-type="hardness">
            <?php foreach ($fields as $key => $value) { if($key != "empty"){?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo $slug; ?>-hardness[]" value="<?php echo $key; ?>" id="hardness<?php echo $key; ?>"  <?php checkbox($slug.'-hardness',$key);?>>
              <label class="filter__label" for="hardness<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
          </div>
          <?php endif; ?>
          
          <?php $fields = CFS()->find_fields( array( 'field_name' => $slug.'-type' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="hardness">Тип</div>
          <div class="filter__item hidden_type_min-md" data-type="type">
            <?php foreach ($fields as $key => $value) { if($key != "empty"){?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo $slug; ?>-type[]" value="<?php echo $key; ?>" id="type<?php echo $key; ?>"  <?php checkbox($slug.'-type',$key);?>>
              <label class="filter__label" for="type<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
          </div>
          <?php endif; ?>
          
          <?php $fields = CFS()->find_fields( array( 'field_name' => $slug.'-structure' ))['0']['options']['choices']; if($fields):?>
          <div class="filter__title" data-type="structure">Материал</div>
          <div class="filter__item hidden_type_min-md" data-type="structure">
            <?php foreach ($fields as $key => $value) { if($key != "empty"){?>
            <div class="filter__one">
              <input class="filter__input" type="checkbox" name="<?php echo $slug; ?>-structure[]" value="<?php echo $key; ?>" id="structure<?php echo $key; ?>"  <?php checkbox($slug.'-structure',$key);?>>
              <label class="filter__label" for="structure<?php echo $key; ?>"><?php echo $value; ?></label>
            </div>
            <?php }} ?>
          </div>
          <?php endif; ?>
          
          <div class="filter__show hidden_type_max-md">Показать</div>
        </form>
        <div class="filter__call hidden_type_max-md">Открыть фильтр<i class="fa fa-filter" aria-hidden="true"></i></div>