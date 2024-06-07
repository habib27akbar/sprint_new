 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
      <img src="{{ asset('/assets/images/resources/logo.png') }}" alt="BKN" style="opacity: .8">
      {{-- <span class="brand-text font-weight-light">BKN</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Hi, {{ Auth::user()->name }}</a>
        </div>
      </div>

     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

              
           
          

           @foreach($menu as $key => $value)
                @php
                   $arrow = ''; 
                @endphp
               @if($value->select_menu == 'menu')
                @foreach($menu as $key_ => $value__)
                
                  @if($value__->parent_id == $value->id && $value__->select_menu == 'sub_menu')
                    @php
                      $arrow = '<i class="right fas fa-angle-left"></i>'; 
                    @endphp
                  @endif
                @endforeach
               
                  <li class="nav-item">
                    <a href="{{ url($value->url) }}" class="nav-link">
                      <i class="nav-icon {{ $value->icon }}"></i>
                      <p>
                        {{ $value->nama_menu }}
                        <?=$arrow?>
                      </p>
                    </a>
                    
                  @if(
                    //true
                  $arrow
                  )
                    <ul class="nav nav-treeview">
                  @endif
                      @foreach($menu as $key_ => $value_)
                        @if($value_->select_menu == 'sub_menu' && $value_->parent_id ==  $value->id)
                        
                          <li class="nav-item">
                            <a href="{{ url($value_->url) }}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{ $value_->nama_menu }}</p>
                            </a>
                          </li>
                      
                        @endif
                      @endforeach
                    @if(
                      //true
                    $arrow
                    )
                    </ul>
                    @endif
                  </li>
                @endif
           @endforeach
           

          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>