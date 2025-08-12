<?php
class Favorite {
    public $db = null;

    public function __construct(DBController $db) {
        if (!isset($db->con)) {
            return null;
        }
        $this->db = $db;
    }

    public function insertToFavorites($params = null, $table = "favorites") {
        if ($this->db->con != null) {
            if ($params != null) {
                $columns = implode(",", array_keys($params));
                $values = implode(",", array_values($params));
                $query = "INSERT INTO $table ($columns) VALUES ($values)";
                $result = $this->db->con->query($query);
                return $result;
            }
        }
    }

    // to get user_id and item_id and insert into favorites table
    public  function addToFavorites($userid, $itemid){
        if (isset($userid) && isset($itemid)){
            $params = array(
                "user_id" => $userid,
                "item_id" => $itemid
            );

            // insert data into favorites
            $result = $this->insertToFavorites($params);
            if ($result){
                // Reload Page with current URL parameters
                $current_url = $_SERVER['REQUEST_URI'];
                header("Location: " . $current_url);
            }
        }
    }

    // delete cart item using cart item id
    public function deleteFavorites($item_id = null, $table = 'favorites'){
        if($item_id != null){
            $result = $this->db->con->query("DELETE FROM {$table} WHERE item_id={$item_id}");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    // get all favorites data
    public function getData($table = 'favorites') {
        $result = $this->db->con->query("SELECT * FROM {$table}");

        $resultArray = array();

        //fetch the favorites data one by one
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // get item_id from favorites
    public function getFavoritesById($favoritesArray = null, $key = "item_id") {
        if ($favoritesArray != null) {
            $item_id = array_map(function ($values) use ($key) {
                if (isset($values[$key])) {
                    return $values[$key];
                }
            }, $favoritesArray);
            return $item_id;
        }
    }
}
?>