@extends('front.template')

@section('brand')
    Dashboard
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">


                <div id="floor-zero" class="tabcontent">

                    <div class="header">
                        <h4 class="title">Ground floor</h4>
                        <p class="category">This is an overview of wheter the sensors are up the color says what type it
                            is</p>
                    </div>
                    <div class="content">

                        <canvas id="floor0" width="820" height="292px"
                                style="background-image:url('/img/floor-zero.jpg')"></canvas>
                        @include('partials.legend')
                    </div>
                </div>

                <div id="floor-one" class="tabcontent">
                    <div class="header">
                        <h4 class="title">1st floor</h4>
                        <p class="category">This is an overview of wheter the sensors are up the color says what type it
                            is</p>
                    </div>
                    <div class="content">

                        <canvas id="floor1" width="820" height="292px"
                                style="background-image:url('/img/floor-one.jpg')"></canvas>

                        @include('partials.legend')
                    </div>
                </div>

                <div id="floor-two" class="tabcontent">
                    <div class="header">
                        <h4 class="title">2nd floor</h4>
                        <p class="category">This is an overview of wheter the sensors are up the color says what type it
                            is</p>
                    </div>
                    <div class="content">

                        <canvas id="floor2" width="820" height="292px"
                                style="background-image:url('/img/floor-two.jpg')"></canvas>

                        @include('partials.legend')
                    </div>
                </div>


                <button class="tablink" onclick="openFloor('floor-zero', this, 'red')" id="defaultOpen">Ground floor
                </button>
                <button class="tablink" onclick="openFloor('floor-one', this, 'green')">1st floor</button>
                <button class="tablink" onclick="openFloor('floor-two', this, 'blue')">Top floor</button>
            </div>


        </div>


    <div class="col-md-12">
        <div class="card">
            <canvas id="line-chart" width="800" height="450"></canvas>

        </div>
    </div>
    </div>

@endsection

@section("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>

    <script>
        $(document).ready(function () {
            drawCoordinates(144, 211, 1, 2, 2);
            <?php
            if (!empty($nodes)) {
                foreach ($nodes as $node) {
                    $url = $BASE_URL_API . "/api/sensordata/alive/" . $node->uuid;

                    try {
                        echo "drawCoordinates("
                            . $node->x
                            . " , "
                            . $node->y
                            . " , "
                            . intval(file_get_contents($url))
                            . " , "
                            . $node->floor
                            . " , "
                            . $node->category
                            . "); ";

                    } catch (Exception $e) {

                    };
                }
            }
            ?>
        });


        function drawCoordinates(x, y, pointSize, floorNumber, category) {

            pointSize = pointSize * 12 + 4;

            var ctx = document.getElementById("floor" + floorNumber).getContext("2d");

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

    <script>
        function openFloor(floorName, elmnt, color) {
            // Hide all elements with class="tabcontent" by default */
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Remove the background color of all tablinks/buttons
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }

            // Show the specific tab content
            document.getElementById(floorName).style.display = "block";

            // Add the specific color to the button used to open the tab content
            elmnt.style.backgroundColor = color;
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>

    <script>


        <?php
$values = array(); ;
$times = array(); ;

if (!empty($nodes)) {
    foreach ($nodes as $node) {
        try {
            $json = file_get_contents($BASE_URL_API . "/api/sensordata/");


            $jsonParsed = json_decode($json, TRUE);
            $jsonParsed = $jsonParsed['root'];

            foreach ($jsonParsed as $rootNodes) {

                foreach ($rootNodes['Readings'] as $readings) {

                    if( $readings['Type'] == "temperature"){
                        //dd($readings['Value']);
                        array_push($values, $readings['Value']);
                        array_push($times,$readings['Timestamp']);
                    }

                }
            }

        } catch (Exception $e) {

        };
    }

}

?>


new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
                labels: [{!!    "'" . implode("', '", $times). "'"  !!} ],
                datasets: [{
                    data: [{!!     "'" . implode("', '", $values). "'"  !!} ],
                    label: "Temperature",
                    borderColor: "#3e95cd",
                    fill: false
                }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Temperature, data from api'
                }
            }
        });
    </script>
@endsection