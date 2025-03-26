<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home (Guest route)
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Dashboard (Authenticated)
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// View Complaints (Authenticated)
Breadcrumbs::for('viewcomplaint', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('View Complaints', route('viewcomplaint'));
});

// View Specific Complaint (Authenticated)
Breadcrumbs::for('viewcomplaintId', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('viewcomplaint');
    $trail->push("Complaint #$id", route('viewcomplaintId', $id));
});

// Search Complaints (Authenticated)
Breadcrumbs::for('search.complaints', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Search Complaints', route('search.complaints'));
});

// Users (Role Assignment, Authenticated)
Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Users', route('users'));
});

// Roles (User Access, Authenticated)
Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Roles', route('roles'));
});

// Employee Profile (Authenticated)
Breadcrumbs::for('employee', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Employee Profile', route('employee'));
});

// My Jobs (Authenticated)
Breadcrumbs::for('my-jobs', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('My Jobs', route('my-jobs'));
});

// Departments (Authenticated)
Breadcrumbs::for('departments', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Departments', route('departments'));
});

// Lodge New Complaint (Authenticated)
Breadcrumbs::for('newcomplaint', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Lodge New Complaint', route('newcomplaint'));
});

// Profile Edit (Authenticated)
Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Edit Profile', route('profile.edit'));
});

// Test Employee (Outside Auth, for dev)
Breadcrumbs::for('test-employee', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Test Employee', route('test-employee'));
});

// User Search (Outside Auth)
Breadcrumbs::for('user.search', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Search Users', route('user.search'));
});

// Complaint Status Dropdown (Outside Auth)
Breadcrumbs::for('complaintstatus.typeview', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Complaint Status', route('complaintstatus.typeview'));
});

// Employee Search (Outside Auth)
Breadcrumbs::for('employee.search', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Employee Search', route('employee.search'));
});

// New auth.php breadcrumbs
// Guest Routes
Breadcrumbs::for('register', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Register', route('register'));
});

Breadcrumbs::for('login', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Login', route('login'));
});

Breadcrumbs::for('password.request', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Forgot Password', route('password.request'));
});

Breadcrumbs::for('password.reset', function (BreadcrumbTrail $trail, $token) {
    $trail->parent('password.request');
    $trail->push('Reset Password', route('password.reset', $token));
});

// Authenticated Routes
Breadcrumbs::for('verification.notice', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Verify Email', route('verification.notice'));
});

Breadcrumbs::for('verification.verify', function (BreadcrumbTrail $trail, $id, $hash) {
    $trail->parent('verification.notice');
    $trail->push('Email Verification', route('verification.verify', ['id' => $id, 'hash' => $hash]));
});

Breadcrumbs::for('password.confirm', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Confirm Password', route('password.confirm'));
});

Breadcrumbs::for('password.update', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Update Password', route('password.update'));
});
// New admin-auth.php breadcrumbs
// Guest Routes (Admin)
Breadcrumbs::for('admin.register', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Admin Register', route('admin.register'));
});

Breadcrumbs::for('admin.login', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Admin Login', route('admin.login'));
});

// Authenticated Routes (Admin)
Breadcrumbs::for('admin.dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Admin Dashboard', route('admin.dashboard'));
});
