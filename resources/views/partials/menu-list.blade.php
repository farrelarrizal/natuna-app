<li class="pc-item pc-caption">
  <label>DASHBOARD</label>
</li>
<li class="pc-item">
  <a href="{{ route('dashboard.executive-summary') }}" class="pc-link {{ Request::route()->getName() === 'dashboard.executive-summary' ? 'active' : '' }}">
    <span class="pc-micon">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
        <path opacity="0.4" d="M14.8409 1.83334H7.16836C3.83169 1.83334 1.84253 3.82251 1.84253 7.15917V14.8317C1.84253 18.1683 3.83169 20.1575 7.16836 20.1575H14.8409C18.1775 20.1575 20.1667 18.1683 20.1667 14.8317V7.15917C20.1667 3.82251 18.1775 1.83334 14.8409 1.83334Z" fill="#5B6B79"/>
        <path d="M10.5417 7.41582V15.8125C10.5417 16.1425 10.2117 16.3625 9.90924 16.2341C8.80007 15.7575 7.35172 15.3175 6.34339 15.1892L6.16922 15.1708C5.61005 15.0975 5.15173 14.575 5.15173 14.0067V6.94831C5.15173 6.25165 5.72007 5.72916 6.41674 5.78416C7.56257 5.87582 9.25841 6.42584 10.3217 7.03084C10.4592 7.095 10.5417 7.25082 10.5417 7.41582Z" fill="#5B6B79"/>
        <path d="M16.8484 7.05835V13.9975C16.8484 14.5658 16.3901 15.0883 15.8309 15.1617L15.6384 15.18C14.6392 15.3175 13.2 15.7483 12.0909 16.2158C11.7884 16.3442 11.4584 16.1242 11.4584 15.7942V7.40666C11.4584 7.24166 11.5409 7.08585 11.6875 7.00335C12.7509 6.40752 14.4101 5.87583 15.5376 5.77499H15.5742C16.28 5.78416 16.8484 6.35252 16.8484 7.05835Z" fill="#5B6B79"/>
      </svg>
    </span>
    <span class="pc-mtext">Executive Summary</span>
  </a>
</li>
<li class="pc-item">
  <a href="{{ route('dashboard.recommendation') }}" class="pc-link {{ Request::route()->getName() === 'dashboard.recommendation' ? 'active' : '' }}">
    <span class="pc-micon">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
        <path d="M10.5 13.75C13.9173 13.75 16.6875 11.0824 16.6875 7.79168C16.6875 4.50098 13.9173 1.83334 10.5 1.83334C7.08274 1.83334 4.3125 4.50098 4.3125 7.79168C4.3125 11.0824 7.08274 13.75 10.5 13.75Z" fill="#5B6B79"/>
        <path opacity="0.4" d="M6.3933 12.3933L6.38416 19.1583C6.38416 19.9833 6.96166 20.3866 7.67666 20.0475L10.1333 18.8833C10.335 18.7825 10.6741 18.7825 10.8758 18.8833L13.3417 20.0475C14.0475 20.3775 14.6342 19.9833 14.6342 19.1583V12.2283" fill="#5B6B79"/>
      </svg>
    </span>
    <span class="pc-mtext">Recommendation</span>
  </a>
</li>
<li class="pc-item">
  <a href="{{ route('dashboard.policy-brief') }}" class="pc-link {{ Request::route()->getName() === 'dashboard.recommendation' ? 'active' : '' }}">
    <span class="pc-micon">
      <svg  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path opacity="0.5" d="M3 10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C21 4.34315 21 6.22876 21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3 19.6569 3 17.7712 3 14V10Z" fill="#1C274C"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25 12C7.25 11.5858 7.58579 11.25 8 11.25H16C16.4142 11.25 16.75 11.5858 16.75 12C16.75 12.4142 16.4142 12.75 16 12.75H8C7.58579 12.75 7.25 12.4142 7.25 12Z" fill="#1C274C"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25 8C7.25 7.58579 7.58579 7.25 8 7.25H16C16.4142 7.25 16.75 7.58579 16.75 8C16.75 8.41421 16.4142 8.75 16 8.75H8C7.58579 8.75 7.25 8.41421 7.25 8Z" fill="#1C274C"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25 16C7.25 15.5858 7.58579 15.25 8 15.25H13C13.4142 15.25 13.75 15.5858 13.75 16C13.75 16.4142 13.4142 16.75 13 16.75H8C7.58579 16.75 7.25 16.4142 7.25 16Z" fill="#1C274C"/>
        </svg>
    </span>
    <span class="pc-mtext">Policy Brief</span>
  </a>
