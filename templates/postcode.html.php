<?php
    require_once(__DIR__ . '/header.html.php')
?>
<h2><?=$this->addTitle?></h2>
<form action="<?=route('addcode')?>" method="POST">
    <input name="postcode_postcode">
    <button type="submit"><?=$this->addButton?></button>
</form>
<table id="tab" class="table table-striped table-bordered">
    <tr>
        <th>Kody Pocztowe</th>
        <th></th>
    </tr>
<?php
    foreach($this->postcode as $postcode) {
        echo '<tr><td>'. $postcode->postcode . '</td>';
        echo '<td><form action="delpostcode" method="post">';
        echo "<input type='hidden' name='postcode_id' value='".$postcode->id."'>";
        echo ' <input type="submit" value="Usuń" class="btn btn-danger btn-sm btn-block">';
        echo "</form></td></tr>";
    }
?>
</table>

<?php
    require_once(__DIR__ . '/footer.html.php')
?>