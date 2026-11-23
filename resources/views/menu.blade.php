<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

      <!-- DASHBOARD -->
      <li class="nav-item">
        <?php if(session('Role') == 'admin') { ?>
            <a class="nav-link" href="/dashboard/admin">
        <?php } else if(session('Role') == 'staff') { ?>
            <a class="nav-link" href="/dashboard/staff">
        <?php } else { ?>
            <a class="nav-link" href="/dashboard/customer">
        <?php } ?>
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>

            <!-- ADMIN ONLY MENU -->
      <?php if(session('Role') == 'admin') { ?>
      <li class="nav-heading">Admin Master</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/movies">
          <i class="bi bi-film"></i>
          <span>Data Movies</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/studios">
          <i class="bi bi-door-open"></i>
          <span>Data Studios</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/schedules">
          <i class="bi bi-calendar-event"></i>
          <span>Data Schedules</span>
        </a>
      </li>
      <!-- NEW MENU FOR STAFF -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="/admin/staff">
          <i class="bi bi-person-badge"></i>
          <span>Data Staff</span>
        </a>
      </li>
      <?php } ?>

      <!-- STAFF ONLY MENU -->
      <?php if(session('Role') == 'staff') { ?>
      <li class="nav-heading">Staff Menu</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/staff/orders">
          <i class="bi bi-ticket-perforated"></i>
          <span>Scan & Verify Orders</span>
        </a>
      </li>
      <?php } ?>

      <!-- CUSTOMER ONLY MENU -->
      <?php if(session('Role') == 'customer') { ?>
      <li class="nav-heading">Customer Menu</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/customer/movies">
          <i class="bi bi-camera-reels"></i>
          <span>Now Showing</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/customer/tickets">
          <i class="bi bi-ticket"></i>
          <span>My Tickets</span>
        </a>
      </li>
      <?php } ?>

      <!-- LOGOUT (Everyone) -->
      <li class="nav-heading">Akun</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="/logout">
          <i class="bi bi-box-arrow-right"></i>
          <span>Logout</span>
        </a>
      </li>
    </ul>
</aside>