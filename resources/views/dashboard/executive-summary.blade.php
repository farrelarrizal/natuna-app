@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="<?= asset('assets/css/plugins/datepicker-bs5.min.css') ?>">
    <style>
        .list-inline .text-filter{
            margin-right: 50px;
        }
    </style>
@endsection

@section('content')
@include('partials/breadcrumb')
  <div class="row mb-2">
  <div class="row">
    <h3>Actual North Natuna Indicator</h3>
    <div class="d-flex ">
      <div class="col-3 p-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-s bg-light-primary">
                  <i class="fas fa-ship"></i>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-0">All Indicators</h6>
              </div>
            </div>
            <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <p class="text-primary mb-0 text-3xl">
                    <span class="badge bg-light-success mb-0 mt-1 text-bold text-4xl">Very High</span>
                  </p>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
      <div class="col-3 p-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-s bg-light-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      opacity="0.4"
                      d="M13 9H7"
                      stroke="#4680FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M22.0002 10.9702V13.0302C22.0002 13.5802 21.5602 14.0302 21.0002 14.0502H19.0402C17.9602 14.0502 16.9702 13.2602 16.8802 12.1802C16.8202 11.5502 17.0602 10.9602 17.4802 10.5502C17.8502 10.1702 18.3602 9.9502 18.9202 9.9502H21.0002C21.5602 9.9702 22.0002 10.4202 22.0002 10.9702Z"
                      stroke="#4680FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M17.48 10.55C17.06 10.96 16.82 11.55 16.88 12.18C16.97 13.26 17.96 14.05 19.04 14.05H21V15.5C21 18.5 19 20.5 16 20.5H7C4 20.5 2 18.5 2 15.5V8.5C2 5.78 3.64 3.88 6.19 3.56C6.45 3.52 6.72 3.5 7 3.5H16C16.26 3.5 16.51 3.50999 16.75 3.54999C19.33 3.84999 21 5.76 21 8.5V9.95001H18.92C18.36 9.95001 17.85 10.17 17.48 10.55Z"
                      stroke="#4680FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-0">Defence and Security <br>Score</h6>
              </div>
            </div>
            <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <h3 class="mb-1"><strong>3.58</strong>/100</h3>
                  <p class="text-primary mb-0">
                    <span class="badge bg-light-warning mb-0 mt-1 text-md">Medium</span>
                  </p>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
      <div class="col-3 p-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-s bg-light-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      opacity="0.4"
                      d="M13 9H7"
                      stroke="#4680FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M22.0002 10.9702V13.0302C22.0002 13.5802 21.5602 14.0302 21.0002 14.0502H19.0402C17.9602 14.0502 16.9702 13.2602 16.8802 12.1802C16.8202 11.5502 17.0602 10.9602 17.4802 10.5502C17.8502 10.1702 18.3602 9.9502 18.9202 9.9502H21.0002C21.5602 9.9702 22.0002 10.4202 22.0002 10.9702Z"
                      stroke="#4680FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M17.48 10.55C17.06 10.96 16.82 11.55 16.88 12.18C16.97 13.26 17.96 14.05 19.04 14.05H21V15.5C21 18.5 19 20.5 16 20.5H7C4 20.5 2 18.5 2 15.5V8.5C2 5.78 3.64 3.88 6.19 3.56C6.45 3.52 6.72 3.5 7 3.5H16C16.26 3.5 16.51 3.50999 16.75 3.54999C19.33 3.84999 21 5.76 21 8.5V9.95001H18.92C18.36 9.95001 17.85 10.17 17.48 10.55Z"
                      stroke="#4680FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-0">National Defense and Security Infrastructure</h6>
              </div>
            </div>
            <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <h3 class="mb-1"><strong>4.85</strong>/100</h3>
                  <p class="text-primary mb-0">
                    <span class="badge bg-light-success mb-0 mt-1 text-md">High</span>
                  </p>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
      <div class="col-3 p-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0">
                <div class="avtar avtar-s bg-light-primary">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      opacity="0.4"
                      d="M13 9H7"
                      stroke="#4680FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M22.0002 10.9702V13.0302C22.0002 13.5802 21.5602 14.0302 21.0002 14.0502H19.0402C17.9602 14.0502 16.9702 13.2602 16.8802 12.1802C16.8202 11.5502 17.0602 10.9602 17.4802 10.5502C17.8502 10.1702 18.3602 9.9502 18.9202 9.9502H21.0002C21.5602 9.9702 22.0002 10.4202 22.0002 10.9702Z"
                      stroke="#4680FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                    <path
                      d="M17.48 10.55C17.06 10.96 16.82 11.55 16.88 12.18C16.97 13.26 17.96 14.05 19.04 14.05H21V15.5C21 18.5 19 20.5 16 20.5H7C4 20.5 2 18.5 2 15.5V8.5C2 5.78 3.64 3.88 6.19 3.56C6.45 3.52 6.72 3.5 7 3.5H16C16.26 3.5 16.51 3.50999 16.75 3.54999C19.33 3.84999 21 5.76 21 8.5V9.95001H18.92C18.36 9.95001 17.85 10.17 17.48 10.55Z"
                      stroke="#4680FF"
                      stroke-width="1.5"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h6 class="mb-0 text-justify">Marine Resource <br>Utilization</h6>
              </div>
            </div>
            <div class="bg-body p-1 rounded text-center">
              <div class="mt-2 row align-items-center">
                <div class="col-12">
                  <h3 class="mb-1"><strong>4.85</strong>/100</h3>
                  <p class="text-primary mb-0">
                    <span class="badge bg-light-success mb-0 mt-1 text-md">High</span>
                  </p>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="col d-flex justify-content-between">
        <h3>Forecast North Natuna Indicator</h3>
        <!-- SELECT LIST -->
        <div class="list-inline">
          <select class="form-select text-filter">
            <option selected>Select Scenarios</option>
            <option value="1">2022</option>
            <option value="2">2023</option>
            <option value="3">2024</option>
            <option value="4">2025</option>
          </select>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-primary">
                    <!-- fas fa-ship -->
                    <i class="fas fa-ship"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0">All Indicators</h6>
                </div>
              </div>
              <div class="bg-body p-1 rounded text-center">
                <div class="mt-2 row align-items-center">
                  <div class="col-12">
                    <p class="text-primary mb-0">
                      <span class="badge bg-light-success mb-0 mt-1 text-bold text-4xl">Very High</span>
                    </p>
                  </div>
                </div>
              </div>          
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-primary">
                    <i class="fas fa-shield-alt"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0">Defence and Security <br>Score</h6>
                </div>
              </div>
              <div class="bg-body p-1 rounded text-center">
                <div class="mt-2 row align-items-center">
                  <div class="col-12">
                    <h3 class="mb-1"><strong>3.58</strong>/100</h3>
                    <p class="text-primary mb-0">
                      <span class="badge bg-light-warning mb-0 mt-1 text-md">Medium</span>
                    </p>
                  </div>
                </div>
              </div>          
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-primary">
                    <i class="fas fa-shield-alt"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0">National Defense and Security Infrastructure</h6>
                </div>
              </div>
              <div class="bg-body p-1 rounded text-center">
                <div class="mt-2 row align-items-center">
                  <div class="col-12">
                    <h3 class="mb-1"><strong>4.85</strong>/100</h3>
                    <p class="text-primary mb-0">
                      <span class="badge bg-light-success mb-0 mt-1 text-md">High</span>
                    </p>
                  </div>
                </div>
              </div>          
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                  <div class="avtar avtar-s bg-light-primary">
                    <!-- National Defense and Security Infrastructure -->
                    <i class="fas fa-ship"></i>
                  </div>
                </div>
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-0 text-justify">Marine Resource <br>Utilization</h6>
                </div>
              </div>
              <div class="bg-body p-1 rounded text-center">
                <div class="mt-2 row align-items-center">
                  <div class="col-12">
                    <h3 class="mb-1"><strong>4.85</strong>/100</h3>
                    <p class="text-primary mb-0">
                      <span class="badge bg-light-success mb-0 mt-1 text-md">High</span>
                    </p>
                  </div>
                </div>
              </div>          
            </div>
          </div>
        </div>
      </div>
    </div>


      <br>
      <hr>
      <div class="card ">
        <div class="card-header">
          <h3 class="mb-0">Analisa Kondisi</h3>
        </div>
        <div class="card-body">
          <p>Infrastruktur laut, sumber daya laut, dan pertahanan-keamanan semuanya berada di tingkat <strong>rendah</strong>, menunjukkan minimnya investasi, pemanfaatan, dan kesiapsiagaan. Kondisi ini menunjukkan kawasan yang mungkin kurang strategis atau terbatas secara sumber daya.</p>
          <p>Risiko: Pengawasan minim, rentan terhadap ancaman non-militer seperti pencurian ikan dan aktivitas ilegal kecil.</p>
        </div>
      </div>
      <div class="card ">
        <div class="card-header">
          <h3 class="mb-0">Rekomendasi</h3>
        </div>
        <div class="card-body">
          <p>Pengawasan Minimum: Fokus pada patroli minimal di area yang paling penting, menggunakan kapal patroli yang ada tanpa modernisasi teknologi yang signifikan.</p>
          <p>Kerjasama Minimal: Melakukan diplomasi preventif dengan negara-negara tetangga untuk menjaga keamanan secara minimal tanpa eskalasi.</p>
          <p>Sumber Daya Terbatas: Fokus pada perlindungan sumber daya laut dengan teknologi sederhana, seperti pengawasan berbasis radar minimal dan pemantauan nelayan lokal.</p>
          <p>Infrastruktur: Meningkatkan infrastruktur secara bertahap, dengan prioritas pada perbaikan fasilitas pelabuhan dasar dan komunikasi antar kapal."</p>
          <p>Risiko: Pengawasan minim, rentan terhadap ancaman non-militer seperti pencurian ikan dan aktivitas ilegal kecil.</p>
        </div>
      </div>
      <div class="card ">
        <div class="card-header">
          <h3 class="mb-0">
            <div class="col d-flex">
              <h3> Penjalanan Skenario 
              </h3>
            <small><span class=" mx-2 badge  bg-light-danger">Danger</span></small>
            </div>
          </h3>
        </div>
        <div class="card-body">
          <ol>
            <li>Peningkatan Kemampuan Kapal</li>
            <li>Kerjasama Bilateral</li>
          </ol>
        </div>
      </div>


      {{-- <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="mb-0">Defence and Security Sub Model</h5>
              <div id="defsec-sub-graph"></div>
            </div>
          </div>
      </div>
      <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="mb-0">Defence and Security Infrastructure Sub Model</h5>
              <div id="defsec-infra-sub-graph"></div>
            </div>
          </div>
      </div>
      <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="mb-0">Defence and Security Marine Resource Sub Model</h5>
              <div id="defsec-marine-sub-graph"></div>
            </div>
          </div>
      </div> --}}

  </div>
@endsection

@section('script')
    <script src="<?= asset('assets/js/pages/menu/executive-summary.js') ?>"></script>
    <script src="<?= asset('assets/js/plugins/datepicker-full.min.js') ?>"></script>
    <script>
      (function () {
        const d_week = new Datepicker(document.querySelector('#pc-datepicker-2'), {
          buttonClass: 'btn'
        });
      })();
    </script>
@endsection