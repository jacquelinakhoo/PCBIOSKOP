@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Add Schedule</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Schedule Form</h5>

              <form action="/admin/schedules/add" method="post">
                @csrf
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Movie</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="MovieID" required>
                        <option value="">-- Select Movie --</option>
                        <?php foreach($movies as $m) { ?>
                            <option value="<?= $m->MovieID ?>"><?= $m->Title ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Studio</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="StudioID" required>
                        <option value="">-- Select Studio --</option>
                        <?php foreach($studios as $st) { ?>
                            <option value="<?= $st->StudioID ?>"><?= $st->StudioName ?> (<?= $st->TotalSeats ?> Seats)</option>
                        <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Show Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="ShowDate" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Show Time</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control" name="ShowTime" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Price (Rp)</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="Price" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Save Schedule</button>
                    <a href="/admin/schedules" class="btn btn-secondary">Cancel</a>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>
@endsection