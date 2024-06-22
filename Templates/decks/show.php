<!-- show.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($deck['name']) ?></title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .deck-details {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .deck-details h2 {
            margin-top: 0;
        }

        .card-list {
            list-style-type: none;
            padding: 0;
        }

        .card-item {
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 3px;
        }

        .card-item h3 {
            margin-top: 0;
        }

        .card-item p {
            margin-bottom: 5px;
        }

        .back-link {
            display: block;
            margin-top: 10px;
            text-align: center;
        }

        .back-link a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border-radius: 3px;
        }

        .back-link a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1><?= htmlspecialchars($deck['name']) ?></h1>
<div class="deck-details">
    <h2>Cards in Deck</h2>
    <ul class="card-list">
        <?php foreach ($cards as $card): ?>
            <li class="card-item">
                <h3><?= htmlspecialchars($card['name']) ?></h3>
                <p>Attack: <?= $card['attack'] ?></p>
                <p>Defense: <?= $card['defense'] ?></p>
                <p>Rarity: <?= $card['rarity'] ?></p>
                <p>Price: <?= $card['price'] ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="back-link">
    <a href="/decks">Back to All Decks</a>
</div>
</body>
</html>
