<!DOCTYPE html>
<html>

<head>
    <title>coming soon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            background-color: black;
            color: white;
        }

        p {
            font-size: 30px;
            color: orange;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="w3-display-middle">
        <h1 class="w3-jumbo w3-animate-top w3-center"><code>WelCome User</code></h1>
        <h1 class="w3-center w3-animate-zoom">🚧🚧🚧🚧</h1>

        <!-- <h6 class="w3-center w3-animate-zoom"><code>Logout</code></h6> -->

        <a class="w3-center w3-animate-zoom" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i>
            <span>Logout</span>
        </a>

        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</body>

</html>