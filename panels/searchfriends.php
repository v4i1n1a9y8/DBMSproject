<div id="search" class="tab-pane fade">


<input id="myInput" type="text" placeholder="Search..">
<br><br>


<div id="searchContents">
</div>


<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
$(document).ready(function(){
    setInterval(fetch_search, 5000);
    function fetch_search()
    {
        $.ajax({
            url:"../database/fetch_search.php",
            method:"POST",
            success:function(data){
                $('#searchContents').html(data);
            }
        })
    }  
    
 
    });  
    function addfriend(id) {
                $.ajax({
                    type:"POST",
                    url:"../database/addfriend.php",
                    data: { 
                        id: id
                    },
                    success:function(data){
                    }
                })
            }  
    function acceptfriend(id) {
                $.ajax({
                    type:"POST",
                    url:"../database/acceptfriend.php",
                    data: { 
                        id: id
                    },
                    success:function(data){
                    }
                })
            }  
</script>
</div>