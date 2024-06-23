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
            grid-template-columns: repeat(4, minmax(200px, 1fr));
            gap: 30px;
            list-style-type: none;
            padding: 10;
            margin: 10;
        }

        .card {
            width: 220px; /* Width of Yu-Gi-Oh! card */
            height: 354px; /* Height of Yu-Gi-Oh! card */
            position: relative;
            border: 1px solid #ccc;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-item {
            width: 220px; /* Width of Yu-Gi-Oh! card */
            height: 354px; /* Height of Yu-Gi-Oh! card */
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
            text-align: center;
        }

        .card-details {
            text-align: center;
            margin-top: 5px;
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
            top: 50px;
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

        /* Rarity colors */
        .rarity-common {
            border-color: #3498db;
            border-width: 4px; 
        }
        
        .rarity-rare {
            border-color: #f39c12;
            border-width: 4px; 
        }
        
        .rarity-ultra-rare {
            border-color: #9b59b6;
            border-width: 4px; 
        }

        .rarity-super-rare {
            border-color: red;
            border-width: 4px; 
        }
        
        .rarity-default {
            border-color: #ccc;
            border-width: 4px; 
        }
        
    </style>
</head>
<body>
    <h1 style="text-align: center;">All Cards</h1>
    <div class="make-deck-button">
    <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    ?>
    <?= $_SESSION['role'] == 'pepremium' || $_SESSION['role'] == 'admin' ? 
    '<a href="/decks">
    <button type="submit">Make Deck</button>
</a>' : '' ?>

    <?= $_SESSION['role'] == 'admin' ? 
        '<a href="/cards/create">
        <button type="submit">Make Card</button>
    </a>' : '' ?>

    </div>
    <ul class="card-grid">
        <?php foreach ($cards as $card): ?>
            <li class="card-item rarity-<?php echo strtolower($card['rarity']); ?>">
                <a href="/card/show/<?= $card['id'] ?>">
                    <strong><?= $card['name'] ?></strong>
                </a>
                <div class="card-details">
                    Click to view Card
                    <span>Rarity: <?= $card['rarity'] ?></span>
                    <span>Attack: <?= $card['attack'] ?></span>
                    <span>Defense: <?= $card['defense'] ?></span>
                    <span>Price: $<?= $card['price'] ?></span>
                </div>
                <div class="card-buttons">
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                        <form method="post" action="/card/edit/<?= $card['id'] ?>">
                            <button type="submit">Edit</button>
                        </form>
                        <form onsubmit="return confirm('Are you sure you want to delete this Card?');" method="post" action="/card/delete/<?= $card['id'] ?>">
                            <input type="hidden" name="id" value="<?= $card['id'] ?>">
                            <button type="submit">Delete</button>
                        </form>
                    <?php endif ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
