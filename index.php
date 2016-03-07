<?php
/**
 * @package WordPress
 * @subpackage Custom-Theme
 * @since Custom-Theme
 */
 get_header(); ?>

<section class="mod-teaser-list">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article class="mod-teaser">


      <?php /*********** Figure ***********/ ?>
      <figure class="mod-teaser__figure">
        <?php
        $thumb_size = 'thumbnail';

        $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $thumb_size );
        if ( $image_attributes ) : ?>
          <a href="<?php the_permalink() ?>">
            <img class="mod-teaser__image" src="<?php echo $image_attributes[0]; ?>" alt="<?php the_title(); ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>">
          </a>
        <?php endif; ?>
      </figure>


      <?php /*********** Headline ***********/ ?>
      <h2 class="mod-teaser__title">
        <a href="<?php the_permalink() ?>">
          <?php $key="kunde"; echo get_post_meta($post_id, $key, true); ?>
          <?php the_title(); ?>
        </a>
      </h2>


      <?php /*********** Date ***********/ ?>
      <?php // the_date(); ?>


      <?php /*********** Categories ***********/ ?>
      <ul class="mod-category-list">
        <?php foreach((get_the_category()) as $cat) {
          echo '<li class="mod-category-list__item">';
          echo $cat->cat_name;
          echo '</li>';
        } ?>
      </ul>


      <?php /*********** Content ***********/ ?>
      <div class="entry">
        <?php the_content(); ?>
        <?php // the_excerpt(); ?>
      </div>

    </article>

  <?php endwhile; ?>
</section>

  <?php // post_navigation(); ?>

  <?php else : ?>

    <h2><?php _e('Nothing Found','html5reset'); ?></h2>

  <?php endif; ?>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
