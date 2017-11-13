<html>
<head><title>PHP1-5</title></head>
<body>

<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
	<p>名前 <input type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, "UTF-8"); ?>"></p>
	<p>コメント <input type="text" name="comments" value="<?php echo htmlspecialchars($comments, ENT_QUOTES, "UTF-8"); ?>"></p>
	<p style="color:red;"><?php echo $err; ?></p>
	<p><input type="submit" value="送信"></p>
</form>

<?php

	if($_SERVER["REQUEST_METHOD"] === "POST"){
		if(!empty($_POST["name"]) && !empty($_POST["comments"])){
		$name = $_POST["name"];
		$comments = $_POST["comments"];
		writeDate();
	}else{
		$name = $_POST["name"];
		$comments = $_POST["comments"];
		$err = '入力されていない項目があります';
		print $err;
		}
	}

function writeDate(){
	$date = "<hr>\r\n";
	$date = $date."<p>名前:".$name."</p>\r\n";
	$date = $date."<p>コメント:</p>\r\n";
	$date = $date."<p>".$comments."</p>\r\n";

	print('<p>'.$date.'<p>');


	$five_file = 'kadaifive.txt';

	$fp = fopen($five_file, 'ab');

	if($fp){
		if (flock($fp, LOCK_EX)){
			if(fwrite($fp, $date) === FALSE){
				print('ファイルの書き込みに失敗しました');
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


