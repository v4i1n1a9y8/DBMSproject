<div id="local" class="tab-pane fade in active">

<div class="form-group">
  <textarea class="form-control" rows="3" id="message-local"></textarea>
  <button type="submit" class="btn btn-default" onclick="post_local()">Post</button>
</div> 

    <div id=local_list>
<img style="
display: block;
margin-left: auto;
margin-right: auto;
"
src='../images/ajax-loader.gif'>
    </div>

</div>

<script>  //AJAX 
    $(document).ready(function(){
    setInterval(fetch_local, 5000);
    function fetch_local()
    {
        $.ajax({
            url:"../database/fetch_local.php",
            method:"POST",
            success:function(data){
                $('#local_list').html(data);
            }
        })
    }
    
    });  

    function post_local(id)
    {
        var msg = $('#message-local').val();
        $.ajax({
            type:"POST",
            url:"../database/post_local.php",
            data: { 
                message: msg
            },
            success:function(data){
                $('#message-local').val("");
            }
        })

    }
</script>

