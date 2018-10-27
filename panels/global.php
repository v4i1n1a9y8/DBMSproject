


<div id="global" class="tab-pane fade">

<div class="form-group">
  <textarea class="form-control" rows="3" id="message-global"></textarea>
  <button type="submit" class="btn btn-default" onclick="post_global()">Post</button>
</div> 

    <div id=global_list>
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
    setInterval(fetch_global, 5000);
    function fetch_global()
    {
        $.ajax({
            url:"../database/fetch_global.php",
            method:"POST",
            success:function(data){
                $('#global_list').html(data);
            }
        })
    }
    
    });  

function post_global(id)
    {
        var msg = $('#message-global').val();
        $.ajax({
            type:"POST",
            url:"../database/post_global.php",
            data: { 
                message: msg
            },
            success:function(data){
                $('#message-global').val("");
            }
        })
    }
</script>

