<!-- views/home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: 'Poppins';
        }

        html, body {
            background-color: #456146;
            height: 100%;
            margin: 0;
            padding: 0;
            color: #FFFFFF; /* White text color */
        }

        body {
            height: 50% !important;
            padding: 40px 0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-gap: 10px;
            align-items: stretch;
        }

        .grid > article {
            border: 1px solid #FFD700; /* Gold border color */
            box-shadow: 2px 2px 6px 0px rgba(0, 0, 0, 0.3);
        }

        .grid > article img {
            max-width: 100%;

        }

        .grid .text {
            padding: 10px;
        }

        @keyframes shake {
            0% {transform: translateX(-10px);}
            20% {transform: translateX(10px);}
            40% {transform: translateX(-10px);}
            60% {transform: translateX(10px);}
            80% {transform: translateX(0px);}
        }

    </style>
</head>
<body><div class="container">
    <main class="grid">
        <?php foreach ($cards as $card): ?>
            <article>
                <img src="<?php echo $card->getImagePath(); ?>" alt="<?php echo $card->getName(); ?>">
                <div class="text">
                    <h3>Card: <?php echo $card->getName(); ?></h3>
                    <p>Rarity: <?php echo $card->getRarity(); ?></p>
                    <p>Market Price: <?php echo $card->getMarketPrice(); ?></p>
                </div>
            </article>
        <?php endforeach; ?>
    </main>
</div>

</body>
</html>
