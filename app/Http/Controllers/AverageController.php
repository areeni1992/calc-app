<?php

namespace App\Http\Controllers;

use App\Models\Average;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AverageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Average::paginate(5);

        return response()->view('index', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator($request->all, [
            'student_name' => 'required|string|min:3',
            'mid_mark' => 'required|decimal:0,30',
            'final_mark' => 'required|decimal:0,50',
            'activity_marks' => 'required|decimal:0,20'
        ]);

        if (!$valid->fails()) {
            Average::create($request->all());

            return response()->json(['status' => $valid, 'message' => 'The Marks Added Successfully'], Response::HTTP_CREATED);
        }

        return response()->json(
            ['status' => false, 'message' => $valid->getMessageBag()->first()],
            Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Average $average)
    {
        $deleted = $average->delete();

        if ($deleted) {
            return response()->json(
                ['status' => $deleted, 'message' => 'Deleted Successfully'],
                Response::HTTP_OK
            );
        }
        return response()->json(
            ['status' => false, 'message' => 'Fails Delete'],
            Response::HTTP_BAD_REQUEST
        );
    }
}
