@php
    $setting = App\Models\Setting::orderBy('created_at', 'desc')
        ->select('site', 'image', 'logo', 'favicon', 'description')
        ->first();
@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">

    <a href="/" target="_blank" class="app-brand-link">
      <span class="app-brand-logo demo">
      @if ($setting && $setting->logo)
      <img src="{{ \Storage::url($setting->logo) }}" alt="" class="img-fluid" style="width:150px;" />
      @endif                    
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2"></span>
    </a>
 
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>


  <ul class="menu-inner py-1">

    <!-- Dashboard -->
    <li class="menu-item active">
      <a href="{{ url('/admin')}}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    <!-- Layouts -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Layouts">Categories</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/categories') }}" class="menu-link">
            <div data-i18n="Without menu">Categories</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ url('/categories/create') }}" class="menu-link">
            <div data-i18n="Without navbar">Add Category</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ url('/genres') }}" class="menu-link">
            <div data-i18n="Container">Genres</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ url('/genres/create') }}" class="menu-link">
            <div data-i18n="Fluid">Add Genre</div>
          </a>
        </li>

      </ul>
    </li>
    @if(Auth::user()->role == 2)
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Files</span>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bxs-music"></i>
        <div data-i18n="Account Settings">Music</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/all-music') }}" class="menu-link">
            <div data-i18n="Account">Music <i class='bx bxs-music'></i></div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ url('/all-music/create') }}" class="menu-link">
            <div data-i18n="Notifications">Upload Song</div>
          </a>
        </li>

        <li class="menu-item">
          <a href="{{ url('/beats') }}" class="menu-link">
            <div data-i18n="Account">Beats <i class='bx bxs-music'></i></div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ url('/beats/create') }}" class="menu-link">
            <div data-i18n="Notifications">Upload Beat</div>
          </a>
        </li>

      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
        <div data-i18n="Authentications">Pages</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ route('products') }}" class="menu-link" >
            <div data-i18n="Basic">Pages</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('products.create') }}" class="menu-link" >
            <div data-i18n="Basic">Add Page</div>
          </a>
        </li>

      </ul>
    </li>
    @else
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Files</span>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dock-top"></i>
        <div data-i18n="Account Settings">Music</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/all-music') }}" class="menu-link">
            <div data-i18n="Account">Music</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ url('/all-music/create') }}" class="menu-link">
            <div data-i18n="Notifications">Add Song</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ url('/beats') }}" class="menu-link">
            <div data-i18n="Account">Beats <i class='bx bxs-music'></i></div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ url('/beats/create') }}" class="menu-link">
            <div data-i18n="Notifications">Upload Beat</div>
          </a>
        </li>

        
      </ul>
    </li>
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
        <div data-i18n="Authentications">Pages</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('products') }}" class="menu-link" >
            <div data-i18n="Basic">Pages</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('products.create') }}" class="menu-link" >
            <div data-i18n="Basic">Add Page</div>
          </a>
        </li>

      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
        <div data-i18n="Authentications">SMS</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ route('send-sms-form') }}" class="menu-link" >
            <div data-i18n="Basic">send sms</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ route('send-sms-form2') }}" class="menu-link" >
            <div data-i18n="Basic">send bulk sms</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ url('/data') }}" class="menu-link" >
            <div data-i18n="Basic">SMSs</div>
          </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('users.index') }}" class="menu-link">
              <div data-i18n="Perfect Scrollbar">Users balance</div>
            </a>
          </li>
      </ul>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cube-alt"></i>
        <div data-i18n="Misc">General Setting</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/settings') }}" class="menu-link">
            <div data-i18n="Error">Edit Setting</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="{{ url('/settings/create') }}" class="menu-link">
            <div data-i18n="Under Maintenance">Settings</div>
          </a>
        </li>
        <li class="menu-item">
          <a  class="menu-link" href="#" onclick="runCacheOptimization();">
            <i class="bx bx-refresh me-2"></i>
            <span class="align-middle">Optimize</span>
        </a>
        
        <form id="cache-optimization-form" action="{{ route('run.optimize') }}" method="GET" class="d-none">
            @csrf
        </form>
        </li>
      </ul>
    </li>
    <!-- Components -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Manager config</span></li>
    <!-- Cards -->
    <li class="menu-item">
      <a href="cards-basic.html" class="menu-link">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div data-i18n="Basic">Manager</div>
      </a>
    </li>
    <!-- User interface -->
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-box"></i>
        <div data-i18n="User interface">Contacts</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ url('/owners') }}" class="menu-link">
            <div data-i18n="Accordion">edit contacts</div>
          </a>
        </li>

      </ul>
      <ul class="menu-sub">
        <li class="menu-item">
          <a  class="menu-link" href="#" onclick="runCacheOptimization();">
            <i class="bx bx-refresh me-2"></i>
            <span class="align-middle">Optimize</span>
        </a>
        
        <form id="cache-optimization-form" action="{{ route('run.optimize') }}" method="GET" class="d-none">
            @csrf
        </form>
        </li>

      </ul>
    </li>
    @endif

    
  
  
  
    <!-- Extended components -->
    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-copy"></i>
        <div data-i18n="Extended UI">Users</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="{{ route('users.index') }}" class="menu-link">
            <div data-i18n="Perfect Scrollbar">Users balance</div>
          </a>
        </li>

      </ul>
    </li>

  </ul>
</aside>
