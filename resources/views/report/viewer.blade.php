@extends('layouts.adminlte.master')

@section('title')
    View Report
@endsection

@section('custom_css')
    <style>
        .pdfobject-container {
            height: 500px;
        }

        .pdfobject {
            border: 1px solid #666;
        }
    </style>
@endsection

@section('page_title')
    View Report
@endsection

@section('page_title_desc')
    @lang('report.master.page_title_desc')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 pull-right">
            <div class="btn-toolbar">
                <a id="excelButton" href="{{ asset('storage/reports/' . $fileName . '.xlsx') }}"
                   target="_blank" class="btn btn-primary pull-right">Download Excel</a>
                <a id="pdfButton" href="{{ asset('storage/reports/' . $fileName . '.pdf') }}"
                   target="_blank" class="btn btn-primary pull-right">Download PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </div>
    </div>
    <hr>
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <div id="pdf-viewer">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript" src="{{ asset('adminlte/js/pdfobject.min.js') }}"></script>
    <script type="application/javascript">
        PDFObject.embed('{{ asset('storage/reports/' . $fileName . '.pdf') }}', "#pdf-viewer");
    </script>
@endsection