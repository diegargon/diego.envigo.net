<!--
 Copyright @ 2016 Diego Garcia
-->
<?php
#include "config/config.php";
//$token = '26cd28613f4b503c745c83bcc011bac73acda5e6';
//
//User Config
$user = 'diegargon';



//End User Config

function get_readme($reponame) {
  $curl_readme_url = 'https://api.github.com/repos/' . $GLOBALS["user"] . '/' . $reponame .'/readme';
  $response = curl_get($curl_readme_url);
  return base64_decode($response->content);
}

function get_repo() {
    $curl_repo_url = 'https://api.github.com/users/' . $GLOBALS["user"] . '/repos';
    $response = curl_get($curl_repo_url);  
    //print_r($response);
    return $response;
}

function curl_get($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Awesome-Octocat-App', $GLOBALS["curl_token"]));
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response);  
}

?>
<div class="blackdiv"></div>
<div class="wrapper_w100_padding">

    <div class="github-card"  data-user="diegargon"></div>
    <script src="//cdn.jsdelivr.net/github-cards/latest/widget.js"></script>


    
    <div class="github_repo">
    
<?php

$curl_token = 'Authorization: token ' . $token;

$response = get_repo();

  if (!empty($response)) {
    
    foreach ($response as $repo) {
      $readme_content = get_readme($repo->name);
      print '<a href="' . $repo->html_url . '" target="_blank">' . $repo->name . '</a><br />';      
      echo nl2br(htmlspecialchars($readme_content));
    }
  }
?>
   
    </div>
</div>


