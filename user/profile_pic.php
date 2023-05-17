<?php
    include("../session.php");
    include("../conn.php");

    $id = $_SESSION['id'];
    $query = "SELECT Profile_pic FROM user WHERE ID = $id";
    $result = mysqli_query($con, $query);
    $profile_pic = mysqli_fetch_assoc($result);
?>


<div class="shadow p-5 pt-4">
<img src="profile/<?php echo $profile_pic['Profile_pic']?>" class="img-thumbnail thumbnail" alt="..." id="preview">
    <form action="" method="" id="edit-pic">
    <input type="hidden" name="id" value='<?php echo $_SESSION['id'] ?>'>
        <div class="mx-auto">
        <label for="" class="form-label">Profile Picture</label>
            <input id="profile-pic" class="form-control" type="file" name="profile-pic">
        </div>
        <div class="col-md-6 mt-2 mx-auto text-center pt-3">
            <input type="hidden" name="edit-profile-picture" value="1">
            <button class="btn btn-primary" name="edit" style="width: 10vh;">
                SAVE
            </button>
        </div>
    </form>
</div>

<script>
        $(document).ready(function() {
        $('#edit-pic').submit(function(e) {
            e.preventDefault();
            var form_data = $(this).serializeArray();
            var form_data = new FormData($(this)[0]);
            var file = document.forms['edit-pic']['profile-pic'].files[0];
            const file_name = file.name;
            //form_data.push({name: "profile-pic", value: file_name})
            form_data.append('profile-pic', file_name);
            $.ajax({
                type: 'POST',
                url: 'update_profile.php',
                processData: false,
                contentType: false,
                data:  form_data,
                success: function(response) {
                    console.log("Test");
                    console.log('Response:', response);
                    var data = JSON.parse(response);
                    if (data.response == 'Success') {
                        alert("Success");
                        document.getElementById("preview").src = "/FWDD-KON-QUIZ/user/profile/" + data.type;
                    }
                    else {
                        alert("Failed");
                    }
                }
            });
        });
    });
</script>