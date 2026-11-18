@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Edit Schedule</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Schedule Form</h5>

              <form action="/admin/schedules/edit/<?= $schedule->ScheduleID ?>" method="post">
                @csrf
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Movie</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="MovieID" required>
                        <?php foreach($movies as $m) { ?>
                            <option value="<?= $m->MovieID ?>" <?php if($schedule->MovieID == $m->MovieID) echo 'selected'; ?>>
                                <?= $m->Title ?>
                            </option>
                        <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Studio</label>
                  <div class="col-sm-10">
                    <select class="form-select" disabled>
                        <?php foreach($studios as $st) { ?>
                            <option value="<?= $st->StudioID ?>" <?php if($schedule->StudioID == $st->StudioID) echo 'selected'; ?>>
                                <?= $st->StudioName ?>
                            </option>
                        <?php } ?>
                    </select>
                    <small class="text-danger">Studio cannot be changed once seats are generated.</small>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Show Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="ShowDate" value="<?= $schedule->ShowDate ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Show Time</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control" name="ShowTime" value="<?= $schedule->ShowTime ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Price (Rp)</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="Price" value="<?= $schedule->Price ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Update Schedule</button>
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