<?php
if(array_key_exists("Red_Guy's_name", $_COOKIE)&&preg_match('/([Ee])lmo+/', $_COOKIE["Red_Guy's_name"])){
  $output=('<p>You got it! flag{YummyC00k13s}</p>');
}else{
    $output = ("<p>He's my favorite Red guy</p>");
    setcookie("Red_Guy's_name", 'NameGoesHere', time()+300);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cookie_monster</title>
    </head>
    <body>
    <?php
    echo($output);
    ?>
</body>
</html>
