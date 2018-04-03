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
        <p>Este articulo tratara de introducir al uso del chip ESP12-E en digamos "en crudo" no en una placa prehecha y información
            de los problemas que posiblemente tengáis si estáis acostumbrados a trabajar con las placas comunes de desarrollo y os pasais a
            fabricar la vuestra propia.
        </p>
        <p>
            ¿por que? bueno hay muchas razones pero la más básica y simple es que una vez tengamos nuestro dispositivo programado con la comodidad
            que dan dichas placas y queremos fabricar en masa, o simplemente reducir el tamaño, dichas placas ya no son convenientes y hay que diseñar
            la nuestra propia, aparte quizás ya no necesitaremos algo como el puerto usb para programarlo/depurarlo o los botones extra como boot.
        </p>
        <h2>Primeros detalles</h2>
        <p>Lo más básico y importante que viene en cada placa es lo siguiente:</p>
        <ul>
        <li>Conector USB, y chip USB->Serial</li>
        <li>Regulador 5v a 3.3v</li>
        <li>Botón reset y boot</li>
        <li>Interconexión de pines para el funcionamiento mínimo</li>
        </ul>
        <p>
            El conector usb y chip usb serial, nos permite conectar el ESP12-E de manera fácil
            y cómodamente a nuestro ordenador para programarlo y depurarlo, si no tuviera dicho chip y como en nuestro ejemplo no vamos a utilizarlo
            necesitaremos un cable/placa USB-TTL Serial para subir el programa. Personalmente utilizo uno basado en el chip CH340, adquirible por 
            ebay por uno o dos euros si optamos por la compra directa en china. Dichas placas/cables también vienen con convertidor 5v a 3.3v 
            para poder conectarlos sin freír los chips/placas que funciona a 3.3v, por lo que habrá que tener cuidado en no usar el pin marcado con 
            5v si vamos a  conectar directamente sin regulador. 
            En mi ejemplo, una vez programado la primera vez utilizando el cable USB-TTL, el dispositivo se actualizara vía 
            <a href="https://en.wikipedia.org/wiki/Over-the-air_programming" target="_blank">OTA</a> así que puedo prescindir del chip USB->Serial
        </p>
        <p>
        <img width="300px" src="<?= $cfg['IMG_PATH'] ?>/ch340-usb-to-ttl-serial-adaptor.jpg" alt="ch340-usb-to-ttl-serial-adaptor"/>
        Imagen de un convertidor USB-TTL CH340
        </p>
        <p>
            El regulador 5v a 3.3v si lo vamos a necesitar por lo que también lo añadiremos a nuestra placa, si bien el ESP12-E funciona con 3.3v 
            (incluso menos), tener 5v es conveniente por diversas razones, en el caso de mi dispositivo este va a estar alimentado por una batería 
            de 3.7v de tipo  18650, batería que en su plena carga tiene 4.2v lo cual posiblemente freiría nuestro dispositivo.
        </p>
        <p>
            Otra razón es que por comodidad tanto para los usuarios del dispositivo o para alimentación de este en nuestros proyectos, casi nadie 
            tiene una fuente de 3.3v pero si de 5v, en cuyo caso claro esta seria conveniente también añadir un conector micro-usb. 
            En mi caso el conector micro-usb lo contendrá el dispositivo de carga de la batería, y cargarlo va a ser la única razón para conectarlo.
            La placa encargada de controlar la carga ira en principio aparte con la batería, aunque igual cambio en el futuro eso integrando todo, 
            pero de momento por diferentes motivos me parece más conveniente tener separado las dos placas.
        </p>
        <p>
            Por ultimo, muchas placas accesorias, sensores, y otros funcionan con 5v, así que es razonable que en muchos casos nos resulte conveniente 
            alimentarlo con 5v y usar un regulador 3.3v para el ESP12-E y disponer de 5v, mucho más conveniente que alimentarlo con 3.3v y en caso 
            necesario tener que añadir un boost converter para tener los 5v
        </p>
        <p> Añadir y <b>advertir</b>, sobretodo a la gente que viene de placas tipo arduino UNO, es que casi todos los otros chips/placas, ya sea 
            ESP12-e, raspberry u otro funciona con lógica de 3.3v, debido al éxito de arduino hay multitud de sensores y accesorios que funciona 
            con lógica de 5v para conectarlo  al arduino UNO, si conectamos dichas placas al ESP12-E fundiremos las pines por lo que hay que conectar 
            entre medias un convertidor de lógica de 5v->3.3v.
        </p>
        <p>
        <img width="300px" src="<?= $cfg['IMG_PATH'] ?>/logic_converter.jpg" alt="logic_converter"/>
        Fotografía de un convertidor de lógica 5v/3.3v</p>
        <p>
            El botón de boot solo se utilizara para programar por lo que posiblemente podríamos también omitirlo si vamos a utilizar 
            <a href="https://en.wikipedia.org/wiki/Over-the-air_programming" target="_blank">OTA</a> y simplemente puentear 
            para quemar la primera imagen de alguna forma simple. 
            En las placas mencionadas ni siquiera es necesario utilizarlo por que ellas mismas cuando le damos a subir el programa simulan su 
            activación, cosa que seguramente sea cómodo implementar si queremos que los usuarios puedan actualizarlo fácilmente, aunque en mi 
            opinión es mejor y más cómodo la actualización <a href="https://en.wikipedia.org/wiki/Over-the-air_programming" target="_blank">OTA</a>.            
            El botón de reset puede ser útil pero generalmente con un botón de apagado y encendido es suficiente, simple, ahorra espacio y 
            componentes, apartemos mi dispositivo sera a prueba de agua y cuanto más simple mejor.
        </p>
        
        <h2>Placas para soldar</h2>
        <p>Aunque voy a crear la mía propia y de eso trata el articulo, hay placas para prototipos diferentes a las mencionadas que vienen sin chip
            y hay que añadir lo que queramos soldando, aprovecho aquí para hablar de una de las placas para soldar más comunes 
            para hacer prototipos. Es relevante mencionar que a pesar de la popularidad del chip del que estamos hablando, el ESP12-E no hay muchas 
            placas adecuadas  para el, o personalmente no encontré, y muy pocas aunque sean justas a buen precio, la más común y barata es la siguiente.
        </p>
        <p>
            Placa blanca standard para soldar
            <img width="300px" src="<?= $cfg['IMG_PATH'] ?>/ESP8266-ESP-12-Breakout.jpg" alt="ESP8266-ESP-12-Breakout"/>
        </p>
        <p>
            Dicha placa no es que sea especifica para el ESP12-E  pero se utiliza, como podéis observar el ESP12-E (no el de la foto de la placa) 
            tiene pines en la parte de abajo y dicha placa no los conecta, de todas formas es raro utilizar todos los pines y específicamente tener 
            que utilizar esos pines  por lo que puede ser una posibilidad de uso. Aparte como comentare más adelante algunos de esos pines no 
            se deberían usar.
        </p>
        <p>
            La placa tiene 3 resistencias SMD, y un conector por detrás para un regulador pequeño SMD. El 
            <a href="http://www.gy018.com/files856985665897965/productpdf/2011-7-26/201867155.pdf">7333A</a> encaja perfectamente, 
            el otro ampliamente utilizado y más potente es el <a href="http://www.ti.com/lit/ds/symlink/lm1117.pdf">LM1117-3.3</a> pero se queda 
            demasiado pequeño el hueco. 
        </p>
        <p>
            Se puede alimentar con 3.3v y sin regular así como esta simplemente haciendo uso de las entradas marcadas para VCC/GND <b>pero ojo</b>, si 
            conectamos el regulador y mandamos cinco o más voltios tenemos que quitar la resistencia del medio, dicha resistencia es de 0 ohmios 
            y actúa simplemente de puente para alimentar directamente con 3.3v, si no quitamos la resistencia y metemos 5v freiremos el chip.            
        </p>
        
        <p> Las otras resistencias es para conectar otros pines como el CH_PD o GPIO15 que es requerimiento para su funcionamiento, pero de los conexiones
        ya hablaremos, la cuestión es que quizás para una versión más antigua pudiera ser útil pero específicamente para el ESP12-E
        la placa no es suficientemente útil por que hay que emplazar componentes casi obligatorios o muy convenientes aparte de dos resistencias y 
        un regulador de voltaje como ya comentaré más adelante.
        </p>
        <p>
            Otra placa que se puede comprar por ebay entre 1€ y 2€ es la siguiente:            
        </p>
        <p><img width="300px" src="<?= $cfg['IMG_PATH'] ?>/esp12e-breakboard.jpg" alt="esp12e-breakboard"/></p>
        <p>
            Hay dos versiones para ESP12e y para el ESP32 (los pines no coinciden). Tiene muchas más posibilidades para crear un prototipo 
            pero la falta de conexiones  pre-hechas básicas y que son obligatorias como el caso del pin CH_PD a Vcc/3.3v, así como otras 
            personalmente me resultaría molesto pagar por algo que no tiene lo básico.
        </p>
        <p>
            Luego hay otras un poco más preparadas pero siguen siendo placas para prototipos muy standard, y mayormente como las mencionadas
            al principio del articulo, y esas ya son suficientes para el que empieza.
        </p>

        <h2>Al lió</h2>
        <p>
            Si buscamos por internet diagramas de conexionado del ESP12-E encontraremos varios, algunos más completos que otros pero ninguno totalmente
            funcional y robusto, al menos yo no encontré en su momento, y por eso me anime a escribir este articulo una vez tenía claro el tema y probar 
            diferentes formas con más o menos éxito utilizando partes de uno y de otro esquema, informarme por que algunos daban problemas, etc.
            Al final obtuve un diagrama a mi parecer bastante robusto, con toda seguridad no perfecto y con posibilidades de mejorarse sin duda 
            (mi email esta a pie de pagina para sugerencias).
        </p>
        <p>Los diagramas que veras están hechos con Eagle, no tengo apenas experiencia en utilizar dicha aplicación pero me pareció más cómoda que el 
            kicad, aunque el kicad tenia un par detalles que lo hacían mucho más interesantes, de todas formas me tiro para atrás la facilidad con 
            que se pasa de diagrama a la placa con Eagle. Algún día igual profundizo en el tema y posiblemente me quede con el KiCad pero ahora no 
            es el momento. El Eagle tiene versión gratuita limitada, completa de subscripción (15$/mes) y estudiantes que es la que utilizo yo. 
        </p>
        <h2>Pines GPIO Seguros</h2>            
        <p>
            El ESP12e tiene varios pines GPIO que se pueden utilizar pero no todos se pueden calificar como seguros, algunos se activan durante el arranque 
            y otros pueden activarse por diversas razones internas como se explicaran un poco más adelante.
            Los pines GPIO proporcionan un máximo de 12mA,  aunque leí por ahí que aceptaban picos de 20mA (no investigue el tema). En cualquier caso
            lo recomendado anda por 6mA.
        </p>
        <p>
            De todos los GPIO que tiene el ESP12E realmente los únicos totalmente seguros son los marcados como GPIO4, GPIO5, GPIO12,GPIO13 y GPIO14 los
            demás GPIO tiene sus peros cuando no son nada recomendables su uso o simplemente no se puede.
        </p>
        <p>
            Si vemos el chip de frente, en la parte inferior tenemos los pines del 9 al 14, dichos pines son utilizados para la conexión SPI y el GPIO9 y
            GPIO10 son utilizados para la memoria flash, alguna gente comenta que el GPIO10 es utilizable, otros que lo es pero que da problemas, así que
            esos pines los tachamos como no seguros por lo que evitaremos utilizarlos.
        </p>
        <p>
            Por lo demás empezaremos por el pin 1, etiquetado como RST (reset), el propósito de ese pin es evidente, reiniciar/resetear el chip. Normalmente 
            estará puesto a 1 y si queremos reiniciarlo hay que ponerlo a 0. Si hablamos del reset hay que hablar del pin GPIO16, este no esta mencionado 
            como seguro  por que durante el arranque esta a 1 por lo que puede activar algo sin ser deseable. También tiene otra función, si ponemos el chip
            "a dormir" (deep sleep) un tiempo para ahorrar batería, dicho pin quedara a 1 y cuando pase el tiempo enviara 0, si lo conectamos al reset  
            reiniciara el chip. Esto habrá que tenerlo en cuenta si queremos utilizarlo, en mi caso utilizare el deep sleep. Por lo demás aunque yo
            simplemente lo "enganchare" a Vcc con una resistencia aunque el esquema os muestre la conexión con botón añadido. 
        </p>
        <p><img width="300px" src="<?= $cfg['IMG_PATH'] ?>/reset.png" alt="esp12e-reset"/></p>
        <p>
            Los siguientes pines que nos encontramos es el ADC y el CH_PD, no tienen que ver uno con otro pero por simplicidad paso a comentar los dos, pero 
            primero el esquema relevante:
        </p>
        <p><img height="200px" src="<?= $cfg['IMG_PATH'] ?>/adc_chpd.png" alt="esp12e-adc-chpd"/></p>
        <p>
            El más rápido y sencillo de comentar es el CH_PD, es requerimiento para que arranque el ESP12E que este a 1 así que mediante una resistencia de
            10k lo que conectamos y listo.
        </p>
        <p>
            El ADC es como reza sus siglas un convertidor analógico a digital, de 10bits, los valores que entregaran van de 0 a 1024. Lo más importante comentar
            respecto a este pin es que es fácil dar por sentado que se le puede conectar una señal de hasta 3.3v, pero no es así, solo admite 1v, leyendo al
            principio vi comentarios de que algunos modelos si aceptaban 3.3v, pero incluso vi comentarios de gente que mencionaba que el ESP12-E admitía 3.3v,
            el datasheet es bastante claro, solo acepta 1v y probado efectivamente con 1v tenemos una lectura de 1024.
        </p>
        <p>
            Por lo que si queremos leer un valor de diferente voltaje deberemos trasladar ese voltaje a algo que no nos fría el pin, por ejemplo un divisor
            de tensión como en el ejemplo. Personalmente lo utilizare para leer el voltaje de la batería y el máximo valor que da cargada la batería que usare
            (18650) es 4.2 por lo que tendré que adecuar los valores de las resistencias del divisor de la tensión para que con 4.2v tenga un 1v en la 
            entrada del pin.
        </p>
        <p>Los siguientes pines GPIO{12,13,14} son como comente seguros</p>
        <p>Toca el turno al pin VCC, y ya que hablo del Vcc, damos por hablado del Gnd que no tiene ninguna historia más que conectarlo a negativo... pero 
            primero el esquema:
        <p><img height="200px" src="<?= $cfg['IMG_PATH'] ?>/esp12e-vcc.png" alt="esp12e-adc-chpd"/></p>     
        <p>La conexión Vcc es sencilla pero importante hacerla correctamente si no queremos tener problemas de estabilidad, y tener por seguro que los
            tendréis si no lo hacéis correctamente. Este punto muchos diagramas ya sea por olvido o por simplificar lo obvian. Como podéis ver hay dos 
            condensadores, dichos condensadores tiene que estar lo más cerca de la toma Vcc posible, la función del de 0.1uf es la del típico filtro, y 
            la función del de 470uf es el de estabilizador, este ultimo es bastante importante para la estabilidad y minimizar los problemas de los picos 
            de consumo  del ESP12e, sin  ese condensador nuestro ESP12e sera completamente inestable, sobretodo cuando arranque, o activamos el WIFI, con
            toda seguridad nos produciría constantes reseteos y excepciones aleatorias. Podríamos optar por uno de 100uf aunque lo recomendable es 220uf, 
            con 470uf aseguramos.
        </p>
        <p>
            Siguiendo tenemos los pines TX, RX, GPIO5 y GPIO4, no me parare en ellos, el RX/TX es donde debemos conectar nuestro USB-TTL serial para subir
            el programa y los GPIO son como ya mencione los seguros
        </p>
        <p>
            Del GPIO 0, 2 y 15 tiene una función conjunta y es referente a la programación del chip.
        </p>
        <p><img height="200px" src="<?= $cfg['IMG_PATH'] ?>/esp12e-flash.png" alt="esp12e-flash"/></p>
        <p>
            Esos 3 GPIOs determina el modo de arranque, si normal o para programarlo, el GPIO15 tiene que estar a 0 y el GPIO2 a alto y permanecerá a alto
            después de arrancar por eso no se puede considerar seguro su uso más que para su propósito. El GPIO0 es el que condiciona, si esta a 0 arrancara 
            en modo UART para flashear a través de los pines TX/RX y si esta a 1 arrancar de forma normal. A pesar que comente mi placa no llevara el botón
            de flash por que una vez grabada se actualizara vía OTA aquí os muestro como seria la conexión. Si no se quiere poner botón en el GPIO0 aunque
            arranque en modo normal hay que ponerlo a 1 con una resistencia de 10k, y que no permanezca  floating o indeterminado.
        </p>
        <p>Por lo demás así quedaría nuestro esquema de conexión del ESP12e básico, mínimo y estable</p>                    
            <p align="center"><img width="800px" src="<?= $cfg['IMG_PATH'] ?>/esp12e.png" alt="esp12e-esquema"/></p>
        
        <p>Más adelante quizás añada más información respecto a mi placa, como utilizo las GPIO disponibles, el diagrama y todos los archivos, aunque 
            sería información más especifica y quizás menos útil, de todos modos no es seguro que me pare.
        </p>
        <h2>Enlaces de interes</h2>
        <ul>
            <li><a href="https://www.espressif.com" target="_blank">Espressif Homepage</li>
            <li><a href="http://kicad-pcb.org/" target="_blank">Kicad</li>
            <li><a href="https://www.autodesk.com/products/eagle/overview" target="_blank">Autodesk Eagle</li>
            <li><a href="http://simba-os.readthedocs.io/en/latest/_images/esp12e-pinout.png" target="_blank">ESP12e pinout</a></li>
        </ul>
    </article>
</div>
<?php
include("" . $cfg['INC_PATH'] . "/profilebanner.inc.php");
include("" . $cfg['INC_PATH'] . "/footer.inc.php");
