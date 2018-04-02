<?php
/* 
 *  Copyright @ 2017 Diego Garcia
 */
include("include/head.inc.php");
?>

<div class="blackdiv"></div>
<div class="wrapper_w100_padding">
    <p>Fecha creacion: Julio 2016 - Dependiendo de la fecha puede estar obsoleto o parcialmente obsoleto </p>
    <h1>Orange PI</h1>
    <p>La Tarjeta <a href="http://orangepi.org">Orange Pi</a> es una tarjeta similar y compatible con la <a href="https://www.raspberrypi.org">Raspberry PI</a>, tiene diferentes
        versiones como podéis ver en su pagina web, por lo general son más baratas.                
    </p>
    <p>
        Recientemente he necesitado utilizar una, específicamente una Orange PI Lite, precio muy asequible y incluye WIFI, la única limitación a tener en cuenta dentro de 
        las limitaciones comunes de este tipo de mini ordenadores es que este modelo no cuenta con un puerto ethernet. Tiene un par de inconvenientes más y es que necesita una fuente de
        alimentación de 5v con 2 amperios que sea bastante estable si nos puede dar problemas. La otra cosa problemática es una tarjeta micro SD buena, recomiendan una clase 10 pero personalmente 
        comprobé que algunas clase 4 funciona y otras clase 10 no funcionan, así que toca probar, si no te arranca es que probablemente sea una de esas dos cosas, personalmente 
        me encontré con dos tarjetas que no arrancaba (clase 4 y 10) y ningún problema con la fuente de alimentación. Aveces el problema es el cable de alimentación USB, algunos cables son demasiado finos
        y tienen una caida de voltaje en el extremo pequeña pero significativa provocando problemas debido a la demanda y la poca sección</p>
    <p>
        Sobre tarjetas hablan bien de las Samsung EVO, yo probe dos y las dos funcionarión. Este modelo también tienen la limitación de un máximo 32GB de capacidad,
        cosa que no debería ser grave para la mayoría.
    </p>
    <div class="blockquote_center">
    <blockquote>
        <h2>¿que significa clase 4 o clase 10 en una tarjeta sd? </h2>
        Las diferentes clases de las tarjetas SD simplemente hacen referencia a la velocidades de estas. 
        <ul>
            <li>Clase 1 = 1 MB/s</li>
            <li>Clase 2 = 2 MB/s</li>
            <li>Clase 10 = 10 MB/s</li>
        </ul>
        Las clase 10 son ideales y muy usadas para cámaras de fotos de alta resolución  y vídeos 1080p , aunque actualmente muchas superan esa velocidad.
        Hoy en día también hay otra clase que son  UHC y vienen marcado por el numero dentro de U:
                <ul>
            <li>Clase 1U = 10 MB/s</li>
            <li>Clase 2U = 20 MB/s</li>
            <li>Clase 3U = 30 MB/s</li>
        </ul>        
    </blockquote>        
    </div>
    <p>
        En cualquier caso aparte de la velocidad hay que tener cuenta la calidad, al parecer que muchas tarjetas standard (sin marca o marca rara) suelen dar problemas        
    </p>
    <p>
        En la pagina web podéis encontrar imágenes que escribir en la tarjetas para arrancar vuestra Orange PI, dichas imágenes son de las distribuciones Raspbian, Lubuntu y Armbian
        . Personalmente me decante por Armbian.
    </p>
    <p>
        Tuve que construir una distribución basada en Armbian con paquetes extra y de paso ya que tenia todo el toolchain construí las imágenes básicas, sin paquetes añadidos, cambiando solamente 
        el lenguaje a es_ES@UTF-8 y el teclado al español, os dejo el enlace a para descargas en una cuenta mega.co.nz. (Elimanado enlaces por anticuados)
    </p>
    <ul>
        <li>Orange PI Lite Debian Jessie 3.4.112 (Solo consola)</li> 
        <li>Orange PI Lite Ubuntu Xenial 3.4.112 (Escritorio)</li>
        <li>Orange PI One Ubuntu Xenial 3.4.112 (Escritorio)</li>
        <li>Orange PI PC PLUS Ubuntu Xenial 3.4.112 (Escritorio</li>
    </ul>
    
    <p>Todos tienen el legacy kernel ya que con el vanilla si bien esta más actualizado se pierde la aceleración de vídeo</p>
    <p>De momento nada más</p>
</div>


<?php

include("include/profilebanner.inc.php");

include("include/footer.inc.php");


