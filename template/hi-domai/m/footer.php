<footer>
<ul class="innerfooter">
    <li>
        <dl>
            <dt>News</dt>
<?php
latest_post(5,"news");
while(have_posts()){
 echo "<dd><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a>[".get_the_post_time()."]</dd>";
}
?>
        </dl>
    </li>
    <li>
        <dl>
            <dt>Successful Cases</dt>
<?php
rand_post(2,"case");
while(have_posts()){
   echo "<dd><a href=\"".get_the_post_link()."\"><amp-img src=\"".get_the_rand_image(get_the_post_link(),"/uploads/case/")."\" alt=\"".get_the_post_title()."\" width=\"170\" height=\"128\"></amp-img></a><a href=\"".get_the_post_link()."\">".get_the_post_title()."</a></dd>";
}
?>
        </dl>
    </li>
    <li>
        <h4>ABout Us</h4>
        <p>CamelWay founded in 1983, is a high-tech enterprise specialized in producing concrete mixers, concrete batching plants, stabilized soil equipment, sand aggregate equipment.  Over the past 30 years, the company has always been committed to providing safe and reliable equipment and quick and thoughtful service for the users, and has more than 10000 customers around the world, who come from China, Vietnam, Laos, Kazakhstan, Mongolia, Russia, Cuba, Brazil, Malaysia and other countries...</p>
        <p class="tel">Tel:+8618639554260</p>
        <p class="email">Email: zziavip@gmail.com</p>
    </li>
</ul>
<p class="copy">Copyright &copy;2018 Camelway Machinery</p>
</footer>
</body>
</html>
