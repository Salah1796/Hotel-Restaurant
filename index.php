<?php
$h1 = "Booking";
$title = "Booking";
?>
<?php require "layout/head.php"; ?>
<?php include "layout/nav.php"; ?>
<!-- END nav -->
<?php include "layout/header-slider.php"; ?>
<!-- boking form -->
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 " style="margin-top: -50px">
            <div class="col-md-12 text-center heading-section ftco-animate">
                <h2>Room Reservation</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 dish-menu border " style="margin-top:-50px">

                <div class="nav nav-pills justify-content-center ftco-animate" id="v-pills-tab" role="tablist"
                     aria-orientation="vertical">
                </div>


                <form action="resource/library/Boking.php" method="post" class="d-block">
                    <div class="form-group">
                        <label for="name"> Name</label>
                        <input type="text" class="form-control" placeholder=" Enter Guest Name" name="name" id="name"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="credit">Credit Number</label>
                        <input type="number" class="form-control" placeholder=" Enter Credit Number " id="credit"
                               required
                               maxlength="14">
                    </div>
                    <div class="form-group">
                        <label for="check-in">Check in</label>
                        <input type="text" id="checkin_date" class="form-control date" placeholder="M/D/YYYY"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="check-out">Check out</label>
                        <input type="text" id="checkout_date" class="form-control date" placeholder="M/D/YYYY"
                               required>
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
                    <div class="col-md-12">

                        <div class="form-group text-center">
                            <input type="submit" id="book" class="search-submit btn btn-primary" value="Save">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php include "layout/footer.php"; ?>
<script>
    function Booking(Name, credit, check_in, check_out, room) {

        this.Name = Name;
        this.credit = credit;

        this.check_in = check_in;
        this.check_out = check_out;
        this.room = room;


    }

    var chkin, chkout;
    //filter select box
    $(".date").on("changeDate", function () {
        chkin = new Date($("#checkin_date").val());
        chkout = new Date($("#checkout_date").val());
        //alert("chand");

        if (chkin < chkout) {

            $.post("resource/library/Boking.php",
                {

                    filter:1,
                    check_in: $("#checkin_date").val(),
                    check_out: $("#checkout_date").val()


                },
                function (data, status) {
                    if (status = "success") {
                        // console.log(data[0]);

                        var rooms = JSON.parse(data);
                        $("#room").html("");

                        for (var i = 0; i < rooms.length; i++) {
                            //var obj = json[i];
                            $("#room").append("<option value=" + rooms[i].id + ">" + rooms[i].No + "</option>");

                            //console.log(obj.id);
                        }

                        $("#res").text("Rooms available at this time");
                        // console.log(arr[0].id);

                    }
                    else {
                        alert("error")
                    }

                });
            // alert();
        }


    });


    $("#book").on("click", function (e) {
        e.preventDefault();


        //validation
        var errorMsg = " ", erronum = 0, days = 0;

        var chkin = new Date($("#checkin_date").val());
        var chkout = new Date($("#checkout_date").val());

        if (chkin > chkout) {
            errorMsg += "Check in Date Must be  before  check out Date\n\n";
            erronum++;

        }
        else {

            days = Math.floor((chkout - chkin) / (60 * 60 * 24 * 1000));

        }
        if ($("#credit").val().length == 0) {
            errorMsg += "Credit Number Not Valid  \n ";
            erronum++;
        }
        var name=$("#name").val().trim();

        if ( name.split(" ").length!= 3) {
            errorMsg += "Guest Name must Be Three word  \n ";
            erronum++;
        }
        if (erronum > 0) {
            alert(errorMsg);
            e.preventDefault();
            //return 0;
        }
        else {

            $.post("resource/library/Boking.php",
                {

                    name: $("#name").val(),
                    credit: $("#credit").val(),
                    check_in: $("#checkin_date").val(),
                    check_out: $("#checkout_date").val(),
                    room: $("#room").val(),
                    dys:days

                },
                function (data, status) {
                    if  (status = "success") {
                        alert(data);
                        location.reload(true);

                    }
                    else {
                        alert("error")
                    }

                });
        }


    });


</script>
</body>
</html>
