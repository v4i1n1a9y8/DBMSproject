<div  id="users"></div>


<script>  //AJAX 
    $(document).ready(function(){
    fetch_user();
    function fetch_user()
    {
        $.ajax({
            url:"database/fetch_user.php",
            method:"POST",
            success:function(data){
                $('#users').after(data);
            }
        })
    }  
    function fetch_messages(id)
    {
        return;
        $.ajax({
            url:"database/fetch_local.php",
            method:"POST",
            success:function(data){
                $('#local_list').html(data);
            }
        })
    }
    
    });  
</script>
