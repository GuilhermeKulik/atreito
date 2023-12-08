<?php

namespace Atreito\Model;

class Promotion extends GenericModel {

    private $promotionID;
    private $name;
    private $value;
    private $creationDate;
    private $expirationDate;
    private $createdByUserID;

    public function __construct($conn) {
        parent::__construct($conn);
    }

    public function setPromotionID($promotionID) {
        $this->promotionID = $promotionID;
    }

    public function getPromotionID() {
        return $this->promotionID;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setExpirationDate($expirationDate) {
        $this->expirationDate = $expirationDate;
    }

    public function getExpirationDate() {
        return $this->expirationDate;
    }

    public function setCreatedByUserID($createdByUserID) {
        $this->createdByUserID = $createdByUserID;
    }

    public function getCreatedByUserID() {
        return $this->createdByUserID;
    }

    public function createPromotion($name, $value, $expirationDate, $category, $level, $createdByUserID) {
        $this->name = $name;
        $this->value = $value;
        $this->creationDate = date('Y-m-d H:i:s'); // Data e hora atuais
        $this->expirationDate = $expirationDate;
        $this->category = $category;
        $this->level = $level;
        $this->createdByUserID = $createdByUserID;
    
        $data = [
            'name' => $this->name,
            'value' => $this->value,
            'creation_date' => $this->creationDate,
            'expiration_date' => $this->expirationDate,
            'category' => $this->category,
            'level' => $this->level,
            'created_by_user_id' => $this->createdByUserID
        ];
    
        return parent::insert('promotion', $data);
    }

    public function updatePromotion($promotionID, $newData) {
        $data = [];
        $conditions = ['promotion_id' => $promotionID];

        if (isset($newData['name'])) {
            $data['name'] = $newData['name'];
        }

        if (isset($newData['value'])) {
            $data['value'] = $newData['value'];
        }

        if (isset($newData['creation_date'])) {
            $data['creation_date'] = $newData['creation_date'];
        }

        if (isset($newData['expiration_date'])) {
            $data['expiration_date'] = $newData['expiration_date'];
        }

        if (isset($newData['created_by_user_id'])) {
            $data['created_by_user_id'] = $newData['created_by_user_id'];
        }

        return parent::update('promotion', $data, $conditions);
    }

    public function deletePromotion($promotionID) {
        $conditions = ['promotion_id' => $promotionID];
        return parent::delete('promotion', $conditions);
    }

    public function getPromotionById($promotionID) {
        return parent::fetch('promotion', ['promotion_id' => $promotionID]);
    }

    public function getAllPromotions() {
        return parent::fetchAll('promotion');
    }
}
