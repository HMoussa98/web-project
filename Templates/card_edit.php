<form method="post" action="/card/update/<?= $card['id'] ?>">
    <label>Name: <input type="text" name="name" value="<?= htmlspecialchars($card['name']) ?>"></label><br>
    <label>Attack: <input type="number" name="attack" value="<?= $card['attack'] ?>"></label><br>
    <label>Defense: <input type="number" name="defense" value="<?= $card['defense'] ?>"></label><br>
    <label>Set Name: <input type="text" name="set_name" value="<?= htmlspecialchars($card['set_name']) ?>"></label><br>
    <label>Rarity: <input type="text" name="rarity" value="<?= htmlspecialchars($card['rarity']) ?>"></label><br>
    <label>Price: <input type="number" step="0.01" name="price" value="<?= $card['price'] ?>"></label><br>
    <button type="submit">Update Card</button>
</form>
