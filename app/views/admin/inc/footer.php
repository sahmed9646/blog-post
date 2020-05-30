
  <footer id="main-footer" class="bg-dark text-white mt-5 p-5">
    <div class="conatiner">
      <div class="row">
        <div class="col">
          <p class="lead text-center">Copyright &copy; <a href="https://sabbirsplanet.com">Sabbir Ahmed</a></p>
        </div>
      </div>
    </div>
  </footer>
  
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {
      //the following script for submitting a form by a button which is located outside oof form
       $("#submitButton").click(function() {
           $("#submit-form").submit();
       });

       // Ajax Jquery for search bar
      // $("#searchBar").keyup(function() {
      //   var values = $(this).val();
      //   if (values != '') {
      //     $.ajax({
      //       url:"../ajaxphp.php",
      //       method:"POST",
      //       async:true,
      //       data:{search:values},
      //       datatype:"text",
      //       success:function($data){
      //         $('#liveStatus').html($data);
      //       }
      //     });
      //   }else{
      //     $('#liveStatus').html('');
      //   }
      // });

      $("#searchBar").keyup(function() {
        var values = $(this).val();
        if (values != '') {
          $.ajax({
            url:"../AjaxQueries",
            method:"POST",
            data:{search:values},
            datatype:"text",
            success:function($data){
              $('#liveStatus').html($data);
            }
          });
        }else{
          $('#liveStatus').html('');
        }
      });
    });
</script>


</body>
</html>