</li>
<li class="pc-item">
  <a href="{{ route('dashboard.maps') }}" class="pc-link {{ Request::route()->getName() === 'dashboard.maps' ? 'active' : '' }}">
    <span class="pc-micon">
     <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
      <path opacity="0.4" d="M17.7234 19.195C16.8526 19.8367 15.7068 20.1667 14.3409 20.1667H6.65925C6.43925 20.1667 6.21926 20.1575 6.00842 20.13L12.3334 13.805L17.7234 19.195Z" fill="#5B6B79"/>
      <path opacity="0.4" d="M19.6667 7.15913V14.8408C19.6667 16.2066 19.3367 17.3525 18.6951 18.2233L13.3051 12.8333L19.63 6.5083C19.6575 6.71913 19.6667 6.93913 19.6667 7.15913Z" fill="#5B6B79"/>
      <path opacity="0.4" d="M13.305 12.8333L18.695 18.2233C18.4292 18.6083 18.1084 18.9292 17.7234 19.195L12.3334 13.805L6.00838 20.13C5.42171 20.0933 4.89005 19.9742 4.40421 19.7908C2.44255 19.0758 1.33337 17.3342 1.33337 14.8408V7.15917C1.33337 3.82251 3.32254 1.83334 6.65921 1.83334H14.3409C16.8342 1.83334 18.5759 2.94251 19.2909 4.90418C19.4742 5.39001 19.5934 5.92168 19.63 6.50834L13.305 12.8333Z" fill="#5B6B79"/>
      <path d="M13.3051 12.8333L18.6951 18.2233C18.4293 18.6083 18.1085 18.9291 17.7235 19.195L12.3335 13.805L6.00846 20.13C5.4218 20.0933 4.89013 19.9741 4.4043 19.7908L4.76178 19.4333L19.291 4.90414C19.4743 5.38998 19.5934 5.92164 19.6301 6.50831L13.3051 12.8333Z" fill="#5B6B79"/>
      <path d="M10.7201 7.26918C10.3717 5.75668 9.0334 5.07835 7.86007 5.06918C6.68673 5.06918 5.34841 5.74752 5.00007 7.26002C4.61507 8.93752 5.64173 10.34 6.56756 11.22C6.93423 11.5683 7.39257 11.7334 7.86007 11.7334C8.32757 11.7334 8.7859 11.5592 9.15257 11.22C10.0784 10.34 11.1051 8.93752 10.7201 7.26918ZM7.88757 8.69918C7.3834 8.69918 6.9709 8.28668 6.9709 7.78252C6.9709 7.27835 7.37423 6.86585 7.88757 6.86585H7.89674C8.40091 6.86585 8.81341 7.27835 8.81341 7.78252C8.81341 8.28668 8.39173 8.69918 7.88757 8.69918Z" fill="#5B6B79"/>
    </svg>
    </span>
    <span class="pc-mtext">Maps</span>
  </a>
