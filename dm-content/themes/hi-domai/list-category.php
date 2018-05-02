<?php
get_header();
?>
    <div class="entry-content">
        <header class="page-header">
        <h1><?php the_category();?></h1>
        </header>
<?php
init_post();
while(have_posts()){
?>
        <article class="category-post-thumb-list">
          <header>
            <h2><a href="<?php the_post_link()?>"><?php the_post_title();?></a></h2>
            </header>
            <figure>
                <img src="<?php the_rand_image(get_the_post_title())?>"  alt="<?php the_post_title();?>">
                <figcaption><?php the_post_title();?></figcaption>
            </figure>
            <p><?php the_post_description();?></p>
        </article>
<?php
}?>
        <nav class="paging">
            <?php the_paging_nav();?>
        </nav>
</div>
<?php
get_sider();
?>
</main>
<?php
get_footer();
?>
