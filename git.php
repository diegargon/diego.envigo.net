<!--
 Copyright @ 2016 Diego Garcia
 V:0.001
-->

<?php
require "config/gittoken.conf.php"; // <-- $token = '26cd28613f4b503c745c83bcc011bac73acda5e6'; 

require "include/git.inc.php";

//User Config
$user = 'diegargon';
//End User Config
 
?>
<div class="blackdiv"></div>
<div class="wrapper_w100_padding"> 
    <div class="github_user">
    <?php
        $user_info = get_user($user);
        echo "<div class='github_user_top'>";
        echo "<div class='github_user_top_avatar'><img src='$user_info->avatar_url'></div>";
        echo "<div class='github_user_top_name'><a href='$user_info->html_url'>$user_info->name</a><br/>@$user_info->login</div>";
        echo "</div>";
        
        echo "<div class='github_user_middle_details'>";
        echo "<ul>";
        echo "<li>Company: $user_info->company</li>";
        echo "<li>Location: $user_info->location</li>";
        echo "<li>Web: <a href='$user_info->blog'>$user_info->blog</a></li>";
        echo "<li>Email:<a href='mailto:$user_info->email'>$user_info->email</a></li>";        
        echo "</ul>";
        echo "</div>";
        
        echo "<div class='github_user_bottom_details'>";
        echo "<a  href='$user_info->repos_url'><strong>$user_info->public_repos</strong><span>Repos</span></a>";
        echo "<a  href='$user_info->gist_url'><strong>$user_info->public_gists</strong><span>Gist</span></a>";
        echo "<a  href='$user_info->followers_url'><strong>$user_info->followers</strong><span>Followers</span></a>";
        echo "</div>";
    ?>
    </div>
    
    <div class="github_repo">
    
<?php

$curl_token = 'Authorization: token ' . $token;

$response = get_repos();

  if (!empty($response)) {
    
    foreach ($response as $repo) {
      $readme_content = get_readme($repo->name);
      print '<b>Project</b>: <a href="' . $repo->html_url . '" target="_blank">' . $repo->name . '</a><br />';      
      print '<div class="github_readme">';
      print '<p>Readme:</p>';
      echo nl2br(htmlspecialchars($readme_content));
      print '<br/>';
      print '</div>';
      print '<br/>';
      
    }
  }
?>
   
    </div>
</div>


