<!DOCTYPE html>

<html lang="ru" >
<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="style.css">
  <title></title>
</head>
<body>
  <div id="form">
    <form action="" method="POST">
      <label>
	    Имя:<br />
        <input name="name"/>
      </label><br />
      <label>
        Email:<br />
        <input name="mail" type="email" />
      </label><br />
      <label>
        Дата рождения:<br />
        <input name="date" value="ГГГГ-ММ-ЧЧ" type="date" />
      </label><br />

      Пол:<br />
      <label><input type="radio" checked="checked" name="gender" value="1" />М</label>
      <label><input type="radio" name="gender" value="2" />Ж</label><br />

      Количество конечностей:<br />
      <label><input type="radio" checked="checked" name="limbs" value="1" />1</label>
      <label><input type="radio" name="limbs" value="2" />2</label><br />
      <label><input type="radio" name="limbs" value="3" />3</label>
      <label><input type="radio" name="limbs" value="4" />4</label><br />     

      <label>
        Сверхспособности:<br />
        <select name="powers" multiple="multiple">
          <option value="1" selected="selected">Бессмертие</option>
          <option value="2">Прохождение сквозь стены </option>
          <option value="3">Левитация </option>
        </select>
      </label><br />

      <label>
        Биография:<br />
        <textarea name="biography"></textarea>
      </label><br />

      <label><input type="checkbox" checked="checked" name="checkbox" />С контрактом ознакомлен (а)</label><br />
      <input type="submit" value="Отправить" />
    </form>
  </div>
</body>
</html>
