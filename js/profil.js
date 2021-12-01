
function onClickFavorited(event)
{
  window.location.replace('index.php?action=profil&show=favorited&id='+event.srcElement.alt);
}
function onClickMyPost(event)
{
  window.location.replace('index.php?action=profil&show=self&id='+event.srcElement.alt);
}