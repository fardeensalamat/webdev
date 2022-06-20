@extends('user.layouts.userMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        @include('alerts.alerts')
        <div class="card-body bg-info">
            <div class="d-flex justify-content-between">
                <p class="pt-2 m-0">{{__('opinions.my_opinions')}}</p>
                <p class="m-0">
                    <a class="btn btn-dark" href="{{ route('user.allOpinions') }}">{{__('opinions.all_opinions')}}</a>
                    <a class="btn btn-dark" href="{{ route('user.addOpinions') }}">{{__('opinions.add_opinions')}}</a>
                </p>
            </div>
        </div>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>{{__('opinions.sl')}}</th>
                    <th>{{__('opinions.action')}}</th>
                    <th>{{__('opinions.opinions')}}</th>
                    <th>{{__('opinions.user_tenants')}}</th>
                    <th>{{__('opinions.status')}}</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php $i = 1; ?>

                <?php $i = ($my_opinions->currentPage() - 1) * $my_opinions->perPage() + 1; ?>

                @foreach ($my_opinions as $opinion)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>
                            <div class="btn-group btn-sm">
                                <a onclick="return confirm('are you sure for delete this openion?')" href="{{ route('user.deleteOpinion',['opinion'=>$opinion->id]) }}" class="btn btn-danger btn-xs">Delete</a>
                                <a href="{{ route('user.viewOpinion',['opinion'=>$opinion->id]) }}" class="btn btn-info btn-xs">Details</a>
                                <a href="{{ route('user.editOpinion',['opinion'=>$opinion->id]) }}" class="btn btn-warning btn-xs">Edit</a>
                            </div>
                        </td>

                        <td>{{ $opinion->opinion }}</td>
                        <td>
                            {{ $opinion->user->name }} ({{ $opinion->user->id }})
                        </td>
                        <td>
                            @if ($opinion->status == 'cancled')
                                <span class="badge badge-danger">
                                    Cancled
                                </span>
                                @elseif ($opinion->status== 'lived')
                                <span class="badge badge-success">
                                   Lived
                                </span>
                                @else
                                <span class="badge badge-warning">
                                   Pending
                                </span>
                            @endif
                        </td>
                        
                    </tr>

                    <?php $i++; ?>

                @endforeach
            </tbody>

        </table>

        {{ $my_opinions->render() }}

        {{-- <div class="row">
            @forelse ($opinions as $opinion)
                <div class="col-sm-6 col-md-4 col-12  mt-3 mb-2 mb-md-0">
                    <div class="card card-widget p-0">
                        <div class="card-header ">
                            <div class="user-block">
                                <img class=" img-circle"
                                    src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $opinion->user->img_name]) }}"
                                    alt="sans" />
                                <span class="username text-dark">
                                    {{ $opinion->user->name }} <a class="btn btn-success btn-xs" href="{{ route('user.editOpinion',['opinion'=>$opinion->id]) }}">Edit</a>
                                </span>
                                <span class="description">
                                    @if ($opinion->status == 'lived')
                                        <span class="badge badge-success">{{ $opinion->status }}</span>
                                        @elseif ($opinion->status == 'pending')
                                        <span class="badge badge-warning">{{ $opinion->status }}</span>
                                        @else
                                        <span class="badge badge-danger">{{ $opinion->status }}</span>
                                    @endif
                                </span>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                                    <i class="far fa-circle"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <div class="card-body ">
                            <p class="mb-0">{{ $opinion->opinion }}</p>
                        </div>
                        <div class="card-footer text-center" style="background-color: #f8f9fa">
                            <p>© Copyright {{ date('Y') }} | {{ $_SERVER['SERVER_NAME'] }}</p>
                        </div>
                    </div>
                </div>
            @empty
            <h2 class="m-auto text-danger">No Opinions Found</h2>
            @endforelse
        </div> --}}
        </div><!-- /.container-fluid -->

    </section>
@endsection


@push('js')


@endpush
