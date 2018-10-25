<div id="local" class="tab-pane fade in active">

   <div id=local_list>
<img style="
display: block;
margin-left: auto;
margin-right: auto;
"
src='images/ajax-loader.gif'>
    </div>

</div>

<script>  //AJAX 
    $(document).ready(function(){
    fetch_local();
    function fetch_local()
    {
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

