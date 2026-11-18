@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Movie Data</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard/admin">Home</a></li>
          <li class="breadcrumb-item active">Movies</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">List of Movies</h5>
              
              <?php if(session('success')) { ?>
                  <div class="alert alert-success"><?= session('success') ?></div>
              <?php } ?>

              <a href="/admin/movies/add" class="btn btn-primary mb-3">Add Movie</a>

              <div class="table-responsive">
                <table class="table table-striped align-middle">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Title</th>
                      <th>Synopsis</th>
                      <th>Duration</th>
                      <th>Status</th>
                      <th>Poster</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Added the $no = 1 counter here -->
                    <?php $no = 1; foreach($movies as $m) { ?>
                      <tr>
                        <td><?= $no++ ?></td> <!-- Prints 1, 2, 3... -->
                        <td><?= $m->Title ?></td>
                        <td style="min-width: 200px;"><?= $m->Synopsis ?></td>
                        <td><?= $m->Duration ?> Mins</td>
                        <td><?= $m->MovieStatus ?></td>
                        <td>
                            <!-- Changed width from 80 to 120 to make it wider -->
                            <img src="{{ asset('assets/img/'.$m->Poster) }}" width="120" class="img-fluid rounded" alt="Poster">
                        </td>
                        <td>
                          <a href="/admin/movies/edit/<?= $m->MovieID ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                          <a href="/admin/movies/delete/<?= $m->MovieID ?>" class="btn btn-sm btn-danger mb-1">Delete</a>
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