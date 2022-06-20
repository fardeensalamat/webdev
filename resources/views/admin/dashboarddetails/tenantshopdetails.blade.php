@extends('admin.layouts.adminMaster')

@section('content')
    <section class="content">

        
        <style>
            tr.nowrap td {
                white-space: nowrap;
            }

            tr.nowrap th {
                white-space: nowrap;
            }

        </style>

        <br>
        <div class="row">
           
            <div class="col-md-12">
                @include('alerts.alerts')
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{$title}}  List 
                        </h3>
                  
                     <div class="card-tools">
                        <form action="">

                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text"
                                    data-url="{{ route('admin.searchAjax', ['type' => $type, 'status' => isset($status) ? $status : null]) }}"
                                    class="form-control ajax-data-search" placeholder="Search Shop">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary w3-border">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    <div class="card-body">
                        @include('admin.dashboarddetails.ajax.tenantshopdetails')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
