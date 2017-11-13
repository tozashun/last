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

//通常の書き込み処理
//二回目の書き込み処理をした際に、h_editが消えてしまい、ここから先の分岐が行われていないと思われる。

		if(!isset ($_POST["id"])){
			$fp = fopen ("kadai2-2.txt","a");
			fputs($fp, $write);
			fclose($fp);
		}

//idがある＝編集処理
		if(isset($_POST["id"])){
			$contents = file("kadai2-2.txt");
			$fp1 = fopen('kadai2-2.txt','w');
			$edit_num =  $_POST["id"];
			foreach($contents as $content) {
				$parts = explode("<>", $content);
				if($parts[0] == $edit_num){
					fwrite($fp1,$write);
				} else {
					fwrite($fp1, "$content");
				}
			}
		fclose($fp1);
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

<p>-----------------------</p>
<p>編集したい番号を、半角数字で入力してください</p>
<form method="post" action="<?php echo($_SERVER['PHP_SELF']) ?>">
<input type="text" name="edit_num" placeholder="例)1" value="<?= isset($_POST['edit_num']) ? $_POST['edit_num'] : null ?>">
<input type="submit"  name="edit_btn" value="編集する">
<input type="hidden"  name="edit" value="hensyu">
</form>

<?php
  if(isset($_POST["edit_btn"])){  //編集ボタンが押されたら
    if($_POST["edit_num"]){
      $edit_num =  $_POST["edit_num"];
      foreach ($contents as $content){
        $parts = explode("<>", $content);
        if($parts[0] == $edit_num){

<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post">
<input type="hidden" name="id" value="<?= $parts[0] ?>">
<p>投稿者<input type="text" name="name" value="<?php echo $simEdit[1]; ?>"><br></p>
<p>コメント<br></p>
<p><textarea name="comment" rows="8" cols="40"><?php echo $simEdit[2]; ?>
</textarea><br><br></p>
<tr><td><input type="submit" name="submit" value="送信"></td></tr>
</form>

	}
      }
    } else {
      echo "編集する番号を入力してください！";
    }
  }

?>

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



