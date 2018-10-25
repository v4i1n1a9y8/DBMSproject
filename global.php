


<div id="global" class="tab-pane fade">
    <div id=global_list>
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

