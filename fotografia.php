<?php

/* 
 *  Copyright @ 2016 Diego Garcia
 */

include("include/head.inc.php");
?>
<div class="blackdiv"></div>
<div class="wrapper_w100">
    <div class="default-slider">
        <ul>
         <li><img src="http://diego.envigo.net/photos/udra1.jpg" alt=""></li>
        <li><img src="http://diego.envigo.net/photos/manzaneda1.jpg" alt=""></li>
	</ul>
    </div>

    <script>
    $('.default-slider').unslider({
        autoplay: true,  
        delay: 9000,
        speed: 750
    });
    </script>
</div>

<?php

include("include/profilebanner.inc.php");

include("include/footer.inc.php");