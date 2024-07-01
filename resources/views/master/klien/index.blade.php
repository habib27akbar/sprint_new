@extends('layouts.master')

@section('title','Klien')
@section('css')
  
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
@section('content')  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Klien</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Klien</a></li>
              <li class="breadcrumb-item active">List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary card-outline">
              
              <div class="card-body">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Perusahaan</th>
                                <th>Jenis Badan Usaha</th>
                                <th>Nama Perusaahan</th>
                                <th>Jenis Produsen</th>
                                <th>Action</th>
                            </tr>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>
                                    {{-- <select id="id_perusahaan_filter" class="form-control select2">
                                        <option value="">All</option>
                                    </select> --}}
                                    </th>
                                    <th>
                                    {{-- <select id="jenis_badan_usaha_filter" class="form-control select2">
                                        <option value="">All</option>
                                    </select> --}}
                                    </th>
                                    <th>
                                    {{-- <select id="nama_perusahaan_filter" class="form-control select2">
                                        <option value="">All</option>
                                    </select> --}}
                                    </th>
                                    <th>
                                    {{-- <select id="jenis_produsen_filter" class="form-control select2">
                                        <option value="">All</option>
                                    </select> --}}
                                    </th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </thead>
                    </table>
              </div>
              <!-- /.card -->
            </div>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
    
  @endsection

  @section('js')
    
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        // $(function () {
        //     //Initialize Select2 Elements
        //     $('.select2').select2()
        // });

    $(document).ready(function() {
      var t = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('data-klien.getData') }}",
        columns: [
          {
            data: null,
            name: 'rownum',
            orderable: false,
            searchable: false
          },
          { data: 'id_perusahaan', name: 'id_perusahaan' },
          { data: 'jenis_badan_usaha', name: 'jenis_badan_usaha' },
          { data: 'nama_perusahaan', name: 'nama_perusahaan' },
          { data: 'ln_dn', name: 'ln_dn' },
          { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        createdRow: function(row, data, dataIndex) {
            var pageInfo = t.page.info();
            $('td:eq(0)', row).html(pageInfo.start + dataIndex + 1);
            },
            initComplete: function() {
            var api = this.api();
            api.columns().every(function(index) {
                var column = this;

                // Skip the "No" and "Action" columns
                if (index === 0 || column.dataSrc() === 'action') {
                    return;
                }

                var select = $('<select class="form-control select2"><option value="">All</option></select>')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                    updateOtherFilters(column.dataSrc(), val);
                });

                var columnName = column.dataSrc();

                $.ajax({
                url: "{{ route('data-klien.getUniqueValues') }}",
                data: { column: columnName },
                success: function(data) {
                    data.forEach(function(d) {
                    select.append('<option value="' + d + '">' + d + '</option>');
                    });
                    // Initialize Select2
                    select.select2();
                }
                });
            });

            function updateOtherFilters(currentColumn, selectedValue) {
                api.columns().every(function(index) {
                var column = this;
                var select = $('select', column.footer());
                var columnName = column.dataSrc();

                // Skip the "No" and "Action" columns
                if (index === 0 || columnName === 'action') {
                    return;
                }

                var currentFilterValue = select.val();
                $.ajax({
                    url: "{{ route('data-klien.getUniqueValues') }}",
                    data: {
                    column: columnName,
                    filtered: true,
                    filters: getFilters(currentColumn, selectedValue)
                    },
                    success: function(data) {
                    select.empty().append('<option value="">All</option>');
                    data.forEach(function(d) {
                        select.append('<option value="' + d + '">' + d + '</option>');
                    });
                    if (currentFilterValue) {
                        select.val(currentFilterValue);
                    }
                    // Initialize Select2
                    select.select2();
                    }
                });
                });
            }

            function getFilters(currentColumn, selectedValue) {
                var filters = {};

                api.columns().every(function() {
                var column = this;
                var select = $('select', column.footer());
                var val = select.val();

                if (val) {
                    filters[column.dataSrc()] = val;
                }
                });

                if (selectedValue) {
                filters[currentColumn] = selectedValue;
                }

                return filters;
            }
            }
        });

    // Initialize Select2 for initial filters
    $('.select2').select2();
    });


    </script>
  @endsection