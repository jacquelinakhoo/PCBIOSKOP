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

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Movie ID</th>
                    <th>Title</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Poster</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($movies as $m) { ?>
                    <tr>
                      <td><?= $m->MovieID ?></td>
                      <td><?= $m->Title ?></td>
                      <td><?= $m->Duration ?> Mins</td>
                      <td><?= $m->MovieStatus ?></td>
                      <td><img src="{{ asset('assets/img/'.$m->Poster) }}" width="80" alt="Poster"></td>
                      <td>
                        <a href="/admin/movies/edit/<?= $m->MovieID ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="/admin/movies/delete/<?= $m->MovieID ?>" class="btn btn-sm btn-danger">Delete</a>
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