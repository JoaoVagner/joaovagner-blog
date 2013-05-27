<div class="slidebox">
<div class="flexslider">
	<ul class="slides">	
		<?php 
			$slide = get_option('nomad_slide_cat');
			$count = get_option('nomad_slide_count');
			$slide_query = new WP_Query( 'category_name='.$slide.'&posts_per_page='.$count.'' );
			while ( $slide_query->have_posts() ) : $slide_query->the_post();
		?>	
		<li>
			<a href="<?php the_permalink() ?>"><img class="slideimg" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo get_image_url()?>&amp;h=300&amp;w=720&amp;zc=1" title="" alt="" /></a>
		</li>
		<?php endwhile; ?>
	</ul>
</div>
</div>