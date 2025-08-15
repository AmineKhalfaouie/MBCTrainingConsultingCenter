<?php
class Offer {
    public $db = null;

    public function __construct(DBController $db) {
        if(!isset($db->con)) return null;
        $this->db = $db;
    }

    //fetching offer data using getData method
    public function getData($table = 'offer') {
        $result = $this->db->con->query("SELECT * FROM {$table}");

        $resultArray = array();

        //fetch the offer data one by one
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    //fetching offer data by item_id
    public function getOfferById($item_id = null, $table = 'offer') {
        if (isset($item_id) && isset($user_id)) {
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE item_id = {$item_id}");

            $resultArray = array();

            //fetch the offer data one by one
            while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

    //fetching offer data using getFavoriteByUserIdAndItemId method
    public function getFavoriteByUserIdAndItemId($user_id = null) {
        $result = $this->db->con->query("SELECT * FROM offer as o, favorites as f, user as u WHERE f.user_id = u.user_id AND f.item_id = o.item_id AND u.user_id = $user_id");

        $resultArray = array();

        //fetch the offer data one by one
        while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }

        return $resultArray;
    }
}
?>