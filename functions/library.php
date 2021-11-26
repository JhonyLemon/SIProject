<?php

function redirect($url)
{
    header("Location: index.php?action=$url",TRUE,301);
}
function testInput($data) 
{ 
    $data = trim($data);
    $data = htmlspecialchars($data);   
    return $data;
}

function IconsURL($name)
{
return _ICON_PATH.DIRECTORY_SEPARATOR.$name.'.png';
}

function PostURL($row)
{
$post=array();
$post['url']=_PHOTO_PATH.DIRECTORY_SEPARATOR.$row['IDphoto'].'.'.$row['ext'];
$post['alt']=$row['IDpost'];
$post['description']=$row['description'];
return $post;
}

?>

