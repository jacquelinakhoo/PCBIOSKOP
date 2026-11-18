@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Add Studio</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Studio Form</h5>

              <form action="/admin/studios/add" method="post">
                @csrf
                <div class="row mb-3">
                  <label for="StudioName" class="col-sm-2 col-form-label">Studio Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="StudioName" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="TotalSeats" class="col-sm-2 col-form-label">Total Seats</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="TotalSeats" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Save Studio</button>
                    <a href="/admin/studios" class="btn btn-secondary">Cancel</a>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>
@endsection