<?php get_header();
query_posts('&cat=34&posts_per_page=-1');
if ( have_posts() ) : ?>
<div class="listing" data-filter="none">
    <div class="cloth__title">белоснежный</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("white", $field['marker'])):?>
            <div class="listing__item">
                <img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
    <div class="cloth__title">крем&молоко</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("neutral", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
    <div class="cloth__title">все оттенки серого</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("gray", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
    <div class="cloth__title">уголь</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("black", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
    <div class="cloth__title">сочный красный</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("red", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
<div class="cloth__title">апельсин</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("orange", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
<div class="cloth__title">карамбола&лимон&горчица</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("yellow", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
<div class="cloth__title">лайм&мята&изумруд</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("green", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
<div class="cloth__title">морская волна</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("aqua", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
<div class="cloth__title">кофе&шоколад</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("brown", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
<div class="cloth__title">глубокий синий&голубой</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("blue", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
<div class="cloth__title">баклажан&виноград</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("purple", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
<div class="cloth__title">сирень</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("lilac", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
<div class="cloth__title">бордо&марсала</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("turquoise", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
<div class="cloth__title">роза</div>
    <?php while ( have_posts() ) : the_post();?>
        <?php $fields = CFS()->get( 'palette' );
            if( ! empty($fields)):
            foreach ( $fields as $field ){
            if(array_key_exists("pink", $field['marker'])):?>
            <div class="listing__item">
                <picture>
                <source srcset="<?php echo $field['icon-webp']; ?>" type="image/webp"><img class="listing__foto" src="<?php echo $field['icon-jpg']; ?>" loading="lazy" alt="<?php echo get_bloginfo('description'); ?> <?php echo get_bloginfo('name'); ?>">
            </picture>
            <div class="listing__title">
                <p><?php echo $field['name-color']; ?></p>
                <ul>
                <?php foreach ( $field['marker'] as $key => $value ){?>
                    <li style="text-transform:none;text-align: left;"><?php echo $value;?></li>
                <?php }?>
                </ul>
            </div>
          </div>
    <?php endif; } endif; endwhile; ?>
</div>
<?php endif;
get_footer();?>