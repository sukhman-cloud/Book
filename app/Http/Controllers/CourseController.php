<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorecategoryRequest;
use Illuminate\Http\Request;
use App\Models\Course;
class CourseController extends Controller
{
    
    public function fetchCourseData (Request $request)
    {
        $course= Course::all();

        return view('course.index', compact('course'));
    }

    public function insertCourseData(Request $request)
    {
        // Log incoming request for debugging
        \Log::info('Request Data:', $request->all());

        $request->validate([
            'course_name' => 'required',
            'course_abbrivation' => 'required',
            'total_semester' => 'required'
        ]);

        if ($request->id) {
            $course = Course::find($request->id);
            if ($course) {
                $course->course_name = $request->course_name;
                $course->course_abbrivation = $request->course_abbrivation;
                $course->total_semester = $request->total_semester;
                $course->save();
                return response()->json(['success' => true, 'message' => 'Courses Updated Successfully!']);
            }
            return response()->json(['success' => false, 'message' => 'Courses Not Found!']);
        } else {
            // Create a new course entry
            Course::create([
                'course_name' => $request->course_name,
                'course_abbrivation' => $request->course_abbrivation,
                'total_semester' => $request->total_semester,
            ]);
            return response()->json(['success' => true, 'message' => 'Courses Added Successfully!']);
        }
    }


        public function editCourse($id)
        {
            $course = Course::find($id);
            if ($course) {
                return response()->json(['success' => true, 'data' => $course]); // Ensure the data is being returned correctly
            }
            return response()->json(['success' => false, 'message' => 'Courses Not Found!']);
        }


    public function deleteCourse($id)
    {
        $course = Course::find($id);
        if($course){
            $course->delete();
            return response()->json(['success' => true, 'message' => 'Courses Delete Successfully!']);
        }
        return responses()->json(['success' => false, 'message' => 'Courses Not Found!']);
    }

}
