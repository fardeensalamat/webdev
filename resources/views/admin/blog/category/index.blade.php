@extends('admin.layouts.adminMaster')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endpush

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="card bg-info">
            <div class="card-body">
                <h3>Categories</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-5 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.addCategory') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Category Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-info" type="submit" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Action</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php $i = ($categories->currentPage() - 1) * $categories->perPage() + 1; ?>
                                @forelse ($categories as $cat)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                        <div class="btn-group btn-sm">
                                            <a href="{{ route('admin.editCategory',['category'=>$cat->id]) }}" class="btn btn-info btn-xs">Edit</a>
                                            <a href="{{ route('admin.deleteCategory',['category'=>$cat->id]) }}" onclick="return confirm('Are you sure> You want to delete This category?');" class="btn btn-danger btn-xs">Delete</a>
                                        </div>
                                        </td>
                                        <td>{{ $cat->name }}</td>
                                        <td>{{ $cat->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $cat->updated_at->format('Y-m-d') }}</td>
                                    </tr>
                                    <?php $i++ ?>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-danger text-center">No Catagory Found</td>
                                        
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $categories->render() }}
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')

@endpush
