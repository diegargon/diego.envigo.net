<!--
 Copyright @ 2016 Diego Garcia
-->


<?php


?>
 
<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/unslider/unslider.css">
        <link rel="stylesheet" href="/unslider/unslider-dots.css">
        <link rel="stylesheet" href="css/diegostyle.css">
        <link rel="stylesheet" href="css/mobile.css">
        <link rel="stylesheet" href="css/thirdparty.css">
        <link rel="stylesheet" href="css/octicons/octicons.css">
        <link rel="stylesheet" href="css/git.css">

        
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="/unslider/unslider-min.js"></script>
       
       
        <script>
            /* Button mail */
            $(document).ready(function(){
                $("#MyEmail").click(function(){
                    window.location.href = "mailto:diego@envigo.net?subject=Personal%20Webpage&body=";
                
                });
            });

            /* Navigation Buttons */

            $(document).ready(function(){
                $("#BtnHome").click(function(){
                    window.location='http://diego.envigo.net';
                });
            });
            
            $(document).ready(function(){
                $("#BtnGitHub").click(function(){
                    $('#loading_wrap').show();
                    $('#phrase').hide();
                    $('#content_down').hide();
                
                    /* $('#content_up').text("Wait..."); */               
                   $('#content_up').load("git.php");
                   
                });
            });
            $(document).ready(function(){
                $("#BtnSystems").click(function(){
                    
                    $('#phrase').hide();
                    $('#content_down').hide();
                    $('#content_up').load("systems.html");
                });
            });            
            $(document).ready(function(){
                $("#BtnPhotos").click(function(){
                    $('#phrase').hide();
                    $('#content_down').hide();
                    $('#content_up').load("unslider.html");
                });
            });
            $(document).ready(function(){
                $("#BtnMoto").click(function(){
                    $('#phrase').hide();
                    $('#content_down').hide();
                    $('#content_up').load("motorcycles.html");
                });
            });
            $(document).ready(function(){
                $("#BtnYoutube").click(function(){
                    $('#phrase').hide();
                    $('#content_down').hide();
                    $('#content_up').load("Youtube.html");
                });
            });
            
        </script>
            

        <title>Diego García Gonzalez</title>
    </head>
    <body>
        
        
        <div class="folio">
            <div id='loading_wrap' class="loading"></div>   
            <div class="linksmenu">
                <button id="BtnHome" class="navbtn navbtn_first homebtn"><img width="14" height="10" src="images/home.png"></button>  
                <button id="BtnSystems" class="navbtn">Systems</button>  
                <button id="BtnPhotos" class="navbtn">Photography</button> 
                <button id="BtnYoutube" class="navbtn">Youtube</button>
                <button id="BtnWebDesign" class="navbtn">Web Design</button>
                <button id="BtnMoto" class="navbtn">Motorcycles</button>  
                <button id="BtnGitHub" class="navbtn navbtn_last">GitHub</button>  
            </div>
            
            <div id="content_up">
                              
            </div>
            
            
            <div class="profile">
                <div class="resume">
                    <p>Diego García Gonzalez</p>
                    <p><button id="MyEmail" class="btn">diego@envigo.net</button></p>
                    <p>Developer, designer, systems and a little else.</p>
                </div>
                
                <div class="photo">
                <img alt="Diego García Gonzalez"  src="images/Mifoto_Desktop.png">
                </div>
            </div>

  <!-- 
        <div class="main_text"><br/>Diego García Gonzalez</div>
     -->
     <div id="phrase" class="wrapper_w100">
         <div class="bottombanner">
             <p>“In expanding the field of knowledge we but increase the horizon of ignorance.”
― Henry Miller</p>
        </div>
     </div>
     
     
     <div id="content_down">
         
         <div class="wrapper_w100">
             <div class="maincolumn">
                 <div id="col1" class="maincolumn_text">
                 <p class="col_title">WELCOME!</p>
                 <p>Hello! I'm a developer, system administrator (linux), and designer. I like repairing motorcycles, make small electronic projects and recently begin 
                     learning photography. I'm based in Vigo (Spain). 
                     I spend my time designing 3D assets, webs,  developing games demos and virtual reality experiences.
                     When i get up from the chair i enjoy walking throught the woods or the spanish coast with my dog and ride my motorcycle. 
                     My english ins't good enough so excuse my mistakes and hope you found something interesting in my site!
                 </p>
                 </div>
                 
             </div>
             <div class="maincolumn">
                 <div id="col2" class="maincolumn_text">
                 <p class="col_title">LATEST NEWS</p>
                 <ul>
                     <li>[14/03/2016] I begin doing this homepage </li>                 
                 </ul>
                 </div>
             </div>
            <div  class="maincolumn">
                <div id="col3" class="maincolumn_text">
                 <p class="col_title">LATEST LINKS I ENJOY</p>
                 <ul>
                     <li><a href="https://github.com/ssloy/tinyrenderer/wiki">How OpenGL works</a></li>
                     <li><a href="http://buildnewgames.com/gamephysics/">How Physics engine works</a></li>
                     <li><a href=""></a></li>
                 </ul>                         
                </div>
             </div>
        </div>
         
     </div>
     <div class="footer">
         <br/> 
         <p>Copyright @ 2016 Diego García</p>
     </div>
        
        </div>

    </body>
</html>


