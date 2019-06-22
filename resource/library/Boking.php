<?php
require "../Config.php";
if (isset($_POST["name"])) {
    $guestName = $_POST["name"];
    $creditNo = $_POST["credit"];
    $roomNo = $_POST["room"];
    $checkIn = $_POST["check_in"];
    $check_out = $_POST["check_out"];
    $dys= $_POST["dys"];
    $checkIn = date_create($checkIn);
    //die($checkIn.);

    $checkIn = date_format($checkIn, "Y-m-d ");
    $check_out = date_create($check_out);
    $check_out = date_format($check_out, "Y-m-d ");

    //connect to db
    $conn = new mysqli(servername, username, password, database);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed  ");
    } else {
        $res = mysqli_query($conn, "SELECT * FROM guest where Name = '" . $guestName . "'");

        if(mysqli_num_rows($res) == 0) {
            //add Guest in db
            $sql = "INSERT INTO guest (Name	, CreditNo) VALUES ('" . $guestName . "','" . $creditNo . "')";
            $result = $conn->query($sql);
            $sql = "SELECT ID FROM guest ORDER BY ID DESC LIMIT 1;";
            $result = $conn->query($sql);

            $guestID = $result->fetch_assoc()["ID"];
        }
        else {
            $guest = mysqli_fetch_array($res);
            $guestID = $guest["ID"];
        }
            //check room Avaliablity
            if ($checkIn < $check_out) {
                //get All reversion time for this room
                $sql = "select Id from room where room_No =$roomNo";

                $result = $conn->query($sql);
               // die($result);

                $room = $result->fetch_assoc();
                $rommId = $room["Id"];

                $sql = "select * from reservation where room_id =$rommId";


                $result = mysqli_query($conn, $sql);


                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $date = date_create($row['check_in']);
                        $start = date_format($date, "Y-m-d");
                        $date = date_create($row['check_out']);
                        $end = date_format($date, "Y-m-d");

                        if (($checkIn < $start) & ($check_out < $start) || ($checkIn > $end) & ($check_out > $end)) {

                            //okk
                            continue;
                        } else
                            die ("Room Not available  This Appointment");
                    }
                }
            } else
                die("Check In & Check out dates Not Correct");


            $sql = "INSERT INTO reservation (guest_id, room_id,check_in,check_out,dys) VALUES ('" . $guestID . "','" . $rommId . "','" . $checkIn . "','" . $check_out . "','" . $dys . "')";

            if ($conn->query($sql) === TRUE) {
                echo "Reservation Successfully";
            } else {

                echo $conn->error;

            }



        $conn->close();


    }


}
if (isset($_POST["filter"])) {

    $checkIn = date_create($_POST["check_in"]);
    //die($checkIn.);

    $checkIn = date_format($checkIn, "Y-m-d ");
    $check_out = date_create($_POST["check_out"]);
    $check_out = date_format($check_out, "Y-m-d ");


    $avalRooms = []; //store room numbers
    $conn = new mysqli(servername, username, password, database);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed  ");
    } else {

    }
    $sql = "select * from room ";

    $res = $conn->query($sql);

    while ($rooms = mysqli_fetch_assoc($res)) {

        $id = $rooms["Id"];
        $roomNo = $rooms["room_No"];
        $av = true;

        $sql = "select * from reservation where room_id =$id";


        $result = mysqli_query($conn, $sql);

        //room_No
        // print_r($result);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                $date = date_create($row['check_in']);
                $start = date_format($date, "Y-m-d");
                $date = date_create($row['check_out']);
                $end = date_format($date, "Y-m-d");

                if (($checkIn < $start) & ($check_out < $start) || ($checkIn > $end) & ($check_out > $end)) {

                    $av = true;
                    //okk
                } else {
                    $av = false;
                    break;
                }
            }
            if ($av) {

                $avalRooms[count($avalRooms)] = [

                    "id" => $id,
                    "No" => $roomNo
                ];

            }

        } else {
            $avalRooms[count($avalRooms)] = [

                "id" => $id,
                "No" => $roomNo
            ];
            //print_r($avalRooms);

        }

    }


    //print_r($avalRooms);
    //echo count($avalRooms);
    echo json_encode($avalRooms);
}

?>