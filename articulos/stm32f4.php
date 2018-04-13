<?php
/*
 *  Copyright @ 2017 Diego Garcia
 */
include("../config/config.php");
include("" . $cfg['INC_PATH'] . "/head.inc.php");
?>

<div class="blackdiv"></div>
<div class="wrapper_w100_padding">
    <div class="fechas">
        <p>Fecha creación: 13 Abril 2018</p>
        <p>Fecha actualización: 13 Abril 2018 </p>
        <p>Dependiendo de las fechas este articulo puede estar obsoleto o parcialmente obsoleto</p>
    </div>
    <article class="gen_article">
        <h1>Primer contacto con la placa STM32F4XX  (Black Board)</h1>    
        <p>La placa STM32F4xx, es una placa de pruebas basadas en los chips STM32F4.
        </p>
        <p>
            Recientemente cayó en mi poder una y aunque por cuestiones de tiempo aun no me voy a parar con ella,
            no me pude resistir a ver sus posibilidades y escribir un poco sobre ella, aunque espero poder
            ponerme en el futuro y profundizar en ella.

        </p>
        <h2>La placa</h2>
        <p>
            La placa es pequeña, similar a una arduino UNO pero mucho más potente, de precio muy contenido 
            (actualmente 8€ en ebay enviado desde china). 
        </p>
        <p>
            Hay unas cuantas variantes la mía es la que viene con:
        <ul>
            <li>RTC (pila CR1220-3v incluida) y oscilador 8MHz</li>
            <li>Slot para tarjeta mini SD</li>
            <li>Mini-USB - USB Serial (VCP)</li>
            <li>4 botones</li>
            <li>Memoria Flash</li>
            <li>Conector J-TAG/DBG</li>
            <li>Conector para modulo NRF24L01</li>
            <li>Conector TFT (16 pin + SPI para tactil)</li>
            <li>3 leds</li>
            <li>Memoria flash adicional 16mbit en SPI1 compartido con el conector NRF2401 (Winbond W25Q16) </li>
            <li>78 pinouts tipicos de propositio varios/general</li>
        </ul>
        </p>
        <p><img width="400" src="<?= $cfg['IMG_PATH'] ?>/F4VET6board"/></p>
        <p>Hay varias variantes del MCU STM32F407 en el caso de la black board, en estos momentos al menos lleva el STM32F407VET6</p>
        <p>Advertencia: algunas lotes de estas placas vienen por error con unas resistencias SMD de 22k (223) en vez de 22 Ohmios
            (220) en el USB lo que impide su funcionamiento más que para alimentarla y arrancarlaV (no en mi caso).
        </p>
        <p>
            El conector usb es mini no el tipico micro-usb utilizado por moviles, si no el antiguo más alto. 
        </p>
        <p>El kit viene con un cable mini-usb -> usb varios cables dupont femia/femia y un par de jumpers</p>
        <h2>La CPU</h2>
        <p>Como mencione, esta placa suele venir con la MCU+FPU STM32F407VET6, sus caracteristicas principales son:                    
        </p>
        <p><ul>
            <li> ARM Cortex-M4 32it</li>
            <li>168Mhz / 210DMIPS</li>
            <li>Flash 512kb</li>
            <li>Ram interna 192kb</li>
            <li>12+2 timers 16/32 bit, 2x Watchdogs</li>
            <li>Ethernet</li>
            <li>USB OTG HS/FS *</li>            
            <li>16x12-bit 2.4MSPS A/D (7.2MSP intercalados)</li>
            <li>2x12-bit D/A Converter</li>
            <li>DSP</li>
            <li>Bus: 3xI2C, 3xSPI, 2xI2S, 2xCan</li>
            <li>4xUSART, 2xUART</li>
            <li>1.8/3.6v</li>            
        </ul></p>
        <p>
            El puerto USB es Full Speed (12mbps) no viene preparado para High Speed (480mbps) aunque si es posible obtener HS 
            conectando al interface ULPI un dispositivo <a href="https://es.wikipedia.org/wiki/PHY_(circuito_integrado)">PHY</a>

        </p>

        <h2>Flashing</h2>
        <p>
            Para subir nuestro programa hay varias opciones, las más basicas son via serial, o via STLink V2 que es el adaptador tipico de los STM32. 
            El metodo STLink es el recomendado y el que al parecer no da problemas, al contrario que el serial. En ebay se encuentra el programador
            STLink V2 importado por dos euros y es el que yo utilizare con toda probabilidad cuando me ponga. No puedo hablar mucho más sobre esto
            hasta que me ponga así que hago alto aquí y lo dejo para futuros articulos.
        </p>
        <h2>Programación</h2>
        <p>
            En la pagina web del producto existen IDE, librerias y un largo etc de software, tambien hay iniciativas de usuarios que han añadidor soporte  
            al Arduino IDE para programar los chips STM32. No tiene soporte por defecto hay que descargarse de github todo lo necesario para añadir el
            soporte al Arduino IDE. Como en el caso de "Flashing" dejo este tema para futuros articulos cuando me meta en serio, lo que tengo claro ya
            es que si bien para programar algo sencillo y rapido el Arduino IDE y sus librerias son unas magnificas aliadas, para este placa/mcu que 
            supera con creces la potencia y opciones de las tipicas placas arduino se que me quedaría cojo, sobretodo metiendole mano a los ADC/DAC como
            pretendo.
        </p>
        <h2>Futuro</h2>
        <p>Tengo pensado meterme cuando pueda en esta placa a fondo, principalmente para "tocar" sus ADC/DAC y funciones DSP por lo que en el futuro (no a corto
            plazo seguramente escriba algo más util y profundice en la programación de esta placa</p>
        <p>Referencias y enlaces de interés:
        <ul>
            <li><a href="http://www.st.com/resource/en/datasheet/stm32f405rg.pdf">STM32F405xx/STM32F407xx Datasheet</a></li>
            <li><a href="http://wiki.stm32duino.com/index.php?title=STM32F407">SMT32duino</a></li>
        </ul>
        </p>
    </article>
</div>


<?php
include("" . $cfg['INC_PATH'] . "/profilebanner.inc.php");
include("" . $cfg['INC_PATH'] . "/footer.inc.php");


