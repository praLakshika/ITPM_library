<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Book_author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Book_authors=Book_author::all();
        return view('admin.author.index', compact('Book_authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.author.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Book_author $Book_author)
    {
        $pic_name="panding";
        $file=$request ->file('author_image');

        $authorVals = DB::select('select * from book_author ORDER BY id DESC LIMIT 1');
        $type=$file->guessExtension();
        $lastid = 0;
        foreach($authorVals as $authorVal)
        {
            $lastid=$authorVal->id;
        }
        $lastid=$lastid+1;
        $pic_name=$lastid."member.".$type;
        $file->move('image/author/pic',$pic_name);

       $Book_author->name = $request->get('author_name');
       $Book_author->birthday = $request->get('birthday');
       $Book_author->address = $request->get('author_address');
       $Book_author->pic = $pic_name;
       $Book_author->email = $request->get('email');
       $Book_author->contact = $request->get('contact');
       $Book_author->save();
       
       return view('admin.author.success');
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
    public function destroy($id)
    {
        //
    }
}
