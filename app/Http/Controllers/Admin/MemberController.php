<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PdfReport;
use Carbon\Carbon;
use App\Models\Auth\Role\Role;
use App\Models\Auth\User\User;
use App\Models\Member;
use Ramsey\Uuid\Uuid;
use Validator;
use App;
use Barryvdh\DomPDF\Facade as PDF;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::all();
        return view('admin.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Member $Member)
    {
        $pic_name="panding";
        $file=$request ->file('mer_pic');

        $memberVals = DB::select('select * from member ORDER BY id DESC LIMIT 1');
        
        $type=$file->guessExtension();
        $lastid = 0;
        foreach($memberVals as $memberVal)
        {
            $lastid=$memberVal->id;
        }
        $lastid=$lastid+1;
        $pic_name=$lastid."member.".$type;
        $file->move('image/member/pic',$pic_name);

        $Member->name=$request->get('name');
        $Member->nic=$request->get('nic');
        $Member->mbr_pic=$pic_name;
        $Member->contact=$request->get('contact');
        $Member->email=$request->get('email');
        $Member->birthday=$request->get('birthday');
        $Member->address=$request->get('address');
        $Member->address=$request->get('address');
        $Member->save();

        return view('admin.member.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        return view('admin.member.delete',['member' => $member]);
    }
    public function sedelete(Request $request)//Request $request, Employee $employee
    {
        DB::table('member')->where('id', $request['id'])->delete();
         return view('admin.member.success');
    }
}
