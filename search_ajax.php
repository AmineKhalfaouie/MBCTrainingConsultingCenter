<?php
// Include necessary files
require_once 'database/DBController.php';
require_once 'functions.php'; // This contains the $offer object

// Get search keyword from POST request
$search = isset($_POST['search-keyword']) ? $_POST['search-keyword'] : '';

// Initialize database connection
$db = new DBController();

// Fetch search results
$searchResults = [];

if($db->con) {
    if(!empty($search)) {
        // Use the existing getOfferBySearch function from the Offer class
        $searchResults = $offer->getOfferBySearch($search);
        
        // If no results from getOfferBySearch, try a broader search
        if(empty($searchResults)) {
            $query = "SELECT * FROM offer WHERE item_name LIKE ? OR item_category LIKE ? ORDER BY item_register DESC LIMIT 10";
            $stmt = mysqli_prepare($db->con, $query);
            $searchTerm = "%$search%";
            mysqli_stmt_bind_param($stmt, "ss", $searchTerm, $searchTerm);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            while($row = mysqli_fetch_assoc($result)) {
                $searchResults[] = $row;
            }
        }
    } else {
        // If no search term, get recent offers
        $query = "SELECT * FROM offer ORDER BY item_register DESC LIMIT 10";
        $result = mysqli_query($db->con, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $searchResults[] = $row;
        }
    }
} else {
    // Database connection failed
    error_log("Database connection failed in search_ajax.php");
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($searchResults);
?> 