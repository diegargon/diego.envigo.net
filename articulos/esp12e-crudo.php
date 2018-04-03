<?php
/*
 *  Copyright @ 2017 Diego Garcia
 */
include("../config/config.php");
include("" . $cfg['INC_PATH'] . "/head.inc.php");
?>

<div class="blackdiv"></div>
<div class="wrapper_w100_padding">
    <p>Fecha creación: Abril 2018 - Dependiendo de la fecha puede estar obsoleto o parcialmente obsoleto </p>
    <p><b>Articulo en desarrollo</b></p>
    <article class="gen_article">
        <h1>ESP12-E en crudo</h1>
        <div align="center"><img width="300px" src="<?= $cfg['IMG_PATH'] ?>/esp12.jpg" alt="ESP12-E"/></div>
        <h2>ESP12-E Introducción</h2>
        
        <p>
            Normalmente lo más comodo para empezar a programar con esp8266 o alguna de sus variantes es utilizar una placa de desarrollo
            tipo 
            <a href="http://www.nodemcu.com/index_en.html" target="_blank">NodeMCU</a>, 
            <a href="https://wiki.wemos.cc/products:lolin32:lolin32" target="_blank"> Lolin32</a> 
            o similar, dichas placas vienen preparadas con lo básico para poder conectarlas al puerto USB y ponernos a trastear sin tener que
            construir nosotros una placa y soldar el chip principal u otros complicaciones.
        </p>
        <p>Este articulo tratara de introducir al uso del chip ESP12-E en digamos "en crudo", creando nuestra propia placa y información
            de los problemas que posiblemente tengáis si estáis acostumbrados a trabajar con las placas comunes de desarrollo
        </p>
        <p>
            ¿por que? bueno hay muchas razones pero la más básica y simple es que una vez tengamos nuestro dispositivo programado con la comodidad
            que dan dichas placas y queremos fabricar en masa, o simplemente reducir el tamaño, dichas placas ya no son convenientes y hay que diseñar
            la nuestra propia, aparte quizás ya no necesitaremos algo como el puerto usb para programarlo/depurarlo o los botones extra como boot.
        </p>
        <h2>Primeros detalles</h2>
        <p>Lo más básico he importante que viene en cada placa es lo siguiente:</p>
        <li>Conector USB, y chip USB->Serial</li>
        <li>Regulador 5v a 3.3v</li>
        <li>Botón reset y boot</li>
        <li>Interconexión de pines para el funcionamiento mínimo</li>

        <p>
            El conector usb y chip usb serial, nos permite conectar el ESP12-E de manera fácil
            y cómodamente a nuestro ordenador para programarlo y depurarlo, si no tuviera dicho chip y como en nuestro ejemplo no vamos a utilizarlo
            necesitaremos un cable/placa USB-TTL Serial para subir el programa. Personalmente utilizo uno basado en el chip CH340, adquirible por ebay por 
            uno o dos euros si optamos por la compra en china directamente. Dichas placas/cables también vienen con convertidor 5v a 3.3v para poder 
            conectarlos sin freír los chips/placas que funciona a 3.3v, por lo que habrá que tener cuidado en no usar el pin marcado con 5v si vamos a 
            conectar directamente sin regulador. 
            En mi ejemplo, una vez programado la primera, utilizando el cable USB-TTL, el dispositivo se actualizara vía 
            <a href="https://en.wikipedia.org/wiki/Over-the-air_programming" target="_blank">OTA</a> así que puedo prescindir del chip USB->Serial
        </p>
        <p>
        <img width="300px" src="<?= $cfg['IMG_PATH'] ?>/ch340-usb-to-ttl-serial-adaptor.jpg" alt="ch340-usb-to-ttl-serial-adaptor"/>
        Imagen de un convertidor USB-TTL CH340
        </p>
        <p>
            El regulador 5v a 3.3v si lo vamos a necesitar por lo que también lo añadiremos a nuestra placa, si bien el ESP12-E funciona con 3.3v (incluso menos), 
            tener 5v es conveniente por diversas razones, en el caso de mi dispositivo este va a estar alimentado por una batería de 3.7v de tipo 
            18650, batería que en su plena carga tiene 4.2v y posiblemente freiría nuestro dispositivo.
        </p>
        <p>
            Otra razón es que por comodidad tanto para los usuarios del dispositivo o para alimentación de este en nuestros proyectos, casi nadie tiene una 
            fuente de 3.3v pero si de 5v, en cuyo caso claro esta seria conveniente también añadir un conector micro-usb. 
            En mi caso el conector micro-usb lo contendrá el dispositivo de carga de la batería, y cargarlo va a ser la única razón para conectarlo. La placa encargada
            de controlar la carga ira en principio aparte con la batería, aunque igual cambio en el futuro eso integrando todo, pero de momento por
            diferentes motivos me parece más conveniente tener separado las dos placas.
        </p>
        <p>
            Por ultimo, muchas placas accesorias, sensores, y otros funcionan con 5v, así que es razonable que en muchos casos nos resulte conveniente 
            alimentarlo con 5v y usar un regulador 3.3v para el ESP12-E y disponer de 5v, mucho más conveniente que alimentarlo con 3.3v y en caso 
            necesario tener que añadir un boost converter para tener los 5v
        </p>
        <p> Añadir y <b>advertir</b>, sobretodo a la gente que viene de placas tipo arduino UNO, es que casi todos los otros chips/placas, ya sea ESP12-e, 
            raspberry u otro funciona con lógica de 3.3v, debido al éxito de arduino hay multitud de sensores y accesorios que funciona con lógica de 5v 
            para conectarlo  al arduino UNO, si conectamos dichas placas al ESP12-E fundiremos las pines por lo que hay que conectar entre medias un 
            convertidor de lógica de 5v->3.3v.
        </p>
        <p>
        <img width="300px" src="<?= $cfg['IMG_PATH'] ?>/logic_converter.jpg" alt="logic_converter"/>
        fotografía de un convertidor de lógica 5v/3.3v</p>
        <p>
            El botón de boot solo se utilizara para programar por lo que posiblemente podríamos también omitirlo si vamos a utilizar 
            <a href="https://en.wikipedia.org/wiki/Over-the-air_programming" target="_blank">OTA</a> y simplemente puentear 
            para quemar la primera imagen. 
            En las placas mencionadas ni siquiera es necesario utilizarlo por que ellas mismas cuando le damos a subir el programa simulan su activación, cosa
            que seguramente sea cómodo implementar si queremos que los usuarios puedan actualizarlo fácilmente, aunque en mi opinión es mejor y más cómodo
            la actualización <a href="https://en.wikipedia.org/wiki/Over-the-air_programming" target="_blank">OTA</a>.            
            El botón de reset puede ser útil pero generalmente con un botón de apagado y encendido es suficiente, simple, ahorra espacio y componentes, apartemos
            mi dispositivo sera a prueba de agua y cuanto más simple mejor.
        </p>
        
        <h2>Placas para soldar</h2>
        <p>Aunque voy a crear la mia propia aprovecho para hablar de una de las placas para soldar más comunes, es relevante mencionar que a pesar 
           de la popularidad del chip del que estamos hablando, el ESP12-E no hay muchas placas adecuadas para el, o personalmente no encontre, y muy pocas
           aunque sean justas a buen precio, la más común y barata es la siguiente.
        </p>
        <p>
            Placa standard para soldar
            <img width="300px" src="<?= $cfg['IMG_PATH'] ?>/ESP8266-ESP-12-Breakout.jpg" alt="ESP8266-ESP-12-Breakout"/>
        </p>
        <p>
            Dicha placa no es que sea especifica para el ESP12-E  pero se utiliza, como podéis observar el ESP12-E (no el de la foto de la placa) tiene pines en la 
            parte de abajo y dicha placa no los conecta, de todas formas es raro utilizar todos los pines y específicamente tener que utilizar esos 
            pines por lo que puede ser una posibilidad de uso.
        </p>
        <p>
            La placa tiene 3 resistencias, y un conector por detrás para un regulador pequeño SMD, el 
            <a href="http://www.gy018.com/files856985665897965/productpdf/2011-7-26/201867155.pdf">7333A</a> encaja perfectamente, 
            el otro ampliamente utilizado y más potente es el <a href="http://www.ti.com/lit/ds/symlink/lm1117.pdf">LM1117-3.3</a> pero se queda demasiado 
            pequeño el hueco. 
        </p>
        <p>
            Se puede alimentar con 3.3v y sin regular así como esta simplemente haciendo uso de las entradas marcadas para VCC/GND pero ojo, si 
            conectamos el regulador y mandamos cinco o más voltios tenemos que quitar la resistencia del medio, dicha resistencia es de 0 ohmios y actúa
            simplemente de puente para alimentar directamente con 3.3v, si no quitamos la resistencia y metemos 5v freiremos el chip.            
        </p>
        
        <p> Las otra resistencia es para conectar otros pines como el CH_PD que es requerimiento para su funcionamiento, pero de los conexiones
        ya hablaremos, la cuestión es que quizás para una versión más antigua pudiera ser útil pero específicamente para el ESP12-E
        la placa no es suficientemente útil por que hay que emplazar componentes extra obligatorios y muy convenientes aparte de dos resistencias y 
        un regulador de voltaje como ya comentaría más adelante.
        </p>

        
        <p><b>CONTINUARA</b></p>
    </article>
</div>
<?php
include("" . $cfg['INC_PATH'] . "/profilebanner.inc.php");
include("" . $cfg['INC_PATH'] . "/footer.inc.php");
