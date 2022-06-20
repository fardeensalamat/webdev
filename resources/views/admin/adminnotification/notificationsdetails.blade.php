@extends('admin.layouts.adminMaster')

@push('css')



@endpush

@section('content')
    <section class="content">
        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header w3-teal">
                    <h3>Notifications Details</h3>
                </div>
                <div class="card-body">
                    <p><b>Date: </b>{{date("d-m-Y", strtotime($details->date))}}</p>
                    <p><b>Title: </b>{{ $details->title }}</p>
                    <p><b>Messages: </b>{{ $details->messages }}</p>
                    <p><b>Details: </b>{{ $details->details }}</p>
                    <p><b>Type: </b>{{ $details->type}}</p>
                </div>
            </div>
        </div>

        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')

    <script>

        function subscribeId(actionUrl) {
            $("#subscribeForm").attr("action", actionUrl);
        }
        $(document).ready(function() {
            $('select').change(function() {
                if ($(this).val() === "new")
                    $('.hideme').show();
                else
                    $('.hideme').hide();
            }).change();
        });
    </script>

@endpush
