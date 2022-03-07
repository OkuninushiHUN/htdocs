<?php
include VIEW_PATH . 'layout/header.view.php';
?>

Könyv Hozzáadása

<form action="/create" method="post">
    <label for="title">Cím:</label>
    <input id="title" type="text" name="title" />
    <br>
    <label for="author">Szerző:</label>
    <input id="author" type="text" name="author" />
    <br>
    <label for="year">Kiadás éve:</label>
    <input id="year" type="text" name="year" />
    <br>
    <label for="language">Nyelv:</label>
    <input id="language" type="text" name="language" />
    <br>
    <label for="isbn">ISBN:</label>
    <input id="isbn" type="text" name="isbn" />
    <br>

    <input type="submit" value="Létrehozás">
    <a href="/">Vissza</a>


</form>

<?php
include VIEW_PATH . 'layout/footer.view.php';
?>