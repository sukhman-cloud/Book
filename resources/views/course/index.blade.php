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
                            <span>Course List</span>
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h6>Course List Details</h6>

                            <div class="btn-box">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddCourse">
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
                                                    <th>Course Name</th>
                                                    <th>Abbrivation</th>
                                                    <th>Total Semesters</th>
                                                    <th class="text-end">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($course as $courses)
                                                    <tr>
                                                        <td>{{ $courses->id }}</td>
                                                        <td>{{ $courses->course_name }}</td>
                                                        <td>{{ $courses->course_abbrivation}}</td>
                                                        <td>{{ $courses->total_semester}}</td>
                                                        <td>
                                                            <div class="action-btns">
                                                            <button type="button" class="btn btn-sm iconBtn btn-primary"
                                                                data-bs-toggle="modal" data-bs-target="#AddCourse"
                                                                id="editCourse" onclick="editCourse({{ $courses->id }})">
                                                                <i class="material-icons">edit</i>
                                                            </button>

                                                                <form id="deleteCourseForm" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" style="position: relative;
    top: 7px;" class="btn btn-sm btn-danger" onclick="deleteCourse({{ $courses->id }})">
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

    <div class="modal fade" id="AddCourse" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="AddCourseLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddCourseLabel">Add Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="courseForm">
                        @csrf
                        <input type="hidden" name="id" id="courseId">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Add Course</label>
                                    <input type="text" name="course_name" id="course_name" class="form-control" placeholder="Enter Course Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Add Abbreviation</label>
                                    <input type="text" name="course_abbrivation" id="course_abbrivation" class="form-control" placeholder="Enter Abbreviation Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Add Total Semester</label>
                                    <input type="text" name="total_semester" id="total_semester" class="form-control" placeholder="Enter Total Semesters">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="submitCourseBtn" onclick="submitCourse();">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @stack('modals')

    @livewireScripts

    <script>
        function submitCourse(){
            var formdata = new FormData($("#courseForm")[0]);
            toastr.options = {
                "positionClass": "toast-top-right",
                "timeOut": "3000",
                "closeButton": true
            };

            var csrfMetaTag = document.querySelector('meta[name="csrf-token"]');
            var CSRF_TOKEN = csrfMetaTag ? csrfMetaTag.getAttribute('content') : '';

            $.ajax({
                url:'/addCourse',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                success: function(response) {
                    console.log('success:', response);
                    $('#AddCourse').modal('hide');
                    toastr.success(response.message);
                    window.location.reload();
                },
                error: function (xhr, status, error){
                    console.log('Error:', error);
                    toastr.error('An error occurred. Please try again.');
                }
            });
        }


        function deleteCourse(id) {
            var csrfMetaTag = document.querySelector('meta[name="csrf-token"]');
            var CSRF_TOKEN = csrfMetaTag ? csrfMetaTag.getAttribute('content') : '';
           if (confirm('Are you sure you want to delete this Course?')) {
            $.ajax({
                type: "DELETE",
                url: "/course/delete/" + id,
                data: {
                    _token: CSRF_TOKEN,
                },
                header: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.success) {
                        toastr.success('Course deleted successfully!');
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

        function editCourse(id) {
            $('#courseForm')[0].reset(); // Reset the form before populating
            $.ajax({
                url: '/course/edit/' + id, // Ensure this is correct
                type: 'GET',
                cache: false,
                success: function(response) {
                    console.log(response); // Log the response to see what it contains
                    if (response.success) {
                        $('#course_name').val(response.data.course_name);
                        $('#course_abbrivation').val(response.data.course_abbrivation);
                        $('#total_semester').val(response.data.total_semester);
                        $('#courseId').val(response.data.id);
                        $('#AddCourseLabel').text('Edit Course');
                        $('#submitCourseBtn').text('Update');
                        $('#AddCourse').modal('show');
                    } else {
                        toastr.error('Course not found!');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while fetching the Course data.');
                }
            });
        }


        // function addcategory() {
        //     $('#categoryForm')[0].reset();
        //     $('#categoryId').val('');
        //     $('#AddCategoryLabel').text('Add Category');
        //     $('#submitCategoryBtn').text('Submit');
        //     $('#AddCategory').modal('show');
        // }
    </script>

