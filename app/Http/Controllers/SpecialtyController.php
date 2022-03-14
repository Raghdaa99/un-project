<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $specialties = Specialty::all();
        return response()->view('cms.specialties.index', ['specialties' => $specialties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('cms.specialties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
        ]);

        if (!$validator->fails()) {
            $Specialties = new Specialty();
            $Specialties->name = $request->input('name');
            $isSaved = $Specialties->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Specialty created successfully' : 'Create failed!'
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
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function show(Specialty $specialty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialty $specialty)
    {
        //
        return response()->view('cms.specialties.edit', ['specialty' => $specialty]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialty $specialty)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:100',
        ]);

        if (!$validator->fails()) {
            $specialty->name = $request->input('name');
            $isSaved = $specialty->save();
            return response()->json(
                [
                    'message' => $isSaved ? 'Specialty created successfully' : 'Create failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty)
    {
        //
        $isDeleted = $specialty->delete();
        return response()->json(
            ['message' => $isDeleted ? 'Deleted successfully' : 'Delete failed!'],
            $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
