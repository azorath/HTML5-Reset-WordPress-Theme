<?php
/**
 * @package WordPress
 * @subpackage Custom-Theme
 * @since Custom-Theme
 */
?>

<?php /*********** Main footer ***********/ ?>
<footer id="footer" class="c-main-footer source-org vcard copyright" role="contentinfo">
  <small>&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?></small>
</footer>
<?php // wp_footer(); ?>


<?php /*********** Close wrapper tags ***********/ ?>
</main>
</div> <?php /* page wrapper */ ?>


<?php /*********** Scripts ***********/ ?>
<script src="<?php bloginfo('template_directory'); ?>/_/js/app.min.js"></script>


<?php /*********** Google Analytics ***********/ ?>
<?php /*
Asynchronous google analytics; this is the official snippet.
 Replace UA-XXXXXX-XX with your site's ID and domainname.com with your domain, then uncomment to enable.

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-XXXXXX-XX', 'domainname.com');
  ga('send', 'pageview');

</script>
*/ ?>

</body>

</html>
