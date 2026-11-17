@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Edit Movie</h1>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Movie Form</h5>

              <form action="/admin/movies/edit/<?= $movie->MovieID ?>" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                  <label for="Title" class="col-sm-2 col-form-label">Title</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="Title" value="<?= $movie->Title ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Duration" class="col-sm-2 col-form-label">Duration (Minutes)</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="Duration" value="<?= $movie->Duration ?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Synopsis" class="col-sm-2 col-form-label">Synopsis</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="Synopsis" style="height: 100px" required><?= $movie->Synopsis ?></textarea>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="MovieStatus" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="MovieStatus" required>
                        <option value="Now Showing" <?php if($movie->MovieStatus == 'Now Showing') echo 'selected'; ?>>Now Showing</option>
                        <option value="Coming Soon" <?php if($movie->MovieStatus == 'Coming Soon') echo 'selected'; ?>>Coming Soon</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="Poster" class="col-sm-2 col-form-label">Poster Image</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="Poster">
                    <small class="text-muted">Leave blank if you don't want to change the poster.</small>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Update Movie</button>
                    <a href="/admin/movies" class="btn btn-secondary">Cancel</a>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </section>
@endsection