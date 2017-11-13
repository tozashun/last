<?php

	$name = $_POST['name'];
	$name = htmlspecialchars($name);

	$comment = $_POST['comment'];
	$comment = htmlspecialchars($comment);

	$delete = $_POST['delete'];
//	$delete = htmlspecialchars($delete);

	$edit = $_POST['edit'];
//	$edit = htmlspecialchars($edit);

	$time = date("Y/m/d H:i:s");

	$line = file("kadai2-2.txt");
	$num = count($line);

	$write = $num."<>".$name."<>".$comment."<>".$time."\r\n";

	if(!empty($name) && !empty($comment)){
		$fp = fopen ("kadai2-2.txt","a");
		fputs($fp, $write);
		fclose($fp);
	}

  if (!empty($delete)) {
        $delCon = file("kadai2-2.txt");
        for ($j = 0; $j < count($delCon) ; $j++) {
            $delData = explode("<>", $delCon[$j]);
            if ($delData[0] == $delete) {
                array_splice($delCon, $j, 1);
                file_put_contents("kadai2-2.txt", $delCon);
            }
        }
    }

	if(!empty($edit)){
		$ediCon = file("kadai2-2.txt");
		for ($k = 0; $k < count($ediCon) ; $k++){
			$ediData = explode("<>", $ediCon[$k]);
			if ($ediData[0] == $edit){
				for($h = 0; $h < count($ediData); $h++){
					$simEdit[$h] = mb_substr(trim($ediData[$h]),0);
				}
			}
		}
	}

?>


<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8"/>
<head>
<title>PHP2-5</title>
</head>

<body>
<h1>簡易掲示板</h1>

<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
<p>投稿者<input type="text" name="name" value="<?php echo $simEdit[1]; ?>"><br></p>

<p>コメント<br></p>
<p><textarea name="comment" rows="8" cols="40"><?php echo $simEdit[2]; ?>
</textarea><br><br></p>

<input type="submit" value="投稿する">
</form>

<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
<p>削除要請</p>
<p>投稿番号<input type="text" name="delete"><br></p>
<input type="submit" name="btn2" value="削除する">
</form>

<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
<p>編集要請</p>
<p>投稿番号<input type="text" name="edit"><br></p>
<input type="submit" value="編集する">
<input type="hidden"  name="h_edit" value="hensyu">

</form>

<?php
//配列への代入処理
	$fp3 = fopen('kadai2-2.txt', "r");
	$dataArr= array();
	while( $res = fgets($fp3)){
		$tmp = explode("<>",$res);
		$arr = array(
		"No."=>$tmp[0],
		"name"=>$tmp[1],
		"comment"=>$tmp[2],
		"time"=>$tmp[3],
		);
		$dataArr[]= $arr;
	}
?>

//書き込み内容の表示
<dl>
	<?php foreach( (array)$dataArr as $message ):?>
		<p><span><?php echo $message["No."]; ?></span>:<span><?php echo $message["name"]; ?></span>:<span><?php echo $message["comment"]; ?></span>:<span><?php echo $message["time"]; ?></span></p>
	<?php endforeach;?>
</dl>


</body>
</html>



