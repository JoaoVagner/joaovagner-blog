<?php get_header(); ?>

<div class="left">
	<div id="top"> 
	<a class="mylogo" href="<?php bloginfo('siteurl');?>/"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" class="logoimg" alt="" /></a>
		<div id="blogname">	
			<h1><a href="<?php bloginfo('siteurl');?>/" title="<?php bloginfo('name');?>"> <?php bloginfo('name');?></a></h1>
		</div>
	</div>
<?php get_sidebar(); ?>
</div>

<div id="content">

<?php get_template_part( 'index', 'slide' ); ?>


<?php if (have_posts()) : ?>
<?php $count = 0; ?>
<?php while (have_posts()) : the_post(); ?>

<div class="box" id="post-<?php the_ID(); ?>">
	<a href="<?php the_permalink() ?>"><img class="boximg" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=200&amp;w=330&amp;zc=1" alt=""/></a>

	<div class="btitle">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	</div>
	<div class="entry">
		<?php wpe_excerpt('wpe_excerptlength_index', ''); ?>
		<div class="clear"></div>
	</div>
	<div class="titlemeta clearfix">
		<span class="smore"> <a href="<?php the_permalink() ?>"> Read More  </a>  </span>
		<span class="slike"><?php printLikes(get_the_ID()); ?></span>
		<span class="comm"><?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?></span>
	</div>
</div>

<?php if(++$counter % 2 == 0) : ?>
	<div class="clear"></div>
<?php endif; ?>
<?php endwhile; ?>

<div class="clear"></div>
<?php getpagenavi(); ?>
<?php else : ?>
		<h1 class="title">Not Found</h1>
		<p>Sorry, but you are looking for something that isn't here.</p>
<?php endif; ?>
  
</div>


<?php get_footer(); ?>