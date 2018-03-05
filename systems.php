<?php
/* 
 *  Copyright @ 2017 Diego Garcia
 */
include("include/head.inc.php");
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
                        <li><a href="/iot.php">Empezando con dispositivos IoT y embebidos</a></li>
                        <li><a href="/OrangePI.php">Intro a OrangePI y firmwares</a></li>
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
                        <li><a href="/qos.php">QoS: Introducción</a></li>                        
                    </ul>                    
                </td>
        </table>             
    </div> 
</div>

<?php
include("include/profilebanner.inc.php");
include("include/footer.inc.php");


