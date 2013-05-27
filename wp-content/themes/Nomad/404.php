<?php get_header(); ?>
<div class="left">
	<div id="top"> 
	<a class="mylogo" href="<?php bloginfo('siteurl');?>/"><img src="<?php bloginfo('template_directory'); ?>/images/logo.png" class="logoimg" alt="" /></a>
		<div id="blogname">	
			<h1><a href="<?php bloginfo('siteurl');?>/" title="<?php bloginfo('name');?>"> NOMAD<?php //bloginfo('name');?></a></h1>
		</div>
	</div>
<?php get_sidebar(); ?>
</div>

<div id="content">
<div class="post">
<div class="title">
<h2>Not Found !</h2>
</div>
<div class="entry"><p>The page you are looking for is not here. Please try a different search or go back to the home page.</p></div>
</div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>