<?php
require "../Config.php";

if (isset($_POST['order'])) {

    $orders = $_POST['order'];
    $guest_Name = $orders[0]["guest_Name"];
    //die();
    $conn = new mysqli(servername, username, password, database);
    if ($conn->connect_error) {
        die("Connection failed  ");
    } else {
        $result = mysqli_query($conn, "SELECT * FROM guest where Name = '" . $guest_Name . "'");



        if (mysqli_num_rows($result) == 0) {
            die("Guest Not Found");
        } else {
            $guest = mysqli_fetch_array($result);
            $guestID = $guest["ID"];
            //  die($guestID);
        }
        foreach ($orders as $order) {


            $room_id = $order["room_id"];
            $meal_id = $order["meal_id"];
            $meal_Name = $order["Meal_Name"];

            $meal_price = $order["meal_price"];
            $qt = $order["qt"];
            $total = $meal_price * $qt;
            if ($conn->connect_error) {
                die("Connection failed  ");
            } else {

                $sql = "INSERT INTO meal_order (guest_id, meal_id,meal_name,meal_price,num,total_price,room_id)" .
                    "VALUES ('" . $guestID . "','" . $meal_id . "','" . $meal_Name . "','" . $meal_price . "','" . $qt . "','" . $total . "','" . $room_id . "')";

                if ($conn->query($sql) === false) {
                    die("insert failed  ");
                }


            }

        }
        echo "Order Saved  Successfully";
    }
}




  //{"credit":$("#credit").val(),"room_id":$("#room").val(),"meal_id":Meal_id,"meal_price":mealPrice,"qt":qt};


 else {
    die("You didn't select any meals.");

}
?>