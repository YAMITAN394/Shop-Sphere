<?php
namespace database;
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/functions.php';
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/DBController.php';
require_once 'C:/xampp/htdocs/tutorial/MOBILE SHOPEE/database/Product.php';

use database\DBController;


$db = new DBController();
$product = new Product($db);



$product_shuffle = $product->getData();
$item_id = isset($_GET['item_id']) ? $_GET['item_id'] : 1;
$local_stores = $product->getLocalStores($item_id);
$ratingData = $product->getRatings($item_id);

class Product {
    public $db = null;

    public function __construct(DBController $db) {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    public function getData($table = 'product') {
        $result = $this->db->con->query("SELECT * FROM $table");
        $resultArray = [];

        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function getProduct($item_id = null, $table = 'product') {
        $resultArray = [];

        if (isset($item_id)) {
            $result = $this->db->con->query("SELECT * FROM $table WHERE item_id=$item_id");

            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }
        }

        return $resultArray;
    }
    public function getLocalStores($item_id) {
        $resultArray = [];

        if (isset($item_id)) {
            $query = "SELECT * FROM local_stores WHERE product_id = $item_id";
            $result = $this->db->con->query($query);

            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }
        }

        return $resultArray;
    }
    public function getRatings($item_id) {
        $ratingData = [];

        if (isset($item_id)) {
            $query = "SELECT total_ratings, answered_questions FROM ratings WHERE product_id = $item_id";
            $result = $this->db->con->query($query);

            if ($result && $row = mysqli_fetch_assoc($result)) {
                $ratingData = $row;
            }
        }

        return $ratingData;
    }


}




