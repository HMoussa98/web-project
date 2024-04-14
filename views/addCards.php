<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Card</title>
    <style>
        /* Your styling here */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Poppins';
        }
        body {
            background-color: #DDF7E3;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .loginDiv {
            width: 300px;
            padding: 30px;
            background-color: #C7E8CA;
            border-radius: 20px;
            box-shadow: 0 0 20px -8px #4a7d47;
        }

        input {
            display: block;
            width: calc(100% - 20px);
            margin: 10px auto;
            height: 30px;
            padding: 4px;
            border: none;
            border-radius: 2px;
            background-color: #c7e8ca;
            border-bottom: 2px solid #4a7d47;
            font-size: 18px;
            outline: none;
        }

        .login {
            width: calc(100% - 20px);
            margin: 10px auto;
            padding: 10px;
            background-color: #4a7d47;
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login:hover {
            background-color: #5D9C59;
        }

        .login:focus {
            outline: none;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #253e24;
        }

        label {
            font-size: 18px;
            color: #253e24;
        }
    </style>
</head>
<body>
<div class="loginDiv">
    <h1>Add Card</h1>
    <form method="post">
        <label for="name">Card Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="set_id">Set ID:</label>
        <input type="text" id="set_id" name="set_id" required>
        <label for="rarity">Rarity:</label>
        <input type="text" id="rarity" name="rarity" required>
        <label for="market_price">Market Price:</label>
        <input type="text" id="market_price" name="market_price" required>
        <label for="image_path">Image Path:</label>
        <input type="text" id="image_path" name="image_path" required>
        <button type="submit" class="login">Add Card</button>
    </form>
</div>
</body>
</html>
