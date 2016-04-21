<?php

/* 
 *  Copyright @ 2016 Diego Garcia
 */


include("include/head.inc.php");

?>



<div class="blackdiv"></div>

<div class="wrapper_w100_padding">
    
    <article class="gen_article">
        <h1>IoT (Internet of Things / Internet de las cosas)</h1>
        <h2>Escrito 1: Iniciando</h2>
        <p>Recientemente decidí ponerme un poco al tanto de esta  tecnología que cada vez está más en auge, y aprovechar para hacer un 
            par de proyectos que tengo en mente relacionados.
        </p>
        <p>Los proyectos finales van a ser en mayor parte “close source”  pero tengo idea de poner parte de mis pruebas y algunos ejemplos 
            en mi Github mientras “juego” y aprendo con los diferentes dispositivos con los que voy a trabajar y escribir mis impresiones que  
            empiezan con este texto y que pueda que valgan a alguien también para iniciarse, o al menos ese es el objetivo.
        </p>        
        <p> Mis conocimientos y experiencia de “Linux Embed” e <a href="https://es.wikipedia.org/wiki/Internet_de_las_cosas" target="_blank">IoT</a> iniciales 
            son nulos y este texto se ira corrigiendo si errara en algún concepto. 
        </p>
        <p>Véase este texto como un diario técnico y de conceptos más que un tutorial.</p>
        <p>De todas formas mis conocimientos de Linux son bastante amplios y tengo bastante años de experiencia por lo que no creo que se me 
            complique mucho entrar en el mundo del Internet de las cosas y los sistemas embebidos. </p>        
        <p>Debido a esto advierto también no voy a entrar en detalles de muchas cosas comunes de Linux por lo que quizás tendrás que tener una base 
            Linux  decente para seguir algunos pasos de este articulo porque no me parare en explicaciones.</p>        
        <p>Personalmente empecé a utilizar Linux hace ya más de 15 años, he configurado, optimizado muchos kernels desde aquella, e instalados 
            innumerables sistemas, como realizado recoverys de sistemas. Como diversión y aprendizaje  instale en otro tiempo unas cuantas veces 
            <a href="http://www.linuxfromscratch.org" target="_blank">LFS</a>   para luego unos cuantos años después pasarme a 
            <a href="http://www.gentoo.org" target="_blank">Gentoo</a> (construir un sistema de forma algo más automático) 
            y colaborar un poco en su desarrollo (ebuilds), también he programado chips (<a href="https://es.wikipedia.org/wiki/Microchip" target="_blank">Microchips</a>) 
            en plan hobby por lo que creo que tengo una base bastante consistente para asimilar bastante rápido todo esto. 
        </p>
        <p>Todo esto viene porque posiblemente para seguir esto tengas que tener también cierta base en esos temas, tampoco creo que necesites una experiencia 
            de años pero si tengo que configurar por ejemplo un kernel para un sistema embebido  no esperes encontrar aquí los pormenores de como configurar un kernel en linux 
            porque seguramente me llevaría más tiempo del que dispongo para escribir sobre IOT.
        </p>
        <p>De todas formas lo aquí escrito está en el aire, como he dicho estoy empezando tanto en
            <a href="https://es.wikipedia.org/wiki/Internet_de_las_cosas" target="_blank">IoT</a> como en este artículo, y aun no sé exactamente lo que 
            me encontrare o lo que necesitare hacer para llevar a buen puerto los dos proyectos que tengo en mente. Me consta que las distribuciones/firmwares 
            embebidas están bastante evolucionadas y facilitan enormemente el crear proyectos, y en este punto aún no se si tendré que crear alguna propia, me 
            valdrá con alguna standard o quizás solamente tenga que hacer algún pequeño cambio en algún kernel de un firmware de sobra conocido. Todo esto lo 
            iré viendo y poniendo aquí mis impresiones.
        </p>
        <p>Con el hardware otro tanto de lo mismo, no sé si cumplirá mis expectativas, si cambiare de hardware por sus limitaciones o si a medida que transcurren 
            los días sale algo que se adapte mejor a mis necesidades, eso si a la hora de escribir esto ya tengo visto con lo que empezare en un principio, 
            aunque aún estoy en espera de recibir todo el hardware por lo que evidentemente empezare hablando por mis elección en cuanto a hardware.
        </p>
        <h2>El hardware</h2>
        <p> Elegir el hardware con el trabajar es el primer paso, depende las necesidades del proyecto que tengas en mente te convendrá más uno que otro, si no 
            tienes ninguno especial también hay hardware con multitud de opciones que se adaptaran a todo tipo de situaciones mejor que otros más específicos con 
            lo que estarás limitado, personalmente yo tengo en mente dos proyectos y mi elección es por algo específico que se limite a lo que necesito.
        </p>
        <p>Mi búsqueda se limitó a hardware barato, open source por supuesto, con alta disponibilidad, y adopción, con el menor consumo posible, y algo compacto
            para no tener que andar con módulos y añadidos salvo posibles sensores. Mi elección final para uno de mis proyectos después de ver varias alternativas
            fue el ESP8266 que se puede conseguir importado de china por escasos dos euros, o 3 euros comprando el NodeMCU que ya viene preparado con pines, usb y
            firmware open sources para empezar a trastear.
        </p>
        <p>El NodeMCU es un módulo WIFI 802.11 bgn  con antena incorporada, usb, con un alcance en exteriores de hasta 450 metros con antena 2dbi (o al menos eso 
            es de lo que presume luego ya veremos). Tiene  16 GPIO y un ADC, y se alimenta con 3.3v. Está muy ajustado en cuanto a capacidad ya que tiene 4mb 
            de flash y su consumo al 90% es de solo 200mA.
        </p>
        <p>Sus características completas se pueden ver en por ejemplo la <a href="https://en.wikipedia.org/wiki/ESP8266" target="_blank">Wikipedia</a>
        </p>
        <p>En principio parece perfecto para mi primer proyecto si consigo encajar en esa memoria todo  el código que necesito, que tampoco va a ser mucho, para 
            hacerlo funciona como quiero.
        </p>
        <p>Hay dos versiones V1 y V2, compre uno de cada, la diferencia precio es de un euro en estos momentos y las cualidades similares.</p>
        <p>Desgraciadamente para mi segundo proyecto aparte de muchas de las cualidades del ESP8266 necesito poder conectar una cámara por lo que  necesito algo 
            con más chicha de CPU, memoria y al menos un USB host. 
        </p>
        <p>Mis búsquedas dieron con el HLK-rm04: </p>
        <p>HLK-RM04 v2:</p>
        <p>CPU: 360MHZ, Flash: 8mb, RAM: 32mb, Precio: 4-10€</p>

        <p>Y el  <a href="http://www.dragino.com">dragino</a>:</p>
        <p>CPU: 400mhz, RAM: 64mb, Flash: 16mb, Precio: 15-20€</p>
    
        <p>Mi decisión final aunque me lo pensé por el precio fue para el <a href="http://www.dragino.com">dragino</a> por que este proyecto va ser en general un dispositivo que el precio final no 
            necesita estar tan ajustado como el otro que necesita ser bastante barato para tener salida, y va a pedir más recursos y el doble de RAM/ROM me
            parece interesante, aunque no descarto que al final probar si funciona adecuadamente en el HLK-rm04 para reducir costes. Aunque aún no sé siquiera 
            que tal tirara este procesando el video de una cámara.
        </p>
        <p>Otra vez en vez de comprar el modulo a secas, compre el Yun Shield que ya viene en una PCB listo para “jugar” sin soldar nada por un precio de 
            24€ importado.
        </p>
        <p>Decir que estos modulos, en especial el Yun Shield son adecuados para trabajar con Arduino, y tienen un amplio soporte, personalmente aparte de gustarme más trabajar con Microchip 
           para mis proyectos no creo que me haga falta ni lo uno ni lo otro. O sea en principio este articulo no contendrá nada de Arduino ni de Microchip especifico.
        </p>
            
        <p>Había opciones más baratas y más potentes en el momento de la compra, había una Orange PI  por 10€ en una página de importación interesante,  
            si bien el precio era más barato era la versión antigua por eso supongo que el precio hasta deshacerse del stock, y no se conseguirá ese 
            precio en ninguna versión nueva y si quieres lanzar algún dispositivo, y conseguir precios en algo con tarjeta gráfica y todo lo que tiene 
            la Orange Pi sería bastante difícil, aparte de excesivo para un proyecto específico como el que tengo planeado, aparte el consumo es bastante 
            mayor (una gran pega para un proyecto que planeas utilizar baterías) , hace falta un módulo wifi que conectarle (el más barato tampoco 
            es mucho, creo que andan por 5€) y es más grande que un dragino sin PCB.
        </p>
        <p>De todos modos un minipc  quad-core 1.2ghz  512mb ram, GPIO, chip grafico MALI400, por 10€ es algo que por supuesto compre ya por vicio ;)
        </p>

        <p>Y hasta aquí el “Escrito 1” toca esperar la llegada del hardware para comenzar.
        </p>
    </article>        
    
</div>

<?php
include("include/profilebanner.inc.php");

include("include/footer.inc.php");