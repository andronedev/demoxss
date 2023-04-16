<!DOCTYPE html>
<html>
<head>
  <title>Exemple de XSS stocké</title>
</head>
<body>
  <h1>Exemple de XSS stocké</h1>
  <div id="comments">
    <?php
    $filename = "comments.txt";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['reset'])) {
            file_put_contents($filename, '');
        } elseif (!empty($_POST['comment'])) {
            $comment = $_POST['comment'] . "\n";
            file_put_contents($filename, $comment, FILE_APPEND | LOCK_EX);
        }
    }
    $comments = file($filename, FILE_IGNORE_NEW_LINES);
    foreach ($comments as $comment) {
        echo "<div>{$comment}</div>";
    }
    ?>
  </div>
  <form method="post">
    <label for="comment">Laissez un commentaire :</label>
    <input type="text" id="comment" name="comment">
    <button type="submit">Envoyer</button>
  </form>
  <form method="post" style="margin-top: 20px;">
    <input type="hidden" name="reset" value="1">
    <button type="submit">Réinitialiser les commentaires</button>
  </form>
</body>
</html>
