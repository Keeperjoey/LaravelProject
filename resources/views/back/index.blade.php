@extends('back.template')

@section('main')

    @include('back.partials.entete', [
        'title' => trans('back/admin.dashboard'),
        'icon' => 'dashboard',
        'fil' => trans('back/admin.dashboard')
    ])
    
    <div class="row">

    </div>

@endsection


