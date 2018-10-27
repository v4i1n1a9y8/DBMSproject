<?php
include("../database/dbconnect.php");

session_start();
if(isset($_POST["change"]))
{
    updateUser($_SESSION["user_id"],$_POST["password"]);
    $message = "<label>Updated successfully</label>";
}
?>



<div id="profile" class="tab-pane fade">

<form method="post">
  <p ><?php echo $message; ?></p>
  <div class="form-group">
    <label for="pwd">Change Password:</label>
      <input type="password" class="form-control" name="password" required />
  </div>
  <input type="submit" class="btn btn-default" name="change" value="Change" />
</form>

<form method="post">
  <input type="submit" class="btn btn-default" name="deleteuser" value="Delete User"  onclick="deleteUser()"/>
</form> 

</div>
<script>
function deleteUser(id)
    {
        $.ajax({
            type:"POST",
            url:"../database/delete_user.php",
            success:function(data){
            }
        })
    }
</script>