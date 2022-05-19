<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET')	
{
  if (!empty($_GET['save']))
 {
    print('Спасибо, результаты сохранены.');
  }
  include('form.php');
  exit();
}

$errors = FALSE;
if (empty($_POST['name']))
{
  print('Заполните имя.<br/>');
  $errors = TRUE;
}
if (empty($_POST['mail']))
{
  print('Введите почту.<br/>');
  $errors = TRUE;
}
if (empty($_POST['date']))
{
  print('Заполните дату.<br/>');
  $errors = TRUE;
}

if ($errors)
{
  print('hi error');
  exit();
}
  
$user = 'u47592';
$pass = '8750191';
$db = new PDO('mysql:host=localhost;dbname=u47592', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

try {
  $stmt = $db->prepare("INSERT INTO site (name, mail, date, gender, limbs, powers, biography) 
  VALUES (:name, :mail, :date, :gender, :limbs, :powers, :biography)");
  
  $stmt -> bindParam(':name', $name);
  $stmt -> bindParam(':mail', $mail);
  $stmt -> bindParam(':date', $date);
  $stmt -> bindParam(':gender', $gender);
  $stmt -> bindParam(':limbs', $limbs);
  $stmt -> bindParam(':powers', $powers);
  $stmt -> bindParam(':biography', $biography);
  
  $name = $_POST['name'];
  print($name.'<br />');
  $mail = $_POST['mail'];
  print($mail.'<br />');
  $date = $_POST['date'];
  print($date.'<br />');
  $gender = $_POST['gender'];
  print($gender.'<br />');
  $limbs = $_POST['limbs'];
  print($limbs.'<br />');
  $powers = $_POST['powers'];
  print($powers.'<br />');
  $biography = $_POST['biography'];
  print($biography.'<br />');
  $stmt->execute();
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');