</li>
<li class="pc-item pc-hasmenu">
  <a href="#!" class="pc-link">
    <span class="pc-micon">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
        <path opacity="0.4" d="M9.13002 1.99017L4.08836 3.87851C3.12586 4.24517 2.33752 5.38184 2.33752 6.41767V13.8427C2.33752 14.5852 2.82336 15.566 3.41919 16.006L8.46086 19.7735C9.35002 20.4427 10.8075 20.4427 11.6967 19.7735L16.7384 16.006C17.3342 15.5568 17.82 14.5852 17.82 13.8427V6.41767C17.82 5.39101 17.0317 4.24517 16.0692 3.88767L11.0275 1.99934C10.5142 1.79767 9.65252 1.79767 9.13002 1.99017Z" fill="#5B6B79"/>
        <path d="M14.6666 10.6068C12.3933 10.6068 10.5416 12.4585 10.5416 14.7318C10.5416 17.0052 12.3933 18.8568 14.6666 18.8568C16.94 18.8568 18.7916 17.0052 18.7916 14.7318C18.7916 12.4493 16.94 10.6068 14.6666 10.6068Z" fill="#5B6B79"/>
        <path d="M19.25 20.2227C19.0025 20.2227 18.7734 20.1218 18.5992 19.9568C18.5625 19.911 18.5167 19.8652 18.4892 19.8102C18.4525 19.7643 18.425 19.7093 18.4067 19.6543C18.3792 19.5993 18.3609 19.5443 18.3517 19.4893C18.3425 19.4252 18.3334 19.3702 18.3334 19.306C18.3334 19.1868 18.3609 19.0677 18.4067 18.9577C18.4525 18.8385 18.5167 18.7468 18.5992 18.6552C18.81 18.4443 19.1309 18.3435 19.4242 18.4077C19.4884 18.4168 19.5434 18.4352 19.5984 18.4627C19.6534 18.481 19.7084 18.5085 19.7542 18.5452C19.8092 18.5727 19.855 18.6185 19.9009 18.6552C19.9834 18.7468 20.0475 18.8385 20.0934 18.9577C20.1392 19.0677 20.1667 19.1868 20.1667 19.306C20.1667 19.5443 20.0659 19.7827 19.9009 19.9568C19.855 19.9935 19.8092 20.0302 19.7542 20.0668C19.7084 20.1035 19.6534 20.131 19.5984 20.1493C19.5434 20.1768 19.4884 20.1952 19.4242 20.2043C19.3692 20.2135 19.305 20.2227 19.25 20.2227Z" fill="#5B6B79"/>
      </svg>
    </span>
    <span class="pc-mtext">Threats</span>
    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
  </a>
  <ul class="pc-submenu">
    <li class="pc-item"><a class="pc-link" href="{{ route('hankam.threats.military') }}">Military Threats</a></li>
    <li class="pc-item"><a class="pc-link" href="{{ route('hankam.threats.non-military') }}">Non-Military Threats</a></li>
    <li class="pc-item"><a class="pc-link" href="{{ route('hankam.threats.hybrid-military') }}">Hybrid Threats</a></li>
  </ul>
</li>

<li class="pc-item pc-caption">
  <label>Summary</label>
</li>
<li class="pc-item">
  <a href="{{ route('summary.hankam') }}" class="pc-link">
    <span class="pc-micon">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
        <path opacity="0.4" d="M18.7917 6.41668V13.75H5.82087C4.38171 13.75 3.20837 14.9233 3.20837 16.3625V6.41668C3.20837 2.75001 4.12504 1.83334 7.79171 1.83334H14.2084C17.875 1.83334 18.7917 2.75001 18.7917 6.41668Z" fill="#5B6B79"/>
        <path d="M18.7917 13.75V16.9583C18.7917 18.7275 17.3525 20.1667 15.5834 20.1667H6.41671C4.64754 20.1667 3.20837 18.7275 3.20837 16.9583V16.3625C3.20837 14.9233 4.38171 13.75 5.82087 13.75H18.7917Z" fill="#5B6B79"/>
        <path d="M14.6667 7.10416H7.33337C6.95754 7.10416 6.64587 6.79249 6.64587 6.41666C6.64587 6.04082 6.95754 5.72916 7.33337 5.72916H14.6667C15.0425 5.72916 15.3542 6.04082 15.3542 6.41666C15.3542 6.79249 15.0425 7.10416 14.6667 7.10416Z" fill="#5B6B79"/>
        <path d="M11.9167 10.3125H7.33337C6.95754 10.3125 6.64587 10.0008 6.64587 9.625C6.64587 9.24917 6.95754 8.9375 7.33337 8.9375H11.9167C12.2925 8.9375 12.6042 9.24917 12.6042 9.625C12.6042 10.0008 12.2925 10.3125 11.9167 10.3125Z" fill="#5B6B79"/>
      </svg>
    </span>
    <span class="pc-mtext">Defence and Security</span>
  </a>
