@extends('template')

@section('content')
    <div class="pagetitle">
      <h1><?= $movie->Title ?></h1>
    </div>

    <section class="section">
      <div class="row">
        <!-- Movie Info -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body text-center pt-4">
              <img src="{{ asset('assets/img/'.$movie->Poster) }}" class="img-fluid rounded mb-3" alt="Poster">
              <h5><?= $movie->Title ?></h5>
              <p class="text-muted"><i class="bi bi-clock"></i> <?= $movie->Duration ?> Mins</p>
              <p class="small text-start"><?= $movie->Synopsis ?></p>
            </div>
          </div>
        </div>

        <!-- Schedule List -->
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Available Schedules</h5>
              
              <div class="table-responsive">
                <table class="table table-hover align-middle">
                  <thead>
                    <tr>
                      <th>Studio</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(count($schedules) == 0) { ?>
                        <tr><td colspan="5" class="text-center">No schedules available for this movie yet.</td></tr>
                    <?php } ?>

                    <?php foreach($schedules as $s) { ?>
                      <tr>
                        <td><?= $s->StudioName ?></td>
                        <td><?= $s->ShowDate ?></td>
                        <td><?= $s->ShowTime ?></td>
                        <td>Rp <?= number_format($s->Price, 0, ',', '.') ?></td>
                        <td>
                          <a href="/movie/select-seats/<?= $s->ScheduleID ?>" class="btn btn-sm btn-primary">Select Seats</a>
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