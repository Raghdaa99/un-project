<?php

namespace App\Http\Controllers;

use App\Models\Patient;

use Illuminate\Http\Request;




use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        return response()->view('cms.patients.index', ['patients' => $patients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'age' => 'required',
            'phone' => 'required|string|min:8',
            'gender' => 'required|string|in:Male,Female',
        ]);

        if (!$validator->fails()) {
            $patient = new Patient();
            $patient->name = $request->input('name');
            $patient->age = $request->input('age');
            $patient->phone = $request->input('phone');
            $patient->gender = $request->input('gender');
            $isSaved = $patient->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'User created successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return response()->view('cms.patients.edit', ['patient' => $patient]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {

        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'age' => 'required',
            'phone' => 'required|string|min:8',
            'gender' => 'required|string|in:Male,Female',

        ]);

        if (!$validator->fails()) {
            $patient->name = $request->input('name');
            $patient->age = $request->input('age');
            $patient->phone = $request->input('phone');
            $patient->gender = $request->input('gender');
            $isSaved = $patient->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'User updated successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $isDeleted = $patient->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
