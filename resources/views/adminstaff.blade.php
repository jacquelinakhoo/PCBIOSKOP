@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Staff Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard/admin">Home</a></li>
          <li class="breadcrumb-item active">Staff</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Staff</h5>
              
              <?php if(session('success')) { ?>
                  <div class="alert alert-success"><?= session('success') ?></div>
              <?php } ?>

              <a href="/admin/staff/add" class="btn btn-primary mb-3">Add Staff</a>

              <table class="table table-striped align-middle">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach($staffs as $s) { ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $s->name ?></td>
                      <td><?= $s->email ?></td>
                      <td><span class="badge bg-success"><?= $s->Role ?></span></td>
                      <td>
                        <a href="/admin/staff/delete/<?= $s->id ?>" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </section>
@endsection