@extends('admin.layouts.admin')
@section('title', "Online Book Management")

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                    @php
    
                    use Illuminate\Support\Facades\DB;
                    $email=auth()->user()->email;
                    $IDs = DB::table('book_author')->where('id', $bookonlines->authorid)->get();
                    $author_name = "pandding";
                        foreach($IDs as $ID)
                        {
                            $author_name=$ID->name;
                            
                        }
                    @endphp
                <th>Book Image</th>
                <td>
                        <img  id="myImg" onclick="displayIMG(this.id)" height="200" width="200" src="\image\onlineBook\pic\{{$bookonlines->book_pic}}" alt={{ $bookonlines->bookname }}>{{-- {{ $employee->avatar }} --}}
                        <div id="myModal" class="modal">
                                <span class="close">&times;</span>
                            <img class="modal-content" id="img01">
                            <div id="caption"></div>
                          </div>
                        {{-- <img height="200" width="200" src="\image\service\item\{{$Services->pic}}" class="user-profile-image"></td> --}}
            </tr>
            <tr>
                    <th>Book PDF doc</th>
                    <td><a class="fas fa-file-pdf-o" href="\image\onlineBook\pdf\{{$bookonlines->pdf_doc}}">Open the pdf!</a></td>
                </tr>
            <tr>
                <th>Book name</th>
                <td>{{ $bookonlines->bookname }}</td>
            </tr>

            <tr>
                    <th>Book author name</th>
                    <td>{{ $author_name }}</td>
                </tr>
            
            <tr>
                <th>Book published year</th>
                <td>
                    {{ ($bookonlines->book_published_year)}} 
                </td>
            </tr>
            </tbody>
        </table>
        <a href="{{ route('admin.online_book',[$bookonlines->id]) }}" class="btn btn-danger">Online Book home</a>
        <a class="btn btn-info" href="{{ route('admin.online_book.edit',[$bookonlines->id]) }}">Edit</a>
    </div>
    <script>
            // Get the modal
            var modal = document.getElementById('myModal');
            // var img=document.getElementById("myImg");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
           
              function displayIMG(clicked_id)
            {
                modal.style.display = "block";
                modalImg.src = document.getElementById(clicked_id).src;
                captionText.innerHTML =document.getElementById(clicked_id).alt;
            }  
            
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() { 
                modal.style.display = "none";
            }
            </script>
            
@endsection