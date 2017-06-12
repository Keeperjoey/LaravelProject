@extends('back.template')

@section('main')



    <div class="col-md-3">

        <div class="panel-heading">Node {{ $node->id }}</div>
        <div class="panel-body">

            <a href="{{ url('/admin/nodes') }}" title="Back">
                <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
            </a>
            <a href="{{ url('/admin/nodes/' . $node->id . '/edit') }}" title="Edit Node">
                <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                </button>
            </a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['admin/nodes', $node->id],
                'style' => 'display:inline'
            ]) !!}
            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Node',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
            {!! Form::close() !!}
            <br/>
            <br/>

            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $node->id }}</td>
                    </tr>
                    <tr>
                        <th> Uuid</th>
                        <td> {{ $node->uuid }} </td>
                    </tr>
                    <tr>
                        <th> Content</th>
                        <td> {{ $node->content }} </td>
                    </tr>
                    <tr>
                        <th> X</th>
                        <td> {{ $node->x }} </td>
                    </tr>
                    <tr>
                        <th> Y</th>
                        <td> {{ $node->y }} </td>
                    </tr>
                    <tr>
                        <th> Category</th>
                        <td> {{ $node->category }} </td>
                    </tr>

                    <tr>
                        <th> Node status</th>
                        <td>
                            <?php

                            $url = $BASE_URL_API. "/api/sensordata/alive/".$node->uuid;
                            try{
                                echo "Up chance: " . file_get_contents($url);}
                            catch(Exception $e){
                                echo "Node does not exist or api is down";
                            };
                            ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <div class="col-md-9">
        <div id="floor0" style="padding-top: 40px">
            <canvas id="canvas" width="840" height="292px"
                    style="background-image:url('/img/floor-zero.jpg')"></canvas>
        </div>
    </div>


@endsection

@section('scripts')
    <script>

        $( document ).ready(function() {
            var x = {{ $node->x }} ;
            var y = {{ $node->y }};
            changeBackgroundImage();
            drawCoordinates( x,y );
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

        var pointSize = 8;


        function drawCoordinates(x, y) {
            var ctx = document.getElementById("canvas").getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            var category = {{ $node->category }};

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

@endsection