<?php
require_once '../vendor/autoload.php'; // Adjust path as needed

use app\Database\DatabaseConnector;
use app\Model\Card;

// Adjust the path to your SQLite database file
$dbFile = __DIR__ . '/../trading_card_game.db';

// Get an instance of the DatabaseConnector
$db = DatabaseConnector::getInstance($dbFile)->getConnection();

// Create an instance of the Card model
$cardModel = new Card($db);

// Check command-line arguments
if ($argc < 2) {
    echo "Usage: php testdb.php delete <card_id>\n";
    exit(1);
}

// Get the card ID to delete
$cardId = $argv[2];

// Execute the deleteCard method
try {
    $cardModel->deleteCard($cardId);
    echo "Card with ID $cardId deleted successfully.\n";
} catch (\PDOException $e) {
    echo "Failed to delete card with ID $cardId: " . $e->getMessage() . "\n";
}
?>
