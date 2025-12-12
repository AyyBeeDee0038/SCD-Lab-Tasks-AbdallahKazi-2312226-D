<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // 1. GET ALL (Read All)
    public function index()
    {
        $students = Student::all();
        return response()->json($students, 200);
    }

    // 2. POST (Create)
    public function store(Request $request)
    {
        $student = Student::create($request->all());
        return response()->json([
            'message' => 'Student created successfully',
            'data' => $student
        ], 201);
    }

    // 3. GET SINGLE (Read Single)
    public function show($id)
    {
        $student = Student::find($id);
        if ($student) {
            return response()->json($student, 200);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }

    // 4. PUT/PATCH (Update)
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->update($request->all());
            return response()->json([
                'message' => 'Student updated successfully',
                'data' => $student
            ], 200);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }

    // 5. DELETE (Delete)
    public function destroy($id)
    {
        $student = Student::find($id);
        if ($student) {
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }
}