</li>
<li class="pc-item">
  <a href="{{ route('summary.infra-hankam') }}" class="pc-link">
    <span class="pc-micon">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
        <path opacity="0.4" d="M18.7917 6.41668V13.75H5.82087C4.38171 13.75 3.20837 14.9233 3.20837 16.3625V6.41668C3.20837 2.75001 4.12504 1.83334 7.79171 1.83334H14.2084C17.875 1.83334 18.7917 2.75001 18.7917 6.41668Z" fill="#5B6B79"/>
        <path d="M18.7917 13.75V16.9583C18.7917 18.7275 17.3525 20.1667 15.5834 20.1667H6.41671C4.64754 20.1667 3.20837 18.7275 3.20837 16.9583V16.3625C3.20837 14.9233 4.38171 13.75 5.82087 13.75H18.7917Z" fill="#5B6B79"/>
        <path d="M14.6667 7.10416H7.33337C6.95754 7.10416 6.64587 6.79249 6.64587 6.41666C6.64587 6.04082 6.95754 5.72916 7.33337 5.72916H14.6667C15.0425 5.72916 15.3542 6.04082 15.3542 6.41666C15.3542 6.79249 15.0425 7.10416 14.6667 7.10416Z" fill="#5B6B79"/>
        <path d="M11.9167 10.3125H7.33337C6.95754 10.3125 6.64587 10.0008 6.64587 9.625C6.64587 9.24917 6.95754 8.9375 7.33337 8.9375H11.9167C12.2925 8.9375 12.6042 9.24917 12.6042 9.625C12.6042 10.0008 12.2925 10.3125 11.9167 10.3125Z" fill="#5B6B79"/>
      </svg>
    </span>
    <span class="pc-mtext">Defence Infrastructure</span>
  </a>
</li>
<li class="pc-item">
  <a href="{{ route('summary.marine-resource') }}" class="pc-link">
    <span class="pc-micon">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
        <path opacity="0.4" d="M18.7917 6.41668V13.75H5.82087C4.38171 13.75 3.20837 14.9233 3.20837 16.3625V6.41668C3.20837 2.75001 4.12504 1.83334 7.79171 1.83334H14.2084C17.875 1.83334 18.7917 2.75001 18.7917 6.41668Z" fill="#5B6B79"/>
        <path d="M18.7917 13.75V16.9583C18.7917 18.7275 17.3525 20.1667 15.5834 20.1667H6.41671C4.64754 20.1667 3.20837 18.7275 3.20837 16.9583V16.3625C3.20837 14.9233 4.38171 13.75 5.82087 13.75H18.7917Z" fill="#5B6B79"/>
        <path d="M14.6667 7.10416H7.33337C6.95754 7.10416 6.64587 6.79249 6.64587 6.41666C6.64587 6.04082 6.95754 5.72916 7.33337 5.72916H14.6667C15.0425 5.72916 15.3542 6.04082 15.3542 6.41666C15.3542 6.79249 15.0425 7.10416 14.6667 7.10416Z" fill="#5B6B79"/>
        <path d="M11.9167 10.3125H7.33337C6.95754 10.3125 6.64587 10.0008 6.64587 9.625C6.64587 9.24917 6.95754 8.9375 7.33337 8.9375H11.9167C12.2925 8.9375 12.6042 9.24917 12.6042 9.625C12.6042 10.0008 12.2925 10.3125 11.9167 10.3125Z" fill="#5B6B79"/>
      </svg>
    </span>
    <span class="pc-mtext">Marine Resource</span>
  </a>
</li>


<li class="pc-item pc-caption">
  <label>System Dynamics</label>
