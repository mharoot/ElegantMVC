<?php   
ini_set('display_errors',1);
 error_reporting(E_ALL); 
 ?>

 <div class="jumbotron">
<h3> Join Demos </h3>

<h4> Table 1 Values </h4>
<table  class="table table-hover table-striped">
	<thead>
      <tr>
        <th> ID </th>
        <th> THING </th>
      </tr>
    </thead>
	<?php 

   foreach ($j1 as $j) 
    {
      $str = '<tr> <td>'. $j->id . '</td>';
      $str .= '<td> '.$j->thing . '</td> </tr>';
      echo $str;

    }



	?>
</table>

<h4> Table 2 Values </h4>
<table  class="table table-hover table-striped">
  <thead>
      <tr>
        <th> ID </th>
        <th> THING </th>
      </tr>
    </thead>
  <?php 

   foreach ($j2 as $j) 
    {
      $str = '<tr> <td>'. $j->id . '</td>';
      $str .= '<td> '.$j->thing . '</td> </tr>';
      echo $str;

    }



  ?>
</table>

<h4> Join Table 1 and Table 2 </h4>
<img src="assets/images/join.png" class="img-thumbnail">
<table  class="table table-hover table-striped">
  <thead>
      <tr>
        <th> ID </th>
        <th> THING </th>
      </tr>
    </thead>
  <?php 

   foreach ($join as $j) 
    {
      $str = '<tr> <td>'. $j->id . '</td>';
      $str .= '<td> '.$j->thing . '</td> </tr>';
      echo $str;

    }



  ?>
</table>

<h4> Left Join Table 1 and Table 2 </h4>
<img src="assets/images/leftJoin.png" class="img-thumbnail">
<table  class="table table-hover table-striped">
  <thead>
      <tr>
        <th> ID </th>
        <th> THING </th>
      </tr>
    </thead>
  <?php 

   foreach ($leftJoin as $j) 
    {
      $str = '<tr> <td>'. $j->id . '</td>';
      $str .= '<td> '.$j->thing . '</td> </tr>';
      echo $str;

    }



  ?>
</table>

<h4> Right Join Table 1 and Table 2 </h4>
<img src="assets/images/rightJoin.png" class="img-thumbnail">
<table  class="table table-hover table-striped">
  <thead>
      <tr>
        <th> ID </th>
        <th> THING </th>
      </tr>
    </thead>
  <?php 

   foreach ($rightJoin as $j) 
    {
      $str = '<tr> <td>'. $j->id . '</td>';
      $str .= '<td> '.$j->thing . '</td> </tr>';
      echo $str;

    }



  ?>
</table>

<h4> Full Join Table 1 and Table 2 </h4>
<img src="assets/images/fullJoin.png" class="img-thumbnail">
<table  class="table table-hover table-striped">
  <thead>
      <tr>
        <th> ID </th>
        <th> THING </th>
      </tr>
    </thead>
  <?php 

   foreach ($fullJoin as $j) 
    {
      $str = '<tr> <td>'. $j->id . '</td>';
      $str .= '<td> '.$j->thing . '</td> </tr>';
      echo $str;

    }



  ?>
</table>

<h4> Cross Join Table 1 and Table 2 </h4>
<img src="assets/images/crossJoin.png" class="img-thumbnail">
<table  class="table table-hover table-striped">
  <thead>
      <tr>
        <th> ID </th>
        <th> THING </th>
      </tr>
    </thead>
  <?php 

   foreach ($crossJoin as $j) 
    {
      $str = '<tr> <td>'. $j->id . '</td>';
      $str .= '<td> '.$j->thing . '</td> </tr>';
      echo $str;

    }



  ?>
</table>


</div>