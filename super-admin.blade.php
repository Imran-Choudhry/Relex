{{-- resources/views/dashboard/super-admin.blade.php --}}
@extends('layouts.app')

@section('title', 'Super Admin Dashboard')

@section('sidebar')
<nav class="nav flex-column">
    <a class="nav-link active" href="{{ route('super_admin.dashboard') }}">
        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
    </a>
    <a class="nav-link" href="{{ route('users.manage', ['role' => 'manager']) }}">
        <i class="fas fa-users-cog me-2"></i> Manage Managers
    </a>
    <a class="nav-link" href="{{ route('system.config') }}">
        <i class="fas fa-cog me-2"></i> System Configuration
    </a>
    <a class="nav-link" href="{{ route('reports.financial') }}">
        <i class="fas fa-chart-line me-2"></i> Financial Reports
    </a>
    <a class="nav-link" href="{{ route('audit.logs') }}">
        <i class="fas fa-clipboard-list me-2"></i> Audit Logs
    </a>
</nav>
@endsection

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">System Overview</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Managers</h6>
                        <h3 class="mb-0">{{ $stats['total_managers'] }}</h3>
                    </div>
                    <div class="bg-primary text-white rounded-circle p-3">
                        <i class="fas fa-user-tie fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Providers</h6>
                        <h3 class="mb-0">{{ $stats['total_providers'] }}</h3>
                    </div>
                    <div class="bg-success text-white rounded-circle p-3">
                        <i class="fas fa-hands-helping fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Clients</h6>
                        <h3 class="mb-0">{{ $stats['total_clients'] }}</h3>
                    </div>
                    <div class="bg-info text-white rounded-circle p-3">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stat-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Platform Balance</h6>
                        <h3 class="mb-0">${{ number_format($stats['total_revenue'], 2) }}</h3>
                    </div>
                    <div class="bg-warning text-white rounded-circle p-3">
                        <i class="fas fa-wallet fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">System Alerts</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <small class="text-muted">No alerts at this time</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-6">
                        <a href="{{ route('users.create', ['role' => 'manager']) }}" 
                           class="btn btn-outline-primary w-100">
                            <i class="fas fa-plus me-1"></i> Add Manager
                        </a>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-outline-secondary w-100">
                            <i class="fas fa-file-export me-1"></i> Export Data
                        </button>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('system.config') }}" 
                           class="btn btn-outline-info w-100">
                            <i class="fas fa-cog me-1"></i> Configuration
                        </a>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-outline-success w-100">
                            <i class="fas fa-sync me-1"></i> Run Backup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
