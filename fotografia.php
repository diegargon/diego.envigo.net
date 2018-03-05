<?php
/* 
 *  Copyright @ 2017 Diego Garcia
 */

include("include/head.inc.php");
?>
<div class="blackdiv"></div>
<div class="wrapper_w100">
    <div class="default-slider">
        <ul>
         <li><img src="https://diego.envigo.net/photos/udra1.jpg" alt="Cabo Udra"></li>
        <li><img src="https://diego.envigo.net/photos/manzaneda1.jpg" alt="Manzaneda"></li>
        <li><img src="https://diego.envigo.net/photos/DSC_2040-4k.jpg" alt="Manzaneda"></li>
        <li><img src="https://diego.envigo.net/photos/DSC_2046.jpg" alt="Manzaneda"></li>
        <li><img src="https://diego.envigo.net/photos/DSC_1905-modA.jpg" alt="Manzaneda"></li>
        <li><img src="https://diego.envigo.net/photos/DSC_2023-ModB.jpg" alt="Manzaneda"></li>
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