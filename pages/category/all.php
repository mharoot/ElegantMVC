

<table>
<?php
foreach ($categories as $category)
{
    echo "<tr><td>$category->CategoryID</td><td>$category->CategoryName</td><td>$category->Description</td></tr>";
}
?>
</table>