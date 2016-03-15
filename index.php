<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/unslider/unslider.css">
        <link rel="stylesheet" href="/unslider/unslider-dots.css">
        <link rel="stylesheet" href="http://diego.envigo.net/diegostyle.css">
        

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>  -->
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
                $('#phrase').toggle();
                $('#content').load("mygithub.html");
                });
            });
            $(document).ready(function(){
                $("#BtnPhotos").click(function(){
                    $('#phrase').toggle();
                    $('#content').load("unslider.html");
                });
            });

            
        </script>
            

        <title>Diego García Gonzalez</title>
    </head>
    <body>
        <div class="folio">
            
            <div class="linksmenu">
                <button id="BtnHome" class="navbtn">Home</button>  
                <button id="BtnSistemas" class="navbtn">Systems</button>  
                <button id="BtnGitHub" class="navbtn">GitHub</button>  
                <button id="BtnPhotos" class="navbtn">Photography</button> 
                <button id="BtnUE4" class="navbtn">Unreal Engine</button>  
            </div>
            
            
            <div class="profile">
                <div class="resume">
                    <p>Diego García Gonzalez</p>
                    <p><button id="MyEmail" class="btn">diego@envigo.net</button></p>
                    <p>Programmer, design, systems and a little else.</p>
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
     
     
     <div id="content">
         
         <div class="wrapper_w100">
             <div class="maincolumn">
                 <div id="col1" class="maincolumn_text">
                 <p class="col_title">WELCOME!</p>
                 <p>Hello! I'm a developer, designer, hobbyst photographer. I'm based in Vigo (Spain). 
                     I spend my time designing webs and 3D assets developing games demos and virtual reality experiences.
                     When i get up from the chair i enjoy walking throught the woods and the spanish coast with my dog. 
                     My english ins't good enough so excuse my mistakes and hope you found something interesting in my site!
                 </p>
                 </div>
                 
             </div>
             <div class="maincolumn">
                 <div id="col2" class="maincolumn_text">
                 <p class="col_title">LATEST NEWS</p>
                 <ul>
                     <li>[14/03/2016] I begin doing this homepage</li>                 
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
