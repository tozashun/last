<?php
$firstName = "";
$lastName = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  if (!empty($_POST["first_name"]) && !empty($_POST["last_name"])) {
    $fullName = $_POST["last_name"] . " " . $_POST["first_name"];
  } else {
    $lastName = $_POST["last_name"];
    $firstName = $_POST["first_name"];
    $err = "���͂���Ă��Ȃ����ڂ�����܂��B";
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>�T���v��</title>
  <meta name="robots" content="noindex, nofollow" />
</head>
<body>
  <?php if (!isset($fullName)) : ?>
    <form action="" method="post">
      <p>���F <input type="text" name="last_name" value="<?php echo htmlspecialchars($lastName, ENT_QUOTES, "UTF-8"); ?>"></p>
      <p>���F <input type="text" name="first_name" value="<?php echo htmlspecialchars($firstName, ENT_QUOTES, "UTF-8"); ?>"></p>
      <p style="color:red;"><?php echo $err; ?></p>
      <p><input type="submit" value="���M"></p>
    </form>
  <?php else : ?>
    <p>
      ���Ȃ��̖��O�� <?php echo htmlspecialchars($fullName, ENT_QUOTES, "UTF-8"); ?> �ł��ˁB<br>
    </p>
    <p><a href="">�߂�</a></p>
  <?php endif; ?>
</body>
</html>