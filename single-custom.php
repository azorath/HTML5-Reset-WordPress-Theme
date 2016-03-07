<?php
/**
 * @package WordPress
 * @subpackage Custom-Theme
 * @since Custom-Theme
 */
 get_header(); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php the_tags( __('Tags: ','html5reset'), ', ', ''); ?>

      <?php the_content(); ?>



      <?php /*********** Prev/Next post links ***********/ ?>
      <?php
        $current_post_url = get_permalink( $post->ID );
        $next_post_url = get_permalink(get_adjacent_post(false,'',false));
        $prev_post_url = get_permalink(get_adjacent_post(false,'',true));

        $output = "<div class=\"mod-post__next-link\">\n";
        $output .= "<a href=\"" . $next_post_url . "\">nächstes Projekt</a>\n";
        $output .= "<span class=\"mod-icon-arrow-right\"></span>\n";
        $output .= "</div>\n";

        /*
        if ($current_post_url != $next_post_url) {
          echo $output;
        }*/
      ?>

    </article>

  <?php // comments_template(); ?>

  <?php endwhile; endif; ?>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
