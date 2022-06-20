<br>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            @include('alerts.alerts')
            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title">
                        <i class="fa fa-plus"></i>
                        Add Category of OBSB
                    </h3>
                </div>
                <div class="card-body">
                    <div class="card card-widget mb-0">
                        <div class="card-body w3-gray p-2">
                            <div class="card card-widget mb-0">
                                <div class="card-body">

                                    <form action="{{ route('admin.addNewJobCategory') }}"
                                        enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3">
                                                <b>Category Name</b>
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    class="form-control" placeholder="Category name">
                                            </div>
                                            <div class="col-md-4">
                                                <b>Description</b>
                                                <textarea rows="1" placeholder="Description" class="form-control"
                                                    name="description">{{ old('description') }}</textarea>
                                            </div>



                                            <div class="col-md-2">
                                                <b>&nbsp;</b>
                                                <button style="margin-top: 20px;" type="submit"
                                                    class="btn  btn-primary ">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="card card-widget">
                <div class="card-header with-border">
                    <h3 class="card-title">
                        <i class="fa fa-th"></i>
                        All Categories of OBSB
                    </h3>
                </div>
                @if ($categories->count() > 0)
                    <div class="card-body w3-gray p-1">


                        @foreach ($categories as $category)
                            <div class="card card-widget form-outer-area  collapsed-card mb-3">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <b>{{ $loop->iteration }}. Category Title</b>: {{ $category->title }}

                                    </h3>

                                    <div class="card-tools">

                                        <a href="{{ route('admin.jobcategoryEdit', $category) }}"
                                            class="btn btn-tool"><i class="fas fa-edit"></i></a>
                                        <a title="Delete" class="w3-btn p-1 px-2 w3-small   w3-border"
                                            onclick="return confirm('Do you really want to delete this category?');"
                                            href="{{ route('admin.jobcategoryDelete', [$category->id]) }}"><i
                                                class="fa fa-times w3-text-red"></i>
                                        </a>

                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-plus"></i>
                                        </button>
                                    </div>



                                </div>

                                <div class="card-body p-1">

                                    <div class="px-3 py-1">

                                        Category Description: {!! $category->description !!}



                                    </div>



                                    <div class="card card-widget mb-0 ">
                                        <div class="card-body w3-light-gray p-1">

                                            <div class="card card-widget mb-0 ">
                                                <div class="card-header w3-border w3-border-blue w3-card">
                                                    <div class="">

                                                        <form class="form-add-item"
                                                            action="{{ route('admin.jobSubcategory', ['category' => $category]) }}"
                                                            method="post">

                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-md-4">

                                                                    <div class="form-group">
                                                                        <label>New SubCategory</label>
                                                                        <input type="text" name="name"
                                                                            {{ old('title') }} class="form-control"
                                                                            placeholder="Add New SubCategory">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>SubCategory Description</label>
                                                                        <input type="text" name="description"
                                                                            {{ old('description') }}
                                                                            class="form-control"
                                                                            placeholder="SubCategory Description">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>How Many Screenshot</label>

                                                                        <select class="form-control" name="screenshot"
                                                                            id="">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>

                                                                        </select>
                                                                    </div>

                                                                </div>


                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>Job Post Price</label>
                                                                        <input type="text" name="job_post_price"
                                                                            {{ old('job_post_price') }}
                                                                            class="form-control"
                                                                            placeholder="Job Post Price">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Job Work Price</label>
                                                                        <input type="text" name="job_work_price"
                                                                            {{ old('job_work_price') }}
                                                                            class="form-control"
                                                                            placeholder="Job Work Price">
                                                                    </div>




                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                name="admin_approve" id="admin_approve">
                                                                            Job post admin approve
                                                                        </label>
                                                                    </div>

                                                                    <div class="form-check">
                                                                        <label class="form-check-label">
                                                                            <input type="checkbox"
                                                                                class="form-check-input"
                                                                                name="work_link" id="work_link">
                                                                            Work Link Mandatory
                                                                        </label>
                                                                    </div>



                                                                </div>










                                                                <div class="col-md-5">

                                                                    <div class="form-group">
                                                                        <label>Instruction for subcategory</label>
                                                                        <textarea type="text" name="instraction"
                                                                            {{ old('instraction') }} rows="6"
                                                                            class="form-control textarea"
                                                                            placeholder="Instruction"></textarea>
                                                                    </div>


                                                                    <button type="submit"
                                                                        class="btn btn-primary">Submit</button>

                                                                </div>


                                                            </div>


                                                        </form>
                                                    </div>
                                                </div>
                                                <div
                                                    class="all-data-area question-area card-body  p-1 table-responsive">




                                                    @include('admin.jobcategories.ajax.subcatTable')


                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>


                            </div>



                            {{-- modal starts --}}
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Subategory</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="subcatForm" action="" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Subcategory
                                                        Title:</label>
                                                    <input type="text" name="name" value="" class="form-control"
                                                        id="recipient-name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text"
                                                        class="col-form-label">Description:</label>
                                                    <textarea class="form-control" value="" name="description"
                                                        id="message-text"></textarea>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- ./modals ends --}}


                        @endforeach



                    </div>
                @else
                    <h3 class="w3-center w3-text-red">No Category Yet</h3>
                @endif
            </div>
        </div>
    </div>
</section>
