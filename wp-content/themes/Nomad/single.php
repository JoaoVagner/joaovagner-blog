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

<div id="content" >

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<img class="postimg" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=300&amp;w=720&amp;zc=1" alt=""/>
<div class="post" id="post-<?php the_ID(); ?>">

	<div class="title">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	</div>

	<div class="entry">
		<?php the_content('Read the rest of this entry &raquo;'); ?>
		<div class="clear"></div>
		<?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	</div>

	<div class="titlemeta clearfix">
		<span class="categori"> Categories: <?php the_category(', '); ?>   </span>
		
	</div>
</div>

<?php comments_template(); ?>
<?php endwhile; endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>