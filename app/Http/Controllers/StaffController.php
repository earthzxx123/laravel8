<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = 10;

        $search = $request->get('search');
        if (!empty($search)) {
            //กรณีมีข้อมูลที่ต้องการ search จะมีการใช้คำสั่ง where และ orWhere
            $covid19s = Staff::where('name', 'LIKE', "%$search%")
                ->orWhere('age', 'LIKE', "%$search%")
                ->orWhere('salary', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->orderBy('name', 'desc')->paginate($perPage);
        } else {
            //กรณีไม่มีข้อมูล search จะทำงานเหมือนเดิม
            $covid19s = Staff::orderBy('name', 'desc')->paginate($perPage);
        }

        // //DISPLAY ON VIEW
        return view('staff/index ', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ดึงข้อมูลทั้งหมดของหน้าฟอร์มมาเก็บใน $requestData
        $requestData = $request->all();
        //บันทึกข้อมูล ใหม่ลงฐานข้อมูล
        Staff::create($requestData);
        //เด้งไปหน้า /staff
        return redirect('staff');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Query ข้อมูลขึ้นมา 1 ชิ้น ถ้าไม่เจอให้ขึ้น 404
        $staff = Staff::findOrFail($id);

        return view('staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Query ข้อมูลขึ้นมา 1 ชิ้น ถ้าไม่เจอให้ขึ้น 404
        $staff = Staff::findOrFail($id);

        return view('staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //ดึงข้อมูลทั้งหมดของหน้าฟอร์มมาเก็บใน $requestData
        $requestData = $request->all();
        //ดึงข้อมูลเก่าออกมาก่อน 
        $staff = Staff::findOrFail($id);
        //อัพเดทข้อมูลใหม่
        $staff->update($requestData);
        //เด้งไปหน้า /staff
        return redirect('staff');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //ลบข้อมูลตาม primary key id ที่ระบุ
        Staff::destroy($id);
        //เด้งไปหน้า /staff
        return redirect('staff');
    }
}
