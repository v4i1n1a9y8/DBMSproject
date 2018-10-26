<<!DOCTYPE html>
<html>
<head>

        <?php include("modules/head.php")?>
</head>
<body>

<div class="form-group">
  <button type="submit" class="btn btn-default" onclick="resetdb()">DO NOT PRESS, reset database</button>
</div> 
<script>
  function resetdb()
    {
        $.ajax({
            type:"POST",
            url:"../database/resetdb.php",
            success:function(data){
            }
        })
    }
</script>
</body>
</html>