<?php
/* 
 *  Copyright @ 2017 Diego Garcia
 */
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Pagina web personal diegargorn (Diego García)">
        <meta name="keywords" content="HTML,css, iot, unreal engine, linux, sql, embed">
        <link rel="stylesheet" href="/unslider/unslider.css">
        <link rel="stylesheet" href="/unslider/unslider-dots.css">
        <link rel="stylesheet" href="css/diegostyle.css">        
        <link rel="stylesheet" href="css/thirdparty.css">
        <link rel="stylesheet" href="css/octicons/octicons.css">
        <link rel="stylesheet" href="css/git.css">
        <link rel="stylesheet" href="css/mobile.css">
        
        <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="/unslider/unslider-min.js"></script>
       
        <script>

            $(document).ready(function(){
                $("#BtnGitHub").click(function(){
                    $('#loading_wrap').show();
                    $('#phrase').hide();
                    $('#content_down').hide();
                
                    /* $('#content_up').text("Wait..."); */               
                   $('#content_up').load("git.php");
                   
                });
            });
  
        </script>
            

        <title>Diego García Gonzalez</title>
    </head>
    <body>
        <div class="wrap_center">

        <div class="folio">
            <div id='loading_wrap' class="loading"></div>  
<?php
        include("include/menu.inc.php");
?>

            <div id="content_up">
                              
            </div>
            