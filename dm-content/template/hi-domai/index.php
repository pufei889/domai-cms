<?php
get_header();
?>
    <div class="banner">
        <img src="/template/images/banner.jpg" alt="">
    </div>
    <ul class="products">
        <li>
            <a href="/batching-plant/"><img src="/uploads/batching-plant.jpg" alt="concrete batching plant" title="for ready mixed concrete, precast, etc."></a>
            <dl>
                <dt><a href="/batching-plant/">Concrete Batching Plant</a></dt>
<?php
rand_post(8,"batching plant");
while(have_posts()){
              echo "<dd><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></dd>";
}
?>
            </dl>
        </li>
        <li>
            <a href="/mixing-plant/"><img src="/uploads/rcc-plant.jpg" alt="Continuous Mixing Plant" title="for Roller Compacted Concrete, Stabilized Soil Application in Paving and dam construction"></a>
            <dl>
                <dt><a href="/mixing-plant/">Continuous Mixing Plant</a></dt>
<?php
rand_post(8,"mixing plant");
while(have_posts()){
              echo "<dd><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></dd>";
}
?>
            </dl>
        </li>

        <li>
            <a href="/mobile-crushing-plant/"><img src="/uploads/mobile-crusher.jpg" alt="Mobile Crushing Plant" title="Mobile Stone Crushing Plant, for Aggregate or Manufacured Sand"></a>
            <dl>
                <dt><a href="/mobile-crushing-plant/">Mobile Crushing Plant</a></dt>
<?php
rand_post(8,"mobile crushing plant");
while(have_posts()){
              echo "<dd><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></dd>";
}
?>
            </dl>
        </li>

        <li>
            <a href="/crushing-plant/"><img src="/uploads/crushing-plant.jpg" alt="Stone Crushing Plant" title="Stone Crusher and Stone Crushing Plant for Aggregate, Sand and Mining."></a>
            <dl>
                <dt><a href="/crushing-plant/">Stone Crushing Plant</a></dt>
<?php
rand_post(8,"crushing plant");
while(have_posts()){
              echo "<dd><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></dd>";
}
?>
            </dl>
        </li>
    </ul>
</main>
<?php
get_footer();
?>
