<div class="container">
  <div class="brand-box" style="height: 200px">Review Employee Information</div>

  <div class="row">
<?php
if ( isset($_SESSION['success_message']) ) 
{
    echo '<p style="color:green">'.$_SESSION['success_message'].'</p>';
    unset($_SESSION['success_message']);
} 
else if ( isset($_SESSION['error_message']) ) 
{
    echo '<p style="color:red">'.$_SESSION['error_message'].'</p>';
    unset($_SESSION['error_message']);
}
?>
  </div>

  <div class="row">
<?php     
if ( isset($employee_info) && $employee_info != false)
{
?>
    <form action="./edit-employee-information" method="POST">
        <table>
        <tr>
            <td>Last Name</td>
            <td><input type='text' name='Lastname' value="<?php echo $employee_info->LastName; ?>"></td>
        </tr>
            
        <tr>
            <td>First Name</td> 
            <td><input type='text' name='FirstName' value="<?php echo $employee_info->FirstName; ?>"></td>
        </tr>
        
        <tr>
            <td>Birth Date</td> 
            <td><input type='text' name='BirthDate' value="<?php echo $employee_info->BirthDate; ?>"></td>
        </tr>
        
        <tr>
            <td>Photo</td> 
            <td><input type='text' name='Photo' value="<?php echo $employee_info->Photo; ?>"></td>
        </tr>
        
        <tr>
            <td>Notes</td> 
            <td><input type='text' name='Notes' value="<?php echo $employee_info->Notes; ?>"></td>
        </tr>
        </table>
        <button class='btn btn-primary' type='submit' value='Submit'> Update Employee Information </button>
    </form>
  </div>
<?php
} 
else
{
?>
<form action="./edit-employee-information" method="POST">
    <table>
    <tr>
            <td>Last Name</td>
            <td><input type='text' name='Lastname' value=""></td>
        </tr>
            
        <tr>
            <td>First Name</td> 
            <td><input type='text' name='FirstName' value=""></td>
        </tr>
        
        <tr>
            <td>Birth Date</td> 
            <td><input type='text' name='BirthDate' value=""></td>
        </tr>
        
        <tr>
            <td>Photo</td> 
            <td><input type='text' name='Photo' value=""></td>
        </tr>
        
        <tr>
            <td>Notes</td> 
            <td><input type='text' name='Notes' value=""></td>
        </tr>
    </table>
    <button class='btn btn-primary' type='submit' value='Submit'> Update Employee Information </button>
</form>
<?php
}
?>
</div>