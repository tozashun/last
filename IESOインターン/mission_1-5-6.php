<html>
<head><title>PHP1-5</title></head>
<body>

<form action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
	<p>���O <input type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, "UTF-8"); ?>"></p>
	<p>�R�����g <input type="text" name="comments" value="<?php echo htmlspecialchars($comments, ENT_QUOTES, "UTF-8"); ?>"></p>
	<p style="color:red;"><?php echo $err; ?></p>
	<p><input type="submit" value="���M"></p>
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
		$err = '���͂���Ă��Ȃ����ڂ�����܂�';
		print $err;
		}
	}

function writeDate(){
	$date = "<hr>\r\n";
	$date = $date."<p>���O:".$name."</p>\r\n";
	$date = $date."<p>�R�����g:</p>\r\n";
	$date = $date."<p>".$comments."</p>\r\n";

	print('<p>'.$date.'<p>');


	$five_file = 'kadaifive.txt';

	$fp = fopen($five_file, 'ab');

	if($fp){
		if (flock($fp, LOCK_EX)){
			if(fwrite($fp, $date) === FALSE){
				print('�t�@�C���̏������݂Ɏ��s���܂���');
			}

			flock($fp, LOCK_UN);
		}else{
			print('�t�@�C�����b�N�Ɏ��s���܂���');
		}
	}

	fclose($fp);
}

?>
</body>
</html>


