<?php

/* 
 *  Copyright @ 2017 Diego Garcia
 */
include("config/config.php");
include("".$cfg['INC_PATH']."/head.inc.php");
?>

<div class="blackdiv"></div>
<div class="wrapper_w100_padding">
    <div class='textcenter'>
        <p>
            Aquí encontraras algunos videos de mis trabajos en 3D. En la esquina superior derecha puedes acceder a la lista de reproducción.
        </p>
        <p> 
            Here you can find some public videos of my work. In the video, at the top right corner you can access to the playlist or simple click <a rel="nofollow" href="https://www.youtube.com/watch?list=PLedhcphOZyVwUa9oYyaicdolNGkfXNXvG&v=zQwyuig8UX0" target=_blank>here</a> for open in a new window.
        </p>
    </div>
        
   <div class="youtube-video"> 
       <div>
            <iframe
                src="https://www.youtube.com/embed/videoseries?list=PLedhcphOZyVwUa9oYyaicdolNGkfXNXvG&showinfo=1&rel=0" frameborder="0" allowfullscreen>            
               </iframe>
       </div>
   </div> 
</div>


<?php

include("include/profilebanner.inc.php");

include("include/footer.inc.php");