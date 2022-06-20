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
                <h3>Edits Rating & Review</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-5 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.updaterating',$data->id) }}" method="POST" id='my-form'>
                                @csrf
                                <input  type="hidden" value="{{$data->id}}" class="form-control" name="id" required>
                                <div class="form-group">
                                    <label for="name">Rating</label>
                                    <input  type="text" value="{{$data->rating}}" class="form-control" name="rating" required>
                                    @error('rating')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                              
                                <div class="form-group">
                                    <label for="title">Comments</label><br>
                                    <textarea name="comments" type="text" class="form-control" id="" cols="45" rows="3">{{$data->comments}}</textarea>
                                    
                                    @error('comments')
                                        <span class="text-danger">{{ $comments }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="type">District</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Pending" @if($data->status=='Pending') selected @endif>Pending</option>
                                        <option value="Approved" @if($data->status=='Approved') selected @endif>Approved</option>
                                       
                                    </select>
                                   
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                               
                                <div class="form-group">
                                    <input class="btn btn-info" type="submit" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

          
        </div>
    </section>
@endsection
@push('js')


@endpush
