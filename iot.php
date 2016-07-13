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
        
        <ul>
            <li><a href="#Iniciando">Iniciando</a></li>
            <li><a href="#ElHardware">El Hardware</a></li>
            <li><a href="#LosProyectos">Los proyectos</a></li>
            <li><a href="#PrimDragino">Primer vistazo al Dragino</a></li>
            <li><a href="#PartYOverlay">Particiones y OverlayFS</a></li>
            <li><a href="#DefaultDragino">El sistema por defecto del Dragino</a></li>
            <li><a href="#PrimNodeMCU">Primer vistazo al NodeMCU</a></li>
            <li><a href="#OtherLangLua">Lua ¡Otro lenguaje más a aprender</a></li>
            <li><a href="#PrimLua">Comenzando con Lua</a></li>
            <li><a href="#PrimProgLua">Primeras impresiones programando el NodeMCU/ESP8266</a></li>
        </ul>

        
        <h2>Entrada 1</h2>
        <h2 id="Iniciando">Iniciando</h2>
        <p>
            Recientemente decidí ponerme un poco al tanto de esta  tecnología que cada vez está más en auge, y aprovechar para hacer un 
            par de proyectos que tengo en mente relacionados.
        </p><p>
            Los proyectos finales van a ser en mayor parte “close source”  pero tengo idea de poner parte de mis pruebas y algunos ejemplos 
            en mi Github o ente mismo documento mientras “juego” y aprendo con los diferentes dispositivos, claro esta si los considero relevantes por
            algún motivo, hay código de sobra online y mis primeros pasos seguramente sean básicos como para poner algo que no este ya colgado.
        </p><p>
            Lo que si voy  escribir mis impresiones que empiezan con este texto y que pueda que valgan a alguien también para iniciarse, o al menos ese es el objetivo.
            De todas formas véase este texto como un <strong>diario técnico</strong> introductorio y de conceptos más que un tutorial.        
        </p><p> 
            Mis conocimientos y experiencia de “Linux Embed” e <a rel="nofollow" href="https://es.wikipedia.org/wiki/Internet_de_las_cosas" target="_blank">IoT</a> iniciales 
            son nulos y este texto se ira corrigiendo si errara en algún concepto. Si alguien tiene alguna critica, sugerencia o rectificación tiene mi email en la
            cabecera de esta web o en el banner de cada pie de página.
        </p><p>
            De todas formas mis conocimientos de Linux son bastante amplios y tengo bastante años de experiencia por lo que no creo que se me 
            complique mucho entrar en el mundo del Internet de las cosas y los sistemas embebidos. 
        </p><p>
            Personalmente empecé a utilizar Linux hace ya más de 15 años, he configurado, optimizado muchos kernels desde aquella, e instalados 
            innumerables sistemas, como realizado recoverys de sistemas, también como entretenimiento y aprendizaje  instale (o más bien construí) en otro tiempo unas cuantas 
            veces sistemas basados en <a href="http://www.linuxfromscratch.org" target="_blank" rel="nofollow">LFS</a>   para luego unos cuantos años después pasarme a 
            <a href="http://www.gentoo.org" target="_blank" rel="nofollow">Gentoo</a> (construir el sistema de forma algo más automático) 
            y colaborar un poco en su desarrollo (ebuilds), también he programado chips (<a href="https://es.wikipedia.org/wiki/Microchip" target="_blank" rel="nofollow">Microchips</a>) 
            en plan hobby por lo que creo que tengo una base bastante consistente para asimilar bastante rápido todo esto. 
        </p><p>
            Todo esto viene porque posiblemente para seguir esto tengas que tener también cierta base en esos temas, tampoco creo que necesites una experiencia 
            de años pero si tengo que configurar por ejemplo un kernel para un sistema embebido  no esperes encontrar aquí los pormenores de como configurar un kernel en linux 
            porque seguramente me llevaría más tiempo del que dispongo para escribir sobre IoT si entro en detalles generales. 
        </p><p>
            De todas formas lo vaya a escribir aquí está en el aire, como he dicho estoy empezando en
            <a href="https://es.wikipedia.org/wiki/Internet_de_las_cosas" target="_blank" rel="nofollow">IoT</a> y linux embed, y aun no sé exactamente lo que 
            me encontrare o lo que necesitare hacer para llevar a buen puerto los dos proyectos que tengo en mente. Me consta que las distribuciones/firmwares 
            embebidas están bastante evolucionadas y facilitan enormemente el crear proyectos, y en este punto aún no se si tendré que crear alguna propia, me 
            valdrá con alguna standard o quizás solamente tenga que hacer algún pequeño cambio en algún kernel de un firmware de sobra conocido. Todo esto lo 
            iré viendo y poniendo aquí mis impresiones, que es el objetivo principal de este documento.
        </p><p>
            Con el hardware otro tanto de lo mismo, no sé si cumplirá mis expectativas, si cambiare de hardware por sus limitaciones o si a medida que transcurren 
            los días sale algo que se adapte mejor a mis necesidades, eso si a la hora de escribir esto ya tengo visto el hardware con el que empezare, y 
            dado que aun estoy a la espera de recibirlo empezare hablando por dicha elección.
        </p>
        
        <h2 id="ElHardware">El hardware</h2>
        
        <p> 
            Elegir el hardware con el trabajar es uno de los primeros pasos que hay que dar, depende las necesidades del proyecto que tengas en mente te convendrá más 
            uno que otro, si no tienes ninguno especial también hay hardware con multitud de opciones que se adaptaran a todo tipo de situaciones mejor que otros más 
            específicos con lo que estarás limitado, personalmente yo tengo en mente dos proyectos y mi elección es por algo específico que se limite a lo que necesito.
        </p><p>
            Mi búsqueda se limitó a hardware barato, open source por supuesto, con alta disponibilidad, y adopción, con el menor consumo posible, y algo compacto
            para no tener que andar con módulos y añadidos salvo posibles sensores. Mi elección final para uno de mis proyectos después de ver varias alternativas
            fue el ESP8266 que se puede conseguir importado de china por escasos dos euros, o 3 euros comprando el NodeMCU que ya viene preparado con pines, usb y
            firmware open sources para empezar a trastear sin necesidad de fabricar PCB o soldar nada.
        </p><p>
            El NodeMCU es un módulo WIFI 802.11 b/g/n  con antena incorporada, usb, con un alcance en exteriores de hasta 450 metros con antena 2dbi (o al menos eso 
            es de lo que presume luego ya veremos). Tiene  16 GPIO y un ADC, y se alimenta con 3.3v. Está muy ajustado en cuanto a capacidad ya que tiene 4mb 
            de flash y su consumo al 90% es de solo 200mA.
        </p><p>
            Sus características completas se pueden ver por ejemplo en la <a href="https://en.wikipedia.org/wiki/ESP8266" target="_blank" rel="nofollow">Wikipedia</a>
        </p><p>
            En principio parece perfecto para mi primer proyecto si consigo encajar en esa memoria todo  el código que necesito para 
            hacerlo funciona como quiero, que de todos modos tampoco va a ser mucho.
        </p><p>
            Hay dos versiones V1 y V2, compre uno de cada, la diferencia precio es de un euro en estos momentos y las cualidades similares. Entre otras cosas la versión
            V2 es más protoboard friendly
        </p><p>
            NodeMCU V2:
        </p>
        <img width="400" src="images/nodecuV2"/>

        <p>
            Desgraciadamente para mi segundo proyecto aparte de muchas de las cualidades del ESP8266 necesito poder conectar una cámara por lo que  necesito algo 
            con más chicha de CPU, memoria y al menos un USB host. 
        </p><p>
            Mis búsquedas dieron con el HLK-rm04: 
        </p><p>
            HLK-RM04 v2:
        </p><p>CPU: 360MHZ,  RAM: 32mb, Flash: 8mb, Precio: 4-10€
        </p><p>
            Y el  <a href="http://www.dragino.com">dragino</a>:
        </p><p>
            CPU: 400mhz, RAM: 64mb, Flash: 16mb, Precio: 15-20€
        </p><p>
            Mi decisión final aunque me lo pensé por el precio fue para el <a href="http://www.dragino.com" rel="nofollow">dragino</a> por que este proyecto va ser en general un
            dispositivo que el precio final no necesita estar tan ajustado como el otro que necesita ser bastante barato para tener salida ya que busco ofrecer un 
            dispositivos muy asequible, además este va a pedir más recursos y el doble de RAM/ROM me
            parece bastante interesante aunque no descarto probar al final si funciona adecuadamente en el HLK-rm04 para reducir costes. De todos modos aún no sé siquiera 
            que tal tirara este procesando el vídeo de una cámara ni la opción de la calidad de la cámara que utilizare, pues no pedirá lo mismo una cámara 480p, que 
            una 720p o superior.
        </p><p>
            Otra vez, en vez de comprar el modulo a secas, compre el Yun Shield que ya viene en una PCB listo para “jugar” sin soldar nada por un precio de 
            24€ importado.
        </p><p>
            Yun Shield:(la parte de abajo es una placa arduino no incluida)
        </p>
        <img width="400" src="images/YunShield_2.png"/>

        <p>
           Decir que estos módulos, en especial el Yun Shield son adecuados para trabajar con Arduino, y tienen un amplio soporte, personalmente aparte de gustarme más 
           trabajar con Microchip para mis proyectos no creo que me haga falta ni lo uno ni lo otro. O sea en principio este articulo no contendrá nada de Arduino ni 
           de Microchip especifico, al menos si puedo evitarlo.
        </p><p>
            Había opciones más baratas y más potentes en el momento de la compra, había una Orange PI  por 10€ en una página de importación interesante,  
            si bien el precio era más barato era la versión antigua por eso supongo ese precio tan bonito, pero ese precio sera  hasta que acaben con el stock antiguo, 
            y no se conseguirá ese precio en ninguna versión nueva, aparte de ser un producto con menos disponibilidad, y si quieres lanzar algún dispositivo, 
            y conseguir precios en algo con tarjeta gráfica y todo lo que tiene la Orange Pi sería bastante difícil, aparte de excesivo para un proyecto específico 
            como el que tengo planeado. También importante es que el consumo es bastante  mayor, cosa que es una gran pega para un proyecto que se planea utilizar 
            baterías, por lo que descarto por completo este tipo de mini pcs. También  hace falta un módulo wifi que conectarle (el más barato tampoco es mucho, creo 
            que andan por 5€), otra pega es que es más grande que un dragino sin PCB. Y por ultimo necesita una tarjeta flash. Todo eso encarecería y haría poco 
            practico un producto final cuyo objetivo es entre otras cosas un coste de producción bajo. 
            Vamos que como os podéis imaginar lo descarte rápidamente, aunque para jugar de forma genérica posiblemente tanto la Orange PI como la Raspberry Pi sean 
            unos muy buenos candidatos.
        </p><p>
            De todos modos un minipc  quad-core 1.2ghz  512mb ram, GPIO, chip gráfico MALI400, por 10€ es algo que por supuesto compre ya por vicio ;)
        </p><p>
            Y hasta aquí la primera entrada de este diario, toca esperar la llegada del hardware para comenzar.
        </p>
        
        <!-- -->
        <h2>Entrada 2</h2>
        <h2 class="LosProyectos">Los proyectos</h2>
        <p>   
            Como comente tengo en mente dos proyectos, los dos muy similares, son en principio bastante simples por lo que son ideales para entrar dentro del 
            mundo de los sistemas embebidos principalmente y rozar la tecnología IoT, tengo en mente otros para entrar más de lleno en IoT y redes MESH pero de
            momento me limitare a estos, cada cosa a su tiempo y antes tendré que finalizar estos.
        </p><p>
            A grandes rasgos para ambos proyectos necesito lo mismo, el uso de varias entradas GPIO para controlar otros dispositivos, ambos van a estar alimentados por baterías,
            un servidor web simple en cada dispositivo que me permita controlar remotamente  los dispositivos añadidos / GPIO, los dispositivos se configuran en modo AP. 
            La diferencia principal entre uno y otro es que uno incluirá una cámara por lo que los requerimientos en cuanto a CPU serán mayores, aparte de la necesidad 
            de una conexión USB HOST, por lo demás todo lo controlado vía GPIO será igual en ambos, las GPIO a utilizar serán de tipo IN y OUT y ON/OFF, en principio
            no necesito ningún otro tipo de configuración como PWN (Pulse width modulation).
        </p><p>
            De aquí en adelante me referiré a Proyecto1 al que haré con NodeMCU en el no necesito cámara, y el Proyecto2 al que necesito utilizar una cámara y que también en principio 
            implementare utilizando el Dragino.
        </p>

        <h2 id="PrimDragino">Primer vistazo: Dragino Yun shield: </h2>       
        <p>
            Hoy me llego el Dragino y aunque primero quiero trabajar con el NodeMCU y dejar este un poco de lado hasta finalizar con el primero habrá que echarle un vistazo 
            mientras no me llega el otro.
        </p><p>
            El Yun Shield viene con una variante de OpenWrt-Yun preinstalada llamada Dragino Yun, variante específica para “Arduino Yun” que a su vez es una variante de OpenWrt 12.9 Attitude 
            Adjustament.
        </p><p>
            Dragino ofrece otra variante de firmware, basado en OpenWrt 12.9 también, llamada “Mesh IoT Firmware”, más genérico y más limitado en soporte para placas arduino,  soporte para Mesh, 
            USB 3G, IoT entre otros.
        </p><p>
            El cambio de un firmware a otro se debe de hacer a través de u-boot por UART o ETHERNET LAN. Las actualizaciones una vez instalado el firmware deseado se puede hacer por web.
        </p><p>
            De momento dejare este firmware pues primero quiero centrarme en el NodeCMU y ver mejor ventajas y desventajas de uno y otro firmware
        </p><p>
            La placa viene bastante preparada como ya mencione para conectarlo encima de un arduino y alimentarla a través de este. Para alimentarla sin arduino muevo el jumper 
            amarillo que une VIN/VCC y uno VCC/5v y conecto 5v al pin 5v que está justo detrás del jumper y el negativo al Ground/GND que está al lado, y esta comenzara a arrancar 
            encendiéndose el led verde de POWER, luego el LAN  empezara a parpadear si tenemos conectado el cable y wifi en azul. 
        </p><p>
            NOTA: El modelo anterior no tiene ese jumper y habría que hacer un puente.
        </p><p>
            El proceso de arranque no es que sea muy rápido, desde que conectamos la alimentación hasta que tenemos el WIFI disponible pasa un buen minuto.
        </p><p>
            Por si alguien se lo pregunta no se puede alimentar a través del USB ya que no arrancaría el Dragino HE
        </p><p>
            El Dragino HE se alimenta a través del pin VIN, se podría conectar con el jumper puenteando VIN/VCC pero entonces requerirá 5v en el pin +5v pues es este alimenta el USB HOST, 
            WIFI y RJ45
        </p><p>
            Si se utiliza un arduino + yun shield y se conecta algo al USB HOST recomienda alimentar el arduino con +7v/15v, supongo que será debido al USB HOST que dependiendo de 
            lo que conectes y su consumo puede dar problemas de demanda e inestabilidad produciendo posiblemente reinicios del sistema si es que arranca.
        </p><p>
            Una vez arrancado ya podremos entrar para curiosear o configurarlo, tanto por SSH como por web, las instrucciones de todo este procedimiento están disponibles 
            en la página de Dragino y son suficientemente claras por lo que no me parare.
        </p><p>
            Vía web nos encontraremos con un panel de control específico de dragino, si pinchamos en “Systems” arriba nos encontraremos con la opción de entrar en el especifico de 
            OpenWrt pinchando en “advanced configuration panel (luci)”. Como indica el titulo está basado en luci, luci está programado principalmente y no únicamente en C.
        </p><p>
            Entrando por SSH comprobamos con ‘df –h’ que tengo espacio en principio de sobra con este firmware para mi proyecto.
        </p>
        
        <pre class="code">
