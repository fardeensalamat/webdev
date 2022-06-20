@extends('admin.layouts.adminMaster')

@section('content')
    <br>
    <section class="content">
        @include('alerts.alerts')
        <div class="card bg-info">
            <div class="card-body">
                <h3>Add Applicant Category</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.storeapplicantcategory') }}" method="POST" id='my-form' enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Name</label>
                                            <input  type="text" value="" class="form-control" name="name" placeholder="Ex: Shop Manager" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Salary Type</label>
                                             <select name="salary_type" id="salary_type" class="form-control">
                                                 <option value="Fixed">Fixed</option>
                                                 <option value="Negotiable">Negotiable</option>
                                             </select>
                                            @error('salary_type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="service_charge">Service Charge</label><br>
                                            <input  type="number" value="" class="form-control" name="service_charge" placeholder="Ex: 250" required>
                                            
                                            @error('service_charge')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                       

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="salary_amount">Salary Amount</label><br>
                                            <input  type="number" value="" class="form-control" name="salary_amount" placeholder="Ex: 1000">
                                            
                                            @error('salary_amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                       

                                    </div>
                                </div>
                              

                               
                              
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="btn btn-info" type="submit" value="Save">
                                        </div>
                                        
                                    </div>
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
