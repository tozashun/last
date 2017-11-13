﻿<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8"/>
<head>
<title>PHP2-3</title>
</head>

<body>
<h1>簡易掲示板</h1>
<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
<p>投稿者 <input type="text" name="name"><br></p>
<p>コメント<br></p>
<p><textarea name="comment" rows="8" cols="40">
</textarea><br><br></p>
<input type="submit" name="btn1" value="投稿する">

<p>削除要請</p>
<p>投稿番号 <input type="text" name="name"><br></p>
<input type="submit" name="btn2" value="投稿する">

</form>




<?php


//タイムゾーン
date_default_timezone_set('Asia/Tokyo');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	writeData();
}

function writeData(){

//内容の代入
	$name = $_POST['name'];
	$comment = $_POST['comment'];
	$comment = nl2br($comment);

//カウンターの数を増やす。
	$counter_file = 'count.txt';

	$fp = fopen($counter_file, "r+");
	if ($fp){
		if (flock($fp, LOCK_EX)){
			$counter = fgets($fp, 10);
			$counter++;
			rewind($fp);
			if(fwrite($fp, $counter) === FALSE){
				print('ファイルの書き込みに失敗しました');
				}
			flock($fp, LOCK_UN);
			}
		}
	fclose($fp);

//各行の配置
	$data = $counter."<>".$name."<>".$comment."<>".date(' Y h:i:s A')."\r\n";
//	$data = strip_tags($data);

	$kadai2_2_file = 'kadai2-2.txt';
	$fp2 = fopen($kadai2_2_file, "ab");

	if ($fp2){
        if (flock($fp2, LOCK_EX)){
            if (fwrite($fp2,  $data) === FALSE){
                print('ファイル書き込みに失敗しました');
            }

            flock($fp2, LOCK_UN);
        }else{
            print('ファイルロックに失敗しました');
        }
	}
	fclose($fp2);
}

	$kadai2_2_file = 'kadai2-2.txt';
	$fp3 = fopen($kadai2_2_file, "r");

//配列への代入
$dataArr= array();
while( $res = fgets( $fp3)){
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