root@dragino-af26d1:~# df -h
Filesystem                Size      Used Available Use% Mounted on
rootfs                    5.6M    416.0K      5.2M   7% /
/dev/root                 8.8M      8.8M         0 100% /rom
tmpfs                    29.8M    108.0K     29.7M   0% /tmp
tmpfs                   512.0K         0    512.0K   0% /dev
/dev/mtdblock3            5.6M    416.0K      5.2M   7% /overlay
overlayfs:/overlay        5.6M    416.0K      5.2M   7% /
        </pre>
        
        <p>
Ya puestos veamos los puntos de montaje.
        </p>

        <pre class="code">
root@dragino-af26d1:~# cat /proc/mounts
rootfs / rootfs rw 0 0
/dev/root /rom squashfs ro,relatime 0 0
proc /proc proc rw,noatime 0 0
sysfs /sys sysfs rw,noatime 0 0
tmpfs /tmp tmpfs rw,nosuid,nodev,noatime,size=30560k 0 0
tmpfs /dev tmpfs rw,noatime,size=512k,mode=755 0 0
devpts /dev/pts devpts rw,noatime,mode=600 0 0
/dev/mtdblock3 /overlay jffs2 rw,noatime 0 0
overlayfs:/overlay / overlayfs rw,relatime,lowerdir=/,upperdir=/overlay 0 0
debugfs /sys/kernel/debug debugfs rw,relatime 0 0
none /proc/bus/usb usbfs rw,relatime 0 0
        </pre>

        <p>
            Esto me presenta la primera duda respecto a este tipo de particionamiento/montaje a lo referente al OverlayFS
        </p>

        <h2 id="PartYOverlay">Particionamiento y OverlayFS</h2>
        <p>
            La partición principal como era de prever en un sistema embebido esta RO (Read-Only), el sistema de ficheros es 
            <a href=”https://es.wikipedia.org/wiki/SquashFS” target=”_blank” rel="nofollow">SquasFS</a>, un sistema específico para este tipo de sistemas, 
            comprimido y Read Only.
        </p><p>
            La partición principal se monta en /rom como mencione en modo RO. /dev /sys /tmp se montan en RAM utilizando TMPFS  por lo que el contenido 
            ahí se crea en el arranque y se borra en cada reinicio.            
        </p><p>
            El espacio libre es asignado a otra partición y montada con  <a href=”https://en.wikipedia.org/wiki/JFFS2” target=”_blank” rel="nofollow">jffs2</a> en el directorio /overlay
        </p><p>
            A su vez se utiliza Overlayfs para montarlo ambos en la partición /, cosa que en sistemas normales no es algo común encontrarse y que 
            desconozco exactamente cómo funciona. 
        </p><p>
            La explicación afortunadamente es sencilla, overlay significa sobrepuesto y lo que se hace montando las particiones así es sobreponer una sobre 
            otra, en este caso /rom y /overlay una RO y la otra RW son montados en el root ‘/’, quedando un sistema en el que aparecen los archivos de la ROM 
            y de la partición escribible. Así podremos escribir en todo el árbol “/”, el sistema en realidad si tecleamos “touch /algo.txt” estará creando ese 
            algo en la partición escribible, o sea /overlay de forma transparente. Asimismo si instalamos o sobrescribimos un archivo de configuración pasara 
            exactamente lo mismo, realmente lo estaremos instalando en /overlay. El sistema o nosotros si tiene que acceder por ejemplo ‘less /algo.txt lo que 
            hará de forma transparente es leerlo primeramente de /overlay/algo.txt y si no lo encuentra ahí en /rom/algo.txt, por lo que esto también nos 
            permitiría por ejemplo instalar una aplicación  ya existente de la ROM y que el sistema utilice esa nueva aplicación y no la que viene con la ROM.

        </p><p> 
            Otra ventaja es podremos actualizar la ROM y conservar los archivos de la otra partición, tanto programas como archivos de configuración, aunque 
            en el caso de programas posiblemente dé algún problema y en caso de actualizar la ROM  sea mejor borrar la partición haciendo previamente antes 
            una copia de seguridad de los archivos de configuración, o eliminar programas y librerías instaladas.
        </p>
        
        <h2 id="DefaultDragino"> 
            El sistema por defecto del Dragino.
        </h2>

        <p> 
            Mi dragino vino con el firmware 2.0.6 y lo primero que hice fue instalar la actualización a 2.0.7, como comente aun no sé si utilizare esta o el otro
            firmware o creare una custom, pero  actualizarlo no cuesta nada.
        </p><p> 
            Os muestro un ‘dmesg’ con la información más relevante
        </p>
        <pre class="code">

