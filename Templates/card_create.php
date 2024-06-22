<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
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
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Create Card</h1>

    <form method="post" action="/cards/create">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="attack">Attack:</label>
        <input type="number" id="attack" name="attack" required><br>

        <label for="defense">Defense:</label>
        <input type="number" id="defense" name="defense" required><br>

        <label for="set_name">Set Name:</label>
        <input type="text" id="set_name" name="set_name" required><br>

        <label for="rarity">Rarity:</label>
        <select id="rarity" name="rarity" required>
            <option value="Common">Common</option>
            <option value="Rare">Rare</option>
            <option value="Ultra-Rare">Ultra-Rare</option>
            <option value="Super-Rare">Super-Rare</option>
        </select><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <button type="submit">Create Card</button>
    </form>
</div>
</body>
</html>
