<h1><?= $card['name'] ?></h1>
<p>Attack: <?= $card['attack'] ?></p>
<p>Defense: <?= $card['defense'] ?></p>
<p>Set Name: <?= $card['set_name'] ?></p>
<p>Rarity: <?= $card['rarity'] ?></p>
<p>Price: $<?= $card['price'] ?></p>
<a href="/card/edit/<?= $card['id'] ?>">Edit</a>
<form method="post" action="/card/delete/<?= $card['id'] ?>">
    <button type="submit">Delete</button>
</form>
