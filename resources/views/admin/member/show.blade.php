@extends('admin.layouts.admin')

@section('title', __( "Book Management", ['name' => $book->name]))

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>
            <tr>
                <th>{{ __('views.admin.users.show.table_header_0') }}</th>
                <td>
                     <img id="myImg" src="\image\book\pic\{{$book->book_pic}}" alt="Snow" style="width:100%;max-width:200px">{{-- {{ $employee->avatar }} --}}
                    <div id="myModal" class="modal">
                        <span class="close">&times;</span>
                        <img class="modal-content" id="img01">
                        <div id="caption"></div>
                      </div>
                      
            </tr>

            <tr>
                <th>{{ __('views.admin.users.show.table_header_1') }}</th>
                <td>{{ $patient->name }}</td>
            </tr>

            <tr>
                <th>E-Mail</th>
                <td>
                    {{-- <a href="mailto:{{ $patient->patientType }}"> --}}
                    {{ $patient->email }}
                    {{-- </a> --}}
                </td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>
                    {{-- <a href="mailto:{{ $patient->patientType }}"> --}}
                    {{ $patient->Gender}}
                    {{-- </a> --}}
                </td>
            </tr>

            <tr>
                <th>NIC</th>
                <td>
                    {{ $patient->nic }}
                </td>
            </tr>

            <tr>
                <th>Address</th>
                <td>
                    {{ $patient->address }}
                </td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td>
                    {{ $patient->mobile }}
                </td>
            </tr>


            <tr>
                <th></th>
                <td><a href="{{ URL::previous() }}" class="btn btn-light"><i class="fa fa-arrow-left"></i> Go Back</a></td>
                {{-- href="{{ route('admin.patients') }}" --}}
            </tr>
            </tbody>
        </table>
    </div>
    <script>
            // Get the modal
            var modal = document.getElementById('myModal');
            
            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById('myImg');
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }
            
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];
            
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() { 
                modal.style.display = "none";
            }
            </script>
@endsection