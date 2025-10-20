        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo m-0 border-bottom">
              <a href="#" class="app-brand-link">
                <span class="app-brand-logo demo">
                  <img src="{{ asset('mnk_logo.png') }}" style="max-width: 50px" alt="">
                </span>
              </a>

              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
              </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1 mt-3">
              <!-- Dashboard -->
              <li class="menu-item {{ Route::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-home"></i>
                  <div data-i18n="Dashboard">Dashboard</div>
                </a>
              </li>

              <!-- Users - Hanya untuk Admin -->
              @if(Auth::user()->role === 'admin')
              <li class="menu-item {{ Route::is('users*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-user"></i>
                  <div data-i18n="Users">Users</div>
                </a>
              </li>

              <li class="menu-item {{ Route::is('question*', 'answers*') ? 'active' : '' }}">
                <a href="{{ route('questions.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-file"></i>
                  <div data-i18n="Qestion">Soal</div>
                </a>
              </li>
              @endif

              <li class="menu-item {{ Route::is('exams*') ? 'active' : '' }}">
                <a href="{{ route('exams.index') }}" class="menu-link">
                  <i class="menu-icon tf-icons bx bxs-file"></i>
                  <div data-i18n="Exams">Ujian</div>
                </a>
              </li>
            </ul>
          </aside>
          <!-- / Menu -->
