@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header w3-indigo">
                    <h3>{{__('myservices.services_search')}}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.servicesSearchFilterDashboard') }}" method="get">
                        {{-- @csrf --}}
                        <div class="form-group">
                            <select name="service_station" id="service_station" class="form-control" data-url="{{ route('user.searchCategoryAjax') }}">
                                <option value="">{{__('myservices.select_service_station')}}</option>
                                @foreach ($service_station as $st)
                                    <option value="{{ $st->id }}">{{ $st->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="workstation_cat" id="workstation_cat" class="form-control">
                                <option value="">{{__('myservices.select_category')}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-success" type="submit">
                        </div>
                    </form>
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
            ///Extra

// $('select#service_station').on('hover',function(){
//     alert($(this).val());
// });
            //Extra end

            $('select#service_station').on('change', function() {
                var st = $(this).val();
                var url= $(this).attr('data-url');
                $.ajax({
                    url: url,
                    method: 'post',
                    data: {
                        id: st,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        // console.log(data.subcategories)
                        $('#workstation_cat').empty();
                        $.each(data.categories, function(index, categories) {
                            $('select#workstation_cat').append('<option value="' +
                                categories.id + '">' + categories.name.en +
                                '</option>');
                            // console.log(categories.id);
                        })
                    }
                });
            });


        });
    </script>

@endpush
