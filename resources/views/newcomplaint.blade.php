@extends('layouts.app')
@section('content')
<div class="container mx-auto">
    <x-complaint-form :complaintTypes="$complaintTypes" :branchData="$branchData" />
</div>
@endsection