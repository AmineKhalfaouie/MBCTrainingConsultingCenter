<?php
require('database/DBController.php');
$db = new DBController();
// getting user message throw ajax
$getMesg = mysqli_real_escape_string($db->con, $_POST['text']);
// check if user message is empty
$checkData = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%'";
$runQuery = mysqli_query($db->con, $checkData) or die("Error");

if(mysqli_num_rows($runQuery) > 0) {
    // if uer message is not empty then fetch the data from database and display it
    $fetchData = mysqli_fetch_assoc($runQuery);
    // get the replies from database and send it to the ajax
    $replay = $fetchData['replies'];
    echo $replay;
}
else {
    echo "Sorry, I don't understand your question.";
}
?>