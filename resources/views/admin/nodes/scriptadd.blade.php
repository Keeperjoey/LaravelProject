<script>

    $( document ).ready(function() {
        changeBackgroundImage();
        drawCoordinates(($( "#x" ).val()),  ($( "#y" ).val()));
    });

    $( "#floor" ).change(function () {
        changeBackgroundImage();

    })

    $( "#x, #y, #category" ).change(function() {
        drawCoordinates(($( "#x" ).val()),  ($( "#y" ).val()));

    });


    function changeBackgroundImage(){
        if ($('#floor').val() == 0) {
            $('#canvas').css("background-image", "url(/img/floor-zero.jpg)");
        }
        if ($('#floor').val() == 1)
            $('#canvas').css("background-image", "url(/img/floor-one.jpg)");

        if ($('#floor').val() == 2)
            $('#canvas').css("background-image", "url(/img/floor-two.jpg)");
    }

    $("#canvas").click(function (e) {
        getPosition(e);
    });


    var pointSize = 8;

    function getPosition(event) {
        var rect = canvas.getBoundingClientRect();
        var x = event.clientX - rect.left;
        var y = event.clientY - rect.top;

        drawCoordinates(x, y);
        document.form.x.value = Math.floor(x);
        document.form.y.value = Math.floor(y);

    }

    function drawCoordinates(x, y) {
        var ctx = document.getElementById("canvas").getContext("2d");
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        var category = $( "#category" ).val();

        if (category == 0)
            ctx.fillStyle = "#00ff12"; // Red color
        if (category == 1)
            ctx.fillStyle = "#ff640d"; // orange color
        if (category == 2)
            ctx.fillStyle = "#000000"; // black color



        ctx.beginPath();
        ctx.arc(x, y, pointSize, 0, Math.PI * 2, true);
        ctx.fill();
    }
</script>