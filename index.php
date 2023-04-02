<?php
require_once 'config.php';

$pdo = new PDO(DSN, USER, PASS);


if (!empty($_POST)){
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);

$query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
$statement = $pdo->prepare($query);
$statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
$statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
$statement->execute();
header('Location:/');
exit();
}

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friendsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste d'amis</title>
</head>
<body>
    <ul>
        <?php foreach($friendsArray as $friend) : ?>
            <li><?= $friend['firstname'] . ' ' . $friend['lastname']  ?></li>
                <?php endforeach; ?>
    </ul>

<form  action=""  method="post">
    <div>
      <label  for="firstname">firstname :</label>
      <input  type="text"  id="firstname"  name="firstname" required>
    </div>
    <div>
      <label  for="lastname">lastname :</label>
        <input  type="text"  id="lastname"  name="lastname" required>
    </div>
    <button>Submit</button>
  </form>

</body>
</html>