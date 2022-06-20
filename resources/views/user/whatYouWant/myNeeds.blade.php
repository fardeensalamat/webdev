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
                    <h3>Needs</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th>{{__('needs.sl')}}</th>
                                    <th>{{__('needs.action')}}</th>
                                    <th>{{__('needs.title')}}</th>
                                    <th>{{__('needs.description')}}</th>
                                    <th>{{__('needs.category')}}</th>
                                    <th>{{__('needs.workstation')}}</th>
                                    <th>{{__('needs.status')}}</th>
                                    <th>{{__('needs.total_bid')}}</th>
                                    <th>{{__('needs.closed_date')}}</th>
                                    

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>

                                <?php $i = ($needs->currentPage() - 1) * $needs->perPage() + 1; ?>
                                @forelse ($needs as $need)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                          <div class="btn-group btn-sm">
                                            <a href="{{ route('user.myNeedDetails',['need'=>$need->id]) }}" class="btn btn-info btn-xs">Details</a>
                                            @if ( count($need->bids) <=0)
                                            <a href="{{ route('user.myNeedEdit',['need'=>$need->id]) }}" class="btn btn-warning btn-xs">Edit</a>
                                            @endif
                                          </div>
                                        </td>
                                        <td>{{ $need->title }}</td>
                                        <td>{{ mb_substr($need->description,0,30) }}..</td>
                                        <td>{{ $need->workstation ? $need->workstation->title :null }}</td>
                                        <td>{{ $need->category ? $need->category->name :null }}</td>
                                        <td>{{ $need->status }}</td>
                                        <td>{{ count($need->bids) }}</td>
                                        <td>{{ $need->closed_date }}</td>
                                        
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-danger text-center">No Needs Found 
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $needs->render() }}
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
