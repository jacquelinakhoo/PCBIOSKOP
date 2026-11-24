@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Movie Details</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard/admin">Home</a></li>
          <li class="breadcrumb-item active"><?= $movie->Title ?></li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        
        <!-- LEFT SIDE: Movie Info -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="{{ asset('assets/img/'.$movie->Poster) }}" alt="Poster" class="rounded" style="width: 100%; max-width: 250px; margin-bottom: 15px;">
              
              <h4><?= $movie->Title ?></h4>
              <div class="d-flex gap-2 mb-3">
                  <span class="badge bg-secondary"><?= $movie->Duration ?> Mins</span>
                  <span class="badge bg-success"><?= $movie->MovieStatus ?></span>
              </div>

              <h5 class="card-title w-100 text-start border-bottom pb-2">Synopsis</h5>
              <p class="text-start small"><?= $movie->Synopsis ?></p>
            </div>
          </div>
        </div>

        <!-- RIGHT SIDE: Date & Schedules -->
        <div class="col-lg-8">
          
          <!-- Date Selector -->
          <div class="card mb-3">
            <div class="card-body pt-3">
              <h5 class="card-title">Select Date</h5>
              
              <div class="d-flex flex-wrap gap-2">
                <?php if(count($dates) == 0) { ?>
                    <span class="text-muted">No schedules available yet.</span>
                <?php } ?>

                <?php foreach($dates as $d) { ?>
                    <?php 
                        // Format date to look nicer (e.g., 2026-11-24 to 24 Nov)
                        $dateObj = date_create($d->ShowDate);
                        $formattedDate = date_format($dateObj, 'd M');
                        
                        // Check if this is the active date
                        $isActive = ($selectedDate == $d->ShowDate);
                        $btnClass = $isActive ? 'btn-primary' : 'btn-outline-primary';
                    ?>
                    
                    <!-- Using an <a> tag instead of a button so no JS is needed -->
                    <a href="/movie/detail/<?= $movie->MovieID ?>?date=<?= $d->ShowDate ?>" 
                       class="btn <?= $btnClass ?> flex-fill">
                       <?= $formattedDate ?>
                    </a>
                <?php } ?>
              </div>

            </div>
          </div>

          <!-- Schedules List -->
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Available Schedules</h5>

              <?php if(count($schedules) == 0) { ?>
                  <div class="alert alert-warning">No schedules available for this date.</div>
              <?php } ?>

              <!-- List Group for Schedules (Bootstrap style) -->
              <div class="list-group">
                <?php foreach($schedules as $s) { ?>
                  <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h6 class="mb-1 fw-bold"><?= $s->StudioName ?></h6>
                        <small class="text-muted">
                            <i class="bi bi-clock"></i> <?= date('H:i', strtotime($s->ShowTime)) ?> WIB
                        </small>
                    </div>
                    <div class="text-end">
                        <p class="mb-1 fw-bold text-primary">Rp <?= number_format($s->Price, 0, ',', '.') ?></p>
                        <a href="/movie/select-seats/<?= $s->ScheduleID ?>" class="btn btn-sm btn-primary">Select Seats</a>
                    </div>
                  </div>
                <?php } ?>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection