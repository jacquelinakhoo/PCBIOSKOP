@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Select Seats</h1>
      <h6 class="text-muted"><?= $movie->Title ?> - <?= $schedule->ShowDate ?> at <?= $schedule->ShowTime ?></h6>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Screen Area</h5>
              
              <!-- Screen visual -->
              <div class="text-center mb-4">
                <div class="bg-secondary text-white py-2 rounded mx-auto" style="max-width: 600px;">
                    SCREEN THIS WAY
                </div>
              </div>

              <form action="/movie/book" method="post">
                @csrf
                <input type="hidden" name="ScheduleID" value="<?= $schedule->ScheduleID ?>">

                <!-- Seat Grid using Bootstrap Flexbox -->
                <div class="d-flex flex-wrap justify-content-center gap-2 mb-4" style="max-width: 800px; margin: 0 auto;">
                  
                  <?php foreach($seats as $seat) { ?>
                      <?php if($seat->SeatStatus == 'Booked') { ?>
                          <!-- Booked Seat (Disabled) -->
                          <div class="btn btn-danger disabled" style="width: 50px;">
                              <?= $seat->SeatNumber ?>
                          </div>
                      <?php } else { ?>
                          <!-- Available Seat (Checkbox) -->
                          <input type="checkbox" class="btn-check" name="selected_seats[]" id="seat_<?= $seat->SeatsID ?>" value="<?= $seat->SeatsID ?>" autocomplete="off">
                          <label class="btn btn-outline-success" for="seat_<?= $seat->SeatsID ?>" style="width: 50px;">
                              <?= $seat->SeatNumber ?>
                          </label>
                      <?php } ?>
                  <?php } ?>

                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">Confirm Booking</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>
@endsection