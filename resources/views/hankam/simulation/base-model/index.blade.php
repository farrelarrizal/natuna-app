@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
      <link rel="stylesheet" href="<?= asset('assets/css/plugins/dataTables.bootstrap5.min.css') ?>" >
    <style>
      .button-send{
        border-radius: 8px;
      }
      .alert p {
        margin-bottom: 0;
        padding-left:10px;
        font-sizee:15px;
        color: black;
      }
    </style>
@endsection

@section('content')
@include('partials/breadcrumb')
    <div class="row">
      @if (session('success'))
          <div class="col-md-12">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          </div>
      @endif
      @if (session('error'))
          <div class="col-md-12">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error!</strong> {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          </div>
      @endif
      <div class="col-md-12 mb-3">
        <div class="d-flex align-items-center justify-content-between">
            <ul class="list-inline mb-3 d-flex align-items-center">
                <li class="list-inline-item">
                    <div class="avtar avtar-s bg-light-warning">
                        <i class="ti ti-artboard f-20"></i>
                    </div>
                </li>
                <li class="list-inline-item text-filter">
                    <h5 class="mb-0">Defense and Security Scenario Model</h5>
                    {{-- <span>Last Edit: 17 May 2024 18:50</span> --}}
                </li>
            </ul>
            <div class="d-flex flex-wrap gap-2">
              <a href="{{route('hankam.simulation.base-model.edit-parameter')}}" class="btn btn-warning "><i class="ti ti-pencil"></i><span class="text-truncate w-100">&nbsp;Edit Parameter</span></a>
              {{-- <button type="button" class="btn btn-secondary"><i class="ti ti-upload"></i><span class="text-truncate w-100">&nbsp;Export Model</span></button> --}}
              <a href="{{route('hankam.simulation.base-model.upload-model')}}" class="btn btn-info "><i class="ti ti-file-upload"></i><span class="text-truncate w-100">&nbsp;Import Model</span></a>
            </div>
            
        </div>
      </div>
        <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                  
                    <h5 class="mb-0">Defence and Security Graphics</h5>
                        <form id="variableForm">
                          <div class="row row-cols-md-auto g-1 align-items-center">
                            <div class="col-6">
                              <select id="variableSelect" name="variableId" class="form-select form-select-sm">
                              </select>
                            </div>
                            <div class="col-6">
                              <button type="submit" class="btn btn-primary btn-sm button-send">Send</button>
                            </div>
                          </div>
                        </form>
                    
                </div>
                {{-- <div class="pc-component">
                    <div class="alert alert-primary my-3" role="alert">
                        <div class="avtar avtar-s"><i data-feather="alert-circle"></i></div>
                        Information Notes 
                        <p>Additional description and information about copywriting.</p>
                      </div>
                </div> --}}
               <div class="row mt-3">
                <div class="alert alert-primary d-flex align-items-center" role="alert">
                  <div class="avatar avatar-s"><i data-feather="alert-circle"></i></div>
                  <div class="ml-2">
                    <p>Informational Notes</p>
                    
                  </div>
                </div>
              </div>
               
                <div class="row my-3">
                    <div id="defence-and-security-graphics"></div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h5>Causal Loop Diagram</h5>
            </div>
            <div class="card-body">
    
              <div class="row mt-3">
                <img src="{{ asset($image) }}" alt="image" class="img-fluid" width="100%">
              </div>
              <div class="row my-3">
                  <div id="defence-and-security-graphics"></div>
              </div>
            </div>
          </div>
      </div>
        <div class="col-md-12">
            <div class="card">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h5>Model Variables</h5>
              </div>
              <div class="card-body p-0 income-scroll">
                <div class="mt-3 mb-3">
                  <div class="row">
                    @foreach ($variable as $item)
                      <div class="col-md-6 px-4">
                        <div class="flex-grow-1 mx-2" >
                          <div class="div d-flex">

                            <p class="text-muted mb-1">{{$item->name}}</p>
                              
                            @if ($item->key_variable == 1)
                            <span class="badge bg-light-primary mx-2" >Key Variable</span></p>
                            @endif
                          </div>
                        
                          <p class="mb-0">{{$item->value}} 

                            @if($item->level != 'NULL')
                            <span class="mx-2" >({{$item->level}})</span></p>
                            @endif

                            
                          </p>
                        </div>
                        <hr class="border border-primary-subtle" />
                      </div>
                    @endforeach
                  </div>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- <script src="<?= asset('assets/js/pages/menu/simulation.js') ?>"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?= asset('assets/js/plugins/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= asset('assets/js/plugins/dataTables.bootstrap5.min.js') ?>"></script>
    
    <script>
      // js untuk graph 
      document.addEventListener('DOMContentLoaded', function () {
        var variableSelect = document.getElementById('variableSelect');
        var variableForm = document.getElementById('variableForm');

        function loadVariables() {
            fetch('/api/get-variables-active')
                .then(response => response.json())
                .then(variables => {
                    variables.forEach(variable => {
                        var option = document.createElement('option');
                        option.value = variable.id;
                        option.textContent = 'Variable ' + variable.name 
                        variableSelect.appendChild(option);
                    });
                    
                    if (variables.length > 0) {
                        fetchAndRenderGraph(variables[0].id);
                    }
                })
                .catch(error => console.error('Error loading vriables:', error));
        }

        function fetchAndRenderGraph(variableId) {
            fetch(`/api/base-model-graph-data?variableId=${variableId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.data.length === 0) {
                        document.querySelector('#defence-and-security-graphics').innerHTML = '<p>Belum ada skenario pada variabel</p>';
                        return;
                    }
                    function generateColors(numScenarios) {
                        const baseColors = ['#0d6efd', '#63C3EC', '#ff6347', '#6a5acd']; // Add more base colors if needed
                        return baseColors.slice(0, numScenarios);
                    }

                    const numScenarios = data.data.length;
                    const colors = generateColors(numScenarios);
                    var series = data.data.map(item => {  
                      return {
                            name: item.scenario_name,
                            data: item.values
                        };
                    });
                    var options = {
                        chart: {
                            fontFamily: 'Inter var, sans-serif',
                            type: 'area',
                            height: 370,
                            toolbar: {
                                show: false
                            }
                        },
                        colors: colors,
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                type: 'vertical',
                                inverseColors: false,
                                opacityFrom: 0.3,
                                opacityTo: 0
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            width: 3
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '45%',
                                borderRadius: 4
                            }
                        },
                        grid: {
                            strokeDashArray: 4
                        },
                        series: series,
                        xaxis: {
                            categories: data.data[0].node_points.map(String),
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false
                            }
                        }
                    };

                    document.querySelector('#defence-and-security-graphics').innerHTML = '';

                    var chart = new ApexCharts(document.querySelector('#defence-and-security-graphics'), options);
                    chart.render();
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    document.querySelector('#defence-and-security-graphics').innerHTML = '<p>Belum ada skenario pada variabel</p>';
                });
        }

        loadVariables();

        variableForm.addEventListener('submit', function (event) {
            event.preventDefault();
            var variableId = variableSelect.value;
            fetchAndRenderGraph(variableId);
        });
      });

      // [ Add Rows ]
      var t = $('#add-row-table').DataTable();
      var counter = 1;

      $('#addRow').on('click', function () {
        t.row.add([counter + '.1', counter + '.2', counter + '.3', counter + '.4', counter + '.5']).draw(false);

        counter++;
      });


      $('#addRow').click();

      // [ Individual Column Searching (Text Inputs) ]
      $('#footer-search tfoot th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" >');
      });

      var table = $('#footer-search').DataTable();

      // [ Apply the search ]
      table.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change', function () {
          if (that.search() !== this.value) {
            that.search(this.value).draw();
          }
        });
      });

      // [ Individual Column Searching (Select Inputs) ]
      $('#footer-select').DataTable({
        initComplete: function () {
          this.api()
            .columns()
            .every(function () {
              var column = this;
              var select = $('<select class="form-control form-control-sm"><option value=""></option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function () {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column.search(val ? '^' + val + '$' : '', true, false).draw();
                });

              column
                .data()
                .unique()
                .sort()
                .each(function (d, j) {
                  select.append('<option value="' + d + '">' + d + '</option>');
                });
            });
        }
      });
      var srow = $('#row-select').DataTable();

      $('#row-select tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
      });

      var drow = $('#row-delete').DataTable();

      $('#row-delete tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
          $(this).removeClass('selected');
        } else {
          drow.$('tr.selected').removeClass('selected');
          $(this).addClass('selected');
        }
      });

      $('#row-delete-btn').on('click', function () {
        drow.row('.selected').remove().draw(!1);
      });

      function format(d) {
        return (
          '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
          '<tr>' +
          '<td>Full name:</td>' +
          '<td>' +
          d.name +
          '</td>' +
          '</tr>' +
          '<tr>' +
          '<td>Extension number:</td>' +
          '<td>' +
          d.extn +
          '</td>' +
          '</tr>' +
          '<tr>' +
          '<td>Extra info:</td>' +
          '<td>And any further details here (images etc)...</td>' +
          '</tr>' +
          '</table>'
        );
      }

      // [ Form input ]
      var table = $('#form-input-table').DataTable();

      $('#form-input-btn').on('click', function () {
        var data = table.$('input, select').serialize();
        alert('The following data would have been submitted to the server: \n\n' + data.substr(0, 120) + '...');
        return false;
      });

      $('a.toggle-vis').on('click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = sh.column($(this).attr('data-column'));

        // Toggle the visibility
        column.visible(!column.visible());
      });

      // [ Search API ]
      function filterGlobal() {
        $('#search-api')
          .DataTable()
          .search($('#global_filter').val(), $('#global_regex').prop('checked'), $('#global_smart').prop('checked'))
          .draw();
      }

      function filterColumn(i) {
        $('#search-api')
          .DataTable()
          .column(i)
          .search($('#col' + i + '_filter').val(), $('#col' + i + '_regex').prop('checked'), $('#col' + i + '_smart').prop('checked'))
          .draw();
      }

      $('#search-api').DataTable();

      $('input.global_filter').on('keyup click', function () {
        filterGlobal();
      });

      $('input.column_filter').on('keyup click', function () {
        filterColumn($(this).parents('tr').attr('data-column'));
      });
    </script>
@endsection