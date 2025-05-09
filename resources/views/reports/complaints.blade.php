@extends('layouts.app')
@section('content')
<!--Table with Reference number policy number current holders name status view more button-->

<x-report-all-complaints-table :complaints="$complaints" :latestLogs="$latestLogs" :hrData="$hrData" />


@endsection