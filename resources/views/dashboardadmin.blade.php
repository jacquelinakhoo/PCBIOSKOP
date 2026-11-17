@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard/admin">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Welcome Card -->
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Welcome back, <?= session('Username') ?>!</h5>
              <p>This is your Admin control panel. Use the sidebar to manage Movies, Studios, and Schedules.</p>
            </div>
          </div>
        </div>

        <!-- Quick Stats (Static for now) -->
        <div class="col-xxl-4 col-md-6">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Total Movies</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-film"></i>
                </div>
                <div class="ps-3">
                  <h6>5</h6> <!-- You can replace this with PHP count later -->
                  <span class="text-success small pt-1 fw-bold">Active</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xxl-4 col-md-6">
          <div class="card info-card revenue-card">
            <div class="card-body">
              <h5 class="card-title">Tickets Sold</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-ticket-perforated"></i>
                </div>
                <div class="ps-3">
                  <h6>12</h6>
                  <span class="text-success small pt-1 fw-bold">This week</span>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>
@endsection
