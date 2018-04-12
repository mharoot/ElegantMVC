
            </div>
        </div>
        <footer style="left: 0px; width: 100%;margin:0; padding:0;bottom:0;" class="footer">
        Example application of the Elegant framework. Click the icon for more info.
        
        <a href="https://github.com/mharoot/ElegantMVC">
        <img border="0" src="GitHub-Mark-Light-120px-plus.png" width="64" height="64">
        </a>
       
      </footer>
    </body>


     
   
  <!-- jQuery first, then Tether, then Bootstrap JS. -->

  <script>
  function searchProducts(str) {
 
    if (str.length == 0) { 
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var query = null;
          document.getElementById("txtHint").innerHTML = this.responseText;
          query = document.getElementById('firstElement').firstChild.data;
          if(query!=null)
          {
            document.getElementById('formInput').value = query;
          }
        }
      };
      xmlhttp.open("GET", "search?q=" + str, true);
      xmlhttp.send();


    }

     

      

    
  }







/*
  function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
  }

  //Set the width of the side navigation to 0 
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
  }
  */

</script>

  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</html>