 <!-- ═══ HEADER ══════════════════════════════════════════════ -->
 <header class="site-header">
    <div class="hdr-top">
      <a href="#" class="logo">
        <img src="images/logo.png" alt="eBook Stack">
      </a>

      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Search titles, authors…" oninput="renderBooks()">
        <button type="button"><i class="fas fa-search"></i> Search</button>
      </div>

      <div class="hdr-actions">
        <div class="dropdown">
          <button class="btn-acct dropdown-toggle" data-bs-toggle="dropdown">
            <i class="fas fa-user-circle"></i> My Account
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="font-size:13px">
            <li><a class="dropdown-item" href="bookmark.html"><i
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