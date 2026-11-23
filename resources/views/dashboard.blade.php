@extends('template')

@section('content')
    <div class="pagetitle">
      <h1>Now Showing</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Movies</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        
        <!-- LOOP THROUGH MOVIES HERE -->
        <?php if(empty($movies)) { ?>
            <div class="col-12">
                <div class="alert alert-info">No movies are currently showing.</div>
            </div>
        <?php } ?>

        <?php foreach($movies as $m) { ?>
          <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
              
              <!-- Movie Poster -->
            <img src="{{ asset('assets/img/'.$m->Poster) }}" class="card-img-top" alt="<?= $m->Title ?>" style="height: 500px; object-fit: contain; background-color: #f6f9ff;">

              <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-1"><?= $m->Title ?></h5>
                <p class="text-muted small mb-2">
                    <i class="bi bi-clock"></i> <?= $m->Duration ?> Mins
                </p>
                <p class="card-text text-truncate small"><?= $m->Synopsis ?></p>
                
                <!-- Push button to the bottom -->
                <div class="mt-auto pt-2">
                    <a href="/movie/detail/<?= $m->MovieID ?>" class="btn btn-primary w-100">
                        <i class="bi bi-ticket-perforated"></i> Buy Ticket
                    </a>
                </div>
              </div>
              
            </div>
          </div>
        <?php } ?>

      </div>
    </section>
@endsection