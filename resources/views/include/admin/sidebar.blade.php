 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <center>
        <img src="{{ asset('img/logo-391-kemenperin-ri.png') }}" alt="SPRINT" style="width:50%;">
      </center>
      
     
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('img/default.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Hi, {{ Auth::user()->nama_pengguna }}</a>
        </div>
      </div>

     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('data_klien') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Klien</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('profil-pelanggan.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil Pelanggan
                
              </p>
            </a>
          </li>
           
          

         
           

          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>