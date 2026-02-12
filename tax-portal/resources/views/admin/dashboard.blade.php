@extends('layouts.admin.main')
@section('title', 'Admin Dashboard')

@section('content')

<div class="app-content">
    <div class="container-fluid pt-3">

        <!-- PAGE TITLE -->
        <div class="row mb-3">
            <div class="col-12">
                <h4 class="fw-bold text-dark">
                    <i class="bi bi-speedometer2 me-2 text-secondary"></i>
                    Admin Dashboard
                </h4>
                <p class="text-muted mb-0">ZEO Appointment Tracking & Management System</p>
            </div>
        </div>

        <!-- STATUS CARDS -->
        <div class="row">

            <!-- Active -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-white text-dark border shadow-sm">
                    <div class="inner">
                        <h3>45</h3>
                        <p>Active</p>
                    </div>
                    <svg class="small-box-icon text-secondary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2a10 10 0 100 20 10 10 0 000-20z"/>
                    </svg>
                    <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>

            <!-- Pending -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-white text-dark border shadow-sm">
                    <div class="inner">
                        <h3>30</h3>
                        <p>Pending</p>
                    </div>
                    <svg class="small-box-icon text-secondary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6v6l4 2"/>
                    </svg>
                    <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>

            <!-- Approved -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-white text-dark border shadow-sm">
                    <div class="inner">
                        <h3>60</h3>
                        <p>Approved</p>
                    </div>
                    <svg class="small-box-icon text-secondary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                    <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>

            <!-- Completed -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-white text-dark border shadow-sm">
                    <div class="inner">
                        <h3>150</h3>
                        <p>Completed</p>
                    </div>
                    <svg class="small-box-icon text-secondary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 16.5l-4-4 1.5-1.5 2.5 2.5 5.5-5.5 1.5 1.5z"/>
                    </svg>
                    <a href="#" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover">
                        More info <i class="bi bi-link-45deg"></i>
                    </a>
                </div>
            </div>

        </div>

        <!-- SECOND ROW -->
        <div class="row mt-4">

            <!-- TODAY'S APPOINTMENTS -->
            <div class="col-md-8">
                <div class="card border shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-calendar-event me-2 text-secondary"></i>
                            Today’s Appointments
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Time</th>
                                    <th>Department</th>
                                    <th>Requester</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>10:00 AM</td>
                                    <td>Planning</td>
                                    <td>Principal</td>
                                    <td><span class="badge bg-secondary">Active</span></td>
                                </tr>
                                <tr>
                                    <td>11:30 AM</td>
                                    <td>ZED</td>
                                    <td>Teacher</td>
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ESCALATIONS -->
            <div class="col-md-4">
                <div class="card border shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-exclamation-circle me-2 text-secondary"></i>
                            Escalations
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">• 3 requests pending over 7 days</li>
                            <li class="mb-2">• 2 special approvals needed</li>
                            <li>• 1 urgent ZED request</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
