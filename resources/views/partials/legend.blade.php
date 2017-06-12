
@section("head")
    <style>
    /* basic positioning */
    .legend { list-style: none; color:black; margin-left: auto; margin-right: auto; margin-top: 20px; width: 650px; }
    .legend li { float: left; margin-right: 10px; }
    .legend span { border: 1px solid #ccc; float: left; width: 12px; height: 12px; margin: 2px; }
    /* your colors */
    .legend .temp { background-color: #00ff12; }
    .legend .humid { background-color: #ff640d; }
    .legend .people { background-color: #000000; }
    </style>
@endsection

<ul class="legend">
    <li><span class="temp"></span> Temperature</li>
    <li><span class="humid"></span> Humidity</li>
    <li><span class="people"></span> People in the room</li>
</ul>
