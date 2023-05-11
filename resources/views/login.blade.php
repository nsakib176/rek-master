<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #000;
        }

        #slider {
            overflow: hidden;
            position: relative;
        }

        .slides {
            margin-left: 581px;
            width: 70%;
            overflow: hidden;
            animation-name: fade;
            animation-duration: 1s;
            display: none;
           

        }

        .fade{
            animation: fade 1s ease-in-out forwards
        }

        @keyframes fade{
            from{
                opacity: 0;
            }
            to{
                opacity: 1;
            }
        }





        img {
            width: 100%;
        }

        #dot {
            margin: 0 auto;
            text-align: center;
        }

        .dot {
            display: inline-block;
            border-radius: 50%;
            background: #d3d3d3;
            padding: 8px;
            margin: 10px 5px;
        }

        .active {
            background: black;
        }

        @media (max-width: 567px) {
            #slider {
                width: 100%;
            }
        }

        #login-container {
            position: absolute;
            top: 0;
            left: 0;
            /* right: 0; */
            width: 43%;
            height: 100%;
            background-color: #000;
            transform: skew(197deg);
            display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
        }

        #login-form {
            margin-left: 7vw;
            transform: skew(343deg);
            width: 100%;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        input {

            border: none;
            border-radius: 5px;

        }

        .login_frm_data{
            width: 86%;
        }

        .login_frm_data .form-group {
        
            height: 60px;
            border: none !important;
            border-radius: 5px;
            background: #f3f3f3;
            padding: 0 25px;
            color: rgba(36, 35, 38, 0.37);
            margin: 0 0 20px;
        }

        .login_frm_data button[type="submit"] {
            width: 100%;
        
            background: #ff0000;
            text-align: center;
            color: #fff;
            border-radius: 5px;
            height: 60px;
            font-size: 20px;
            transition: all 0.25s;
            border: none;
            cursor: pointer;
            margin: 0 25px 40px 0;
        }

        .cancel_btn {
            width: 100%;
            flex-grow: 1;
            line-height: 60px;
            border: 1px solid #fff;
            border-radius: 5px;
            text-align: center;
            background: transparent;
            font-size: 20px;
            color: #fff;
            margin: 0 0 40px;
            transition: all 0.25s;
            text-decoration: none;
        }

        *:focus {
            outline: none;
        }

        /* moodel code */

        .register-model {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000000;
        }

        .model-content {
            background: #000;
            padding: 20px;
            border-radius: 5px;
           
            width: 70%;
            font-size: 20px !important;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .col {
            flex: 1;
            padding: 0 10px;
        }

        label {
            color: white;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            background: #ff0000;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .close-model {
            background: red;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
   <style>
    /* The container */
    .container {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      font-weight: bold
    }
    
    /* Hide the browser's default checkbox */
    .container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }
    
    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 8px;
      margin-top: 3px
    }
    
    /* On mouse-over, add a grey background color */
    .container:hover input ~ .checkmark {
      background-color: white;
    
    }
    
    /* When the checkbox is checked, add a blue background */
    .container input:checked ~ .checkmark {
      background-color: white;
    }
    
    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }
    
    /* Show the checkmark when checked */
    .container input:checked ~ .checkmark:after {
      display: block;  
    }
    
    /* Style the checkmark/indicator */
    .container .checkmark:after {
    
      width: 65%;
      height: 65%;
       background-color: red;
       border-radius:4px;
     
      
    }
    </style>
</head>

