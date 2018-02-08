<h3>User Information: </h3>
<ul>
<?php
    foreach(  $users as $user)
    {
        echo "<li>
                <ul>
                    <li>user id: $user->user_id</li>
                    <li>first name: $user->first_name </li>
                    <li>last name: $user->last_name</li>
                    <li>user name: $user->user_name</li>
                </ul>
              </li>";
    }
?>
</ul>