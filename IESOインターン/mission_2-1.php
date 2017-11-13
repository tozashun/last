<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8"/>
<head>
<title>PHP2-1</title>
</head>

<body>

<h1>簡易掲示板</h1>

<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
<p>投稿者 <input type="text" name="name"><br></p>
<p>コメント<br></p>
<p><textarea name="comment" rows="8" cols="40">
</textarea><br><br></p>
<input type="submit" name="btn1" value="投稿する">
</form>
  

</body>
</html>


