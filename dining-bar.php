<?php
$h1 = "Discover Our Menus";
$title = "Dining &amp; Ba";
?>
<?php
include "resource/config.php";
?>

<?php require "layout/head.php"; ?>
<body>
<?php include "layout/nav.php"; ?>
<!-- END nav -->
<?php include "layout/header-slider.php"; ?>

<!-- boking form -->


<section class="ftco-section bg-light ">
    <div class="container border" style="margin-top:-100px;; padding: 10px">
        <div class="row justify-content-center mb-5 pb-5">
            <div class="col-md-7 text-center heading-section ftco-animate">
                <span class="subheading">Our Menu</span>
                <h2>Restaurant</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 dish-menu " style="margin-top: -70px">


                <div class="nav nav-pills justify-content-center ftco-animate" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                    <a class="nav-link py-3 px-4 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                       role="tab" aria-controls="v-pills-home" aria-selected="true"><span class="flaticon-tray"></span>
                        Main</a>
                    <a class="nav-link py-3 px-4" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                       role="tab" aria-controls="v-pills-profile" aria-selected="false"><span
                                class="flaticon-beer"></span> Dessert</a>
                    <a class="nav-link py-3 px-4" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages"
                       role="tab" aria-controls="v-pills-messages" aria-selected="false"><span
                                class="flaticon-cheers"></span> Drinks</a>
                </div>


                <form action="resource/library/order.php" method="post" id="order">
                    <div class="tab-content py-5" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                             aria-labelledby="v-pills-home-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php
                                    $conn = new mysqli(servername, username, password, database);
                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed  ");
                                    } else {

                                        $sql = "select * from meal WHERE  cat='meat'  ";
                                        $result = mysqli_query($conn, $sql);
                                        //print_r($result);
                                        //echo "///////////" . $row['Name'];
                                        for ($i = 0; $i < (int)(mysqli_num_rows($result) / 2); $i++) {
                                            $row = mysqli_fetch_assoc($result);

                                            ?>
                                            <div class="menus d-flex ftco-animate">

                                                <div class="menu-img"
                                                     style='background-image: url("public/images/<?php echo $row['img'] ?>");'></div>
                                                <div class="text d-flex">
                                                    <div class="one-half">
                                                        <h3><?php echo $row['Name'] ?></h3>
                                                        <p><?php echo $row['Desc'] ?></p>
                                                    </div>
                                                    <div class="one-forth">
                                                        <span class="price"><?php echo $row['price'] ?></span>


                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-check col-6">


                                                <input name="meal[]" value="<?php echo $row['price'] ?>"
                                                       class="form-check-input" type="checkbox" id="asd">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Add To Order
                                                </label>


                                                <input name="num[]" type="number" class="form-control"
                                                       placeholder="quantity" aria-label="quantity"
                                                       aria-describedby="basic-addon2" min="1" disabled>
                                                <input name="id" hidden value="<?php echo $row['id'] ?>">
                                            </div>

                                        <?php }
                                    } ?>

                                </div>

                                <div class="col-lg-6">
                                    <?php
                                    for ($i = mysqli_num_rows($result) / 2;
                                         $i < mysqli_num_rows($result);
                                         $i++) {
                                        $row = mysqli_fetch_assoc($result);


                                        ?>
                                        <div class="menus d-flex ftco-animate">

                                            <div class="menu-img"
                                                 style='background-image: url("public/images/<?php echo $row['img'] ?>");'></div>

                                            <div class="text d-flex">
                                                <div class="one-half">
                                                    <h3><?php echo $row['Name'] ?></h3>
                                                    <p><?php echo $row['Desc'] ?></p>
                                                </div>
                                                <div class="one-forth">
                                                    <span class="price"><?php echo $row['price'] ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-check col-6">


                                            <input name="meal[]" value="<?php echo $row['price'] ?>"
                                                   class="form-check-input" type="checkbox" id="asd">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Add To Order
                                            </label>


                                            <input name="num[]" type="number" class="form-control"
                                                   placeholder="quantity" aria-label="quantity"
                                                   aria-describedby="basic-addon2" min="1" disabled>
                                            <input name="id" hidden value="<?php echo $row['id'] ?>">
                                        </div>

                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
                        </div><!-- END -->

                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                             aria-labelledby="v-pills-profile-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php
                                    //  $conn = new mysqli(servername, username, password, database);
                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed  ");
                                    } else {

                                        //echo $numofmeal;
                                        $sql = "select * from meal WHERE  cat='Dessert'";
                                        $result = mysqli_query($conn, $sql);
                                        //print_r($result);
                                        //echo "///////////" . $row['Name'];
                                        for ($i = 0; $i < (int)(mysqli_num_rows($result) / 2); $i++) {
                                            $row = mysqli_fetch_assoc($result);

                                            ?>
                                            <div class="menus d-flex ftco-animate">


                                                <div class="menu-img"
                                                     style='background-image: url("public/images/<?php echo $row['img'] ?>");'></div>
                                                <div class="text d-flex">
                                                    <div class="one-half">
                                                        <h3><?php echo $row['Name'] ?></h3>
                                                        <p><?php echo $row['Desc'] ?></p>
                                                    </div>
                                                    <div class="one-forth">
                                                        <span class="price"><?php echo $row['price'] ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-check col-6">


                                                <input name="meal[]" value="<?php echo $row['price'] ?>"
                                                       class="form-check-input" type="checkbox" id="asd">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Add To Order
                                                </label>


                                                <input name="num[]" type="number" class="form-control"
                                                       placeholder="quantity" aria-label="quantity"
                                                       aria-describedby="basic-addon2" min="1" disabled>
                                                <input name="id" hidden value="<?php echo $row['id'] ?>">
                                            </div>

                                        <?php }
                                    } ?>

                                </div>

                                <div class="col-lg-6">
                                    <?php
                                    for ($i = mysqli_num_rows($result) / 2;
                                         $i < mysqli_num_rows($result);
                                         $i++) {
                                        $row = mysqli_fetch_assoc($result);


                                        ?>
                                        <div class="menus d-flex ftco-animate">


                                            <div class="menu-img"
                                                 style='background-image: url("public/images/<?php echo $row['img'] ?>");'></div>
                                            <div class="text d-flex">
                                                <div class="one-half">
                                                    <h3><?php echo $row['Name'] ?></h3>
                                                    <p><?php echo $row['Desc'] ?></p>
                                                </div>
                                                <div class="one-forth">
                                                    <span class="price"><?php echo $row['price'] ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-check col-6">


                                            <input name="meal[]" value="<?php echo $row['price'] ?>"
                                                   class="form-check-input" type="checkbox" id="asd">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Add To Order
                                            </label>


                                            <input name="num[]" type="number" class="form-control"
                                                   placeholder="quantity" aria-label="quantity"
                                                   aria-describedby="basic-addon2" min="1" disabled>
                                            <input name="id" hidden value="<?php echo $row['id'] ?>">
                                        </div>

                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div><!-- END -->

                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                             aria-labelledby="v-pills-messages-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php
                                    //  $conn = new mysqli(servername, username, password, database);
                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed  ");
                                    } else {

                                        //echo $numofmeal;
                                        $sql = "select * from meal WHERE  cat='Drinks'";
                                        $result = mysqli_query($conn, $sql);
                                        //print_r($result);
                                        //echo "///////////" . $row['Name'];
                                        for ($i = 0; $i < (int)(mysqli_num_rows($result) / 2); $i++) {
                                            $row = mysqli_fetch_assoc($result);

                                            ?>
                                            <div class="menus d-flex ftco-animate">

                                                <div class="menu-img"
                                                     style='background-image: url("public/images/<?php echo $row['img'] ?>");'></div>
                                                <div class="text d-flex">
                                                    <div class="one-half">
                                                        <h3><?php echo $row['Name'] ?></h3>
                                                        <p><?php echo $row['Desc'] ?></p>
                                                    </div>
                                                    <div class="one-forth">
                                                        <span class="price"><?php echo $row['price'] ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-check col-6">


                                                <input name="meal[]" value="<?php echo $row['price'] ?>"
                                                       class="form-check-input" type="checkbox" id="asd">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Add To Order
                                                </label>


                                                <input name="num[]" type="number" class="form-control"
                                                       placeholder="quantity" aria-label="quantity"
                                                       aria-describedby="basic-addon2" min="1" disabled>
                                                <input name="id" hidden value="<?php echo $row['id'] ?>">
                                            </div>

                                        <?php }
                                    } ?>

                                </div>

                                <div class="col-lg-6">
                                    <?php
                                    for ($i = mysqli_num_rows($result) / 2;
                                         $i < mysqli_num_rows($result);
                                         $i++) {
                                        $row = mysqli_fetch_assoc($result);


                                        ?>
                                        <div class="menus d-flex ftco-animate">

                                            <div class="menu-img"
                                                 style='background-image: url("public/images/<?php echo $row['img'] ?>");'></div>
                                            <div class="text d-flex">
                                                <div class="one-half">
                                                    <h3><?php echo $row['Name'] ?></h3>
                                                    <p><?php echo $row['Desc'] ?></p>
                                                </div>
                                                <div class="one-forth">
                                                    <span class="price"><?php echo $row['price'] ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-check col-6">


                                            <input name="meal[]" value="<?php echo $row['price'] ?>"
                                                   class="form-check-input" type="checkbox" id="asd">
                                            <label class="form-check-label" for="defaultCheck1">
                                                Add To Order
                                            </label>


                                            <input name="num[]" type="number" class="form-control"
                                                   placeholder="quantity" aria-label="quantity"
                                                   aria-describedby="basic-addon2" min="1" disabled>
                                            <input name="id" hidden value="<?php echo $row['id'] ?>">
                                        </div>

                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">

                        <input name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp"
                               placeholder="Enter guest  Name" required>


                    </div>
                    <div class="form-group">
                        <label for="room">Room Number</label>
                        <div class="select-wrap">
                            <div class="icon"></div>
                            <select name="room" id="room" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>

                            </select>
                            <p id="res"></p>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>


                </form>

                <div id="det" style="margin-top: -20px">
                    <h3 id="lab" style="display: none; margin-top: 50px">Order Details: </h3>
                    <span id="Gust_name" style="display: none"></span>
                    <br>
                    <span id="Room_No" style="display: none"></span>
                    <br>
                    <table id="jqres" class="table table-hover table-border"></table>

                    <button style="display: none;" id="savorder" type="button" class="btn btn-success">Save Order
                    </button>
                    <button style="display: none;" id="cancorder" type="button" class="btn btn-danger">Cancel order
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "layout/footer.php"; ?>


<script>

    $(":checkbox").next().next().prop("disabled", true);

    $(":checkbox").change(function (e) {
        if (e.target.checked) {
            $(this).next().next().prop("disabled", false);
            $(this).next().next().val(1)

        } else {
            $(this).next().next().prop("disabled", true)
            $(this).next().next().val("");
        }
    });
    var order = [];


    $("form").submit(function (e) {

            e.preventDefault();
            order = [];
            var errorMsg = "", erronum = 0;
            if ($('.form-check-input:checkbox:checked').length < 1) {
                errorMsg += "you didn't choose any meal !! \n";
                erronum++;

            }
            var name = $("#name").val().trim();
            var room = $("#room").val();


            if (name.split(" ").length != 3) {
                errorMsg += "Guest Name must Be Three word  \n ";
                erronum++;
            }
            if (erronum > 0) {
                alert(errorMsg);
                e.preventDefault();

            }
            else {

                var x = 0;
                var total = 0;
                var res = " <thead> <tr>       <th scope=\"col\">#</th>\n <th scope=\"col\" >Meal Name </th>   <th scope=\"col\">Price </th><th scope=\"col\" >Qauntaty<th scope=\"col\">Total Price</th><tr>   </thead>\n";
                $.each($('.form-check-input:checkbox:checked'), function () {

                    x++;
                    var Meal_id = $(this).next().next().next().val();

                    var Meal_Name = $(this).parent().prev().find("h3").text();

                    var mealPrice = $(this).parent().prev().find("span").text();
                    var qt = $(this).next().next().val();
                    total += qt * mealPrice
                    order[order.length] = {
                        "guest_Name": name,
                        "room_id": room,
                        "meal_id": Meal_id,
                        "meal_price": mealPrice,
                        "qt": qt,
                        "Meal_Name": Meal_Name
                    };
                    res += "<tr> <th scope=\"row\">" + x + "</th>\n <td>" + Meal_Name + "</td> <td>" + mealPrice + "</td><td>" + qt + "<td>" + qt * mealPrice + "</td><tr>";


                });
                res += "<tr><th scope=\"row\">Total Order Price </th><td></td><td></td><td><td>" + total+ "</td><tr>";
                if (order.length > 0)
                    $("#jqres").html(res);
                $("#Gust_name").show();
                $("#Gust_name").html("Guest Name : " + $("#name").val());
                $("#savorder").show();
                $("#Room_No").show();
                $("#Room_No").html("Room Number : " + $("#room").val());

                $("#lab").show();
                $("#cancorder").show();

            }

            $("#cancorder").click(function () {
                var result = confirm("Are you sure to delete?");
                if (result) {

                    order = [];
                    location.reload(true);
                }
            });


            $("#savorder").click(function () {

                // console.log(order);
                $.ajax({
                    type: "POST",
                    data: {order: order},
                    url: "resource/library/order.php",
                    success: function (msg) {
                        alert(msg);
                        location.reload(true);

                    }
                });
//            //windows.location = "asd.php";
            });

        }
    );


</script>

</body>
</html>