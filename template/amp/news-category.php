<?php
get_header();
?>
    <div class="entry-content">
        <header class="page-header">
        <h1><?php the_category();?></h1>
        </header>
<ul class="pagelist">
<?php
init_post();
while(have_posts()){
?>
         <li><a href="<?php the_amp_post_link();?>"><?php the_post_title();?></a></li>
<?php
}?>
</ul>
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
