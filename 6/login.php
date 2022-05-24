<?php
function dbconnect(){
  $user = 'u48757';
  $pass = '3306557';
  $db = new PDO('mysql:host=localhost;dbname=u48757', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
  return $db;
}
header('Content-Type: text/html; charset=UTF-8');

session_start();

if (!empty($_SESSION['login'])) {
  session_destroy();
  header('Location: ./');
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
if(!empty($_COOKIE['login_error']))
  print $_COOKIE['login_error'];
?>
<form action="" method="post">
  <input name="login" />
  <input name="pass" />
  <input type="submit" value="Войти" />
</form>

<?php
}
else {
  $db=dbconnect();
  try {
    $stmt = $db->prepare("SELECT personID FROM project4_users where login = :login AND pass = :pass");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':pass', $pass);
    $login = $_POST['login'];
    $pass = md5($_POST['pass']);
    $stmt->execute();
    $personID=$stmt->fetchColumn();
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }
  if(empty($personID)){
    $message='Неверный логин или пароль';
    setcookie('login_error',$message);
    header('Location: login.php');
  }
  else{
  $_SESSION['login'] = $_POST['login'];
  $_SESSION['uid'] = $personID;
  setcookie('login_error','',10000);
    header('Location: login.php');
  header('Location: ./');
  }
}
