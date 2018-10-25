


<div id="global" class="tab-pane fade">
    <div id=global_list>
    </div>
</div>

<script>  //AJAX 
    $(document).ready(function(){
    fetch_global();
    function fetch_global()
    {
        $.ajax({
            url:"database/fetch_global.php",
            method:"POST",
            success:function(data){
                $('#global_list').html(data);
            }
        })
    }
    
    });  
</script>

