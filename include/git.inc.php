<?php
/* 
 *  Copyright @ 2016 Diego Garcia
 */

 


if($_SERVER['PHP_SELF'] == '/' . basename(__FILE__)) {
        exit();
}

function get_user($user) {
    $curl_user_url = 'https://api.github.com/users/' . $GLOBALS["user"] . '';
    return curl_Get($curl_user_url);
}

function get_readme($reponame) {
  $curl_readme_url = 'https://api.github.com/repos/' . $GLOBALS["user"] . '/' . $reponame .'/readme';
  $response = curl_get($curl_readme_url);
  return base64_decode($response->content);
}

function get_repos() {
    $curl_repo_url = 'https://api.github.com/users/' . $GLOBALS["user"] . '/repos';
    return curl_get($curl_repo_url);  
    
    //return $response; 
}

function curl_get($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('User-Agent: Awesome-Octocat-App', $GLOBALS["curl_token"]));
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response);  
}

