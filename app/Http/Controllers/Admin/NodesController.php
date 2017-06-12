<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Node;
use Illuminate\Http\Request;
use Session;

class NodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $nodes = Node::where('uuid', 'LIKE', "%$keyword%")
				->orWhere('content', 'LIKE', "%$keyword%")
				->orWhere('x', 'LIKE', "%$keyword%")
				->orWhere('y', 'LIKE', "%$keyword%")
				->orWhere('category', 'LIKE', "%$keyword%")
				->orWhere('floor', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $nodes = Node::paginate($perPage);
        }

        return view('admin.nodes.index', compact('nodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.nodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'uuid'=>'required|size:36|unique:nodes',
            'content'=>'required|min:1',
            'x'=>'required|numeric|min:0|max:840',
            'y'=>'required|numeric||min:0|max:292',
            'category'=>'required',
            'floor'=>'required',
        ]);


        $requestData = $request->all();
        
        Node::create($requestData);

        Session::flash('flash_message', 'Node added!');

        return redirect('admin/nodes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $node = Node::findOrFail($id);

        return view('admin.nodes.show', compact('node'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $node = Node::findOrFail($id);

        return view('admin.nodes.edit', compact('node'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $this->validate($request,[
            'uuid'=>'required|size:36',
            'content'=>'required|min:1',
            'x'=>'required|numeric|min:0|max:840',
            'y'=>'required|numeric||min:0|max:292',
            'category'=>'required',
            'floor'=>'required',
        ]);

        $requestData = $request->all();
        
        $node = Node::findOrFail($id);
        $node->update($requestData);

        Session::flash('flash_message', 'Node updated!');

        return redirect('admin/nodes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Node::destroy($id);

        Session::flash('flash_message', 'Node deleted!');

        return redirect('admin/nodes');
    }
}
