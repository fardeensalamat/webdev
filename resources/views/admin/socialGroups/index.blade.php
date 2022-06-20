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
                <h3>Social Groups</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-5 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.socialGroupsStore') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="type">Group Type</label>
                                    <select name="type" id="" class="form-control">
                                        <option value="">Select Group Type</option>
                                        <option value="facebook">Facebook</option>
                                        <option value="youtube">Youtube</option>
                                        <option value="others">Others</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Group Name</label>
                                    <input type="text" name="title"  class="form-control">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="link">Group Link</label>
                                    <input type="text" name="link"  class="form-control">
                                    @error('link')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="active">
                                        <input type="checkbox" checked name="active" id=""> Active
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-info" type="submit" value="Add">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            All Social Groups
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" style="white-space: nowrap">
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>Action</td>
                                        <td>Title</td>
                                        <td>Link</td>
                                        <td>Type</td>
                                        <td>Status</td>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php $i=1; ?>
                                    <?php $i = ($socials->currentPage() - 1) * $socials->perPage() + 1; ?>
                                    @forelse ($socials as $social)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            <div class="btn-group btn-sm">
                                                @if ($social->active)
                                                    <a href="{{ route('admin.socialGroupsStatusUpdate',['type'=>'inactive','social'=>$social->id]) }}" class="btn btn-danger btn-xs">Inactive</a>
                                                    @else
                                                    <a href="{{ route('admin.socialGroupsStatusUpdate',['type'=>'active','social'=>$social->id]) }}" class="btn btn-success btn-xs">Active</a>
                                                @endif
                                                <a href="{{ route('admin.socialGroupsStatusUpdate',['type'=>'edit','social'=>$social->id]) }}" class="btn btn-info btn-xs">Edit</a>
                                                <a onclick="return confirm('Are you sure? You want to delete this Group?');" href="{{ route('admin.socialGroupsStatusUpdate',['type'=>'delete','social'=>$social->id]) }}" class="btn btn-warning btn-xs">Delete</a>
                                            </div>
                                        </td>
                                        <td>{{ $social->title }}</td>
                                        <td>{{ $social->link }}</td>
                                        <td>
                                            {{ $social->type }}

                                        </td>
                                        <td>
                                            @if ($social->active)
                                                <span class="text-success">Actived</span>
                                                @else
                                                <span class="text-danger">Inactived</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-danger text-center">NO Social Groups Found</td>
                                    </tr>
                                   
                                    @endforelse
                                   
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')

@endpush
