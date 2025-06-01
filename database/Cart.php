<?php

namespace database;
require_once(__DIR__ . '/../database/DBController.php');

ob_start();


class Cart
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    public function insertIntoCart($params = null, $table = "cart")
    {
        if ($this->db->con != null && $params != null) {
            $columns = implode(",", array_keys($params));
            $placeholders = implode(",", array_fill(0, count($params), '?'));
            $stmt = $this->db->con->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");

            if ($stmt === false) {
                die('Prepare failed: ' . $this->db->con->error);
            }

            $types = str_repeat("s", count($params)); // adjust types if needed
            $values = array_values($params);
            $stmt->bind_param($types, ...$values);

            $result = $stmt->execute();
            $stmt->close();

            return $result;
        }
        return false;
    }

    public function addToCart($userid, $itemid)
    {
        if (isset($userid) && isset($itemid)) {
            $params = array("user_id" => $userid, "item_id" => $itemid);
            $result = $this->insertIntoCart($params);
            if ($result) {
                header("Location:" . $_SERVER['PHP_SELF']);
            }
        }
    }

    // ✅ Just added this method
    public function getSum($arr)
    {
        $sum = 0;
        foreach ($arr as $item) {
            foreach ($item as $price) {
                $sum += floatval($price);
            }
        }
        return $sum;
    }

    // ✅ Just added this method
    public function deleteCart($item_id = null, $user_id = null, $table = 'cart') {
        if ($this->db->con != null) {
            $stmt = $this->db->con->prepare("DELETE FROM $table WHERE item_id = ? AND user_id = ?");
            $stmt->bind_param("ii", $item_id, $user_id);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
    }


    public function saveForLater($item_id, $user_id = 1, $table = "wishlist") {
        if ($this->db->con != null) {
            // Move item from cart to wishlist
            $query = "INSERT INTO {$table} (user_id, item_id)
                  SELECT user_id, item_id FROM cart WHERE item_id = $item_id AND user_id = $user_id;

                  DELETE FROM cart WHERE item_id = $item_id AND user_id = $user_id;";

            $result = mysqli_multi_query($this->db->con, $query);
            return $result;
        }
    }
    public function getCartId($cartArray, $key = "item_id") {
        if (is_array($cartArray)) {
            $cart_id = array_map(function ($value) use ($key) {
                return $value[$key];
            }, $cartArray);
            return $cart_id;
        }
        return array(); // return empty array if input is not valid
    }

}


