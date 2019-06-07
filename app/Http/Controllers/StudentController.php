<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    protected $rules = [
        'nombre' => 'required|min:2|max:32',
        'fecha_nacimiento' => 'required|date',
        'email' => 'required|email|unique:students'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = Student::all();
        return view('students')->with([
            'estudiantes' => $estudiantes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(Input::all(), $this->rules);

        if ($validator->fails()) {

            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $student = new Student();
            $student->nombre = $request->nombre;
            $student->fecha_nacimiento = $request->fecha_nacimiento;
            $student->email = $request->email;
            $student->save();
            return response()->json($student);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return response()->json($student); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $reglas = [
            'nombre' => 'required|min:2|max:32',
            'fecha_nacimiento' => 'required|date',
            'email' => 'required|email|unique:students,email,'.$request->id
        ];
        $validator = Validator::make(Input::all(), $reglas);
        
        
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $student = Student::findOrFail($request->id);
            $student->nombre = $request->nombre;
            $student->fecha_nacimiento = $request->fecha_nacimiento;
            $student->email = $request->email;
            $student->save();
            return response()->json($student);
        }
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $student = Student::findOrFail($request->id);
        $student->delete();

        return response()->json($student);
    }
}
