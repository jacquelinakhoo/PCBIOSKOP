@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Add Staff</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Staff Form</h5>

              <form action="/admin/staff/add" method="post">
                @csrf
                <div class="row mb-3">
                  <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="EmailUser" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="EmailUser" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Password" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="Password" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Save Staff</button>
                    <a href="/admin/staff" class="btn btn-secondary">Cancel</a>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>
@endsection