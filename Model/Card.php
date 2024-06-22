<?php

namespace app\Model;

use PDO;

class Card
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createCard($data)
    {
        $stmt = $this->db->prepare("INSERT INTO cards (name, attack, defense, set_name, rarity, price) VALUES (:name, :attack, :defense, :set_name, :rarity, :price)");
        $stmt->execute([
            'name' => $data['name'],
            'attack' => $data['attack'],
            'defense' => $data['defense'],
            'set_name' => $data['set_name'],
            'rarity' => $data['rarity'],
            'price' => $data['price'],
        ]);
    }

    public function getAllCards()
    {
        $stmt = $this->db->query("SELECT * FROM cards");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCardById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM cards WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCard($id, $data)
    {
        $data['id'] = $id;
        $stmt = $this->db->prepare("UPDATE cards SET name = :name, attack = :attack, defense = :defense, set_name = :set_name, rarity = :rarity, price = :price WHERE id = :id");
        $stmt->execute($data);
    }

    public function deleteCard($id)
    {
        $stmt = $this->db->prepare("DELETE FROM cards WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
