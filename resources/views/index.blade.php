<html>
    <head>
        <title>Facebook-log in or sign up</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
          <link rel="shortcut icon" href="<?php echo asset('images/logo.png'); ?>" />
          <link rel="stylesheet" href="<?php echo asset('css/index.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('css/font-awesome.min.css')?>">
    </head>

    <body>
      <!-- Head And Navbar section -->
      <div class="head-navbar">
        <div class="container">
          <div class="row">
            <div class="title col-lg-7 col-md-6 col-sm-6">
              <h1>facebook</h1>
            </div>
            <div class="nav-form col-lg-5 col-md-6 col-sm-6">
              <form>
                <table>
                  <tr>
                    <th>
                      <label>Email</label><br>
                      <input type="email" name="emailForLogin" id="emailForLogin">
                    </th>
                    <th>
                      <label class="inpt">Password</label><br>
                      <input type="password" class="inpt" name="passwordForLogin" id="passwordForLogin">
                    </th>
                    <th>
                      <br>
                      <button type="submit" id="loginBtnFun">Login</button>
                    </th>
                  </tr>
                </table>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Content section -->
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="info col-lg-6 col-md-6 col-sm-6" id="b-navbar-fg" onresize="myFunction()">
              <br>
              <p>Facebook helps you connect and share with the people in your life.</p>
              <img src="<?php echo asset('images/social.png'); ?>">
                <div id="result"><!-- Here Will Show The Errors --></div>
            </div>
            <div class="account col-lg-6 col-md-6 col-sm-6">
              <br><br>
              <h2>Create an account</h2>
              <p>It's quick and easy.</p>
              <br>
              <form>
                <div class="signUpForm">
                  <input class="form-control" type="text" placeholder="Fullname" name="fullname" id="fullname">
                  <input class="form-control" type="email" placeholder="email address" name="email" id="email">
                  <input class="form-control" type="password" placeholder="New password" name="password" id="password">
                  <p>Date of birth</p>
                  <table class="text-center">
                    <tr>
                      <th>
                        <select name="day" id="day">
                          @for( $i=1 ; $i<=31 ; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                          @endfor
                        </select>
                      </th>
                      <th>
                        <select name="month" id="month">
                          <option value="Jan">Jan</option>
                          <option value="Feb">Feb</option>
                          <option value="Mar">Mar</option>
                          <option value="Apr">Apr</option>
                          <option value="May">May</option>
                          <option value="Jun">Jun</option>
                          <option value="Jul">Jul</option>
                          <option value="Aug">Aug</option>
                          <option value="Sept">Sept</option>
                          <option value="Oct">Oct</option>
                          <option value="Nov">Nov</option>
                          <option value="Dec">Dec</option>
                        </select>
                      </th>
                      <th>
                        <select name="year" id="year">
                          @for( $i =date("Y") ; $i >= 1905 ; $i--)
                            <option value="{{$i}}"> {{$i}} </option>
                          @endfor
                        </select>
                      </th>
                    </tr>
                  </table>
                  <p>Gender</p>
                  <div class="form-group">
                      <input type="radio" id="gender" name="gender" value="Female">
                      <label for="Female">Female</label>
                      <input type="radio" id="gender" name="gender" value="Male">
                      <label for="Male">Male</label>
                  </div>
                  <h6>
                    By clicking Sign Up, you agree to our <span> Terms, Data Policy </span>and <span> Cookie Policy</span>.
                    You may receive SMS notifications from us and can opt out at any time.
                  </h6>
                  <br>
                  <button type="submit" id="signUpBtnFun">Sign Up</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
              integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
              crossorigin="anonymous"></script>
      <script>
          // sign up ajax function
          $('#signUpBtnFun').on('click', function(e){
              e.preventDefault();
              let data ={
                  '_token' : '{{csrf_token()}}' ,
                  'fullname' : $('#fullname').val() ,
                  'email' : $('#email').val() ,
                  'password' : $('#password').val() ,
                  'day' : $('#day').val() ,
                  'month' : $('#month').val() ,
                  'year' : $('#year').val() ,
                  'gender' : $('#gender').val()
              } ;

              $.ajax({
                  url : "{{ url('/signUp') }}" ,
                  method : "POST" ,
                  dataType : "json" ,
                  data : data ,
                  success:function(dataBack){
                     if(dataBack.msg == 0){
                         alert('This Account Already Exist');
                         $('#result').hide();
                     }else if(dataBack.msg == 1){
                         alert('Account is created successfully , Please Login Now .');
                         $('#fullname').val('');
                         $('#email').val('') ;
                         $('#password').val('');
                     }
                  },error:function(xhr , status , error){
                      $('#result').html('');
                      $.each(xhr.responseJSON.errors , function(key , item){
                          $('#result').append("<div class=\"alert alert-danger\" role=\"alert\">" + item + " </div>");
                      });
                  }
              });
          });

          // login ajax function
          $('#loginBtnFun').on('click', function(e) {
              e.preventDefault();

              let data = {
                  '_token' : '{{csrf_token()}}' ,
                  'emailForLogin' : $('#emailForLogin').val() ,
                  'passwordForLogin' : $('#passwordForLogin').val()
              }

              $.ajax({
                  url : "{{ url('/login') }}" ,
                  method : "POST" ,
                  dataType : "json" ,
                  data : data ,
                  success:function(dataBack){
                      if(dataBack.msg == 0){
                          window.location.href = "home";
                      }else if(dataBack.msg == 1){
                          alert('Username Or Password is wrong');
                      }
                  },error:function(xhr , status , error){
                      $.each(xhr.responseJSON.errors , function(key , item){
                          alert(item)
                      });
                  }
              });

          });
      </script>
    </body>

</html>
