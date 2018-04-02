<?php
/*
 *  Copyright @ 2017 Diego Garcia
 */

include("include/head.inc.php");
?>

<div class="blackdiv"></div>
<div class="wrapper_w100_padding">
    <article class="gen_article">
        <p>Fecha creacion: Julio 2016 - Dependiendo de la fecha puede estar obsoleto o parcialmente obsoleto </p>
        <h1>QoS (Quality of Service</h1>
        <ul>
            <li><a href="#Intro">Introducción</a></li>
            <li><a href="#Conocimientos">Conocimientos previos</a></li>
            <li><a href="#Escenario">Escenario</a></li>
            <li><a href="#Objetivo">Objetivo</a></li>
            <li><a href="#Consideraciones">Consideraciones</a></li>
            <li><a href="#Comenzando">Comenzando</a></li>
            <li><a href="#Marcado">Marcado de paquetes</a></li>
            <li><a href="#Ajustes">Ajustes finales</a></li>
            <li><a href="#Script">Script</a></li>
            <li><a href="#Enlaces">Enlaces</a></li>
        </ul>


        <h2 id="Intro">Introducción  QoS  con HTB y SFQ</h2>
        <p>QoS es el acrónimo de Quality of Service (Calidad de servicio), y hace referencia al control del tráfico en una red para garantiza 
            un buen funcionamiento de todos los servicios.
        </p>
        <p>HTB es el acrónimo de Hierarchical token bucket, y es un algoritmo que nos proporcionara el modo principal de manejar el ancho de 
            banda, este algoritmo nos permite especificar un ancho de banda reservado (rate) y un máximo de banda a utilizar (ceil). 
            Existen otros algoritmos como CBQ que no entraremos.
        </p>

        <p>SFQ es el acrónimo de Stochastic Fairness Queueing. Por defecto las cola es FIFO (Primero entrar es el primero en salir) 
            este algoritmo lo utilizaremos para modificar ese comportamiento excepto en nuestra clase de mayor prioridad que seguirá siendo 
            la de por defecto.  Con este algoritmo nos aseguraremos que si hay varias conexiones de usuarios un usuario no acapare durante mucho 
            tiempo la conexión, por lo que por mucho que entre antes los paquetes de dicha conexión SFQ dará la misma posibilidad a otros
            paquetes de otra conexiones salir.
        </p>

        <p>Este artículo es introductorio y básico.</p>

        <h2 id="Conocimientos"> Conocimientos previos recomendables.</h2>

        <p> Es conveniente tener conocimientos básicos de redes, así como el uso de iptables y bash. Voy a suponer que si estás buscando algo 
            de QoS ya tienes un servidor realizando NAT/MASQ por lo que no entrare a detallar nada sobre eso. Si no es así hay otras 
            guías específicas.
        </p>

        <h2 id="Escenario">Escenario</h2>
        <p>En este ejemplo vamos configurar QoS en un servidor que  da acceso a una red interna de varios ordenadores  haciendo NAT/Masquerading 
            a través de una conexión de fibra óptica de 200/20 MB de bajada/subida.
        </p>
        <p> El servidor tiene servicios dns, web, mail y hace de firewall con unas reglas por defecto DROP para  INPUT y FORWARD y ACCEPT para OUTPUT.
        </p>
        <p> Solo se hará QoS sobre el tráfico de salida que es el más limitado y el que puede llegar más fácilmente a saturar la conexión.
        </p>

        <h2 id="Objetivo">Objetivo</h2>
        <p>El objetivo es priorizar determinado tráfico con respecto a otro para incrementar la latencia del trafico más priorizado, y en caso de 
            congestión, el trafico más importante tengan garantizado un ancho de manda mínimo.
        </p>
        <p>Para ello utilizaremos cuatro prioridades, de mayor a menor 0, 1, 2, 3 y el marcado de paquetes ira de 1 a 4. (Ya hablere de ello más adelante)
        </p>

        <h2 id="Consideraciones">Consideraciones</h2>

        <p>El servidor cuenta con dos interfaces ethernet, uno conectado a internet y otro conectado al resto de red. El interface conectado a 
            internet tiene el nombre enp1s10 y el de la red local enp1s8. Es común encontrarse con otros nombres como eth0/eth1. Aquí nos 
            centraremos solo en el interface de salida a internet.
        </p>

        <p>Actualmente dicho servidor hace NAT/Masquerading, proporciona servicios de mail, web, dns y firewall. 
        </p>
        <p>En máquinas haciendo NAT/MASQ no se puede marcar por IP el tráfico entrante ya que todo el tráfico entra con la dirección IP del servidor y el marcaje se produce antes de que el servidor cambie al destinatario real dentro de la red local. Aunque se puede utilizar IMQ para marca el tráfico, cosa que no hablaremos en este artículo, aunque quizás en el futuro si me coincide la necesidad aprovechare para hacer alguno articulo al respecto.
        </p>

        <p>El ancho máximo, en nuestro caso de subida de datos, hay que ajustarlo siempre por debajo del máximo, o sea a pesar de tener 20mb de subida lo configurare por a 18mb. Es conveniente hacer sin carga en la red una prueba de velocidad máxima real y trabajar sobre eso, este paso es crítico, ya que el servidor que controle QoS tiene que ser el que limita, si pones por encima del ancho real será el modem/router que da conexión a internet el que limite por saturación y simplemente no funcionara el QoS. 
            Mis test de velocidad marcaban casi 20mb pero sin llegar, yo empecé por  algo más bajo (18mb) y luego  lo deje en 19mb porque después de varias pruebas suele ser bastante estable y está siempre entre 19 y 20. Y lo más importante saturando la conexión compruebo que hay descarte de paquetes por parte del servidor.
        </p>

        <p>El reparto de ancho lo dividiré entre las divisiones proporcionalmente (o sea entre 4) , para este caso no se necesita nada especifico pero cada cual es libre de reservar el ancho que crea oportuno para cada división.
        </p>

        <h2 id="Comenzando">Comenzando</h2>

        <p>El concepto de cómo funciona QoS no es muy difícil de comprender si buscamos una forma visual de imaginarnos el tema de forma simple, y aunque existan peros por que el tema es más profundo para empezar personalmente creo que es lo mejor.
        </p>
        <p>Visualizaremos un departamento de correos de un pequeño pueblo conectado por dos tuberías, una  tubería  viene del pueblo (red local) y está en el extremo izquierdo del departamento, y la otra que está conectada al resto del mundo (internet) que esta al extremo derecho. 
        </p>

        <p>Actualmente están llegando paquetes al departamento de correos desde el pueblo de seguido, así como llegan un oficinista de correos lo coge y lo mete en el otro tubo (FIFO - primero entrar primero en salir) y este recorre toda oficina para ir al resto del mundo (internet) 
        </p>

        <p>Queremos cambiar esto y añadir más tuberías, y especificar el ancho de banda para cada tubería, para ello necesitamos una tubería
            padre por la que pasaran todos los paquetes acoplada a la ya existen tubería que llamaremos enp1s10, que es el interface. Esta tuberia
            nos tiene que crear tuberías ramificadas  por las que enviar con más o menos prioridad los paquetes y ofrecer más o menos ancho de 
            banda garantizada. Esto se consigue añadiendo el qdisc al interface      
        </p>
  
        <pre class="code">$ tc qdisc add dev enp1s10 root handle 1: htb default 13 </pre>

        <p>Con la orden anterior añadimos un "conector" root qdisc referenciado por 1:  al que poder conectar la tubería principal o root y asimismo
            nos permitirá ramificaciones. De paso le indicamos que todo los paquetes van a ir por defecto por la salida 13 que va a ser nuestra tubería 
            de menor prioridad, para así filtrar solo lo que queremos darle más prioridad.
        </p>

        <p>Luego queda añadí la tubería principal al qdic:
        </p>
        <pre class="code"> tc class add dev enp1s10 parent 1: classid 1:1 htb rate 144mbit ceil 144mbit </pre>
        </p>

        <p>Configuramos la tubería principal como  htb, esta tubería tiene la peculiaridad que se le pueden conectar otras tuberías. 
            Según la hemos configurado   tendrá reservado un ancho de banda de 144mbits y podrá alcanzar un máximo de 144mbits. Ósea el máximo del que disponemos
        <p>
        <p>Todos los paquetes que entran por enp1s10 ahora pasaran por aquí. classid es como el nombre para referenciarla después
        </p>

        [ILUSTRACION]

        <p>De momento hasta aquí poco ha cambiado salvo que le indicamos el máximo.</p>
        <p>El sistema para regular la velocidad es un poco primitivo y se basa en que cuando llega al máximo desechar todos los paquetes que llegan para que el que lo envié los deje de enviar tan rápido y reduzca su velocidad.
        </p>

        <p>El camino como vemos sigue siendo recto, todo lo que venga del interface interno entrara por root1 hacia la red externa.
        </p>
        <p>Podemos comprobar con: 
        </p>
        <pre class="code">
            tc -s class show dev enp1s10
        </pre>
        <p>
            Que  efectivamente tenemos un tubería de class 1:1 root por lo que están pasando todos los paquetes.
        </p>
        <p>
            Lo siguiente es añadir  el resto de tuberías que desciende de la padre 1:1, y con classid las pasaremos a denominar 1:10, 1:11, etc
        </p>

        <pre class="code">
            tc class add dev enp1s10 parent 1:1 classid 1:10 htb rate 34mbit ceil 144mbit prio 0
            tc class add dev enp1s10 parent 1:1 classid 1:11 htb rate 34mbit ceil 144mbit prio 1
            tc class add dev enp1s10 parent 1:1 classid 1:12 htb rate 34mbit ceil 144mbit prio 2
            tc class add dev enp1s10 parent 1:1 classid 1:13 htb rate 34mbit ceil 144mbit prio 3
        </pre>
        <p>
            Es muy similar a la otra solo que estas desciende de la tubería root 1:1 en vez del QDISC :1, también cambiamos el ancho de banda reservado a 35mbit y la posibilidad de utilizar el máximo de 144mbit si está libre. Configuramos también las prioridades siendo :10  la tubería con mayor prioridad (0) y la :13 la menor (3).
        </p>

        <p>Nuestra representación gráfica quedaría por lo tanto algo tal que así:
        </p>											            

        [ILUSTRACION]

        <p>Asimismo para evitar que una conexión acapare la cola completamente añadiremos el algoritmo SFQ a todas las tuberías excepto la más prioritaria.
        </p>
        <pre class="code">
            tc qdisc add dev enp1s10 parent 1:11 handle 110: sfq perturb 10
            tc qdisc add dev enp1s10 parent 1:12 handle 120: sfq perturb 10
            tc qdisc add dev enp1s10 parent 1:13 handle 130: sfq perturb 10
        </pre>

        <p>Lo siguiente es añadir los filtros:
        </p>

        <pre class="code">
            tc filter add dev enp1s10 parent 1:0 protocol ip prio 1 handle 1 fw classid 1:10
            tc filter add dev enp1s10 parent 1:0 protocol ip prio 2 handle 2 fw classid 1:11
            tc filter add dev enp1s10 parent 1:0 protocol ip prio 3 handle 3 fw classid 1:12
            tc filter add dev enp1s10 parent 1:0 protocol ip prio 4 handle 4 fw classid 1:13
        </pre>

        <p>
            Con estas líneas creamos 4 filtros con referencia 1, 2, 3, 4 que derivara (fw forward) todo los paquetes a la tubería (classid) indicada.
        </p>
        <p>Ósea todos los paquetes marcados con 1 serán derivados a la tubería 1:10 y así sucesivamente.
        </p>

        <p>Con eso tenemos todas las tuberías que queríamos, si utilizamos la orden anteriormente dada para ver el estado
        </p>

        <pre class="code">$ tc -s class show dev enp1s10</pre>
        <p>
            Veremos que ahora todos los paquetes pasan por la tubería root y la 1:13 que es la que configuramos como tubería por defecto.
            Y  ya tenemos configuradas nuestras tuberías QoS.
        </p>

        <h2 id="Marcado">Marcado de paquetes</h2>
        <p>
            Tenemos las tuberías pero vemos como todos los paquetes aparte de la tubería root pasa por la 14, la default, nuestro objetivo ahora será marcar con iptables los paquetes que pasaran por las otras tuberías con mayor prioridad a la default.
        </p>
        <p>    En este caso que estoy configurado  es bastante simple </p>
        <p>Prioridad más alta (0), marca 1 => 0x1</p>
        <ul>        
        <li>Protocolo ICMP y UDP al completo</li>
        <li>Conexión SSH</li>
        <li>Tos Minime-delay</li>       
        <li>Paquetes SYNC RST ACK</li>
        </ul>        
        <p>Prioridad alta (1) marca 2 => 0x2</p>
        <ul>
        <li>Trafico Web</li>
        </ul>
        <p>Prioridad media (2) marca 3 => 0x3</p>
        <ul>
        <li>Otros servicios  del servidor  (imap, pop, etc)</li>
        </ul>
        <p>Prioridad baja(3) marca 4 => 0x4</p>
        <ul>
        <li>Tubería por defecto, No marcaremos nada especifico todo el resto del trafico ira por aquí.</li>
        </ul>
        <p>Antes de seguir y aunque este artículo no pretende meterse de lleno en iptables/netfilter hay algo que es imprescindible conocer así que hay que hacer un alto.
        </p>
        <p>
            Todo paquete que llega al interface, en nuestro caso enp1s10 pasa por una chains (cadenas) y tablas que determinan su signo, las que nos importan a nosotros es PREROUTING y OUTPUT así que solo explicare por encima estas. Para profundizar sobre netfilter hay otros tutoriales específicos.
        </p>
        <p>
            Empezando por la más encilla, todo lo que sale/generado de nuestro servidor con origen de este sale (o sea localmente) pasa por  OUTPUT. O sea los datos generados y enviados por este.
        </p>
        <p>
            Todos los datos que llegan a cualquier interface pasan primero PREROUTING, luego los que no van destinados al servidor este los manda a FORWARD y luego a POSTROUTING para salir. En PREROUTING hay una tabla llamada mangle que es la que se debe utilizar para meter las reglas de marcar de paquetes.
        </p><p>
            Por lo que como vamos a marcar paquetes que van a internet marcaremos los paquetes en OUTPUT para el tráfico local del servidor y en PREROUTING para el tráfico que llega desde nuestra red interna. Siempre añadiremos en la tabla mangle.
        </p><p>
            Veamos los ejemplos:
        </p>

        <h3>SSH</h3>
        <pre class="code">
            iptables -t mangle -A PREROUTING -p tcp -m tcp --dport 22 -j MARK --set-mark 0x1
            iptables -t mangle -A OUTPUT -p tcp -m tcp --dport 22 -j MARK --set-mark 0x1
        </pre>
        <p>
            La primera linea prioriza los paquetes que vayan con destino a un puerto ssh
        </p><p>
            La segunda linea prioriza la salida de paquetes cuando nos conectamos desde el servidor a algún servidor ssh externo.
        </p>

        <h3>SYNC RST ACK</h3>

        <p>Los paquetes sync, rst y ack se originan para abrir y cerrar nuevas conexiones  por lo que suele ser recomendado hacerlos prioritarios.
        </p>
        <pre class="code">
            iptables -t mangle -I PREROUTING -p tcp -m tcp --tcp-flags SYN,RST,ACK SYN -j MARK --set-mark 0x1
            iptables -t mangle -I OUTPUT -p tcp -m tcp --tcp-flags SYN,RST,ACK SYN -j MARK --set-mark 0x1
        </pre>

        <h3>ICMP</h3>
        <p>
            Los paquetes ICMP participante en el buen funcionamiento de la red y envio de errores.
        </p>
        <pre class="code">
            iptables –t mangle –A PREROUTING -p icmp -j MARK --set-mark 0x1
            iptables –t mangle –A OUTPUT -p icmp -j MARK --set-mark 0x1
        </pre>

        <h3> Navegación Web</h3>
        <p>Vamos a quitar el tráfico de navegación que viene de nuestra red local fuera de prioridad más baja y darle una más alta pero siempre por debajo de la más alta. Para ello marcamos los de destino http normal 80 y https 443
        </p>
        <pre class="code">
            iptables -t mangle -A PREROUTING  -p tcp -m tcp --dport 443 -j MARK --set-mark 0x2
            iptables -t mangle -A PREROUTING  -p tcp -m tcp --dport 80 -j MARK --set-mark 0x2
        </pre>
        <p>Es raro navegar desde el servidor pero ya que estamos también lo añadimos
        </p>
        <pre class="code">
            iptables -t mangle -I OUTPUT -p tcp -m tcp --dport 443 -j MARK --set-mark 0x2
            iptables -t mangle -I OUTPUT -p tcp -m tcp --dport 80 -j MARK --set-mark 0x2
        </pre>

        <h3> Webserver</h3>
        <p>
            Como mencione el servidor tiene  un servidor web así que vamos a añadirlo también a la prioridad 2, funciona casi exclusivamente por el puerto 443 pero otra ya que estamos...
            Este tráfico no viene de dport 443 si no que al contrario que la navegación se origina en 443 por lo que utilizamos sport.
        </p>
        <pre class="code">
            iptables -t mangle -I OUTPUT -p tcp -m tcp --sport 443 -j MARK --set-mark 0x2
            iptables -t mangle -I OUTPUT -p tcp -m tcp --sport 80 -j MARK --set-mark 0x2
        </pre>
        <h3>udp</h3>
        <p>El trafico udp son paquetes pequeños y que generalmente se quiere rapidez en ellos por lo que los movemos para prioridad alta 1. Tambien incluye el marcado de paquetes UDP de nuestro servidor DNS
        </p>
        <pre class="code">
            iptables –t mangle –A  PREROUTING -p udp -j MARK --set-mark 0x1
            iptables –t mangle –A OUTPUT -p udp -j MARK --set-mark 0x1
        </pre>
        <h3>TCP DNS server</h3>
        <p>
            El servidor dns se comunica con otros, esta específicamente es el maestro de otros servidores DNS por lo que aunque poco también hay trafico tcp que podemos meter también como prioritario
        </p>
        <pre class="code">
            iptables –t mangle –A  PREROUTING  -p tcp -m tcp --dport 53 -j MARK --set-mark 0x1
            iptables –t mangle –A  OUTPUT -p tcp -m tcp --dport 53 -j MARK --set-mark 0x1
        </pre>

        <p>Por último el resto del tráfico del servidor lo quitamos de abajo de todo pero por debajo del resto, exactamente a prioridad 3.
        </p>
        <pre class="code">
            iptables -t mangle -I OUTPUT -p tcp -m tcp --sport 25 -j MARK --set-mark 0x3
            iptables -t mangle -I OUTPUT -p tcp -m tcp --sport 110 -j MARK --set-mark 0x3
            iptables -t mangle -I OUTPUT -p tcp -m tcp --sport 587 -j MARK --set-mark 0x3
            iptables -t mangle -I OUTPUT -p tcp -m tcp --sport 993 -j MARK --set-mark 0x3
            iptables -t mangle -I OUTPUT -p tcp -m tcp --sport 995 -j MARK --set-mark 0x3
        </pre>
        <p>
            Y algunos hay ejemplos más hay en el script enlazado al final.
        </p><p>
            Uno de ellos es con respecto al TOS, los encabezados IP tienen una marca de tipo de servicio y estas se toman en consideración para tratarlas con más prioridad o no, así que nuestra configuración QoS será consecuente.
        </p>

        <h2 id="Ajustes">Ajustes finales</h2>
        <p>
            Para empezar a pesar de tener 20mb de subida y comprobados 19.6mb, hemos hecho las pruebas con un ancho de banda de 18, por lo que estamos desperdiciando 1.6mb y toca ajustarlo, el problema es que si nos pasamos el cuello de botella no se generara en nuestro servidor por lo que de nada nos valdrá.
        </p><p>
            La forma más sencilla de comprobar que funciona es saturando la conexión y ver con el comando tc show mencionado anteriormente que el sistema está descartando paquetes. Hay formas de saturar conexiones y en caso de subida no suele ser complicado y seguramente más de una vez la hemos saturado sin querer por eso nos interesamos por el QoS. También hay herramientas  específicas para hacer comprobaciones como es iperf.
        </p>

        <h2 id="Script">Script</h2>
        <p>
            Uno de mis script para Ubuntu se puede descargar <a href="https://gist.github.com/diegargon/414dd5511e7d0bd32ef79a1556312729">pulsando aquí</a>. 
        </p><p>
            El "Requeriment" myFirewall es otro script del firewall usado y es requerido por que activa el NAT/MASQ y otras reglas.
        </p><p>            
            Las reglas opcionales RETURN evitan que se sigan recorriendo si hay coincidencia la otras reglas de marcado. En la mayoría de sistemas es seguro pero puede haber sistemas/configuraciones que no, de ahí a que sea opcional.
        </p><p>            
            Como menciono arriba se hace mención a DOWN_SPEED y INT_IF pero no se utilizan en este ejemplo
        </p>

        <h2 id="Enlaces">Enlaces</h2>
        <p><a href="http://lartc.org/howto/">Linux Advanced Routing HOWTO</a></p>
        <p><a href="https://wiki.debian.org/LSBInitScripts">Scripts de inicio en Ubuntu</a></p>
        <p><a href=""></a></p>
    </article>            
</div>

<?php
include("include/profilebanner.inc.php");
include("include/footer.inc.php");
