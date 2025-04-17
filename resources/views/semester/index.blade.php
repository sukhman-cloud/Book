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
                            <span>Semester List</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h6>Semester List Details</h6>

                            <div class="btn-box">
                                <button type="button" id="btnSemester" class="btn btn-primary" onclick="semesterModalShow()">
                                    <i class="material-icons">add</i>
                                    Add New
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table  id="UsersListTable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Courses</th>
                                                    <th>Category</th>
                                                    <th class="text-end">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($semester as $index => $semesters)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $semesters->course_name }}</td>
                                                        <td>{{ $semesters->categories ? implode
                                                            (', ', $semesters->categories) : 'No Categories' }}</td>
                                                        <td>
                                                            <div class="action-btns">
                                                                <button type="button" class="btn btn-sm iconBtn btn-primary"
                                                                    data-bs-toggle="modal" data-bs-target="#AddSemester"
                                                                    id="viewSemester" onclick="viewSemester({{ $semesters->id }})">
                                                                    <i class="material-icons">open_in_new</i>
                                                                </button>

                                                                <button type="button" class="btn btn-sm iconBtn btn-success"
                                                                    data-bs-toggle="modal" data-bs-target="#AddSemester"
                                                                    id="editSemester" onclick="editSemester({{ $semesters->id }})">
                                                                    <i class="material-icons">edit</i>
                                                                </button>

                                                                <form id="deleteSemesterForm" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" style="position: relative;top: 7px;" class="btn btn-sm iconBtn btn-danger" onclick="deleteSemester({{ $semesters->id }})">
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

    <div class="modal fade" id="AddSemester" tabindex="-1" aria-labelledby="AddSemesterLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddSemesterLabel">Add Semester</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form content goes here -->
                </div>
            </div>
        </div>
    </div>

    <script>

        function semesterModalShow() {
            $.ajax({
                url: '/showmodal',
                type: 'GET',
                success: function (response) {
                    $('.modal-body').html(response); 
                    $('#AddSemester').modal('show'); 
                    $('#course_Select').on('change', courseSelect); 
                    $('#cate').select2({ 
                        placeholder: 'Select Categories',
                        width: '100%' 
                    });
                }
            });
        }

        function courseSelect(){
            console.log('courseId');
            var courseId = document.getElementById('course_Select').value;
            if (courseId > 0){
                $.ajax({
                    url: '/getSemestersByCourse/' + courseId,
                    type: 'GET',
                    success: function(response) {
                        if (response.success){
                            $('#semester_num').prop('disabled', false);
                            $('#semester_num').html('<option value="0">Select Semesters</option>');
                            for (var i = 1; i <= response.data.total_semester; i++){
                                $('#semester_num').append('<option value="Semester ' + i + '">Semester ' + i +'</option>');
                            }
                        }else {
                            toastr.error('No Semesters available for this course.');
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('An error occurred while fetching the semesters.');
                    }
                });
            } else {
                $('#semester_num').prop('disabled', true);
            }
        }

        function updateCategorySelect() {
            var totalSemesters = parseInt(document.getElementById('maximumcat').value);
            var categorySelect = document.getElementById('cate');
            categorySelect.innerHTML = '<option value="0">Select Category</option>';
            if (isNaN(totalSemesters) || totalSemesters < 1) {
                categorySelect.disabled = true;
                return;
            } else {
                categorySelect.disabled = false;
            }
            $.ajax({
                url: '/getCategories',
                type: 'GET',
                success: function(response) {
                    if (response.success && response.data.length > 0) {
                        response.data.forEach(function(category) {
                            var option = document.createElement('option');
                            option.value = category.id;
                            option.textContent = category.category_name;
                            categorySelect.appendChild(option);
                        });
                        var maxSelections = totalSemesters;
                        $(categorySelect).on('change', function() {
                            var selectedValues = $(this).val();
                            if (selectedValues.length > maxSelections) {
                                toastr.error('You can only select up to ' + maxSelections + ' categories.');
                                selectedValues = selectedValues.slice(0, maxSelections); // Trim to the allowed limit
                                $(this).val(selectedValues); // Set the trimmed selection
                            }
                            if (selectedValues.length >= maxSelections) {
                                $(this).find('option').each(function() {
                                    if ($(this).val() !== '0' && !selectedValues.includes($(this).val())) {
                                        $(this).prop('disabled', true); // Disable unselected options
                                    }
                                });
                            } else {
                                $(this).find('option').prop('disabled', false); // Enable all options if selection count is less than max
                            }
                        });
                    } else {
                        console.log('No categories found.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Error fetching categories:', error);
                }
            });
        }

        function submitSemester() {
            let form = $('#semesterForm')[0]; // Get form DOM element
            let formData = new FormData(form); // Create FormData object for the form

            $.ajax({
                url: '/addSemester', // The URL of your POST route
                method: 'POST',
                data: formData,
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Automatically fetch CSRF token
                },
                success: function (response) {
                    if (response.success) {
                        alert(response.message); // Success notification
                        location.reload(); // Reload the page to show updates
                    } else {
                        alert('Error: ' + response.message); // Handle error
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseJSON); // Log the error response
                    alert('Validation error. Please check the form fields.');
                }
            });
        }

        function editSemester(semesterId) {
            $.ajax({
            url: '/semester/edit/' + semesterId,
            type: 'GET',
                success: function (response) {
                    if (response.success) {
                        var semester = response.semester;
                        var courses = response.courses || []; // Ensure courses is an array
                        var categories = response.categories || []; // Ensure categories is an array

                        var html = `<form id="semesterForm">
                                        <input type="hidden" name="id" id="semesterId" value="${semester.id}">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Select Courses</label>
                                                    <div class="custom-select">
                                                        <select name="course_id" id="course_Select" class="form-control" onchange="courseSelect()">
                                                            <option value="0">Select Courses</option>`;
                                                            courses.forEach(function (course) {
                                                                var selected = semester.course_id == course.id ? 'selected' : '';
                                                                html += `<option value="${course.id}" ${selected}>${course.course_abbrivation}</option>`;
                                                            });
                                                        html += `</select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Select Semesters</label>
                                                    <div class="custom-select">
                                                        <select name="semester_num" id="semester_num" class="form-control" ${semester.semester_num ? '' : 'disabled'}>
                                                            <option value="0">Select Semesters</option>`;
                                                            for (var i = 1; i <= 10; i++) {
                                                                var selected = semester.semester_num === 'Semester ' + i ? 'selected' : '';
                                                                html += `<option value="Semester ${i}" ${selected}>Semester ${i}</option>`;
                                                            }
                                                        html += `</select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Add Total Semester</label>
                                                    <input type="number" name="max_cat" id="maximumcat" class="form-control" placeholder="Enter Total Semesters" min="1" value="${semester.max_cat}" oninput="updateCategorySelect();">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Select Category</label>
                                                    <div class="custom-select">
                                                        <select name="category_ids[]" id="cate" class="form-control js-example-basic-multiple form-control-sm" multiple="multiple">
                                                            <option value="0">Select Category</option>`;
                                                            categories.forEach(function (category) {
                                                                var selected = semester.category_id.includes(category.id.toString()) ? 'selected' : '';
                                                                html += `<option value="${category.id}" ${selected}>${category.category_name}</option>`;
                                                            });
                                                        html += `</select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" id="submitSemesterBtn" onclick="submitSemester();">Save</button>
                                        </div>
                                    </form>`;

                        // Inject form into modal body
                        $('.modal-body').html(html);
                        $('#AddSemesterLabel').text('Update Semester');

                        // Initialize Select2 for multi-select categories
                        $('#cate').select2({
                            placeholder: 'Select Categories',
                            width: '100%',
                        });

                        // Show the modal
                        $('#AddSemester').modal('show');
                    } else {
                        toastr.error('Semester not found.');
                    }
                },
                error: function (xhr, status, error) {
                    toastr.error('An error occurred while fetching the semester data.');
                    console.log('Error:', error);
                }
            });
        }

        function deleteSemester(id) {
            var csrfMetaTag = document.querySelector('meta[name="csrf-token"]');
            var CSRF_TOKEN = csrfMetaTag ? csrfMetaTag.getAttribute('content') : '';
            if (confirm('Are you sure you want to delete this Semester?')) {
                $.ajax({
                    type: "DELETE",
                    url: "/semester/delete/" + id,
                    data: {
                        _token: CSRF_TOKEN,
                    },
                    header: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Semester deleted successfully!');
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
       
    </script>