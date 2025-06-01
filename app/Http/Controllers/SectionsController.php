<?php

namespace App\Http\Controllers;

use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SectionsRequest;
use Illuminate\Validation\Rule;


class SectionsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:عرض صلاحية', ['only' => ['index']]);
        $this->middleware('permission:اضافة صلاحية', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل صلاحية', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف صلاحية', ['only' => ['destroy']]);
    }
    public function index()
    {
       $sections = Sections::get();
        return view('sections.index',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionsRequest $request)
    {
        if (Sections::where('name', $request->name)->exists()) {
            session()->flash('error', 'عفواً، اسم القسم مسجل من قبل!');
            return redirect()->route('Sections.index');
        }

        try {
            Sections::create([
                'name' => $request->name,
                'description' => $request->description,
                'created_by' => Auth::user()->name,
            ]);

            session()->flash('add', 'تم إضافة البيانات بنجاح!');
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء إضافة البيانات!'. $e->getMessage());
        }

        return redirect()->route('Sections.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        $id = $request->id;

        // Validate the request
        $this->validate($request, [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sections')->ignore($id),
            ],
            'description' => 'nullable|string',
        ], [
            'name.required' => 'اسم القسم مطلوب',
            'name.unique' => 'اسم القسم مسجل مسبقا',
        ]);

        $section = Sections::find($id);

        $section->update([
            'name' => $request->name,
            'description' => $request->description, // Update description if it exists
        ]);

        session()->flash('edit', 'تم تعديل القسم بنجاح');

        return redirect()->route('Sections.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $id = $request->id;
        Sections::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect()->route('Sections.index');
    }
}
