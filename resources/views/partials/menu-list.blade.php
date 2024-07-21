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

<li class="pc-item pc-caption">
  <label>DEFENCE AND SECURITY</label>
</li>
<li class="pc-item">
  <a href="{{ route('hankam.summary') }}" class="pc-link {{ Request::route()->getName() === 'hankam.summary' ? 'active' : '' }}">
    <span class="pc-micon">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
        <path opacity="0.4" d="M18.7917 6.41668V13.75H5.82087C4.38171 13.75 3.20837 14.9233 3.20837 16.3625V6.41668C3.20837 2.75001 4.12504 1.83334 7.79171 1.83334H14.2084C17.875 1.83334 18.7917 2.75001 18.7917 6.41668Z" fill="#5B6B79"/>
        <path d="M18.7917 13.75V16.9583C18.7917 18.7275 17.3525 20.1667 15.5834 20.1667H6.41671C4.64754 20.1667 3.20837 18.7275 3.20837 16.9583V16.3625C3.20837 14.9233 4.38171 13.75 5.82087 13.75H18.7917Z" fill="#5B6B79"/>
        <path d="M14.6667 7.10416H7.33337C6.95754 7.10416 6.64587 6.79249 6.64587 6.41666C6.64587 6.04082 6.95754 5.72916 7.33337 5.72916H14.6667C15.0425 5.72916 15.3542 6.04082 15.3542 6.41666C15.3542 6.79249 15.0425 7.10416 14.6667 7.10416Z" fill="#5B6B79"/>
        <path d="M11.9167 10.3125H7.33337C6.95754 10.3125 6.64587 10.0008 6.64587 9.625C6.64587 9.24917 6.95754 8.9375 7.33337 8.9375H11.9167C12.2925 8.9375 12.6042 9.24917 12.6042 9.625C12.6042 10.0008 12.2925 10.3125 11.9167 10.3125Z" fill="#5B6B79"/>
      </svg>
    </span>
    <span class="pc-mtext">Summary</span>
  </a>
</li>
<li class="pc-item">
  <a href="{{ route('hankam.maps') }}" class="pc-link {{ Request::route()->getName() === 'hankam.maps' ? 'active' : '' }}">
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
  <a href="#!" class="pc-link {{ Request::route()->getName() === 'hankam.threats.military' || Request::route()->getName() === 'hankam.threats.non-military' || Request::route()->getName() === 'hankam.threats.hybrid-military' ? 'active' : '' }}">
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
<li class="pc-item">
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
</li>

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
    <li class="pc-item"><a class="pc-link" href="{{ route('hankam.simulation.scenario-model.index') }}">Scenario Model</a></li>
    <li class="pc-item"><a class="pc-link" href="{{ route('hankam.simulation.outcome-scenario.index') }}">Outcome Scenario</a></li>
  </ul>
</li>
<li class="pc-item pc-caption">
  <label>TOOLS</label>
</li>
<li class="pc-item">
  <a href="{{ route('tools.key-variable.index') }}" class="pc-link {{ Request::route()->getName() === 'tools.key-variable.index' ? 'active' : '' }}">
    <span class="pc-micon">
          <i class="ph-duotone ph-toolbox"></i>
      </span>
      <span class="pc-mtext">Key Variable</span>
  </a>
</li>
<li class="pc-item pc-caption">
  <label>MARINE RESOURCE</label>
</li>
<li class="pc-item pc-hasmenu">
  <a href="#!" class="pc-link">
    <span class="pc-micon">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
        <path d="M18.1499 11.056H3.84996C3.6483 11.056 3.46497 10.9185 3.4008 10.726C0.879971 2.3935 13.6033 -0.805661 15.07 8.14101C16.5916 8.33351 17.7924 9.19516 18.5349 10.3502C18.7366 10.6527 18.5074 11.056 18.1499 11.056Z" fill="#5B6B79"/>
        <path opacity="0.4" d="M18.3333 14.521H3.66663C3.29079 14.521 2.97913 14.2093 2.97913 13.8335C2.97913 13.4577 3.29079 13.146 3.66663 13.146H18.3333C18.7091 13.146 19.0208 13.4577 19.0208 13.8335C19.0208 14.2093 18.7091 14.521 18.3333 14.521Z" fill="#5B6B79"/>
        <path opacity="0.4" d="M16.5 17.271H5.5C5.12417 17.271 4.8125 16.9593 4.8125 16.5835C4.8125 16.2077 5.12417 15.896 5.5 15.896H16.5C16.8758 15.896 17.1875 16.2077 17.1875 16.5835C17.1875 16.9593 16.8758 17.271 16.5 17.271Z" fill="#5B6B79"/>
        <path opacity="0.4" d="M13.75 20.021H8.25C7.87417 20.021 7.5625 19.7093 7.5625 19.3335C7.5625 18.9577 7.87417 18.646 8.25 18.646H13.75C14.1258 18.646 14.4375 18.9577 14.4375 19.3335C14.4375 19.7093 14.1258 20.021 13.75 20.021Z" fill="#5B6B79"/>
      </svg>
    </span>
    <span class="pc-mtext">Marine Resource</span>
    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
  </a>
  <ul class="pc-submenu">
    <li class="pc-item"><a class="pc-link" href="#">xxx</a></li>
    <li class="pc-item"><a class="pc-link" href="#">yyy</a></li>
    <li class="pc-item"><a class="pc-link" href="#">zzz</a></li>
  </ul>
</li>

{{-- other --}}
<li class="pc-item pc-hasmenu">
  <a href="#!" class="pc-link">
    <span class="pc-micon">
      <svg class="pc-icon">
        <use xlink:href="#custom-shapes"></use>
      </svg>
    </span>
    <span class="pc-mtext">Peta</span>
    <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
    <span class="pc-badge">2</span>
  </a>
  <ul class="pc-submenu">
    <li class="pc-item"><a class="pc-link" href="{{route('peta-geografi')}}">Geografi</a></li>
    <li class="pc-item"><a class="pc-link" href="{{route('peta-keamanan')}}">Keamanan</a></li>
  </ul>
</li>