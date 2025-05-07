@extends('layouts.app')

@section('content')


@if(count($complaints) > 0)
<x-completed-table :complaints="$complaints" />
@else

<div class="p-4 bg-yellow-100 text-yellow-700 rounded-md">
    <p class="font-medium"><span><i class="bx bx-info-circle"></i></span> There are no complaints left.</p>
</div>

@endif


@endsection