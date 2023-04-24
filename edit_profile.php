<!DOCTYPE html>
<html>
    <head>
        <title>KON Quiz - Edit Profile</title>
        <meta name="description" content="Edit Profile page">


        <style>
            @import url("https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css");
            body{background: #1c0052}
            .form-control:focus{box-shadow: none;border-color: #1c0052}
            .profile-button{background: #1c0052;box-shadow: none;border: none}
            /* .profile-button:hover{background: #682773} */
            .profile-button:focus{background: #1c0052;box-shadow: none}
            .profile-button:active{background: #1c0052;box-shadow: none}
            .back:hover{color: #1c0052;cursor: pointer}
            .labels{font-size: 11px}
        </style>


        <script>
            var pswValidation = function() {
                if (document.getElementById("pass1").value == 
                    document.getElementById("pass2").value) {
                    pass1.style.border = "3px solid green";
                    pass2.style.border = "3px solid green";
                    //document.getElementById('submit').disabled = false;
                } else {
                    pass1.style.border = "3px solid red";
                    pass2.style.border = "3px solid red";
                    //document.getElementById('submit').disabled = true;
                }
            }
        </script>


    </head>
        <body>


        <form action="sign_up.php" method="POST" onsubmit='pswValidation()'>
            <div class="container rounded bg-white mt-5 mb-5">
                <div class="row"> 
                    <div class="col-md-3 border-right"></div>
                        <div class="col-md-6 border-right">
                            <div class="p-3 py-5"> 
                                    <div class="d-flex justify-content-between align-items-center mb-3"> 
                                        <h4 class="text-right">Edit Profile</h4> 
                                    </div> 
                                    <div class="row mt-2"> 
                                        <div class="col-md-6">
                                        <label class="labels">Username</label>
                                        <input type="text" class="form-control" placeholder="Enter Username" name="username" pattern="[A-Za-z0-9]{1,25}" title="Only alphanumeric and not longer than 25 alphabet accepted.">
                                    </div> 
                                    <div class="col-md-6">
                                        <label class="labels">Email</label>
                                        <input type="email" class="form-control" value="" placeholder="Enter Email" name="email"></div> 
                                    </div> 
                                    <div class="row mt-2"> 
                                        <div class="col-md-12">
                                            <label class="labels">Password</label>
                                            <input type="password" class="form-control" placeholder="Enter Password" name="password_1" id="pass1" pattern="(?=.*\d).[A-Za-z0-9_@-]{6,}">
                                        </div> 
                                        <div class="col-md-12 mt-2">
                                            <label class="labels">Confirm Password</label>
                                            <input type="password" class="form-control" placeholder="Confirm Password" name="password_2" id="pass2">
                                        </div> 
                                        <div class="col-md-12 mt-2">
                                            <label class="labels">Gender</label>
                                            <select name="gender" class="form-control" >
                                                <option value="">Please select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <label class="labels">Date of Birth</label>
                                            <input type="date" class="form-control" placeholder="Choose a date" name="DOB">
                                        </div> 
                                        <div class="col-md-12 mt-2">
                                            <label class="labels">Mobile Number</label>
                                            <input type="tel" class="form-control" placeholder="Enter Mobile Number" name="mobile_number">
                                        </div>  
                                    </div> 
                                    <div class="mt-5 text-center">
                                        <button class="btn btn-primary profile-button" type="button" name="submit" id="submit">Save Profile</button>
                                        <button class="btn btn-primary profile-button" type="button">Back</button>
                                    </div> 
                                </div> 
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </form>


        </body>
</html> 