<?php get_header(); ?>
<div class="entry-content">
    <header class="page-header">
        <h1><?php the_title()?></h1>
    </header>
    <article class="single">
    <?php
        the_content();
    ?>
    </article>
<?php  comment_form(); ?>
</div>
<?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
