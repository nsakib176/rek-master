<!DOCTYPE html>
<html>

<head>
    <title>USer List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link rel="stylesheet" href="{{asset('jquery-datatables/jquery.dataTables.bootstrap5.min.css')}}">
    <link rel='stylesheet' href="{{asset('css/sweetalert/sweetalert2.min.css')}}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Inter", sans-serif;
            color: #343a40;
            line-height: 1;
            display: flex;
            justify-content: center;
        }

        table {
            /* width: 800px; */
            margin-top: 100px;
            font-size: 18px;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 16px 50px;
            text-align: left;
        }

        thead tr {
            background-color: #087f5b;
            color: #fff;
        }

        thead th {
            width: 25%;
        }

        tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        tbody tr:nth-child(even) {
            background-color: #e9ecef;
        }

        .w3-display-middle {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }

        .h6-cls-middle {
            position: absolute;
            top: 15%;
            left: 45%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <div class="w3-display-middle">
        <h3 class="h6-cls-middle">
            User List
            <div class="col-lg-12 ResponseMessage">
                @include('flash')
            </div>
        </h3>

        <a class="w3-center w3-animate-zoom" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();">
            <i class="fa fa-sign-out"></i>
            <span>Logout</span>
        </a>

        <form id="admin-logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <br>
        <table id="users_table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cnt = 1;
                ?>
                @forelse($get_all_user as $user)
                <tr>
                    <th>{{ $cnt++}}</th>
                    <td>{{ $user->full_name ?? ''}}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mobile }}</td>
                    <td>
                        <a href="{{ url('user/edit/'.$user->id)}}" title="Edit contest">Edit</a> |
                        <a href="javaScript:void(0)" title="Delete User" onclick="delete_record('{{$user->id}}','users')">Delete</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No users found.</td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</body>

<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('jquery-datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('jquery-datatables/custom.jquery.dataTables.bootstrap5.min.js')}}"></script>
<script src="{{ asset('js/sweetalert/sweetalert2.all.min.js')}}"></script>



<script>
    $(document).ready(function() {
        $('#users_table_').DataTable();
    });
</script>
<script>
    var cutom_url = "{{url('/')}}";
</script>

<script>
    setTimeout(function() {
        $('.ResponseMessage').css("display", "none");
    }, 2500);
</script>


<script>
    function delete_record(id, tablename) {
        console.log(id, tablename);
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this " + tablename + "!",
            type: "warning",
            showDenyButton: true,
            confirmButtonText: `YES, DELETE IT!`,
            denyButtonText: `No, cancel plx!`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                $.ajax({
                    type: 'POST',
                    url: cutom_url + "/delete_data",
                    data: {
                        tablename: tablename,
                        id: id,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data) {

                        if (data.status == true) {
                            Swal.fire("Deleted!", "Your " + tablename + "  has been deleted.", "success");
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire("Cancelled", "Something went wrong", "error");
                        }
                    }
                });
            } else if (result.isDenied) {
                Swal.fire("Cancelled", "Your " + tablename + " is safe :)", "error");

            }
        })
    }
</script>

</html>