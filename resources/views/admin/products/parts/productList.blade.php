<br>
<section class="content">
    <div class="card card-primary">
        <div class="card-header with-border">
            <h3 class="card-title">
                All Products List 
            </h3>
        </div>
        <div class="card-body">
            @include('alerts.alerts')
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-5 m-b-xs">
                            <form class="action-form" action="">
                            <div class="input-group mb-3">
                            <select class="form-control" name="action">
                                <option value="">Select Option</option>
                                <option value="active">Status Active</option>
                                <option value="inactive">Status Inactive</option>
                                <option value="featured">Status Featured</option>
                                <option value="unfeatured">Status Un-featured</option>
                                <option value="delete">Delete</option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary filter-btn" type="submit">Action</button>
                            </div>
                            </div>
                        </form>
                            <label style="cursor: pointer;">
                            <input class="checkbox" type="checkbox" name="checkall" id="checkall" style="display: inline-block;"> All Select

                            <span class="succ badge badge-success" style="display:none;">Success</span>

                            </label>
                            
                        </div>
                        <div class="col-sm-7">
                            <div class="input-group mb-3">
                                <input data-url="" type="text" class="form-control form-control-sm ajax-data-search" placeholder="Search by Brand Id, title">
                                <div class="input-group-append">
                                    <button class="btn btn-sm btn-primary" type="button">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                   @include('admin.products.includes.productAll')
                </div>
                </div>
            </div>
        </div>
    </div>
</section>