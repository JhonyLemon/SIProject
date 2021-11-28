<?php

function redirect($url)
{
    header("Location:index.php?action=$url",FALSE,301); exit;
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

function GetChildComments($IDparent,$i,$comments,&$children)
{
    for($j=$i+1; $j<count($comments); $j++)
    {
        if($comments[$j]['IDparent']==$IDparent)
        {
            $children[]=$comments[$j];  
            GetChildComments($comments[$j]['IDcomment'],$j,$comments,$children);
        }
    }
}

function GetCommentIconUpVote($voted,$id)
{
    foreach($voted as $key => $value)
    {
        if($voted[$key]['IDcomment']==$id)
        {
            if($voted[$key]['vote']==1)
                return "UpVoteON";
            else
                return "UpVoteOFF";
        }
    }
    return "UpVoteOFF";
}
function GetCommentIconDownVote($voted,$id)
{
    foreach($voted as $key => $value)
    {
        if($voted[$key]['IDcomment']==$id)
        {
            if($voted[$key]['vote']==0)
                return "DownVoteON";
            else
                return "DownVoteOFF";
        }
    }
    return "DownVoteOFF";
}

?>

