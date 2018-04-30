<?php
get_header();
?>
<div class="banner">
        <amp-img src="/template/images/banner.jpg" width="1200" height="392" layout="responsive"></amp-img>
</div>
<ul class="products">
    <li>
        <a href="/batching-plant/"><amp-img src="/uploads/batching-plant.jpg" width="600" height="380" layout="responsive" alt="concrete batching plant" title="for ready mixed concrete, precast, etc."></amp-img></a>
        <dl>
            <dt><a href="/batching-plant/">Concrete Batching Plant</a></dt>
<?php
latest_post(8,"batching plant");
while(have_posts()){
    echo "<dd><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></dd>";
}
?>
        </dl>
    </li>
    <li>
        <a href="/mixing-plant/"><amp-img src="/uploads/rcc-plant.jpg" width="600" height="380" layout="responsive" alt="Continuous Mixing Plant" title="for Roller Compacted Concrete, Stabilized Soil Application in Paving and dam construction"></amp-img></a>
        <dl>
            <dt><a href="/mixing-plant/">Continuous Mixing Plant</a></dt>
<?php
latest_post(8,"mixing plant");
while(have_posts()){
    echo "<dd><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></dd>";
}
?>
        </dl>
    </li>

    <li>
        <a href="/mobile-crushing-plant/"><amp-img src="/uploads/mobile-crusher.jpg" width="600" height="380" layout="responsive" alt="Mobile Crushing Plant" title="Mobile Stone Crushing Plant, for Aggregate or Manufacured Sand"></amp-img></a>
        <dl>
            <dt><a href="/mobile-crushing-plant/">Mobile Crushing Plant</a></dt>
<?php
latest_post(8,"mobile crushing plant");
while(have_posts()){
    echo "<dd><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></dd>";
}
?>
        </dl>
    </li>

    <li>
        <a href="/crushing-plant/"><amp-img src="/uploads/crushing-plant.jpg" width="600" height="380" layout="responsive" alt="Stone Crushing Plant" title="Stone Crusher and Stone Crushing Plant for Aggregate, Sand and Mining."></amp-img></a>
        <dl>
            <dt><a href="/crushing-plant/">Stone Crushing Plant</a></dt>
<?php
latest_post(8,"crushing plant");
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
