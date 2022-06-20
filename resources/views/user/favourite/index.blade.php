@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="container-fluid">
            <div class="card">
                <div class="card-header w3-teal">
                    <h3>Favourites</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th>SL NO.</th>
                                    <th>Action</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Workstation</th>
                                    <th>Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>

                                <?php $i = ($favourites->currentPage() - 1) * $favourites->perPage() + 1; ?>
                                @forelse ($favourites as $fav)
                                    @if ($fav->favourable_type == 'App\Models\ServiceProfileProduct')
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                <div class="btn-group btn-sm">
                                                    <a class="btn btn-danger btn-xs"
                                                        href="{{ route('user.addTofavourite', ['type' => 'service_product', 'typeid' => $fav->favourable->id ?? 0]) }}">Unfavourite</a>
                                                    <a class="btn btn-success btn-xs"
                                                        href="{{ route('welcome.productShare', ['profile' => $fav->favourable->service_profile_id ?? 0, 'product' => $fav->favourable->id ?? 0, 'reffer' => $fav->favourable->subscription->subscription_code]) }}">Details</a>
                                                </div>

                                            </td>
                                            <td>Service Product</td>
                                            <td>{{ $fav->favourable->category->name ?? '' }}</td>
                                            <td>{{ $fav->favourable->workStation->title ?? ''}}</td>
                                            <th>
                                                {{-- {{ $fav->favourable->id }} --}}
                                                <a
                                                    href="{{ route('welcome.productShare', ['profile' => $fav->favourable->service_profile_id, 'product' => $fav->favourable->id, 'reffer' => $fav->favourable->subscription->subscription_code]) }}">{{ $fav->favourable->name }}</a>


                                            </th>
                                        </tr>
                                    @elseif ($fav->favourable_type == 'App\Models\ServiceProfile')
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                <div class="btn-group btn-sm">
                                                    <a class="btn btn-danger btn-xs"
                                                        href="{{ route('user.addTofavourite', ['type' => 'service_profile', 'typeid' => $fav->favourable->id ?? 0]) }}">Unfavourite</a>
                                                    <a class="btn btn-success btn-xs"
                                                        href="{{ route('welcome.profileShare', ['profile' => $fav->favourable->id ?? 0, 'reffer' => $fav->favourable->ownerSubscription->subscription_code ?? 0]) }}">Details</a>
                                                </div>
                                            </td>
                                            <td>Shop/Service</td>
                                            <td>{{ $fav->favourable->category->name ?? '' }}</td>
                                            <td>{{ $fav->favourable->workStation->title  ?? ''}}</td>
                                            <th>
                                                <a
                                                    href="{{ route('welcome.profileShare', ['profile' => $fav->favourable->id ?? 0, 'reffer' => $fav->favourable->ownerSubscription->subscription_code ?? 0]) }}">{{ $fav->favourable->name ?? 0}}</a>
                                            </th>
                                        </tr>
                                    @elseif ($fav->favourable_type == 'App\Models\Need')
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>
                                                <div class="btn-group btn-sm">
                                                    <a class="btn btn-danger btn-xs"
                                                        href="{{ route('user.addTofavourite', ['type' => 'needs', 'typeid' => $fav->favourable->id ?? 0]) }}">Unfavourite</a>
                                                    <a class="btn btn-success btn-xs"
                                                        href="{{ route('user.needDetails', ['need' => $fav->favourable->id ?? 0]) }}}}">Details</a>
                                                </div>
                                            </td>
                                            <td>Need</td>
                                            <td>{{ $fav->favourable->category->name ?? 0 }}</td>
                                            <td>{{ $fav->favourable->workStation->title ?? 0}}</td>
                                            <th><a
                                                    href="{{ route('user.needDetails', ['need' => $fav->favourable->id ?? 0]) }}">{{ $fav->favourable->title ?? 0 }}</a>
                                            </th>
                                        </tr>
                                    @endif
                                    <?php $i++; ?>
                                @empty
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
                {{ $favourites->render() }}
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
