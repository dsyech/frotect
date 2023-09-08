@verbatim
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="resources/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Frotect</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <div class="search-form d-flex align-items-center">
        <input type="date" name="start_date" style="margin-right:3px" ng-model="start_date">
        <input type="date" name="end_date" ng-model="end_date">
        <button type="submit" ng-click="search()"><i class="bi bi-search"></i></button>
      </div>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">1</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 1 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">Telkom Reg I</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Telkom Reg I</h6>
              <span>Regional Network Operation</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" ng-class="{ 'collapsed': isActivePath('http://10.16.110.100/frotect/') }" href="http://10.16.110.100/frotect/">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" ng-class="{ 'collapsed': isActivePath('http://10.16.110.100/frotect/plan') }" href="http://10.16.110.100/frotect/plan">
          <i class="bi bi-cone-striped"></i>
          <span>Patroli Wasman</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" ng-class="{ 'active': isActivePath('http://10.16.110.100/frotect/cut') }" href="http://10.16.110.100/frotect/cut">
          <i class="bi bi-x-circle"></i>
          <span>Data Gangguan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" ng-class="{ 'active': isActivePath('http://10.16.110.100/frotect/slh') }" href="http://10.16.110.100/frotect/slh">
          <i class="bi bi-graph-up-arrow"></i>
          <span>Span Loss High</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" ng-class="{ 'active': isActivePath('http://10.16.110.100/frotect/technical') }" href="http://10.16.110.100/frotect/technical">
          <i class="bi bi-file-earmark"></i>
          <span>Data Teknis</span>
        </a>
      </li>
    </ul>

  </aside><!-- End Sidebar-->
  @endverbatim