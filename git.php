<?php
include("include/head.inc.php");

/*
if($_SERVER['PHP_SELF'] == '/' . basename(__FILE__)) {
        exit();
}
*/
require "config/gittoken.conf.php"; // <-- $token = '26cd28613f4b503c745c83bcc011bac73acda5e6'; 
require "include/git.inc.php";

//User Config
$user = 'diegargon';
$max_readme_chars = "200";
//End User Config
 
$curl_token = 'Authorization: token ' . $token;
?>


<div class="blackdiv"></div>
<div class="wrapper_w100_padding"> 
    <div class="github_user">
    <?php
        $user_info = get_user($user);
        //print_r($user_info);
        echo "<div class='github_user_top'>";
        echo "<div class='github_user_top_avatar'><img src='$user_info->avatar_url'></div>";
        echo "<div class='github_user_top_name'><a href='$user_info->html_url' target=_blank>$user_info->name</a><br/>@$user_info->login</div>";
        echo "</div>";
        
        echo "<div class='github_user_middle_details'>";
        echo "<ul>";
        echo "<li> <span class='octicon octicon-organization'></span>&nbsp; $user_info->company</li>";
        echo "<li><span class='octicon octicon-location'></span>&nbsp; $user_info->location</li>";
        echo "<li><span class='octicon octicon-link'></span>&nbsp; <a href='$user_info->blog'>$user_info->blog</a></li>";
        echo "<li><span class='octicon octicon-mail'></span>&nbsp; <a href='mailto:$user_info->email'>$user_info->email</a></li>";        
        echo "</ul>";
        echo "</div>";
        
        echo "<div class='github_user_bottom_details'>";
        echo "<a  href='https://github.com/diegargon' target=_blank><strong>$user_info->public_repos</strong><span>Repos</span></a>";
        echo "<a  href='https://gist.github.com/$user' target=_blank><strong>$user_info->public_gists</strong><span>Gist</span></a>";
        echo "<a  href='https://github.com/$user/following' target=_blank><strong>$user_info->followers</strong><span>Followers</span></a>";
        echo "</div>";
    ?>
    </div>
    
    <div class="github_repo">
    
<?php


$response = get_repos();

  if (!empty($response)) {
    
    foreach ($response as $repo) {
      $readme_content = get_readme($repo->name);
      if (strlen($readme_content) > $max_readme_chars) {
          $readme_content = substr($readme_content, 0, $max_readme_chars) ."...";
      }
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
<script type="text/javascript">$('#loading_wrap').hide();</script>

<?php
include("include/profilebanner.inc.php");

include("include/footer.inc.php");
