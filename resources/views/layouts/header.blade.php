 
 
 
 
 
 
 <!-- ═══ HEADER ══════════════════════════════════════════════ -->
 <header class="site-header">
    <div class="hdr-top">
      <a href="#" class="logo">
      <img src="{{ asset('images/logo.png') }}" alt="eBook Stack">
      </a>

      <!--<form action="{{ route('dashboard') }}" method="GET" class="search-box">
        <input 
            type="text" 
            id="searchInput" 
            name="search"
            placeholder="Search titles, authors…"
            value="{{ request('search') }}"
        >

        <button type="submit">
            <i class="fas fa-search"></i> Search
        </button>
    </form>-->

    <form action="{{ route('dashboard') }}" method="GET" class="search-box" id="searchForm">
      <input
          type="text"
          id="searchInput"
          name="search"
          placeholder="Search titles, authors…"
          value="{{ request('search') }}"
      >

      <button type="submit">
          <i class="fas fa-search"></i> Search
      </button>
    </form>

      <div class="hdr-actions">
        <div class="dropdown">
          <button class="btn-acct dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle"></i> My Account
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="font-size:13px">
            <li><a class="dropdown-item" href="{{ route('bookmark') }}"><i
                  class="fas fa-bookmark fa-fw me-2 text-muted"></i>Bookmark</a>
            </li>
          </ul>
        </div>
        <!--<a href="#" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Log Out</a>-->
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="btn-logout border-0 bg-transparent">
            <i class="fas fa-sign-out-alt"></i> Log Out
        </button>
    </form>
      </div>
    </div>
  </header>

  <!-- ═══ HERO STRIP ════════════════════════════════════════════ -->
  <div class="hero-strip">
    <div class="inner">
      <span class="bc">
        <a href="#">eBook Stack</a> &rsaquo; <span id="bcLabel">219 eBooks</span>
      </span>
    </div>
  </div>


  <script>
    let debounceTimer;

    document.getElementById('searchInput').addEventListener('keyup', function () {

        clearTimeout(debounceTimer);

        debounceTimer = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 500);

    });
</script>