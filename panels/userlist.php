<div  id="users">
<img style="
display: block;
margin-left: auto;
margin-right: auto;
"
src='../images/ajax-loader.gif'>
</div>


<script>  //AJAX 
    $(document).ready(function(){
    fetch_user();
    function fetch_user()
    {
        $.ajax({
            url:"../database/fetch_user.php",
            method:"POST",
            success:function(data){
                $('#users').html(data);
            }
        })
    }  
    
    
    });  
    function fetch_messages(id,name)
    {
        $('#message-tab').tab('show');
        //$('#receiver').html(name);
        $('#receiver').html(name);
        window.receiver = id;
        return;
        $.ajax({
            url:"../database/fetch_local.php",
            method:"POST",
            success:function(data){
                $('#local_list').html(data);
            }
        })
    }
</script>
