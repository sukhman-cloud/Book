<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorecategoryRequest;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Models\Semester;

class SemesterController extends Controller
{
    public function semesterShow()
    {
        $semester= Semester::all();
        foreach ($semester as $sem) {
            $course = Course::find($sem->course_id);
            $categories = Category::whereIn('id', json_decode($sem->category_id))->get();
            $sem->course_name = $course ? $course->course_abbrivation : 'Unknown Course';
            $sem->categories = $categories->pluck('category_name')->toArray();
        }
        return view('semester.index', compact('semester'));
    }

    public function fetchCourseById($id)
    {
        $course = Course::find($id);
        if ($course) {
            return response()->json(['success' => true, 'data' => $course]);
        }else {
            return response()->json(['success' => false, 'message' => 'Course not found.']);
        }
    }

    public function getSemestersByCourse($courseId)
    {
        $course = Course::find($courseId);
        if ($course) {
            return response()->json([
                'success' => true,
                'data' => [
                    'total_semester' => $course->total_semester,
                ]
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Course not found.']);
        }
    }

    public function getSemester($id)
    {
        $semester = Semester::find($id);
        $course = Course::find($semester->course_id);
        $categories = Category::whereIn('id', json_decode($semester->category_id))->get();
        $semester->course_name = $course ? $course->course_abbrivation : 'Unknown Course';
        $semester->categories = $categories->pluck('category_name')->toArray();
        return response()->json(['success' => true, 'data' => $semester]);
    }

    public function getCategories()
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'No categories found.']);
        }
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }
   public function fetchCourseSem()
    {
        $course = Course::all();
        $categories = Category::all();
        $html = '<form id="semesterForm">
                    <input type="hidden" name="id" id="semesterId">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Select Courses</label>
                                <select name="course_id" id="course_Select" class="form-control" onchange="courseSelect()">
                                    <option value="0">Select Courses</option>';
                                    foreach ($course as $course) {
                                        $html .= '<option value="' . $course->id . '">' . $course->course_abbrivation . '</option>';
                                    }
                                $html .= '</select>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Select Semesters</label>
                                <select name="semester_num" id="semester_num" class="form-control" disabled>
                                    <option value="0">Select Semesters</option>
                                </select>
                            </div>
                        </div>
                    </div>
                                            
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Add Total Semester</label>
                                <input type="number" name="max_cat" id="maximumcat" class="form-control" placeholder="Enter Total Semesters" oninput="updateCategorySelect();" required>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select name="category_id[]" id="cate" class="form-control js-example-basic-multiple form-control-sm" multiple="multiple" required disabled>
                                    <option value="0">Select Category</option>';
                                    foreach ($categories as $cat) {
                                        $html .= '<option value="' . $cat->id . '">' . $cat->category_name . '</option>';
                                    }
                                $html .= '</select>
                            </div>
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="submitSemesterBtn" onclick="submitSemester();">Submit</button>
                </div>
            </form>';

        return response($html);
    }

    public function insertSemesterData(Request $request)
    {
        $request->validate([
            'semester_num' => 'required|string',
            'course_id' => 'required|integer',
            'max_cat' => 'required|integer',
            'category_id' => 'required|array', // Validate as an array
            'category_id.*' => 'string', // Validate each item in the array as an integer
        ]);

        if ($request->id) {
            $semester = Semester::find($request->id);
            if ($semester) {
                $semester->semester_num = $request->semester_num;
                $semester->course_id = $request->course_id;
                $semester->max_cat = $request->max_cat;
                $semester->category_id = json_encode($request->category_id); // Encode array as JSON
                $semester->save();
                return response()->json(['success' => true, 'message' => 'Semester updated successfully!']);
            }
            return response()->json(['success' => false, 'message' => 'Semester not found!']);
        } else {
            Semester::create([
                'semester_num' => $request->semester_num,
                'course_id' => $request->course_id,
                'max_cat' => $request->max_cat,
                'category_id' => json_encode($request->category_id), // Encode array as JSON
            ]);
            return response()->json(['success' => true, 'message' => 'Semester added successfully!']);
        }
    }

    public function deleteSemester(Request $request, $id)
    {
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json(['success' => false, 'message' => 'Semester not found'], 404);
        }
        $semester->delete();
        return response()->json(['success' => true]);
    }
    
    public function editSemester($id)
    {
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json(['success' => false, 'message' => 'Semester not found.']);
        }
    
        $courses = Course::all(); // Fetch all courses
        $categories = Category::all(); // Fetch all categories
    
        return response()->json([
            'success' => true,
            'semester' => $semester, // The semester being edited
            'courses' => $courses,   // Corrected to 'courses'
            'categories' => $categories, // Corrected to 'categories'
        ]);
    }
}
