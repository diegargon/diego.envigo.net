<?php
/*
 *  Copyright @ 2017 Diego Garcia
 */
include("config/config.php");
include("" . $cfg['PATH'] . "/include/head.inc.php");
?>

<div class="blackdiv"></div>
<div class="wrapper_w100_padding">
    <h1> Sistemas </h1>
    <div class="tables_wrapper">
        <table id="t_systems">
            <tr>
                <td>
                    <img width="200" src="https://diego.envigo.net/systems/img/KernelProgrammingEmbeddedLinux.png" alt='Embedded Systems'/>
                </td>
                <td>
                    <h2>Sistemas embebidos</h2>
                    <ul>                        
                        <li><a>Intro a ESP32 (pronto)</a></li>                             
                        <li><a>Esp12-E y arduino (pronto)</a></li>
                        <li><a href="articulos/esp12e-crudo.php">Esp12-E en crudo</a></li>
                        <li><a href="articulos/iot.php">Empezando con dispositivos IoT y embebidos</a></li>
                        <li><a href="articulos/OrangePI.php">Intro a OrangePI y firmwares</a></li>                   
                    </ul>                    

                </td>
        </table>     
        <table id="t_systems">
            <tr>
                <td>
                    <img width="200" src="https://diego.envigo.net/systems/img/Linux-server.png" alt='redes y administración'/>
                </td>
                <td>
                    <h2>Redes y administración de sistemas</h2>
                    <ul>
                        <li><a href="articulos/qos.php">QoS: Introducción</a></li>                        
                    </ul>                    
                </td>
        </table>             
    </div> 
</div>

<?php
include("" . $cfg['PATH'] . "include/profilebanner.inc.php");
include("" . $cfg['PATH'] . "include/footer.inc.php");
