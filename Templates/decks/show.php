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
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .deck-details h2 {
            margin-top: 0;
            text-align: center;
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
            width: 200px; /* Adjusted width */
            height: 320px; /* Adjusted height */
            position: relative;
            padding: 10px;
            border: 4px solid transparent; /* Default border */
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .card-item:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-item a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
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

        /* Rarity-specific borders */
        .card-item.rarity-common {
            border-color: #3498db; /* Blue border for common cards */
        }

        .card-item.rarity-rare {
            border-color: #f39c12; /* Orange border for rare cards */
        }

        .card-item.rarity-ultra-rare {
            border-color: #9b59b6; /* Purple border for ultra-rare cards */
        }

        .card-item.rarity-default {
            border-color: #ccc; /* Default border color */
        }
    </style>
</head>
<body>
    
<h1><?= htmlspecialchars($deck['name']) ?></h1>
<div class="deck-details">
    <h2>Cards in Deck</h2>
    <ul class="card-grid">
        <?php foreach ($cards as $card): ?>
            <li class="card-item rarity-<?php echo strtolower($card['rarity']); ?>">
                <a href="/card/show/<?= $card['id'] ?>">
                    <strong><?= htmlspecialchars($card['name']) ?></strong>
                </a>
                <div class="card-details">
                    <span>Rarity: <?= $card['rarity'] ?></span>
                    <span>Attack: <?= $card['attack'] ?></span>
                    <span>Defense: <?= $card['defense'] ?></span>
                    <span>Price: $<?= $card['price'] ?></span>
                </div>
                <div class="card-buttons">
                    <form method="post" action="/deck/remove/<?= $card['id'] ?>">
                        <button type="submit">Remove from Deck</button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="back-link">
    <a href="/decks">Back to All Decks</a>
</div>
</body>
</html>
