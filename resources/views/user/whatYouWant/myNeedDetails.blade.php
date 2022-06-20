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
                    <h3>Need</h3>
                </div>
                <div class="card-body">
                    <p><b>Title: </b>{{ $need->title }}</p>
                    <p><b>Desciption: </b>{{ $need->description }}</p>
                    <p><b>Cat: </b>{{ $need->category? $need->category->name:null }}</p>
                    <p><b>SS: </b>{{ $need->workstation ? $need->workstation->title:null }}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-center"><h3>Total Bid: ({{ count($need->bids) }})</h3></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="white-space: nowrap">
                            <tr>
                                <th>#SL</th>
                                <th>Action</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                            @forelse ($need->bidsByPrice() as $bid)
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('user.myNeedBidDetails',['bid'=>$bid->id,'need'=>$need->id]) }}" class="btn btn-info btn-xs">Details</a>
                                    </div>
                                </td>
                                <td>{{ $bid->price }}</td>
                                <td>{{ $bid->description }}</td>
                                <td>
                                    <div class="col-md-4">
                                        @if ($bid->status == 'approved')
                                            <span class="badge badge-success">{{ $bid->status }}</span>
                                            @elseif ($bid->status == 'closed')
                                            <span class="badge badge-success">{{ $bid->status }}</span>
                                            @else
                                            <span class="badge badge-warning">{{ $bid->status }}</span>
                                        @endif
                                     </div>
                                </td>
                            </tr> 
                            @empty
                            <div class="row">
                                <tr>
                                    <td colspan="5" class="text-danger text-center">No Bid Found</td>
                                </tr> 
                            </div>
                            @endforelse
                        </table>
                    </div>
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
