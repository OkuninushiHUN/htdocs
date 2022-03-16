<?php
    include VIEW_PATH . 'layout/header.view.php';
?>
<hr>
<a href="/create">Létrehozás</a>
<div style="border: solid #ff3a3a 1px">
    <?= $message ?? "" ?>
</div>



    <hr>
<table>
    <thead>
    <tr>
        <th>Cím</th>
        <th>Szerző</th>
        <th>Kiadás éve</th>
        <th>Nyelv</th>
        <th>ISBN</th>
    </tr>
    </thead>
    <?php if (isset($data)): ?>
    <tbody>
    <?php foreach ($data as $book): ?>

    <tr>
    <td><?= $book['title']?></td>
    <td><?= $book['author']?></td>
    <td><?= $book['published_at']?></td>
    <td><?= $book['language']?></td>
    <td><?= $book['isbn']?></td>
        <td>
            <a href="/details?id=<?= $book["id"] ?>">Részletek</a>
        </td>

    </tr>
    <?php endforeach;?>
    </tbody>
    <?php else: ?>
    <caption>Nincsenek könyvek a rendszerben</caption>
    <?php endif; ?>
</table>

<?php
include VIEW_PATH . 'layout/footer.view.php';
?>