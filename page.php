<?php
/**
 * @package WordPress
 * @subpackage Custom-Theme
 * @since Custom-Theme
 */
 get_header(); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article class="mod-page">

      <h1 class="mod-page__title"><?php the_title(); ?></h1>

      <?php the_content(); ?>

    </article>

    <?php // comments_template(); ?>

    <?php endwhile; endif; ?>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
