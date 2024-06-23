<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Details</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            width: 220px; /* Width of Yu-Gi-Oh! card */
            height: 354px; /* Height of Yu-Gi-Oh! card */
            position: relative;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 4px solid transparent; /* Initially transparent border */
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-content {
            padding: 10px;
            text-align: center;
        }

        .card-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-details {
            font-size: 14px;
            color: #555;
            text-align: left; /* Align details to the left */
            margin-bottom: 10px;
            padding: 0 10px; /* Add padding for better spacing */
        }

        .card-details span {
            display: block;
            margin-bottom: 5px;
        }

        .card-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            background-color: #f0f0f0;
            border-top: 1px solid #ccc;
        }

        .card-actions form {
            margin: 0 5px;
        }

        .card-actions button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .card-actions button:hover {
            background-color: #0056b3;
        }

        /* Rarity colors */
        .rarity-common {
            border-color: #3498db;
        }

        .rarity-rare {
            border-color: #f39c12;
        }

        .rarity-ultra-rare {
            border-color: #9b59b6;
        }

        .rarity-default {
            border-color: #ccc;
        }
    </style>
</head>
<body>
    <div class="card rarity-<?php echo strtolower($card['rarity']); ?>">
        <div class="card-content">
            <div class="card-title"><?= htmlspecialchars($card['name']) ?></div>
            <div class="card-details">
                <span><strong>Rarity:</strong> <?= htmlspecialchars($card['rarity']) ?></span>
                <span><strong>Attack:</strong> <?= htmlspecialchars($card['attack']) ?></span>
                <span><strong>Defense:</strong> <?= htmlspecialchars($card['defense']) ?></span>
                <span><strong>Price:</strong> $<?= htmlspecialchars($card['price']) ?></span>
            </div>
        </div>
        <div class="card-actions">
        <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        ?>
        <?php if ($_SESSION['role'] == 'premium' || $_SESSION['role'] == 'admin'): ?>
            <form method="post" action="/deck/add/<?= $card['id'] ?>">
                <select name="deck_id">
                    <?php foreach ($decks as $deck): ?>
                        <option value="<?= $deck['id'] ?>"><?= htmlspecialchars($deck['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Add to Deck</button>
            </form>
            
        <?php endif ?>
            
        </div>
    </div>
</body>
</html>
