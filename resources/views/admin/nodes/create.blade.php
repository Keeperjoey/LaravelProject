@extends('back.template')

@section('main')



    <div class="col-md-4">

        <div class="panel-heading">Create New Node</div>
        <div class="panel-body">
            <a href="{{ url('/admin/nodes') }}" title="Back">
                <button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button>
            </a>
            <br/>
            <br/>

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            {!! Form::open(['url' => '/admin/nodes', 'class' => 'form-horizontal', 'files' => true, 'name' => 'form']) !!}

            @include ('admin.nodes.form')

            {!! Form::close() !!}

        </div>
    </div>




    <div class="col-md-8">

        <h2>Select a spot for the new node</h2>

        <div id="floor0" style="padding-top: 40px">
            <canvas id="canvas" width="840" height="292px"
                    style="background-image:url('/img/floor-zero.jpg')"></canvas>
        </div>
        @include('partials.legend')

    </div>

@endsection

@section('scripts')


    @include('admin/nodes/scriptadd')

@endsection