@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Schedule Data</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Schedules</h5>
              
              <?php if(session('success')) { ?>
                  <div class="alert alert-success"><?= session('success') ?></div>
              <?php } ?>

              <a href="/admin/schedules/add" class="btn btn-primary mb-3">Add Schedule</a>

              <div class="table-responsive">
                <table class="table table-striped align-middle">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Movie Title</th>
                      <th>Studio</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; foreach($schedules as $s) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $s->Title ?></td>
                        <td><?= $s->StudioName ?></td>
                        <td><?= $s->ShowDate ?></td>
                        <td><?= $s->ShowTime ?></td>
                        <td>Rp <?= number_format($s->Price, 0, ',', '.') ?></td>
                        <td>
                          <a href="/admin/schedules/edit/<?= $s->ScheduleID ?>" class="btn btn-sm btn-warning">Edit</a>
                          <a href="/admin/schedules/delete/<?= $s->ScheduleID ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
@endsection