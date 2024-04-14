<?php

require_once 'vendor/autoload.php';

use app\repositories\CardDeckRepository;
use app\repositories\UserRepository;
use app\repositories\CardRepository;
use app\repositories\SetRepository;
use app\repositories\DeckRepository;
use app\repositories\RoleRepository;
use app\repositories\UserRoleRepository;
use app\repositories\SubscriptionTypeRepository;
use app\Database\Database;

// Connect to the database
$pdo = Database::connect();

// Instantiate repositories
$userRepository = new UserRepository();
$cardRepository = new CardRepository();
$setRepository = new SetRepository();
$deckRepository = new DeckRepository();
$carDeckRepository = new CardDeckRepository();
$roleRepository = new RoleRepository();
$userRoleRepository = new UserRoleRepository();
$subscriptionTypeRepository = new SubscriptionTypeRepository();

// Display all users
$users = $userRepository->findAll();
echo "<h2>All Users</h2>";
echo "<table border='1'>";
echo "<tr><th>User ID</th><th>Name</th><th>Email</th></tr>";
foreach ($users as $user) {
    echo "<tr><td>{$user->getId()}</td><td>{$user->getUsername()}</td><td>{$user->getEmail()}</td></tr>";
}
echo "</table>";

// Display all cards
$cards = $cardRepository->findAll();
echo "<h2>All Cards</h2>";
echo "<table border='1'>";
echo "<tr><th>Card ID</th><th>Name</th><th>Set ID</th><th>Rarity</th><th>Market Price</th><th>Image Path</th></tr>";
foreach ($cards as $card) {
    echo "<tr><td>{$card->getId()}</td><td>{$card->getName()}</td><td>{$card->getSetId()}</td>
<td>{$card->getRarity()}</td><td>{$card->getMarketPrice()}</td><td><img src='{$card->getImagePath()}'></td></tr>";
}
echo "</table>";

// Display all sets
$sets = $setRepository->findAll();
echo "<h2>All Sets</h2>";
echo "<table border='1'>";
echo "<tr><th>Set ID</th><th>Name</th><th>Release Date</th></tr>";
foreach ($sets as $set) {
    echo "<tr><td>{$set->getId()}</td><td>{$set->getName()}</td><td>{$set->getReleaseDate()}</td></tr>";
}
echo "</table>";

// Display all decks
$decks = $deckRepository->findAll();
echo "<h2>All Decks</h2>";
echo "<table border='1'>";
echo "<tr><th>Deck ID</th><th>User ID</th><th>Name</th></tr>";
foreach ($decks as $deck) {
    echo "<tr><td>{$deck->getId()}</td><td>{$deck->getUserId()}</td><td>{$deck->getName()}</td></tr>";
}
echo "</table>";

// Display all cards in a specific deck
$deckId = 1; // Example deck ID
$cardsInDeck = $carDeckRepository->getCardsInDeck($deckId);
echo "<h2>All Cards in Deck (ID: $deckId)</h2>";
echo "<table border='1'>";
echo "<tr><th>Card ID</th><th>Name</th><th>Rarity</th><th>Image Path</th></tr>";
foreach ($cardsInDeck as $card) {
    echo "<tr><td>{$card->getId()}</td><td>{$card->getName()}</td><td>{$card->getRarity()}</td><td><img src='{$card->getImagePath()}'></td></tr>";
}
echo "</table>";

// Display all roles
$roles = $roleRepository->findAll();
echo "<h2>All Roles</h2>";
echo "<table border='1'>";
echo "<tr><th>Role ID</th><th>Name</th></tr>";
foreach ($roles as $role) {
    echo "<tr><td>{$role->getId()}</td><td>{$role->getName()}</td></tr>";
}
echo "</table>";

// Display users per role
$roleId = 1; // Example role ID
$usersPerRole = $userRoleRepository->findAllUsersByRole($roleId);
echo "<h2>All Users with Role (ID: $roleId)</h2>";
echo "<table border='1'>";
echo "<tr><th>User ID</th><th>Name</th><th>Email</th></tr>";
foreach ($usersPerRole as $user) {
    echo "<tr><td>{$user->getId()}</td><td>{$user->getUsername()}</td><td>{$user->getEmail()}</td></tr>";
}
echo "</table>";

// Display users per role
$roleId2 = 2; // Example role ID
$usersPerRole = $userRoleRepository->findAllUsersByRole($roleId2);
echo "<h2>All Users with Role (ID: $roleId2)</h2>";
echo "<table border='1'>";
echo "<tr><th>User ID</th><th>Name</th><th>Email</th></tr>";
foreach ($usersPerRole as $user) {
    echo "<tr><td>{$user->getId()}</td><td>{$user->getUsername()}</td><td>{$user->getEmail()}</td></tr>";
}
echo "</table>";

// Display all decks per user
$userId = 1; // Example user ID
$decksPerUser = $deckRepository->findAllDecksByUser($userId);
echo "<h2>All Decks for User (ID: $userId)</h2>";
echo "<table border='1'>";
echo "<tr><th>Deck ID</th><th>User ID</th><th>Name</th></tr>";
foreach ($decksPerUser as $deck) {
    echo "<tr><td>{$deck->getId()}</td><td>{$deck->getUserId()}</td><td>{$deck->getName()}</td></tr>";
}
echo "</table>";

// Display all subscription types
$subscriptionTypes = $subscriptionTypeRepository->findAll();
echo "<h2>All Subscription Types</h2>";
echo "<table border='1'>";
echo "<tr><th>Type ID</th><th>Name</th><th>Price</th></tr>";
foreach ($subscriptionTypes as $subscriptionType) {
    echo "<tr><td>{$subscriptionType->getId()}</td><td>{$subscriptionType->getName()}</td><td>{$subscriptionType->getPrice()}</td></tr>";
}
echo "</table>";

// Display users per subscription type
$subscriptionTypeId = 1; // Example subscription type ID
$usersPerSubscriptionType = $subscriptionTypeRepository->findAllUsersBySubscriptionType($subscriptionTypeId);
echo "<h2>All Users with Subscription Type (ID: $subscriptionTypeId) Free</h2>";
echo "<table border='1'>";
echo "<tr><th>User ID</th><th>Name</th><th>Email</th></tr>";
foreach ($usersPerSubscriptionType as $user) {
    echo "<tr><td>{$user->getId()}</td><td>{$user->getUsername()}</td><td>{$user->getEmail()}</td></tr>";
}
echo "</table>";

// Display users per subscription type
$subscriptionTypeId = 2; // Example subscription type ID
$usersPerSubscriptionType = $subscriptionTypeRepository->findAllUsersBySubscriptionType($subscriptionTypeId);
echo "<h2>All Users with Subscription Type (ID: $subscriptionTypeId) Premium</h2>";
echo "<table border='1'>";
echo "<tr><th>User ID</th><th>Name</th><th>Email</th></tr>";
foreach ($usersPerSubscriptionType as $user) {
    echo "<tr><td>{$user->getId()}</td><td>{$user->getUsername()}</td><td>{$user->getEmail()}</td></tr>";
}
echo "</table>";

?>
