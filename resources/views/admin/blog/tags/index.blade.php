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
                <h3>Tags</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-5 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.addTags') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Tag Name</label>
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
                                <?php $i = ($tags->currentPage() - 1) * $tags->perPage() + 1; ?>
                                @forelse ($tags as $tag)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                        <div class="btn-group btn-sm">
                                            <a href="{{ route('admin.editTags',['tag'=>$tag->id]) }}" class="btn btn-info btn-xs">Edit</a>
                                            <a href="{{ route('admin.deleteTags',['tag'=>$tag->id]) }}" onclick="return confirm('Are you sure> You want to delete This Tags?');" class="btn btn-danger btn-xs">Delete</a>
                                        </div>
                                        </td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{{ $tag->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $tag->updated_at->format('Y-m-d') }}</td>
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
                    {{ $tags->render() }}
                </div>
            </div>
        </div>
    </section>
@endsection


@push('js')

@endpush
