




<script>
    $( document ).ready(function() {

    @if(!empty($nodes))
     @foreach ($nodes as $node)
            <?php echo "drawCoordinates(" + $node->uuid + " , " + $node->uuid + ")"  ; ?>
    @endforeach
    @endif

    });

    $( "#x, #y, #category" ).change(function() {
        drawCoordinates(($( "#x" ).val()),  ($( "#y" ).val()));

    });


    var pointSize = 2;

    function getPosition(event) {
        var rect = canvas.getBoundingClientRect();
        var x = event.clientX - rect.left;
        var y = event.clientY - rect.top;

        drawCoordinates(x, y);
        document.form.x.value = Math.floor(x);
        document.form.y.value = Math.floor(y);

    }

    function drawCoordinates(x, y) {
        var ctx = document.getElementById("floor").getContext("2d");
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = "#00ff12"; // Red color
        ctx.beginPath();
        ctx.arc(x, y, pointSize, 0, Math.PI * 2, true);
        ctx.fill();
    }
</script>