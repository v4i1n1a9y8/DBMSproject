<div id="messages" class="tab-pane fade">
    <div class="panel panel-default">
        <div class="panel-heading" id="receiver">Rakesh</div>
<div class="panel panel-warning" style="overflow-y: scroll;height:400px" id="message-list">

    <img style="
    display: block;
    margin-left: auto;
    margin-right: auto;
    "
    src='../images/ajax-loader.gif'>

</div>

<div class="form-group">
  <textarea class="form-control" rows="1" id="message-private"></textarea>
  <button type="submit" class="btn btn-default" onclick="post_message()">Send</button>
</div> 

    </div>
</div>

<script>  //AJAX 
    $(document).ready(function(){
    $("#message-list").animate({ scrollTop: $(document).height() }, "fast");
    setInterval(fetch_messages, 3000);
    function fetch_messages()
    {
        var rec = window.receiver;
        $.ajax({
            type:"POST",
            url:"../database/fetch_messages.php?receiver="+rec,
            data: { 
                receiver: Number(rec)
            },
            success:function(data){
                $('#message-list').html(data);
            }
        })
    }
    
    });  

function post_message(id)
    {
        var rec = window.receiver;
        var msg = $('#message-private').val();
        $.ajax({
            type:"POST",
            url:"../database/post_message.php",
            data: { 
                message: msg,
                receiver: Number(rec)
            },
            success:function(data){
                $('#message-private').val("");
            }
        })
    }
</script>
