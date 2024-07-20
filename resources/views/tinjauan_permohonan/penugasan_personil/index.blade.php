@extends('layouts.master')

@section('title','Penugasan Personil')
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
            <h1>Penugasan Personil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Penugasan Personil</a></li>
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
                @include('include.admin.alert')
                
                <br/><br/>
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Action</th>
                                <th>Status Permohonan</th>
                                <th>Nama Perusahaan</th>
                                <th>Nomor Order</th>
                                <th>Tanggal Order</th>
                                <th>Menu</th>
                                <th>Tujuan</th>
                                <th>Proses Lain</th>
                                
                            </tr>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        // $(function () {
        //     //Initialize Select2 Elements
        //     $('.select2').select2()
        // });

    $(document).ready(function() {
        var t = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('penugasan-data.getData') }}",
            columns: [
            {
                data: null,
                name: 'rownum',
                orderable: false,
                searchable: false
            },
            { data: 'action', name: 'action', orderable: false, searchable: false },
            { data: 'sts_permohonan', name: 'sts_permohonan' },
            { data: 'full_nama_perusahaan', name: 'full_nama_perusahaan' },
            { data: 'no_order', name: 'no_order' },
            { 
                data: 'tanggal_order', 
                name: 'tanggal_order',
                render: function(data, type, row) {
                    return data ? data : '';
                }
            },
            
            { data: 'nama_skema_sertifikasi', name: 'nama_skema_sertifikasi' },
            { data: 'nama_tujuan_audit', name: 'nama_tujuan_audit' },
            { data: 'nama_proses', name: 'nama_proses' }
            
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
                if (index === 0 || column.dataSrc() === 'action' || column.dataSrc() === 'dokumen') {
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
                url: "{{ route('penugasan-data.getUniqueValues') }}",
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
                    url: "{{ route('penugasan-data.getUniqueValues') }}",
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