<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PdfReport;
use Carbon\Carbon;
use App\Models\Auth\Role\Role;
use App\Models\Auth\User\User;
use App\Models\Online_library;
use App\Models\onlineBook_cat;
use Ramsey\Uuid\Uuid;
use Validator;
use App;
use File;

use Barryvdh\DomPDF\Facade as PDF;

class OnlineBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Online_librarys = Online_library::all();
        return view('admin.online_book.index', compact('Online_librarys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.online_book.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Online_library $Book, onlineBook_cat $Book_cat)
    {
        $bookVals = DB::select('select * from online_library ORDER BY id DESC LIMIT 1');
        
        $lastid = 0;
        foreach($bookVals as $bookVal)
        {
            $lastid=$bookVal->id;
        }
        $lastid=$lastid+1;

        $pdf_name="panding";
        $file=$request ->file('book_PDF');
        $type=$file->guessExtension();
        $pdf_name=$lastid."onlineBookpdf.".$type;
        $file->move('image/onlineBook/pdf',$pdf_name);
        
        $pic_name="panding";
        $file=$request ->file('book_image');
        $type=$file->guessExtension();
        $pic_name=$lastid."onlineBook.".$type;
        $file->move('image/onlineBook/pic',$pic_name);

        $Book->authorid=$request->get('book_author');
        $Book->bookname=$request->get('book_name');
        $Book->pdf_doc=$pdf_name;
        $Book->book_pic=$pic_name;
        $Book->book_published_year=$request->get('book_year');
        $Book->save();
       
        $bookVals = DB::select('select * from online_library ORDER BY id DESC LIMIT 1');
        
        foreach($bookVals as $bookVal)
        {
            $lastid=$bookVal->id;
        }
        $checkid =$request->input('ids') ;
       $IDcount=count($checkid);
       for($i=0; $i<$IDcount; $i++ )
       {
        DB::insert('INSERT INTO `onlinebookcat` ( `bookid`,`book_cat_id`) VALUES ( ?,?)',[  $lastid,$checkid[$i]]);
       }
        return view('admin.online_book.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Online_library $bookonline)
    {
        // $file='art.PNG';
        // $filename= public_path().'/img/'.$file;
        // File::delete($filename);
        return view('admin.online_book.show',['bookonlines' => $bookonline]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Online_library $bookonline)
    {
        return view('admin.online_book.edit',['books' => $bookonline]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Online_library $bookonline)
    {
        $Booksonline = DB::select('select * from online_library where id ='.$request['id']);
        if ($request->get('book_image')===null)
            {
                if ($request->get('book_PDF')===null)
                { 
                foreach($Booksonline as $Book)
                {
                    $sname=$Book->bookname;
                    if(($sname==$request['name']) ) 
                    {
                    $message = 'Nothing to update';
                    return redirect()->intended(route('admin.online_book.edit',[$request->id]))->with('message', $message);
                    }
                    else
                    {
                        DB::table('online_library')
                        ->where('id', $request['id'])
                        ->update(['bookname' => $request['name']]);
                    return view('admin.online_book.success');
                    }
                }
                }
                else
                {
                    $file="panding";
                    $lastid= "panding";
                    foreach($Booksonline as $Book)
                    {
                    $file=$Book->pdf_doc;
                    $lastid= $Book->id;
                    }
                    $filename= public_path().'/image/onlineBook/pdf/'.$file;
                    File::delete($filename);
                    

                    $file="panding";
                    $pdf_name="panding";
                    $file=$request ->file('book_PDF');
                    $type=time() . '.' .$file->guessExtension();
                    $pdf_name=$lastid."onlineBookpdf.".$type;
                    $file->move('image/onlineBook/pdf',$pdf_name);

                    DB::table('book')
                        ->where('id', $request['id'])
                        ->update(['bookname' => $request['name']]);
                    return view('admin.online_book.success');
                    
                }
            }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Online_library $bookonline)
    {
        return view('admin.online_book.delete',['books' => $bookonline]);
    }
    public function sedelete(Request $request)//Request $request, Employee $employee
    {
        $Booksonline = DB::select('select * from online_library where id ='.$request['id']);
        
        $file="panding";
        $lastid= "panding";
        foreach($Booksonline as $Book)
        {
        $file=$Book->pdf_doc;
        $lastid= $Book->id;
        }
        $filename= public_path().'/image/onlineBook/pdf/'.$file;
        File::delete($filename);
        
        DB::table('online_library')->where('id', $request['id'])->delete();
         return view('admin.online_book.success');
    }
}
