$(function () {
    $("#table").hide();
    $("#sel3").change(function () {
        if ($(this).val() == 1) {
            $("#text3").attr("disabled", "disabled");
            $("#text3").attr("placeholder", "Luggage inavailable");
        } else {
            $("#text3").removeAttr("disabled");
            $("#text3").attr("placeholder", "Enter the Luggage Weight");
            $("#text3").focus();
        }
    });
    $('#text3').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });

    $("#btn1").click(function (e) {
        e.preventDefault();
        var a = $("#sel1").val();
        var b = $("#sel2").val();
        var c = $("#sel3").val();
        var d = $("#text3").val();
        if (a == "0" || b == "0" || c == "0") {
            if (a == "0") {
                $("#sel1").focus();
            }
            if (b == "0") {
                $("#sel2").focus();
            }
            if (c == "0") {
                $("#sel3").focus();
            }
            alert("Please Enter values in input field");
            return;
        } else {
            $("#btn1").hide();
            $("#btn2").show();
        }
        if (a == b) {
            alert("Pickup Location and Destination can not be same");
            return;
        }
        console.log(a, b, c, d);
        $.ajax({
            url: "cal_cab_Fare.php",
            type: "POST",
            data: { Location: a, Destination: b, Cab: c, Luggage: d },
            success: function (result) {
                // alert(result);
                $("#table").show();
                $('#table1').html(result);
            },
            error: function () {
                alert("error");
            }
        });
    });
    $("#sel1,#sel2,#sel3").click(function () {
        $("#btn1").show();
        $("#btn2").hide();
    });

    $("#btn2").click(function (e) {
        e.preventDefault();
        var a = $("#sel1").val();
        var b = $("#sel2").val();
        var c = $("#sel3").val();
        var d = $("#text3").val();
        var action = 1;
        if (a == "0" || b == "0" || c == "0") {
            if (a == "0") {
                $("#sel1").focus();
            }
            if (b == "0") {
                $("#sel2").focus();
            }
            if (c == "0") {
                $("#sel3").focus();
            }
            alert("Please Enter values in input field");
            return;
        } else {
            $("#btn2").show();
        }
        if (a == b) {
            alert("Pickup Location and Destination can not be same");
            return;
        }
        console.log(a, b, c, d, action);
        $.ajax({
            url: "cal_cab_Fare.php",
            type: "POST",
            data: { Location: a, Destination: b, Cab: c, Luggage: d, action: action },
            success: function (result) {
                alert("RIDE BOOK PLEASE WAIT FOR APPROVAL");
                // alert(result);
            },
            error: function () {
                alert("error");
            }
        });
    });
});