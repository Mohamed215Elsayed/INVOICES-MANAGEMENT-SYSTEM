<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class SectionsController extends Controller
{
    public function index()
    {
        $sections = sections::all();
        return view('sections.sections',compact('sections'));
        // return view('sections.sections',['sections'=>$sections]);
    }
    // public function store(Request $request)// for testing purposes
    // {
    //     $input = $request->all();
    //     $b_existed = sections::where('section_name','=',$input['section_name'])->exists();
    //     if($b_existed){
    //         Session::flash('Error', 'خطأ هذا القسم مسجل مسبقا');
    //         return redirect('/sections');
    //     }
    //         sections::create( $validatedData +[
    //             'section_name' => $request->section_name,
    //             'description' => $request->description,
    //             'Created_by' => Auth::user()->name,

    //         ]);
    //         Session::flash('Add', 'تم اضافة القسم بنجاح ');
    //         return redirect('/sections');
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
        ],
        [
            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
        ]);

            sections::create( $validatedData +[
                'section_name' => $request->section_name,
                'description' => $request->description,
                'Created_by' => Auth::user()->name,

            ]);
            Session::flash('Add', 'تم اضافة القسم بنجاح ');
            return redirect('/sections');
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $this->validate($request, [
            'section_name' => "required|max:255|unique:sections,section_name,{$id}", 
            'description' => 'required',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);
        $sections = sections::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
        ]);

        session::flash('edit','تم تعديل القسم بنجاج');
        return redirect('sections');
        
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        sections::find($id)->delete();
        Session::flash('delete','تم حذف القسم بنجاح');
        return redirect('sections');
    }
}
