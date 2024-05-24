@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <link rel="stylesheet" href="<?= asset('assets/css/plugins/dataTables.bootstrap5.min.css') ?>" >
@endsection

@section('content')
@include('partials/breadcrumb')
    <div class="row">
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
                      <span>Last Edit: 17 May 2024 18:50</span>
                  </li>
              </ul>
              
          </div>
        </div>
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5>Edit Parameters</h5>
              </div>
              <div class="card-body">
                <form action="" method="post">
                  <div class="form-group row">
                    <div class="col-lg-6">
                      <label class="form-label">Naval defense posture (percentage)</label>
                      <input type="email" class="form-control" placeholder="Percentage" >
                      <small class="form-text text-muted">Please enter percentage</small>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label">Naval Strength</label>
                      <input type="email" class="form-control" placeholder="A FUNCTION OF( Integrated Force)" >
                      <small class="form-text text-muted">Please enter Naval Strength</small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-6">
                      <label class="form-label">Number of personnel</label>
                      <input type="email" class="form-control" placeholder="A FUNCTION OF( )" >
                      <small class="form-text text-muted">Please enter number of personnel</small>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label">Oil and Gas</label>
                      <input type="email" class="form-control" placeholder="A FUNCTION OF( 'IGIP (Initial Gas in Place)',Oil and Gas Reserves))" >
                      <small class="form-text text-muted">Oil and Gas</small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-6">
                      <label class="form-label">Harbour</label>
                      <input type="email" class="form-control" placeholder="A FUNCTION OF( National Defense and Security Infrastructure,Recreation,Refulling\,Repair,Replenishment,Rest)" >
                      <small class="form-text text-muted">Please enter harbour</small>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label">Development Program</label>
                      <input type="email" class="form-control" placeholder="A FUNCTION OF( Manufacturing Improvement,Technological Innovation\)" >
                      <small class="form-text text-muted">Please Enter Development Program</small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-6">
                      <label class="form-label">Hybrid Threats</label>
                      <input type="email" class="form-control" placeholder="A FUNCTION OF( Disinformation Campaign,Proxy,Social Media Attack)" >
                      <small class="form-text text-muted">Please enter Hybrid Threats</small>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary mb-4">Submit Form</button>
                </form>
              </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="<?= asset('assets/js/pages/menu/simulation.js') ?>"></script>
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
    </script>
@endsection