<body>

    
    <div id="slider">
        <div id="login-container">
            <div id="login-form">
                <form action="{{ url('savelogindata') }}" method="post" class="login_frm_data" autocomplete="off" id="login_frm_data">
                    @csrf
                    <!-- <a href="#" id="open-model" class="" style="color: #fff;">Open model</a> -->
                    <h1 style="text-align: left; color:#fff"><img src="https://retinaweb.net/rek/wp-content/themes/cms/img/logo-rek-productions.png" alt=""></h1>
                    <br><br>
                    <div class="col-lg-12">
                        @include('flash')
                    </div>
                    <br>
                    <input class="form-group" type="text" placeholder="Enter email" name="email" autocomplete="off">
                    <input class="form-group" type="password" placeholder="Password" name="password" autocomplete="off">
                    <div style="display: flex; justify-content: center;width: 100%;">
                        <button type="submit">Enter</button>
                        <!-- <a href="{{route('register')}}" class="cancel_btn">Register</a> -->
                        <a href="#" id="open-register-model" class="cancel_btn" style="color: #fff;">Register</a>
                    </div>

                    <div style="display: flex;justify-content: space-between;width:100%">

                       
                        <div class="left">
                            <label class="container">Remember
                                <input type="checkbox" checked="checked">
                                <span class="checkmark"></span>
                              </label>
                        </div>

                        <style>
                            .txt_link{
                                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

                                font-size: 17px;
                                


                            }

                            a{
                                color: white !important;
                                text-decoration: none !important;
                                font-weight: bold;
                            }
                        </style>

                        <div class="right" style="
                        display: flex;
                        flex-direction: column;
                        justify-content: flex-end;
                        align-items: flex-end;
                    ">
                            

                            <div class="txt_link" style="display: flex; justify-content: center; color:#fff;">
                                First access? <a class="auth_links" href="">&nbsp Click Here !</a>

                            </div>
                            <div class="txt_link" style="display: flex; justify-content: center; color:#fff">
                                Forgot your password? <a class="auth_links" href="">&nbsp Click Here !</a>

                            </div>      
                        </div>


                    </div>

                </form>
            </div>
        </div>
        <div>
            <div class="slides">
                <img src="{{ asset('assets/images/body1.png')}}" width="100%" />
            </div>
            <div class="slides">
                <img src="{{ asset('assets/images/body2.png')}}" width="100%" />
            </div>
            <div class="slides">
                <img src="{{ asset('assets/images/body3.png')}}" width="100%" />
            </div>
            <div id="dot" style="display: none;">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </div>



    <!-- Registration form -->
    <!-- <a href="#" id="open-model" class="" style="color: #fff;">Open model</a> -->


    <style>
        .flex_cont{
            display: flex;
            width: 100%;
            gap: 20px;

        }
        .input_cont{
            width: 100%;
        }
        .input_cont > input,.input_cont > select{
            height: 45px;
            width: 100%;
            border-radius: 5px;
        }
        .model-content{
            padding: 50px !important;
        }
    </style>

    <div class="register-model">
        <div class="model-content">
            <span class="close-model" style="float: right;">&times; </span>
            <h1 style="text-align: left; color:#fff;display: flex;justify-content: center;"><img style="width: 200px !important;margin:auto" src="https://retinaweb.net/rek/wp-content/themes/cms/img/logo-rek-productions.png" alt=""></h1>
            <h2 style="text-align: center; color:#fff">Register</h2>
            <br>
            <form action="{{ url('saveuserdata') }}" method="post" class="register_form" autocomplete="off" id="register_form" style="color:#f3f3f3;">
            @csrf
                <div class="flex_cont">
                    <div class="input_cont">
                        <label for="name">Name</label>
                        <input type="text" class="form-group" name="full_name" id="full_name" placeholder="" />
                    </div>
                    <div class="input_cont">
                        <label for="email">Email</label>
                        <input type="email" class="form-group" name="email" id="email" placeholder="" />
                    </div>
                </div>

                <br>
                <div class="flex_cont">
                    <div class="input_cont">
                        <label for="password">Password</label>
                        <input type="text" class="form-group" name="password" id="password" placeholder="" />
                    </div>
                    <div class="input_cont">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="text" class="form-group" name="password_confirmation" autocomplete="new-password" placeholder="">
                    </div>
                </div>
                <br>
                <div class="flex_cont">
                    <div class="input_cont">
                        <label for="mobile">Phone</label>
                        <input type="text" class="form-group" name="mobile" id="phone" placeholder="" />
                    </div>
                    <div class="input_cont">
                        <label for="password_confirmation">Category</label>
                      
                        <select class="form-group" name="category_id" id="Category">
                            <option value="weddings" selected="" _msttexthash="158860" _msthash="41">Weddings</option>
                            <option value="pregnant" _msttexthash="114517" _msthash="42">Pregnant</option>
                            <option value="debutantes" _msttexthash="158405" _msthash="43">Debutantes</option>
                            <option value="birthdays" _msttexthash="233103" _msthash="44">Birthdays</option>
                            <option value="social-events" _msttexthash="257088" _msthash="45">Social Events</option>
                            <option value="graduations" _msttexthash="160745" _msthash="46">Graduations</option>
                            <option value="book-studio" _msttexthash="203229" _msthash="47">Book Studio</option>
                            <option value="external-book" _msttexthash="180661" _msthash="48">External Book</option>
                            <option value="new-born" _msttexthash="92352" _msthash="49">New Born</option>
                            <option value="smash-the-cake" _msttexthash="189644" _msthash="50">Smash The Cake</option>
                            <option value="pre-wedding" _msttexthash="166634" _msthash="51">Pre Wedding</option>
                            
                        </select>
                
                    </div>
                </div>
                <br>

                <div style="width: 100%;justify-content: flex-start">
                    <div class="flex_cont" style="width: 50% !important">
                        <div class="input_cont">
                            <label for="date">Event Date</label>
                            <input type="date" class="form-group" name="data" id="date" placeholder="" />
                        </div>
                        <div class="input_cont">
                            <label for="password_confirmation">How did you meet us?</label>
                          
                            <select class="form-group" name="meet_type" id="Category">
                                <option value="facebook" selected="">Facebook</option>
                                <option value="instagram">Instagram</option>
                                <option value="youtube">Youtube</option>
                                <option value="google">Google</option>
                                <option value="recomendacao">Recomendação</option>
                                <option value="outros">Outros</option>
                            </select>
                    
                        </div>
                    </div>
                </div>


                <br>

               

                <div style="width: 100%;">
                    <button type="submit" style="width: 100%;padding:10px;height: 50px;">Register</button>
                </div>
                
            </form>

        </div>
    </div>



    <script>
        var index = 0;
        var slides = document.querySelectorAll(".slides");
        var dot = document.querySelectorAll(".dot");

        function changeSlide() {
            if (index < 0) {
                index = slides.length - 1;
            }
            if (index > slides.length - 1) {
                index = 0;
            }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
                slides[i].classList.remove("fade");
                dot[i].classList.remove("active");
            }
            slides[index].style.display = "block";
            slides[index].classList.add("fade");
            dot[index].classList.add("active");
            index++;
            setTimeout(changeSlide, 2000);
        }
        changeSlide();
    </script>
    <script>
        window.onload = function() {
            document.getElementById("login_frm_data").reset();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script>
        var openBtn = document.getElementById("open-register-model");
        var closeBtn = document.getElementsByClassName("close-model")[0];
        var registerModel = document.getElementsByClassName("register-model")[0];

        openBtn.onclick = function() {
            registerModel.style.display = "flex";
        }

        closeBtn.onclick = function() {
            // $('.register-model').css('display','none');
            registerModel.style.display = "none";
        }
    </script>

</body>

</html>