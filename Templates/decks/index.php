<!-- templates/decks/index.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Decks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .actions a, .actions button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
            text-align: center;
        }
        .actions a:hover, .actions button:hover {
            background-color: #0056b3;
        }

        .h1text {
            text-align: center;
        }

        .frm {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .lbl {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 3px;
        }

       .btn:hover {
            background-color: #45a049;
        }
      
    </style>
</head>
<body>
    <div class="container">
        <h1 class="h1text">Create New Deck</h1>
        <form class="frm" method="post" action="/deck/make">
            <label class="lbl" for="name">Deck Name:</label>
            <input type="text" id="name" name="name" required>
            <button class="btn" type="submit">Create Deck</button>
        </form>
        <h1>User Decks</h1>
    
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($decks as $deck): ?>
                <tr>
                    <td><?= $deck['id'] ?></td>
                    <td><?= htmlspecialchars($deck['name']) ?></td>
                    <td class="actions">
                        <a href="/deck/<?= $deck['id'] ?>">View</a>
                        <form action="/deck/delete/<?= $deck['id'] ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this deck?');">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </body>
    </html>