Linux version 3.3.8 (dragino@iZ28vl6w7rcZ) (gcc version 4.6.3 20120201 (prerelease)
CPU revision is: 00019374 (MIPS 24Kc)
SoC: Atheros AR9330 rev 1
Clocks: CPU:400.000MHz, DDR:400.000MHz, AHB:200.000MHz, Ref:25.000MHz
Memory: 60936k/65536k available (2565k kernel code, 4600k reserved, 649k data, 180k init, 0k highmem
io scheduler deadline registered (default)
Serial: 8250/16550 driver, 16 ports, IRQ sharing enabled
ar933x-uart: ttyATH0 at MMIO 0x18020000 (irq = 11) is a AR933X UART
eth0: Atheros AG71xx at 0xba000000, irq 5
eth0: Found an AR7240/AR9330 built-in switch
eth1: Atheros AG71xx at 0xb9000000, irq 4
ehci_hcd: USB 2.0 'Enhanced' Host Controller (EHCI) Driver
hub 1-0:1.0: USB hub found
hub 1-0:1.0: 1 port detected
usbcore: registered new interface driver usb-storage
USB Mass Storage support registered.
eth0: link up (1000Mbps/Full duplex)
Linux video capture interface: v2.00
        </pre>

        <p> 
            La ultima línea muestra algo interesante para mi proyecto y es que este firmware viene con algún soporte mínimo para V4l, una búsqueda en /lib/modules 
            da que es mínimo del todo y que al menos tendré que instalar los drivers UVC. De todas formas casi ya con toda seguridad que el kernel por defecto me 
            valdrá para proyecto2
        </p><p> 
            Ya acabando por hoy por que nunca esta de más os muestro el /proc/cpuinfo
        </p>
<pre class="code">
root@dragino-af26d1:/proc# cat cpuinfo
system type             : Atheros AR9330 rev 1
machine                 : Arduino Yun
processor               : 0
cpu model               : MIPS 24Kc V7.4
BogoMIPS                : 265.42
wait instruction        : yes
microsecond timers      : yes
tlb_entries             : 16
extra interrupt vector  : yes
hardware watchpoint     : yes, count: 4, address/irw mask: [0x0000, 0x0040, 0x0800, 0x0100]
ASEs implemented        : mips16
shadow register sets    : 1
kscratch registers      : 0
core                    : 0
VCED exceptions         : not available
VCEI exceptions         : not available
</pre>

        <p> 
            Si alguien quiere alguna información extra sobre el Hardware que me escriba, por lo demás es un sistema normal “OpenWrt” con ligeras modificaciones que veré en 
            su momento, el sistema de momento parece que me va a evitar mucho trabajo y posiblemente solo tenga que modificar levemente configuración e instalar alguna 
            pequeña aplicación o driver.
        </p><p> 
            Por otra parte me gustaría meterme en el lio de crear el toolchain y demás para configurar un firmware propio y “custom”, pero en este proyecto no lo 
            haré si no es necesario porque tanto en el Proyecto1 (especialmente) como el Proyecto2 me interesa sacarlo adelante cuanto antes, además tiempo abra si no es con 
            este con algún otro proyecto que le seguirá.
        </p> 
                    
        
        <h2>Entrada 3</h2>
        <h2 id="PrimNodeMCU">Primer vistazo al NodeMCU</h2>

        <p>
            Es fantástico tener por menos de 2-3$ un dispositivo con todas estas opciones. Incluso por 1$ y menos a la hora de comprar al por mayor. 
        </p><p>
            A pesar que comparando con el otro es muy limitado sigue siendo más que suficiente para multitud de tareas
        </p><p>            
            El corazón del NodeMCU es el ESP8266 que funciona a 3.3vcd, concretamente el denominado ESP-12E  también denominado ESP-12F para la versión 
            FCC certificada. Tiene un CPU RISC 32bits Tensilica Xtensa LX106 a 80Mhz. 802.11/b/g/n, 16 GPIO, 1 SPI, 1 I2C, UART y 1 ADC.
        </p><p>
            El ESP8266 tiene intérpretes de Lua, JavaScrip y Pytron y como casi todo hoy en día se lleva bien con arduino.
        </p><p>
            El NodeMCU viene con firmware basado en eLua (eluaproject.net). Lua es un lenguaje event driven (orientado a eventos)
        </p><p>
            En <a href="http://nodemcu-build.com/" target="_blank" rel="nofollow"> nodemcu-build</a> puedes crear online tu propio NodeMCU firmware con las opciones/módulos que quieras. Debido al 
            limitado espacio es algo que seguramente utilizaremos para dejar el mayor espacio posible. Que se pueda hacer de forma tan sencilla 
            es otro punto a favor de este pequeño dispositivo.
        </p><p>
            El ESP8266 soporta hasta 16mb de memoria flash, pero la memoria de almacenamiento que proporciona el NodeMCU es de 4mb.
        </p><p>
            En el momento de escribir esto la guía más completa para empezar posiblemente sea esta: <a href="http://nodemcu.readthedocs.org/en/dev/" target="_blank" rel="nofollow">
                http://nodemcu.readthedocs.org/en/dev/ 
            </a>
        </p><p>
            Y como por algo hay que empezar de momento me decido por trabajar con el ESPlorer, los enlaces los puedes encontrar en la guía anteriormente 
            mencionada, necesitas JAVA y es multiplataforma.
        </p><p>
            Al conectar el NodeMCU  viene con un  convertidor SERIAL->USB  y en Windows quizás te falten los drivers. CH340 Serial Communication Driver 
            es lo que deberías buscar e instalar o este de la pagina de <a href="https://www.silabs.com/products/mcu/Pages/USBtoUARTBridgeVCPDrivers.aspx" target="_blank" rel="nofollow">silabs.com</a>
        </p><p>
            Si vas a trabajas directamente con el ESP8266 necesitas algún convertidor SERIAL->USB, en ebay hay varios por menos de 1€ importado.
        </p><p>
            Mi primera simple prueba de conexión con ESPlorer no fue satisfactoria, no daba conectado y pude comprobar que el NodeMCU emitía señal 
            WIFI, no me lié mucho a ver qué pasaba y fui directamente a instalar el ultimo  firmware, lo que fue un acierto pues después de actualizar conectaba 
            perfectamente.
        </p><p>
            Para actualizar hay que bajarse el <a href="https://github.com/nodemcu/nodemcu-flasher" target="_blank" rel="nofollow">flasher</a>  y, puedes escribir un firmware 
            custom o simplemente darle a “flash” y te instalara  la última versión genérica que viene incluida con el propio flasher. Para empezar y  tener la 
            primera toma de  contacto rápida es lo que hice.
        </p><p> 
            Con el firmware por defecto tenemos el siguiente espacio libre:        
        </p>
        <pre class="code">
            Total : 3441461 bytes
            Used  : 8785 bytes
            Remain: 3432676 bytes 
        </pre>
        
        <p>
            Creía que iba a quedar mucho menos, pero aun hay que ver que tiene y que no tiene ese firmware
        </p><p>
            Una vez actualizado, seleccionado el COM en el ESPlorer y después de pinchar OPEN se conectó rápidamente vía serial.
        </p><p>
            El <a href="http://esp8266.ru/download/esp8266-doc/Getting%20Started%20with%20the%20ESPlorer%20IDE%20-%20Rui%20Santos.pdf " target="_blank" rel="nofollow">Getting Started ESPlorer</a>
            te ayudara a comenzar con el ESPlorer, es una guía muy básica pero útil para empezar.
        </p>
        
        <h2 id="OtherLangLua">Lua ¡Otro lenguaje más a aprender!</h2>

        <p>
            Y otra API!, igual lo has pensado, yo sí, sobretodo viendo que hay alternativas con C o Python u otros, y leyendo algunas críticas al 
            respecto, aunque eran criticas antiguas referentes principalmente al espacio que ocupa y lo poco que dejaba  para código, y sin duda 
            siendo un dispositivo limitado en memoria es algo que pensar, de todas formas antiguamente no era fácil hacer un firmware con lo 
            estrictamente necesario, ahora como ya dije anteriormente hay en herramientas online que te permiten eso y el tamaño que ocupa dicho 
            firmware es más difícil que sea el problema, visto el firmware por defecto aunque aún no comprobé que falta el espacio que hay generoso 
            para un  dispositivo de 4mb.
        </p><p>
            Aparte, después de ver ejemplos me parece sencillo de implementar muchas cosas que no se salgan de las posiblemente típicas necesidades 
            para un dispositivo de este tipo sin necesidad profundizar en Lua, quizás si tuviera algún proyecto muy especial en cuanto a necesidades 
            de programación me decidiría por otro lenguaje en vez de aprender Lua en profundidad, y quizás lo haga en el futuro, o quizás me adapte 
            y me sienta cómodo con el como para profundizar más. 
        </p><p>
            De todas formas  lo que tengo en mente ahora mismo son proyectos puntuales y nada fuera de lo normal, así que probare con dicho lenguaje.
        </p>

        <h2 class="PrimLua">Comenzando con Lua</h2>
        <p>
            Como mencione anteriormente hay firmwares que ayudaran con otros lenguajes/interpretes, yo en principio veré con este
        </p><p>
            Tienes un manual bastante genérico sobre lua en <a href="http://lua.org" target="_blank" rel="nofollow">lua.org</a>, yo lo leí antes de que me llegara 
            mi unidad de prueba y decir que no es un manual nada amigable y me pareció poco útil para empezar, me parecen más útil aprender con los muchos 
            ejemplos de código que hay por internet. 
        </p><p>
            Aparte hay diferencias de Lua con la versión limitada de Lua para NodeMCU
        </p><p>
            De todas formas una lectura no viene mal para entender ciertos conceptos o por lo menos ir asimilándolos, no lleva mucho tiempo leerlo   pero  
            yo tampoco me pararía  demasiado a entenderlo todo como esta explicado allí del tirón. 
        </p><p>
            La mitad del libro es un montón de teoría sin muchos ejemplos, y a veces dichos ejemplos para alguien que empieza dudo que estén bien contextualizados, 
            por lo menos para mí me perdieron un poco. La otra mitad es una explicación de la API y como no tengas una memoria prodigiosa te valdrá en un principio 
            para bien poco, de todas formas es bueno ver las posibilidades aunque no quiere decir que todas estén disponibles en NodeMCU.
         </p><p>
            Como dije para mí lo tal es ir viendo los ejemplos, para cualquiera con conocimientos de programación no le costara aprender así, el libro da otra 
            impresión de dificultad comparándolo con el código que circulan online.
        </p><p>
            De todas formas repito, en mi opinión deberías leerlo al menos del tirón hasta que empieza el API.
        </p><p>
            No voy a poner nada de código a estas alturas,  no voy a descubrir al lector nada que no este online, toca ponerse a jugar con el y aprender del código ya escrito. 
        </p><p>
            Solo decir que cuando arranca el NodeMCU, este busca el archivo init.lua, o sea que es nuestro main, el punto de entrada para el resto del código
        </p>
        <h2>Entrada 4</h2>
        <h2 id="PrimProgLua">Primeras impresiones programando en LUA el NodeMCUESP8266</h2>
        <p> 
            Como comentaba init.lua es el primer archivo que se ejecuta, hay que tener cuidado de que pones allí y como lo pones 
            porque si hay algún error se reiniciara constantemente cada vez que inicias el dispositivo impidiéndote arreglar el 
            problema borrándolo o corrigiéndolo
        </p><p>
            Algunas formas usadas es probar antes en archivos que ejecutemos el código hasta estar seguro que funciona perfectamente.
        </p><p>
            Otra es arrancar el código si determinado GPIO están en algún estado LOW, así si algo falla, lo ponemos en HIGH y no arrancara código.
        </p><p>
            Otra técnica que se comenta es poner un delay para que nos dé tiempo conectarnos al dispositivo y borrar el archivo antes de que 
            lo ejecute si algo falla.
        </p><p>
            Supongo que habrá más, yo personalmente de momento no estoy utilizando init.lua ni veo de momento necesario mientras se desarrolla 
            hacer uso de él, simplemente cree un archivo begin.lua que en su momento renombrare a init.lua y lo ejecuto manualmente desde 
            el ESPlorer
        </p><p>
            La versión que instala el flasher es como comente la última, pero la última estable (0.9.5), si ves que faltan funciones es 
            porque tiene más de un año la versión estable, yo termine actualizando a la última DEV (0.9.6-dev) que también tiene su tiempo y 
            luego viendo que me seguían faltando funciones me pase a hacer mi propio firmware con el http://nodemcu-build.com/ basado en la 
            rama ‘Master’ para encontrarme otra vez con que  sigue siendo bastante anticuada, así que me pase a la rama ‘dev’ en la que si 
            encontré con todas las funciones que hablan los ‘docs’, como podéis imaginar un poco incordio todo eso, aparte que no va tan fina 
            como la otra, en principio encontré varios errores entre ellos que  al hacer un ‘reset’ algunas veces (demasiadas) no arranca bien, 
            y alguna ventaja con que graba los archivos al firmware bastante más rápido al hacerlo por bloques en vez de por líneas.
        </p><p>
            La cuestión es que las versiones más estables están considerablemente atrasadas, pero lo peor no es eso, lo peor es que me 
            encontré con alguna sorpresa más destacable que contare más adelante.
        </p><p>
            En principio con la versiones estables y anticuadas  mi primera impresión fue que es fácil que cualquier programador se adapte, 
            el ESPlorer le falta madurar  mucho porque de avisar de errores nada, o sea que mayormente hay que revisarlo, subirlo y probarlo 
            lo que es un poco incordio sobre todo para empezar porque si somos nuevos en Lua cometeremos bastantes errores de sintaxis entre 
            otros debido a la costumbre de otros lenguajes de programación hasta cambiar el chip. Leí por ahí que había un Lua “Squirrel” 
            con la misma sintaxis que C, es una pena que no sea el utilizado por el NodeMCU.
        </p><p>
            De todas formas creo que me adapte bastante bien hasta llegar al primer gran problema con la versión estable.
        </p><p>
            Tenemos espacio flash que da para muchas líneas, 4mb aunque leí que había algunos chips que venían con 8mb incluso alguno le 
            llego con 16mb, pero bueno 4mb para un dispositivo de este nos debería llegar y para mi proyecto no me preocupa, pero la 
            RAM/instrucciones da bastante pena, si no nos cuidamos con menos de 100 líneas de código igual nos aparece y seguramente 
            nos aparecerá el temible mensaje de “Out of Memory”.
        </p><p>
            Así que toco cambiar el chip en eso también, leer un poco sobre el tema y restructurar todo. En principio  partí todo en archivos
            y utilizo “dofile”, esto ayuda también a trabajar más rápido ya que subir archivos largos para probar cambios o corregir errores 
            pequeños  me estaba siendo un incordio y al principio nos pasara frecuentemente. En definitiva estoy abusando de funciones, 
            funciones cortas y con variables locales con nombres cortos, esto se supone que ayudara con la memoria. Asignar “nil” cuando 
            ya no utilice las globales y centrándome en reusabilidad. En definitiva ¡hay que cuidar el código mucho!
        </p><p>
            Lo siguiente cuando me vuelva a frenar el “Out of memory” será compilar, el código ocupara bastante menos espacio en memoria 
            que subir los scripts sin compilar que es lo que estoy haciendo ahora.
        </p><p>
            Configurar el wifi del dispositivo con Lua es muy fácil, después realice un mini http server, pude ver que hay algún proyecto 
            que otro que están implementando un httpd en condiciones pero me parece exagerado para mis intenciones, además posiblemente 
            propiciara más los problemas de memoria, y en definitiva hacer el mío propio para empezar es más que útil para aprender y al 
            no querer un servidor web bastante completo es más factible hacerlo en mi opinión.
        </p><p>
            A medida que avance el desarrollo me encontré con que muchas de las funciones del API que había en los ‘docs’ no existían en 
            estas versiones así que decidí lo que comente anteriormente de actualizarme a la última.
        </p><p>
            Después de la mareada de firmwares e instalar el ‘dev’ me encontré con el otro problema y es que mi servidor http no funcionaba, 
            de uno a otro cambiaran muchas cosas y la programación procedural enviando sends ya no era confiable pues enviaba el primero 
            y nada garantizaba los demás, y  lo de garantizar es un decir por qué no enviaba ninguno más nunca, así que toco reescribir 
            de nuevo y guiarme por los docs/api para el envió de datos devuelta con send.
        </p><p>
            En definitiva, después de perder el tiempo me parece un poco desastroso que  los docs están actualizados y los firmwares a 
            un año luz de estos, y que no haya un firmware estable que corresponda con los docs por lo que el que se ponga tendrá que 
            elegir entre liarse con los docs y sorpresas del API o la inestabilidad del rama ‘dev’,  y en caso de elegir lo primero 
            cuando saquen un firmware estable y deseáramos actualizar con las nuevas opciones posiblemente tendríamos que hacer 
            importantes cambios en nuestro código para que funcione correctamente, y como tengas un proyecto grande puede ser una 
            buen rompecabezas.
        </p><p>
            Yo personalmente lo tengo claro y voy por lo inestable, esperando que vayan sacando una versión estable pronto sin que sea del siglo pasado.
        </p><p>
            Estos dias comenzo una discusión en  "Issues/github" sobre este problema, los devs de momento recomienda utilizar la rama dev. 
        </p>
    </article>            
</div>

<?php
include("include/profilebanner.inc.php");
include("include/footer.inc.php");