<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>My Form</title>
    <style>
        body {
            background-color: #f2f2f2;
        }

        form {
            background-color: white;
            width: 400px;
            padding: 20px;
            border-radius: 5px;
            margin: 0 auto;
            margin-top: 100px;
            box-shadow: 0px 0px 10px #aaa;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            margin-top: 5px;
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 0px 5px #aaa;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        .error_color {
            color: #d70000;
        }
    </style>
</head>

<body>



    <form action="{{url('update_user')}}" method="POST">
        @csrf
        <h1>Edit User</h1>
        <div class="col-lg-12">
            @include('flash')
        </div>
        <br>

        <input type="hidden" id="id" name="id" required value="{{$get_details->id}}">

        <label for="name">Name:</label>
        @error('full_name')
        <div class="alert alert-danger error_color">{{ $message }}</div>
        @enderror

        <input type="text" id="full_name" name="full_name" value="{{$get_details->full_name}}">
        @error('full_name')
        <div class="alert alert-danger error_color">{{ $message }}</div>
        @enderror
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required value="{{$get_details->email}}">
       

        <label for="mobile">Mobile:</label>
        @error('mobile')
        <div class="alert alert-danger error_color">{{ $message }}</div>
        @enderror
        <input type="tel" id="mobile" name="mobile" required value="{{$get_details->mobile}}">

        <input type="submit" value="Update">
        <a href="{{url('alluserlist')}}">Cancel </a>
        
    </form>
</body>

</html>