<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post">
  <table>
    <tr><td>���O�F</td>
    <td><input type="text" name="name"></td></tr>
    <tr><td>�R�����g�F</td>
    <td><textarea name="comment" cols="30" rows="5"></textarea></td></tr>
    <tr><td><input type="submit" name="submit" value="���M"></td></tr></table>
</form>

<?php
// �V�K�ǉ� (id���Ȃ��ꍇ)
if(isset($_POST["submit"]) && !isset($_POST["id"])) {
  $fp1 = fopen('kadai_2_5.dat','r+');
  $num = fgets($fp1);
  if (empty($num)){$num =1;}
  fseek($fp1,0);
  fputs($fp1,$num + 1);
  fclose($fp1);

  //�t�H�[�����e�Ƒ��M���ԁA���M�ԍ����t�@�C���ɏ������ށB
  $name = $_POST["name"];
  $comment = $_POST["comment"];
  $file = "kadai_2_5.txt";  //.txt�̓t�H�[�����e
  $fp2 = fopen($file, "a+");
  $timestamp = date("Y/m/d H��i��s�b");
  fwrite($fp2, "$num|$name|$comment|$timestamp\n");
  fclose($fp2);
}

// �ύX (id������ꍇ)
if(isset($_POST["submit"]) && isset($_POST["id"])) {
  $contents = file("kadai_2_5.txt");
  $fp1 = fopen('kadai_2_5.txt','w');
  $edit_num =  $_POST["id"];
  foreach($contents as $content) {
    $parts = explode("|", $content);
    if($parts[0] == $edit_num){
      $name = $_POST["name"];
      $comment = $_POST["comment"];
      $timestamp = date("Y/m/d H��i��s�b");
      fwrite($fp1, "$edit_num|$name|$comment|$timestamp\n");
    } else {
      fwrite($fp1, "$content");
    }
  }
  fclose($fp1);
}

// �\��
$contents = file("kadai_2_5.txt");
foreach ($contents as $content) {
  $parts = explode("|", $content);
  foreach ($parts as $part) {
    echo "<table><tr>$part</tr></table>";
  }
}
?>

<p>-----------------------</p>
<p>�ҏW�������ԍ����A���p�����œ��͂��Ă�������</p>
<form method="post" action="<?php echo($_SERVER['PHP_SELF']) ?>">
<input type="text" name="edit_num" placeholder="��)1" value="<?= isset($_POST['edit_num']) ? $_POST['edit_num'] : null ?>">
  <input type="submit"  name="edit_btn" value="�ҏW����">
  <input type="hidden"  name="edit" value="hensyu">
</form>

<?php
  if(isset($_POST["edit_btn"])){  //�ҏW�{�^���������ꂽ��
    if($_POST["edit_num"]){
      $edit_num =  $_POST["edit_num"];
      foreach ($contents as $content){
        $parts = explode("|", $content);
        if($parts[0] == $edit_num){
?>
<form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post">
  <input type="hidden" name="id" value="<?= $parts[0] ?>">
  <table>
    <tr><td>���O�F</td>
    <td><input type="text" name="name" value="<?= $parts[1] ?>"></td></tr>
    <tr><td>�R�����g�F</td>
    <td><textarea name="comment" cols="30" rows="5"><?= $parts[2] ?></textarea></td></tr>
    <tr><td><input type="submit" name="submit" value="���M"></td></tr>
  </table>
</form>
<?php
        }
      }
    } else {
      echo "�ҏW����ԍ�����͂��Ă��������I";
    }
  }