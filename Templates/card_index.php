<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Cards</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .card-item {
            position: relative;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.3s ease;
        }

        .card-item:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-item a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            flex: 1 1 auto;
        }

        .card-details {
            text-align: center;
            margin-top: 10px;
        }

        .card-details strong {
            display: block;
        }

        .card-details span {
            display: block;
            color: #777;
        }

        .card-buttons {
            display: none;
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .card-item:hover .card-buttons {
            display: flex;
        }

        .card-item button {
            padding: 5px 10px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            margin: 0 5px;
        }

        .card-item button:hover {
            background-color: #45a049;
        }

        .make-deck-button {
            text-align: center;
            margin-top: 20px;
        }

        .make-deck-button button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .make-deck-button button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<h1 style="text-align: center;">All Cards</h1>
<div class="make-deck-button">
    <a href="/deck/make">
        <button type="submit">Make Deck</button>
    </a>
</div>
<ul class="card-grid">
    <?php foreach ($cards as $card): ?>
        <li class="card-item rarity-<?php echo strtolower($card['rarity']); ?>">
            <a href="/card/<?= $card['id'] ?>">
                <strong><?= $card['name'] ?></strong>
            </a>
            <div class="card-details">
                <span>Rarity: <?= $card['rarity'] ?></span>
                <span>Attack: <?= $card['attack'] ?></span>
                <span>Defense: <?= $card['defense'] ?></span>
                <span>Price: $<?= $card['price'] ?></span>
            </div>
            <div class="card-buttons">
                <form method="post" action="/card/edit/<?= $card['id'] ?>">
                    <button type="submit">Edit</button>
                </form>
                <form method="post" action="/card/delete/<?= $card['id'] ?>">
                    <button type="submit">Delete</button>
                </form>
                <form method="post" action="/deck/add/<?= $card['id'] ?>">
                    <button type="submit">Add to Deck</button>
                </form>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>
