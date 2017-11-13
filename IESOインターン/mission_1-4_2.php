<?php
$name = "";
$comments = "";
if($_SERVER["REQUEST_METHOD"] === "POST"){
	if(!empty($_POST["name"]) && !empty($_POST["comments"])){
	$name = $_POST["name"];
	$comments = $_POST["comments"];
	}else{
		$name = $_POST["name"];
		$comments = $_POST["comments"];
		$err = '入力されていない項目があります';
		}
	}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>サンプル</title>
	<meta name="robots" content="noindex,nofollow" />
</head>
<body>
	<?php if(empty($_POST["name"]) || empty($_POST["comments"])) : ?>
	<form action="kadai5-2.txt" method="post">
	<p>名前: <input type="text" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES, "UTF-8"); ?>"></p>
	<p>コメント: <input type="text" name="comments" value="<?php echo htmlspecialchars($comments, ENT_QUOTES, "UTF-8"); ?>"></p>
	<p style="color:red;"><?php echo $err; ?></p>
	<p><input type="submit" value="送信"></p>
	</form>
	
	<?php else : ?>
<?php
	$filename ='kadai5-2.txt'
	$fp=fopen($filename,'w');
	fwrite($fp,$name);
	fclose($fp);
?>

	<?php endif; ?>
</body>
</html>



