<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contacts Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">ISMENA</a>

    </div>
</nav>

@if(!empty($message))<div class="alert alert-danger" role="alert" style="width: 300px;position: absolute;
    right: 0;" id="alertmessage"> {{$message}} </div>@endif

<div class="container-fluid">
    <h1 style="text-align: center;">Contacts Information</h1>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addModal" style="float: right;">
    Add
</button><table id="contactinfo" class="table table-striped" style="width:100%">
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach( $contacts as $contact )
    <tr>

        <td>{{$contact->FirstName}}</td>
        <td>{{$contact->LastName}}</td>
        <td>{{$contact->Email}}</td>
        <td>{{$contact->PhoneNumber}}</td>
        <td>
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                </button>
                <ul class="dropdown-menu">
                    <li><!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#UpdateModal" onclick="Update('{{$contact->id}}','{{$contact->FirstName}}','{{$contact->LastName}}','{{$contact->Email}}','{{$contact->PhoneNumber}}');">
                            Update
                        </button>
                    </li>
                    <li>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="Delete('{{$contact->id}}');">
                            Delete
                        </button>
                    </li>

                </ul>
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>





<a href="{{url('/SendEmail')}}"> send email </a>


<!-- Update Modal -->
<div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="UpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{url('/UpdateContact')}}" method="post">
            @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="UpdateModalLabel">Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control mb-3" name="id" id="UpdatedID" type="text" readonly hidden>
                <input class="form-control mb-3" name="firstname" id="UpdatedFN" type="text" placeholder="First Name">
                <input class="form-control mb-3" name="lastname" id="UpdatedLN" type="text" placeholder="Last Name">
                <input class="form-control mb-3" name="text" id="UpdatedE" type="email" placeholder="Email">
                <input class="form-control mb-3" name="phonenumber"  id="UpdatedPN"type="tel" placeholder="Phone Number">
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-dark w-100">Update</button>
            </div>
        </div>
            </form>
    </div>
</div>




<!-- ADD Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{url('/AddContact')}}" method="post">
            @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Add</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <input class="form-control mb-3" name="firstname" type="text" placeholder="First Name">
                <input class="form-control mb-3" name="lastname" type="text" placeholder="Last Name">
                <input class="form-control mb-3" name="email" type="text" placeholder="Email">
                <input class="form-control mb-3" name="phonenumber" type="tel" placeholder="Phone Number">
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-dark w-100">Add</button>
            </div>
        </div>
        </form>
    </div>
</div>






<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{url('/DeleteContact')}}" method="post">
            @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control mb-3" name="id" id="DeletedID" type="text" readonly hidden>
                <p>Are you sure you want to delete this contact?</p>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-danger w-100">Delete</button>
            </div>
        </div>
        </form>
    </div>
</div>














<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#contactinfo').DataTable();
    });
    function Delete(id) {
        document.getElementById('DeletedID').value = id;
    }
    function Update(id, fname , lname , email , phone) {
        document.getElementById('UpdatedID').value = id;
        document.getElementById('UpdatedFN').value = fname;
        document.getElementById('UpdatedLN').value = lname;
        document.getElementById('UpdatedE').value = email;
        document.getElementById('UpdatedPN').value = phone;
    }
    if ($('#alertmessage').length){
        $("#alertmessage").fadeOut(5000);
    }
</script>
</body>
</html>
