<?php get_header(); ?>
<div class="left">
	<div id="top"> 
	<a class="mylogo" href="<?php bloginfo('siteurl');?>/"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" class="logoimg" /></a>
		<div id="blogname">	
			<h1><a href="<?php bloginfo('siteurl');?>/" title="<?php bloginfo('name');?>"> <?php bloginfo('name');?></a></h1>
		</div>
	</div>
<?php get_sidebar(); ?>
</div>
<div id="content">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
		
<div class="post" id="post-<?php the_ID(); ?>">

	<div class="title">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	</div>

	<div class="entry">
		<?php wpe_excerpt('wpe_excerptlength_index', ''); ?>
		<div class="clear"></div>
	</div>
	<div class="titlemeta clearfix">
		<span class="smore"> <a href="<?php the_permalink() ?>"> Read More  </a>  </span>

	</div>
</div>
<?php endwhile; ?>

<?php getpagenavi(); ?>

<?php else : ?>

	<h1 class="title">Not Found</h1>
	<p>Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>