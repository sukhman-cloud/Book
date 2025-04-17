    @include('sidebar')

    <div id="mainLayout">
        <div class="mainBody">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pageTitle">
                        <h2>
                            <div class="TitleIcon">
                                <i class="material-icons">article</i>
                            </div>
                            <span>Users List</span>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h6>Users List Details</h6>

                            <div class="btn-box">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCategory" >
                                    <i class="material-icons">add</i>
                                    Add New
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table id="UsersListTable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Category Name</th>
                                                    <th>category_abbrivation</th>
                                                    <th class="text-end">Actions</th>
                                                </tr>
                                            </thead>    
                                            <tbody>
                                                @foreach ($category as $index => $categoryes)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $categoryes->category_name }}</td>
                                                        <td>{{ $categoryes->category_abbrivation }}</td>
                                                        <td>
                                                            <div class="action-btns">
                                                                <button type="button" class="btn btn-sm iconBtn btn-primary"
                                                                    data-bs-toggle="modal" data-bs-target="#AddCategory"
                                                                    id="editCategory" onclick="editCategory({{ $categoryes->id }})">
                                                                    <i class="material-icons">edit</i>
                                                                </button>

                                                                <form id="deleteCategoryForm" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button style="position: relative;
        top: 7px;" type="button" class="btn btn-sm btn-danger" onclick="deleteCategory({{ $categoryes->id }})">
                                                                        <i class="material-icons">delete</i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="AddCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddCategoryLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        @csrf
                        <input type="hidden" name="id" id="categoryId">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Add Category</label>
                                    <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Add Abbreviation</label>
                                    <input type="text" name="category_abbrivation" id="abbreviation" class="form-control" placeholder="Enter Abbreviation Name">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="submitCategoryBtn" onclick="submitCategory();">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitCategory(){
            var formdata = new FormData($("#categoryForm")[0]);
            toastr.options = {
                "positionClass": "toast-top-right",
                "timeOut": "3000",
                "closeButton": true
            };

            $.ajax({
                url:'/addCategory',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log('success:', response);
                    $('#AddCategory').modal('hide');
                    toastr.success(response.message);
                    window.location.reload();
                },
                error: function (xhr, status, error){
                    console.log('Error:', error);
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }

        function deleteCategory(id) {
            var csrfMetaTag = document.querySelector('meta[name="csrf-token"]');
            var CSRF_TOKEN = csrfMetaTag ? csrfMetaTag.getAttribute('content') : '';
           if (confirm('Are you sure you want to delete this category?')) {
            $.ajax({
                type: "DELETE",
                url: "/category/delete/" + id,
                data: {
                    _token: CSRF_TOKEN,
                },
                header: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.success) {
                        toastr.success('Category deleted successfully!');
                        window.location.reload();
                    }
                },
                error: function(xhr, status, error){
                    toastr.error('An error occured. Please try again.');
                    console.log('Error:', error);
                }
            });
           }
        }

        function editCategory(id) {
            $('#categoryForm')[0].reset();
            $('#categoryId').val(id);
            $.ajax({
                url: '/category/edit/' + id,
                type: 'GET',
                success: function(response) {
                    if (response.data) {
                        $('#category_name').val(response.data.category_name);
                        $('#abbreviation').val(response.data.category_abbrivation);
                        $('#AddCategoryLabel').text('Edit Category');
                        $('#submitCategoryBtn').text('Update');
                        $('#AddCategory').modal('show');
                    } else {
                        toastr.error('Category not found!');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while fetching the category data.');
                }
            });
        }

        function addcategory() {
            $('#categoryForm')[0].reset();
            $('#categoryId').val('');
            $('#AddCategoryLabel').text('Add Category');
            $('#submitCategoryBtn').text('Submit');
            $('#AddCategory').modal('show');
        }
    </script>

