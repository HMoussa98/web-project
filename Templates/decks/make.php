<!-- make.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Deck</title>
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

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
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

        button[type="submit"] {
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

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<h1>Create New Deck</h1>
<form method="post" action="/deck/make">
    <label for="name">Deck Name:</label>
    <input type="text" id="name" name="name" required>
    <button type="submit">Create Deck</button>
</form>
</body>
</html>
