@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Studio Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard/admin">Home</a></li>
          <li class="breadcrumb-item active">Studios</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Studios</h5>
              
              <?php if(session('success')) { ?>
                  <div class="alert alert-success"><?= session('success') ?></div>
              <?php } ?>

              <a href="/admin/studios/add" class="btn btn-primary mb-3">Add Studio</a>

              <table class="table table-striped align-middle">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Studio Name</th>
                    <th>Total Seats</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach($studios as $s) { ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $s->StudioName ?></td>
                      <td><?= $s->TotalSeats ?></td>
                      <td>
                        <a href="/admin/studios/edit/<?= $s->StudioID ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="/admin/studios/delete/<?= $s->StudioID ?>" class="btn btn-sm btn-danger">Delete</a>
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