@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>My Tickets</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard/<?= strtolower(session('Role')) ?>">Home</a></li>
          <li class="breadcrumb-item active">My Tickets</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Order History</h5>

              <?php if(count($orders) == 0) { ?>
                  <div class="alert alert-info text-center">
                      You haven't booked any tickets yet. <br><br>
                      <a href="/dashboard/<?= strtolower(session('Role')) ?>" class="btn btn-primary">Browse Movies</a>
                  </div>
              <?php } else { ?>
              
              <div class="table-responsive">
                <table class="table table-striped align-middle">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Movie</th>
                      <th>Date & Time</th>
                      <th>Total Price</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach($orders as $o) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/img/'.$o->Poster) }}" width="50" class="rounded me-2" alt="Poster">
                                <strong><?= $o->Title ?></strong>
                            </div>
                        </td>
                        <td><?= $o->ShowDate ?> <br> <small class="text-muted"><?= $o->ShowTime ?></small></td>
                        <td>Rp <?= number_format($o->TotalPrice, 0, ',', '.') ?></td>
                        <td>
                            <?php if($o->OrderStatus == 'Paid') { ?>
                                <span class="badge bg-success">Paid</span>
                            <?php } else if($o->OrderStatus == 'Pending') { ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php } else { ?>
                                <span class="badge bg-danger">Cancelled</span>
                            <?php } ?>
                        </td>
                        <td>
                            <!-- We still pass the OrderID in the URL so the system knows which ticket to load, but we don't display it to the user -->
                            <a href="/movie/ticket/<?= $o->OrderID ?>" class="btn btn-sm btn-primary">View Ticket</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              
              <?php } ?>

            </div>
          </div>
        </div>
      </div>
    </section>
@endsection