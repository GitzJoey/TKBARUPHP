@extends('layouts.adminlte.master')

@section('title')
    @lang('report.viewer.title')
@endsection

@section('custom_css')
    <style>
        .pdfobject-container {
            min-height: 768px;
        }

        .pdfobject {
            border: 1px solid #888;
            min-height: 768px;
        }

        #pdf-viewer {
            min-height: 768px;
        }
    </style>
@endsection

@section('page_title')
    <span class="fa fa-table"></span>&nbsp;@lang('report.viewer.page_title')
@endsection

@section('page_title_desc')
    @lang('report.viewer.page_title_desc')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 pull-right">
            <div class="btn-toolbar">
                <a id="excelButton" href="{{ asset('storage/reports/' . $fileName . '.xlsx') }}"
                   target="_blank" class="btn btn-primary pull-right"><span class="fa fa-file-excel-o fa-fw"></span> @lang('buttons.download_excel_button')</a>
                <a id="pdfButton" href="{{ asset('storage/reports/' . $fileName . '.pdf') }}"
                   target="_blank" class="btn btn-primary pull-right"><span class="fa fa-file-pdf-o fa-fw"></span> @lang('buttons.download_pdf_button')</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a id="backButton" onclick="window.history.back()"
                   class="btn btn-primary pull-left"><span class="fa fa-arrow-left fa-fw"></span> @lang('buttons.back_button')</a>
            </div>
        </div>
    </div>
    <hr>
    <embed src="{{ asset('storage/reports/' . $fileName . '.pdf') }}" type="application/pdf" width="100%"></embed>
@endsection

@section('custom_js')
    <script type="application/javascript">
        $('embed').attr('height', ($('.wrapper').css('height')));
    </script>
@endsection