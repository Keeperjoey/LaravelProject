@extends('back.template')

@section('main')


    <div class="col-md-12">

        <div class="panel-heading">Nodes</div>
        <div class="panel-body">
            <a href="{{ url('/admin/nodes/create') }}" class="btn btn-success btn-sm" title="Add New Node">
                <i class="fa fa-plus" aria-hidden="true"></i> Add New
            </a>

            {!! Form::open(['method' => 'GET', 'url' => '/admin/nodes', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
            </div>
            {!! Form::close() !!}

            <br/>
            <br/>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Uuid</th>
                        <th>Content</th>
                        <th>X</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($nodes as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->uuid }}</td>
                            <td>{{ $item->content }}</td>
                            <td>{{ $item->x }}</td>
                            <td>{{ $item->y }}</td>
                            <td>
                                <a href="{{ url('/admin/nodes/' . $item->id) }}" title="View Node">
                                    <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i>
                                        View
                                    </button>
                                </a>
                                <a href="{{ url('/admin/nodes/' . $item->id . '/edit') }}" title="Edit Node">
                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o"
                                                                              aria-hidden="true"></i> Edit
                                    </button>
                                </a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/nodes', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Node',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>

                                <?php

                                $url = $BASE_URL_API . "/api/sensordata/alive/" . $item->uuid;
                                try {
                                    echo "Up chance: " . file_get_contents($url);
                                } catch (Exception $e) {
                                    echo "Node does not exist or api is down";
                                };
                                ?>


                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $nodes->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>

        </div>
    </div>
    </div>
    </div>

@endsection
