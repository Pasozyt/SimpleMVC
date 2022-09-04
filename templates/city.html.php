<?php
    require_once(__DIR__ . '/header.html.php')
?>
<h2><?=$this->addTitle?></h2>
<form action="<?=route('addcity')?>" method="POST">
    <input name="city_name">
    <button type="submit"><?=$this->addButton?></button>
</form>

<table id="tab" class="table table-striped table-bordered">
    <tr>
        <th>Miasta</th>
        <th></th>
    </tr>
    <?php
        foreach($this->city as $city) {
            echo '<tr><td>'. $city->name . '</td>';
            echo '<td><form action="delcity" method="post">';
            echo "<input type='hidden' name='city_id' value='".$city->id."'>";
            echo ' <input type="submit" value="Usuń" class="btn btn-danger btn-sm btn-block">';
            echo "</form></td></tr>";
        }
    ?>
</table>


<?php
    require_once(__DIR__ . '/footer.html.php')
?>