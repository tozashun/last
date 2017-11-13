<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8"/>
<head>
<title>PHP1-6</title>
</head>

<body>

<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
<p>投稿者 <input type="text" name="name"><br></p>
<p>コメント<br></p>
<p><textarea name="comment" rows="8" cols="40">
</textarea><br><br></p>
<input type="submit" name="btn1" value="投稿する">
</form>
  
<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	writeData();
}

function writeData(){
	$name = $_POST['name'];
	$comment = $_POST['comment'];
	$comment = nl2br($comment);

	$data = "<hr>\r\n";
	$data = $data."<p>投稿者：".$name."</p>\r\n";
	$data = $data."<p>内容：</p>\r\n";
	$data = $data."<p>".$comment."</p>\r\n";

	$kadaisix_file = 'kadaisix.txt';

	$fp = fopen($kadaisix, 'ab');

	if ($fp){
        if (flock($fp, LOCK_EX)){
            if (fwrite($fp,  $data) === FALSE){
                print('ファイル書き込みに失敗しました');
            }

            flock($fp, LOCK_UN);
        }else{
            print('ファイルロックに失敗しました');
        }
    }

    fclose($fp);
}

?>
</body>
</html>


