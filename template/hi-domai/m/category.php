<?php get_header();?>
<div class="entry-content">
    <header class="page-header">
        <h1><?php the_category();?></h1>
    </header>
<?php
init_post();
while(have_posts()){
?>
        <article class="category-post-thumb-tiling">
            <header>
            <h2><a href="<?php the_amp_post_link()?>"><?php the_post_title();?></a></h2>
            </header>
            <figure>
                <a href="<?php the_amp_post_link()?>"><amp-img src="<?php the_rand_image(get_the_post_title())?>"  width="288" height="216" layout="responsive" alt="<?php the_post_title();?>"></amp-img></a>
                <figcaption><?php the_post_title();?></figcaption>
            </figure>
            <p><?php the_post_description();?></p>
        </article>
<?php
}
?>
</div>
<?php
get_sidebar();
?>
</main>
<?php get_footer();?>
