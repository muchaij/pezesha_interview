@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row pt-3 pb-3">
        <div class="col-sm-8">
            <h3>Invoices</h3>
        </div>
        <div class="col-sm-4 text-right">
            <button class='btn btn-outline-primary' data-toggle="modal" data-target="#importModal">Import CSV</button>
        </div>
        <div class='col-sm-12'>
            <table class='table'>
                <thead>
                    <th>InvoiceNo</th>
                    <th>StockCode</th>
                    <th>Description</th>
                    <th>InvoiceDate</th>
                    <th>UnitPrice</th>
                    <th>CustomerID</th>
                    <th>Country</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action='{{url('import')}}' method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>Choose File to upload</label>
                    <input name='csv_file' type='file' class='form-control' placeholder="Upload file" accept='.csv'/>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-save">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
    @push('js')
    <script>
        $(document).ready(function(){
            $('.navbar').removeClass('bg-dark');
            $('.navbar').removeClass('navbar-dark');
            $('.navbar').removeClass('fixed-top');
            $('.navbar').addClass('navbar-light');
            $('.navbar').addClass('bg-light');
            $('.navbar').addClass('shadow-sm');
            $('.btn-save').click(function(){
                $('#importModal form').submit();
            });var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                oLanguage: {sProcessing: "<i class='fas fa-spinner fa-pulse'></i> Processing..."},
                dom: 'lBrtip',
                buttons: [
                    {
                        extend: 'csv',
                        text: '<i class="fas fa-file"></i> CSV',
                        className: '',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: '',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    }, {
                        extend: 'pdf',
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        className: '',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    }
                ],
                ajax: //"{{ url('datatables/users') }}",
                    {
                    url: "{{ url('datatable/imports') }}",
                    data: function (d) {
                            d.search = $('input[name=search]').val();
                        }
                    },
                columns: [
                    {data: "InvoiceNo", name: "InvoiceNo"},
                    {data: "StockCode", name: "InvoiceNo"},
                    {data: "Description", name: "Description"},
                    {data: "InvoiceDate", name: "InvoiceDate"},
                    {data: "UnitPrice", name: "UnitPrice"},
                    {data: "CustomerID", name: "CustomerID"},
                    {data: "Country", name: "Country"},
                ]
            });
        });
    </script>
@endpush
