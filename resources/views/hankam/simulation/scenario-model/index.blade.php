@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <link rel="stylesheet" href="<?= asset('assets/css/plugins/dataTables.bootstrap5.min.css') ?>" >
@endsection

@section('content')
@include('partials/breadcrumb')
    <div class="row mb-3">
        <div class="d-flex align-items-center justify-content-between">
            <ul class="list-inline mb-3 d-flex align-items-center">
                <li class="list-inline-item">
                    <div class="avtar avtar-s bg-light-warning">
                        <i class="ti ti-artboard f-20"></i>
                    </div>
                </li>
                <li class="list-inline-item text-filter">
                    <h5 class="mb-0">Defense and Security Scenario Model</h5>
                    <span>Base Model </span>
                </li>
            </ul>
            <a href="{{route('hankam.simulation.scenario-model.createScenario')}}" class="btn btn-primary"><i class="ti ti-square-plus"></i> Add Scenario</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>Scenario</h5>
                
              </div>
              <div class="card-body">
                <div class="dt-responsive table-responsive">
                  <table id="footer-search" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Scenario Name</th>
                        <th>Scenario Description</th>
                        <th>SFD Name</th>
                        <th>Final Time</th>
                        <th>Created At</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($scenarios as $scenario)
                      <tr>
                        <td>{{$scenario->id}}</td>
                        <td>{{$scenario->name}}</td>
                        <td>{{$scenario->desc}}</td>
                        <td>{{$scenario->sfd_name}}</td>
                        <td>{{$scenario->timestep}}</td>
                        <td>{{$scenario->created_at}}</td>
                        <td>
                          <a href="{{route('api.scenario-model.download', $scenario->id)}}" class="btn btn-sm btn-secondary"><i class="ti ti-upload me-1"></i>Download</button> 
                          <a href="{{route('hankam.simulation.scenario-model.detail', $scenario->id)}}" class="btn btn-sm btn-success"><i class="ti ti-eye me-1"></i>View</a>
                          <button type="button" class="btn btn-sm btn-warning"><i class="ti ti-pencil me-1"></i>Edit</button>
                          <button type="button" class="btn btn-sm btn-danger"><i class="ti ti-trash me-1"></i>Delete</button>
                        </td>
                      </tr>
                      @endforeach
                    
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Id</th>
                        <th>Scenario Name</th>
                        <th>Scenario Description</th>
                        <th>SFD Name</th>
                        <th>Final Time</th>
                        <th>Created At</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?= asset('assets/js/plugins/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= asset('assets/js/plugins/dataTables.bootstrap5.min.js') ?>"></script>
      <script>
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

      // if button download clicked show the sweet alert
      $('.download').on('click', function(){
        Swal.fire({
          title: 'Download Scenario',
          text: "Are you sure want to download this scenario?",
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, download it!'
        }).then((result) => {
          if (result.isConfirmed) {
            // loading animation
            Swal.fire({
              title: 'Downloading...',
              html: 'Please wait while we download the scenario',
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading()
              }
            })

            // hit controller to download the scenario
            $.ajax({
              data: {
                id: $(this).data('id')
              },
              url: '{{route('api.scenario-model.download', ':id')}}'.replace(':id', $(this).data('id')),
              type: 'GET',
              // wait until the download is finished
              success: function(response){
                Swal.fire({
                  title: 'Download Success',
                  text: 'Scenario has been downloaded',
                  icon: 'success',
                  timer: 2000,
                  timerProgressBar: true
                })
              }
              // if error
            }).fail(function(){
              Swal.fire({
                title: 'Download Failed',
                text: 'Scenario download failed',
                icon: 'error',
                timer: 2000,
                timerProgressBar: true
              })
            })
          }
        })
      });
    </script>
@endsection