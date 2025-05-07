<!-- resources/views/profile/show.blade.php -->
@extends('layouts.app')
@section('content')

<div class="flex flex-col">
    <div class="bg-gray-100 min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <!-- Profile Header -->
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                    <div class="flex items-center space-x-6">
                        <!-- Profile Avatar -->
                        <div class="flex-shrink-0">
                            <img
                                class="h-24 w-24 rounded-full object-cover border-4 border-white shadow-lg"
                                src="{{ $user->profile_photo ? asset('storage/' . $user->profile_photo) : asset('images/users/avatar-1.jpg') }}"
                                alt="{{ $user->name }}'s profile">
                        </div>

                        <!-- Name and Basic Info -->
                        <div>
                            <h1 class="text-2xl font-bold text-white">{{ $user->name }}</h1>
                            <p class="text-indigo-100">{{ $user->role }} | {{ $user->department ?? 'No Department' }}</p>
                        </div>
                    </div>
                </div>

                <!-- User Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <!-- Personal Information Card -->
                    <div class="bg-gray-50 rounded-lg p-5 shadow-md">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Personal Information</h2>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $user->emp_id }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $user->email }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Details Card -->
                    <div class="bg-gray-50 rounded-lg p-5 shadow-md">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Work Details</h2>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $user->role }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <span class="text-gray-700">{{ $user->department ?? 'Not Assigned' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Complaints Section -->
                <div class="p-6 bg-gray-100 border-t">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Job History</h2>

                    @if(isset($complaints) && count($complaints) > 0)
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach ($complaints as $complaint)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $complaint->name }}</h3>
                                <div class="space-y-2 text-gray-600">
                                    <p><strong>Complaint ID:</strong> {{ $complaint->id }}</p>
                                    <p><strong>Policy Number:</strong> {{ $complaint->policy_number }}</p>
                                    <p class="line-clamp-2">
                                        {{ Str::limit($complaint->complaint_detail, 100, '...') }}
                                    </p>
                                </div>
                                <button
                                    type="button"
                                    class="mt-4 w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition-colors"
                                    data-bs-toggle="modal"
                                    data-bs-target="#transaction-detailModal"
                                    data-complaint='@json($complaint)'>
                                    View Details
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="bg-white rounded-lg shadow-md p-6 text-center">
                        <p class="text-gray-500">No complaints have been assigned.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
<x-complaint-assign-modal :departmentNames="$departmentNames" :divisionNames="$divisionNames" />
@endsection