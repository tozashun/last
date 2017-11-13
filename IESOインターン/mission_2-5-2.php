<?php
//各変数の定義づけ
	$name = $_POST['name'];
	$name = htmlspecialchars($name);

	$comment = $_POST['comment'];
	$comment = htmlspecialchars($comment);

	$delete = $_POST['delete'];

	$edit = $_POST['edit'];
	$h_edit = $_POST['h_edit'];

	$time = date("Y/m/d H:i:s");

	$line = file("kadai2-2.txt");
	$num = count($line);

	$write = $num."<>".$name."<>".$comment."<>".$time."\r\n";

//hidden確認
	if ( isset( $_POST['h_edit'] ) ) {
    		var_dump( $_POST['h_edit'] );
	} else {
	    echo '受け取れてないよ';
	}

//書き込み処理
	if(!empty($name) && !empty($comment)){
						$h_edit = $_POST['h_edit']; 

//通常の書き込み処理
//二回目の書き込み処理をした際に、h_editが消えてしまい、ここから先の分岐が行われていないと思われる。

		if(empty($h_edit)){
			$fp = fopen ("kadai2-2.txt","a");
			fputs($fp, $write);
			fputs($fp, $h_edit.$edit);
			fclose($fp);
		}else{	
//編集用の書き込み処理

/*			$hedCon = file("kadai2-2.txt");
        		for ($l = 0; $l < count($hedCon) ; $l++) {
				$hedData = explode("<>", $hedCon[$l]);
        			if ($hedData[0] == $edit) {
              				  file_put_contents("kadai2-2.txt", $write);	
				}
			}
*/
	    echo $h_edit;
		}
	}

//削除処理
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

//編集時、データの読み込み処理
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


//投稿者名、コメント
<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
<p>投稿者<input type="text" name="name" value="<?php echo $simEdit[1]; ?>"><br></p>
<p>コメント<br></p>
<p><textarea name="comment" rows="8" cols="40"><?php echo $simEdit[2]; ?>
</textarea><br><br></p>

//編集モードの確認
<?php echo $h_edit; ?>
<input type="submit" value="投稿する">
</form>

//削除要請
<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
<p>削除要請</p>
<p>投稿番号<input type="text" name="delete"><br></p>
<input type="submit" name="btn2" value="削除する">
</form>

//編集要請
<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
<p>編集要請</p>
<p>投稿番号<input type="text" name="edit"><br></p>
<input type="hidden"  name="h_edit" >
<input type="submit" value="編集する">

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



