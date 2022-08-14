 <!-- Sidebar -->
 <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon">
             <i class="fas fa-chalkboard-teacher"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Papan Digital</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item {{request()->is('/') ? 'active' : ''}}">
         <a class="nav-link" href="{{route('home')}}">
             <i class="fas fa-fw fa-home"></i>
             <span>Home</span></a>
     </li>

     <hr class="sidebar-divider">


     <div class="sidebar-heading">
         management
     </div>
     <li class="nav-item {{request()->is('items') || request()->is('items/*') ? 'active' : ''}}">
         <a class="nav-link" href="{{route('items.index')}}">
             <i class="fas fa-fw fa-table"></i>
             <span>Items</span></a>
     </li>
     <li class="nav-item {{request()->is('sheets') || request()->is('sheets/*') ? 'active' : ''}}">
         <a class="nav-link" href="{{route('sheets.index')}}">
             <i class="fas fa-fw fa-list"></i>
             <span>Sheets</span></a>
     </li>
     <li class="nav-item {{request()->is('presentation') || request()->is('presentation/*') ? 'active' : ''}}">
         <a class="nav-link" href="{{route('presentation.index')}}">
             <i class="fas fa-fw fa-tv"></i>
             <span>Presentation</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->