</li>
{{-- <li class="pc-item">
  <a href="{{ route('hankam.details') }}" class="pc-link {{ Request::route()->getName() === 'hankam.details' ? 'active' : '' }}">
    <span class="pc-micon">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
        <path opacity="0.58" d="M21.5 0H-0.5V22H21.5V0Z" fill="white"/>
        <path opacity="0.4" d="M14.3409 1.83333H6.66837C3.33171 1.83333 1.34253 3.82249 1.34253 7.15916V14.8317C1.34253 18.1683 3.33171 20.1575 6.66837 20.1575H14.3409C17.6775 20.1575 19.6667 18.1683 19.6667 14.8317V7.15916C19.6667 3.82249 17.6775 1.83333 14.3409 1.83333Z" fill="#5B6B79"/>
        <path d="M9.58337 5.04166V6.87499C9.58337 7.13166 9.38171 7.33333 9.12504 7.33333H7.75004C7.24587 7.33333 6.83337 7.74583 6.83337 8.24999V9.625C6.83337 9.88166 6.63171 10.0833 6.37504 10.0833H4.54171C4.28504 10.0833 4.08337 9.88166 4.08337 9.625V8.24999C4.08337 6.22416 5.72421 4.58333 7.75004 4.58333H9.12504C9.38171 4.58333 9.58337 4.78499 9.58337 5.04166Z" fill="#5B6B79"/>
        <path d="M11.4166 16.9583V15.125C11.4166 14.8683 11.6183 14.6667 11.875 14.6667H13.25C13.7541 14.6667 14.1666 14.2542 14.1666 13.75V12.375C14.1666 12.1183 14.3683 11.9167 14.625 11.9167H16.4583C16.715 11.9167 16.9166 12.1183 16.9166 12.375V13.75C16.9166 15.7758 15.2758 17.4167 13.25 17.4167H11.875C11.6183 17.4167 11.4166 17.215 11.4166 16.9583Z" fill="#5B6B79"/>
      </svg>
    </span>
    <span class="pc-mtext">Details</span>
  </a>
</li> --}}

<li class="pc-item pc-hasmenu">
  <a href="#!" class="pc-link {{ Request::route()->getName() === 'hankam.simulation.base-model.index' || Request::route()->getName() === 'hankam.simulation.scenario-model.index' || Request::route()->getName() === 'hankam.simulatiaon.outcome-scenario.index' ? 'active' : '' }}">
    <span class="pc-micon">
      <span class="pc-micon">
      <i class="ti ti-3d-cube-sphere f-20"></i>
    </span>
    </span>
    <span class="pc-mtext">Simulation</span>
    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
  </a>
  <ul class="pc-submenu">
    <li class="pc-item"><a class="pc-link" href="{{ route('hankam.simulation.base-model.index') }}">Base Model</a></li>
    @if (Auth::user()->role === 'SUPERADMIN')
      <li class="pc-item"><a class="pc-link" href="{{ route('hankam.simulation.scenario-model.index') }}">Scenario Model</a></li>
      <li class="pc-item"><a class="pc-link" href="{{ route('hankam.simulation.outcome-scenario.index') }}">Outcome Scenario</a></li>
    @endif
  </ul>
</li>
<li class="pc-item">
  <a href="{{ route('forms.index') }}" class="pc-link {{ Request::route()->getName() === 'forms.index' ? 'active' : '' }}">
    <span class="pc-micon">
      <!-- survey icon -->
      <i class="fas fa-clipboard-list"></i>
    </span>
    <span class="pc-mtext">Forms</span>
  </a>
</li>
  
@if (Auth::user()->role === 'SUPERADMIN')
  <li class="pc-item pc-caption">
    <label>Tools</label>
  </li>
  <li class="pc-item">
    <a href="{{ route('tools.key-variable.index') }}" class="pc-link {{ Request::route()->getName() === 'tools.key-variable.index' ? 'active' : '' }}">
      <span class="pc-micon">
            <i class="ti ti-key"></i>
        </span>
        <span class="pc-mtext">Key Variable</span>
    </a>
  </li>
  <li class="pc-item">
    <a href="{{ route('tools.recommendation.index') }}" class="pc-link">
      <span class="pc-micon">
            <i class="fas fa-chart-line"></i>
        </span>
        <span class="pc-mtext">Master Recommendation</span>
    </a>
  </li>
@endif

