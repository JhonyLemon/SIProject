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
return _PHOTO_PATH.DIRECTORY_SEPARATOR.$row['IDphoto'].'.'.$row['ext'];
}

function LobbyURL($row)
{
return _PHOTO_PATH.DIRECTORY_SEPARATOR.$row['IDphoto'].'.'.$row['ext'];
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

function GetParentCommentText(&$sortedComments,&$key)
{
    if($sortedComments[$key]['IDparent']!=0)
        for($i=$key-1; $i>=0; $i--)
            if($sortedComments[$i]['IDcomment']==$sortedComments[$key]['IDparent'])
                return $sortedComments[$i]['text'];
}

function RandomID(&$db)
{

    $stmt = $db->query("SELECT MIN(IDpost) FROM posts");
    $min=$stmt->fetch();
    $stmt = $db->query("SELECT MAX(IDpost) FROM posts");
    $max=$stmt->fetch();
    $id=mt_rand($min['0'],$max['0']);
    $stmt = $db->prepare("SELECT IDpost FROM posts WHERE IDpost=(SELECT MIN(IDpost) FROM posts WHERE IDpost>=:id)");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $next=$stmt->fetch();

    $stmt = $db->prepare("SELECT IDpost FROM posts WHERE IDpost=(SELECT MAX(IDpost) FROM posts WHERE IDpost<=:id)");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $previous=$stmt->fetch();

    if($next && $previous && $next['0']-$id>$id-$previous['0'])
    {
        return $previous['0'];
    }
    else if($next && $previous && $next['0']-$id<$id-$previous['0'])
    {
        return $next['0'];
    }
    else if($previous['0'] == $next['0'])
    {
        return $id;
    }
    else if(!$next && $previous)
    {
        return $previous['0'];
    }
    else if(!$previous && $next)
    {
        return $next['0'];
    }
    else
    {
        return RandomID($db);
    }
}
?>