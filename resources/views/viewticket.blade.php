@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Your Ticket</h1>
    </div>

    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body text-center pt-4">
              <?php if(session('success')) { ?>
                  <div class="alert alert-success"><?= session('success') ?></div>
              <?php } ?>

              <h4 class="text-success mb-3">Booking Successful!</h4>
              
              <h5><?= $movie->Title ?></h5>
              <p class="text-muted"><?= $schedule->ShowDate ?> | <?= $schedule->ShowTime ?></p>
              
              <hr>
              
              <div class="row text-start mb-3">
                  <div class="col-6">
                      <!-- HIDING THE DB ID: Using the TicketCode as the Order Reference -->
                      <strong>Order Ref:</strong> <?= $order->TicketCode ?><br>
                      <strong>Status:</strong> <span class="badge bg-warning text-dark"><?= $order->OrderStatus ?></span>
                  </div>
                  <div class="col-6 text-end">
                      <strong>Total Price:</strong><br>
                      <span class="fs-5 text-primary">Rp <?= number_format($order->TotalPrice, 0, ',', '.') ?></span>
                  </div>
              </div>

              <div class="mb-4">
                  <strong>Seats:</strong><br>
                  <!-- Using $no here is fine because it's just numbering the seats visually (1, 2, 3) instead of showing SeatsID -->
                  <?php $no = 1; foreach($details as $d) { ?>
                      <span class="badge bg-primary fs-6 mb-1">Seat <?= $d->SeatNumber ?></span>
                  <?php } ?>
              </div>

              <hr>
              
              <div class="bg-light p-3 rounded mb-3">
                  <p class="mb-1 text-muted small">Show this code to the Staff at the cinema:</p>
                  <h3 class="font-monospace fw-bold"><?= $order->TicketCode ?></h3>
              </div>

              <a href="/dashboard/<?= strtolower(session('Role')) ?>" class="btn btn-secondary w-100 mt-2">Back to Dashboard</a>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection