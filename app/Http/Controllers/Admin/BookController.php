<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\Models\Book_category;
use App\Models\Book;
use App\Models\Book_cat;
use App\Models\Fine_fee;

use Illuminate\Support\Facades\DB;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Books = Book::all();
      
        return view('admin.book.index', compact('Books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.add');
    }

    public function createbook_category()
    {
        return view('admin.book.addbook_category');
    }
    public function store_book_category(Request $request,Book_category $Bookc)
    {   
        $Bookc->book_category_name=$request->get('book_category_name');
        $Bookc->save();
        
        return view('admin.book.success');
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Book $Book, Book_cat $Book_cat,Fine_fee $Fine_fee)
    {
        $pic_name="panding";
        $file=$request ->file('book_image');

        $bookVals = DB::select('select * from book ORDER BY id DESC LIMIT 1');
        $type=$file->guessExtension();
        $lastid = 0;
        foreach($bookVals as $bookVal)
        {
            $lastid=$bookVal->id;
        }
        $lastid=$lastid+1;
        $pic_name=$lastid."book.".$type;
        $file->move('image/book/pic',$pic_name);

        $Book->authorid=$request->get('book_author');
        $Book->bookname=$request->get('book_name');
        $Book->book_quantity_full=$request->get('book_quantity');
        $Book->book_quantity_now=$request->get('book_quantity');
        $Book->book_pic=$pic_name;
        $Book->book_published_year=$request->get('book_year');
        $Book->save();

        $bookVals = DB::select('select * from book ORDER BY id DESC LIMIT 1');
        
        foreach($bookVals as $bookVal)
        {
            $lastid=$bookVal->id;
        }
       
        $Fine_fee->bookcatid=$lastid;
        $Fine_fee->fee_per_day=$request->get('fine_fee');
        $Fine_fee->save();

        $checkid =$request->input('ids') ;
       $IDcount=count($checkid);
       for($i=0; $i<$IDcount; $i++ )
       {
        DB::insert('INSERT INTO `book_cat` ( `bookid`,`book_cat_id`) VALUES ( ?,?)',[  $lastid,$checkid[$i]]);
       }
        return view('admin.book.success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('admin.book.show',['books' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('admin.book.edit',['books' => $book]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Book $book)
    {
        $Books = DB::select('select * from book where id ='.$request['id']);
        
        if ($request->get('book_image')===null)
            {
                
          foreach($Books as $Book)
          {
              $sname=$Book->bookname;
              if(($sname==$request['name']) ) 
              {
              $message = 'Nothing to update';
              return redirect()->intended(route('admin.book.edit',[$request->id]))->with('message', $message);
              }
              else
              {
                DB::table('book')
                ->where('id', $request['id'])
                ->update(['bookname' => $request['name']]);
            
                return view('admin.book.success');
              }
          }
        }

       $file=$request ->file('book_image');

        $bookVals = DB::select('select * from book ORDER BY id DESC LIMIT 1');
        $type=$file->guessExtension();
        $lastid = $request['id'];
        
        $pic_name=$lastid."book.".$type;
        $file->move('image/book/pic',$pic_name);

        DB::table('book')
        ->where('id', $request['id'])
        ->update(['bookname' => $request['name'],'book_pic' => $pic_name]);

    return view('admin.book.success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response Request $request,Book $book
     */
    public function destroy(Book $book)
    {
        return view('admin.book.delete',['books' => $book]);
    }
    public function sedelete(Request $request)//Request $request, Employee $employee
    {
        DB::table('book')->where('id', $request['id'])->delete();
         return view('admin.book.success');
    }
}
