<?php
header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();

  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены.';
  }

  $errors = array();
  $errors['name'] = empty($_COOKIE['name_error']) ? '0' : $_COOKIE['name_error'];
  $errors['email'] = empty($_COOKIE['email_error']) ? '0' : $_COOKIE['email_error'];
  $errors['birth'] = !empty($_COOKIE['birth_error']);
  $errors['pol'] = !empty($_COOKIE['pol_error']);
  $errors['konechnosti'] = !empty($_COOKIE['konechnosti_error']);
  $errors['powers'] = !empty($_COOKIE['powers_error']);
  $errors['biography'] = empty($_COOKIE['biography_error']) ? '0' : $_COOKIE['biography_error'];
  $errors['check'] = !empty($_COOKIE['check_error']);

  // Выдаем сообщения об ошибках.
  if ($errors['name']=='1') {
    setcookie('name_error', '', 100);
    $messages[] = '<div class="error">Укажите имя.</div>';
  }
  if ($errors['name']=='2') {
    setcookie('name_error', '', 100);
    $messages[] = '<div class="error">Неверный формат имени.<br />';
    $messages[] = 'Допустимые символы: A-Z, a-z, А-Я, а-я, пробельные символы и "-"<br />';
    $messages[] = 'Например: Александр</div>';
  }
  if ($errors['email']=='1') {
    setcookie('email_error', '', 100);
    $messages[] = '<div class="error">Укажите email.</div>';
  }  
  if ($errors['email']=='2') {
    setcookie('email_error', '', 100);
    $messages[] = '<div class="error">Неверный формат почты.<br />';
        $messages[] = 'Например: example@mail.com</div>';
  }  
  if ($errors['birth']) {
    setcookie('birth_error', '', 100);
    $messages[] = '<div class="error">Укажите год рождения.</div>';
  }
   if ($errors['pol']) {
    setcookie('pol_error', '', 100);
    $messages[] = '<div class="error">Укажите пол.</div>';
  }
   if ($errors['konechnosti']) {
    setcookie('konechnosti_error', '', 100);
    $messages[] = '<div class="error">Укажите количество конечностей.</div>';
  }
   if ($errors['powers']) {
    setcookie('powers_error', '', 100);
    $messages[] = '<div class="error">Выберите суперспособности.</div>';
  }
   if ($errors['biography']=='1') {
    setcookie('biography_error', '', 100);
    $messages[] = '<div class="error">Напишите биографию.</div>';
  }
  if ($errors['biography']=='2') {
    setcookie('biography_error', '', 100);
    $messages[] = '<div class="error">Неверный формат биографии.';
    $messages[] = 'Допустимые символы: A-Z, a-z, А-Я, а-я, пробельные символы и "-", ",", "."</div>';
  }
   if ($errors['check']) {
    setcookie('check_error', '', 100);
    $messages[] = '<div class="error">Отметьте чекбокс.</div>';
  }

  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['birth'] = empty($_COOKIE['birth_value']) ? '' : $_COOKIE['birth_value'];
  $values['pol'] = empty($_COOKIE['pol_value']) ? '' : $_COOKIE['pol_value'];
  $values['konechnosti'] = empty($_COOKIE['konechnosti_value']) ? '' : $_COOKIE['konechnosti_value'];
  $values['powers'] = empty($_COOKIE['powers_value']) ? '' : unserialize($_COOKIE['powers_value']);
  $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
  $values['check'] = empty($_COOKIE['check_value']) ? '' : $_COOKIE['check_value'];
  include('form.php');
}
else{
$bioreg="/^\s*[\w\s\.йцукенгшщзхъфывапролджэячсмитьбюёЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ,-]*$/";
$reg="/^([a-zA-ZйцукенгшщзхъфывапролджэячсмитьбюёЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ\s-])+$/";
$mailreg="/^[\w\.-]+@([\w-]+\.)+[\w-]{2,4}$/";

$errors = FALSE;
$cookie_error_time= time() + 24 * 60 * 60;
$cookie_value_time= time() + 365 * 24 * 60 * 60;
if (empty($_POST['name'])) {
    setcookie('name_error', '1', $cookie_error_time);
    $errors = TRUE;
    setcookie('name_value','', 100);
}
else{
    if(!preg_match($reg,$_POST['name'])){
      setcookie('name_error', '2', $cookie_error_time);
      $errors = TRUE;
    }
  setcookie('name_value', $_POST['name'], $cookie_value_time);
}
if (empty($_POST['email'])) {
    setcookie('email_error', '1', $cookie_error_time);
    $errors = TRUE;
    setcookie('email_value','', 100);
}
else{
    if(!preg_match($mailreg,$_POST['email'])){
      setcookie('email_error', '2', $cookie_error_time);
      $errors = TRUE;
    }
  setcookie('email_value', $_POST['email'], $cookie_value_time);
}
if (empty($_POST['birth'])||!is_numeric($_POST['birth'])) {
    setcookie('birth_error', '1', $cookie_error_time);
    $errors = TRUE;
}
else{
  setcookie('birth_value', $_POST['birth'], $cookie_value_time);
}
if (empty($_POST['pol'])||!preg_match('/^[mw]$/',$_POST['pol'])) {
    setcookie('pol_error', '1', $cookie_error_time);
    $errors = TRUE;
}
else{
  setcookie('pol_value', $_POST['pol'], $cookie_value_time);
}
if (empty($_POST['konechnosti'])||!preg_match('/^[1-4]$/',$_POST['konechnosti'])) {
    setcookie('konechnosti_error', '1', $cookie_error_time);
    $errors = TRUE;
}
else{
  setcookie('konechnosti_value', $_POST['konechnosti'], $cookie_value_time);
}
if (empty($_POST['powers'])||!is_array($_POST['powers'])) {
    setcookie('powers_error', '1', $cookie_error_time);
    $errors = TRUE;
}
else{
  $powers = array(0, 0, 0);
  foreach($_POST['powers'] as $power){
    if ($power=='1')
      $powers[0]=1;
    if ($power=='2')
      $powers[1]=1;
    if ($power=='3')
      $powers[2]=1;
  }
  setcookie('powers_value', serialize($powers), $cookie_value_time);
}
if (empty($_POST['biography'])) {
    setcookie('biography_error', '1', $cookie_error_time);
    $errors = TRUE;
    setcookie('email_value','', 100);
}
else{
  if (!preg_match($bioreg,$_POST['biography'])){
    setcookie('biography_error', '2', $cookie_error_time);
    $errors = TRUE;
  }
  setcookie('biography_value', $_POST['biography'], $cookie_value_time);
}
if (empty($_POST['check'])) {
    setcookie('check_error', '1', $cookie_error_time);
    $errors = TRUE;
    setcookie('check_value', '', $cookie_value_time);
}
else{
  setcookie('check_value', $_POST['check'], $cookie_value_time);
}
if ($errors) {
    header('Location: index.php');
    exit();
}
else {
    setcookie('name_error', '', 100000);
    setcookie('email_error', '', 100000);
    setcookie('birth_error', '', 100000);
    setcookie('pol_error', '', 100000);
    setcookie('konechnosti_error', '', 100000);
    setcookie('powers_error', '', 100000);
    setcookie('biography_error', '', 100000);
    setcookie('check_error', '', 100000);
  }


// Сохранение в базу данных.

$user = 'u48757';
$pass = '3306557';
$db = new PDO('mysql:host=localhost;dbname=u48757', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

// Подготовленный запрос. Не именованные метки.
try {
  $stmt = $db->prepare("INSERT INTO project4 (name, email, birth, pol, konechnosti, biography, date) VALUES (:name, :email, :birth, :pol, :konechnosti, :biography, :date)");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':birth', $birth);
  $stmt->bindParam(':pol', $pol);
  $stmt->bindParam(':konechnosti', $konechnosti);
  $stmt->bindParam(':biography', $biography);
  $stmt->bindParam(':date', $date);
  $name = $_POST['name'];
  $email = $_POST['email'];
  $birth = $_POST['birth'];
  $pol =$_POST['pol'];
  $konechnosti = $_POST['konechnosti'];
  $biography = $_POST['biography'];
  $date = date('Y-m-d');;
  $stmt->execute();
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
try{
  $stmt = $db->prepare("SELECT id FROM project4 WHERE name = :name AND email = :email AND birth = :birth AND pol = :pol AND konechnosti = :konechnosti AND biography = :biography AND date = :date");
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':birth', $birth);
  $stmt->bindParam(':pol', $pol);
  $stmt->bindParam(':konechnosti', $konechnosti);
  $stmt->bindParam(':biography', $biography);
  $stmt->bindParam(':date', $date);
  $stmt->execute();
  $personID=$stmt->fetchColumn();
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
foreach($_POST['powers'] as $power){
  try{
    if($power=='1')
      $power_name="immortal";
        if($power=='2')
      $power_name="passing through walls";
        if($power=='3')
      $power_name="levitation";
    $stmt = $db->prepare("INSERT INTO project4_powers (personID, power) VALUES (:personID, :power)");
    $stmt->bindParam(':personID', $personID);
    $stmt->bindParam(':power', $power_name);
    $stmt->execute();
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }
}
  setcookie('save', '1');
  header('Location: index.php');
}
