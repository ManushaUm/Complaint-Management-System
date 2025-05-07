@extends('layouts.app')
@section('content')

<x-vertical-nav-tab :departments="$departments" :divisionsData="$divisionsData" />
@endsection