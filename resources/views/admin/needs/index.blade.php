@extends('admin.layouts.adminMaster')

@push('css')



@endpush

@section('content')
    <section class="content">

        <br>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-info">
                    <h3>Needs</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th>#SL</th>
                                    <th>Action</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Workstation</th>
                                    <th>User</th>
                                    <th>Status</th>
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
                                                <a href="{{ route('admin.detailsNeeds', ['need' => $need->id]) }}"
                                                    class="btn btn-warning btn-xs">Details</a>
                                                <a href="{{ route('admin.editNeeds', ['need' => $need->id]) }}"
                                                    class="btn btn-info btn-xs">Edit</a>
                                            </div>
                                        </td>
                                        <td>{{ $need->title }}</td>
                                        <td>{{ $need->category ? $need->category->name : null }}</td>
                                        <td>{{ $need->workstation ? $need->workstation->title : null }}</td>
                                        <td>{{ $need->user ? $need->user->name :null }}</td>
                                        <td>
                                            @if ($need->status == 'approved')
                                                <span class="text-success">Approved</span>
                                            @elseif ($need->status == 'rejected')
                                                <span class="text-danger">Rejected</span>
                                            @else
                                                <span class="text-warning">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-danger">
                                            <h3>{{ $i }}</h3>
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    {{ $needs->render() }}
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection


@push('js')





@endpush
