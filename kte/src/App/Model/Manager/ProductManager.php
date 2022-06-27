<?php

namespace App\Model\Manager;

use App\Model\Table\Product;
use Library\Core\AbstractManager;

class ProductManager extends AbstractManager
{

    public function __construct()
    {
        parent::__construct(self::USERS);
        $this->table = new Product();
    }

    /**
     * @brief Method to get all products.
     * @method array getAllProducts
     * @return array
     */
    public function getAllProducts(): array
    {
        $sql = 'SELECT * FROM ' . self::PRODUCTS . ' ORDER BY id ASC';
        $result = $this->db->getResults($sql);
        $products = [];
        foreach ($result as $row) {
            $products[] = new Product($row);
        }
        return $products;
    }

    public function getProductById(int $id): ?Product
    {
        $sql = 'SELECT * FROM ' . self::PRODUCTS . ' WHERE id = :id';
        $productById = $this->db->getResult($sql, [
            'id' => $id
        ]);
        if ($productById === null) {
            return null;
        }
        $this->table->createDataRow($productById);
        return $this->table;
    }

    public function getProductByTitle(string $title): ?Product
    {
        $sql = 'SELECT * FROM ' . self::PRODUCTS . ' WHERE title = :title';
        $productByTitle = $this->db->getResult($sql, [
            'title' => $title
        ]);
        if ($productByTitle === null) {
            return null;
        }
        $this->table->createDataRow($productByTitle);
        return $this->table;
    }

    public function createProduct(array $data): ?int
    {
        $sql = 'INSERT INTO ' . self::PRODUCTS . ' 
        (title, content, price_halfday, price_day, traveling_region, traveling_country, img) 
        VALUES (:title, :content, :price_halfday, :price_day, :traveling_region, :traveling_country, :img)';
        $productId = $this->db->execute($sql, [
            'title' => $data['title'],
            'content' => $data['content'],
            'price_halfday' => $data['price_halfday'],
            'price_day' => $data['price_day'],
            'traveling_region' => $data['traveling_region'],
            'traveling_country' => $data['traveling_country'],
            'img' => $data['img']
        ]);
        if ($productId === false) {
            return null;
        }
        return $productId;
    }

    public function updateProduct(array $data, int $id): ?int {
        $sql = 'UPDATE ' . self::PRODUCTS . ' 
        SET title = :title, content = :content, price_halfday = :price_halfday, price_day = :price_day, traveling_region = :traveling_region, traveling_country = :traveling_country, img = :img 
        WHERE id = :id';
        $productId = $this->db->execute($sql, [
            'id' => $id,
            'title' => $data['title'],
            'content' => $data['content'],
            'price_halfday' => $data['price_halfday'],
            'price_day' => $data['price_day'],
            'traveling_region' => $data['traveling_region'],
            'traveling_country' => $data['traveling_country'],
            'img' => $data['img']
        ]);
        if ($productId === false) {
            return null;
        }
        return $productId;
    }

    public function deleteProduct(int $id): ?int {
        $sql = 'DELETE FROM ' . self::PRODUCTS . ' WHERE id = :id';
        $productId = $this->db->execute($sql, [
            'id' => $id
        ]);
        if ($productId === false) {
            return null;
        }
        return $productId;
    }
}