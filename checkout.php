<?php
$h1 = "Checkout";
$title = "Checkout";
?>
<?php require "layout/head.php";
require "resource/Config.php";

?>
<?php include "layout/nav.php"; ?>
<!-- END nav -->
<?php include "layout/header-slider.php"; ?>
<!-- boking form -->

<section class="ftco-section bg-light">
    <div class="container  border" style="min-height: 1000px">

        <div class="row justify-content-center mb-5 " style="margin-top: -50px">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <h2>Checkout</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 dish-menu border " style="margin-top:-50px">

                <div class="nav nav-pills justify-content-center ftco-animate" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                </div>


                <form id="form " action="" method="post" class="form">
                    <br>
                    <br>
                    <div class="form-group">

                        <input type="text" class="form-control" placeholder=" Enter Guest Name" name="name" id="name"
                               required>
                    </div>
                    <div class="col-md-12">

                        <div class="form-group text-center">
                            <input name="submit" type="submit" id="book" class="search-submit btn btn-primary"
                                   value="Checkout">

                        </div>
                    </div>

                </form>

            </div>

                <?php
                if (isset($_POST["submit"]))
                {
                ?>
                <br>
            </div>

            <div class="col-md-12 dish-menu">
                <br>
                <br>
                <h3>Restaurant Invoice </h3>

            </div>


            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Meal Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qt</th>
                    <th scope="col">Total Price</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $conn = new mysqli(servername, username, password, database);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed  ");
                } else {

                $guest_Name = $_POST["name"];
                $result = mysqli_query($conn, "SELECT * FROM guest where Name = '" . $guest_Name . "'");


                $guest = mysqli_fetch_array($result);
                $guestID = $guest["ID"];

                //die($guestID);
                $result = mysqli_query($conn, "SELECT * FROM meal_order where guest_id = '" . $guestID . "'");

                $totalMeal = 0;
                $x=0;
                while ($ord = mysqli_fetch_array($result)) {
                    //print_r($ord);
                    $totalMeal += $ord['meal_price'] * $ord['num'];
                    $x++;
                    ?>


                    <tr>
                        <th scope="col"><?php echo $x ?></th>

                        <td scope="col"><?php echo $ord['meal_name']; ?></td>

                        <td scope="col"><?php echo $ord['meal_price']; ?></td>
                        <td scope="col"><?php echo $ord['num']; ?></td>

                        <td scope="col"><?php echo $ord['meal_price'] * $ord['num']; ?></td>
                    </tr>
                    <?php

                }
                ?>

                </tbody>
            </table>
<br>
        <button type="button" class="btn btn-info">Total Restaurant :<?php echo $totalMeal; ?></button>
<br>
        <br>
        <div class="col-md-12 dish-menu">


            <h3>Hotel  Invoice </h3>

        </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Room number</th>

                    <th scope="col"> check in</th>
                    <th scope="col"> check out</th>
                    <th scope="col">number Of Days</th>

                    <th scope="col"> Room Price</th>


                    <th scope="col">Total Price</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $conn = new mysqli(servername, username, password, database);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed  ");
                } else {


                //die($guestID);
                $result = mysqli_query($conn, "SELECT * FROM reservation where guest_id = '" . $guestID . "'");

                $totalBooking = 0;
                $x = 1;
                while ($ord = mysqli_fetch_array($result)) {
                    //print_r($ord);
                    $totalBooking += $ord['dys'] * 200;
                    ?>


                    <tr>
                        <th scope="col"><?php echo $x++ ?></th>
                        <td scope="col"><?php echo $ord['room_id']; ?></td>
                        <td scope="col"><?php echo $ord['check_in']; ?></td>
                        <td scope="col"><?php echo $ord['check_out']; ?></td>
                        <td scope="col"><?php echo $ord['dys']; ?></td>
                        <td scope="col">200</td>
                        <td scope="col"><?php echo $ord['dys'] * 200; ?></td>
                    </tr>
                    <?php

                }
                ?>

                </tbody>
            </table>

        <button type="button" class="btn btn-info">Total Hotel : <?php echo $totalBooking; ?></button>
<br><br>
<hr>
        <button type="button" class="btn btn-success btn-lg  btn-block" ">Total :<?php echo $totalBooking+$totalMeal; ?></button>

        <?php

            }
            }
            }

            ?>



        </div>
    </div>
</section>


<?php include "layout/footer.php"; ?>

<script>
    $("#form").submit(function (e) {
        // e.preventDefault();
        // alert();
        //$(this).hide(1000);

        //console.log( $(this).html());
    })
</script>