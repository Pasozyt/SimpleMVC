<?php
    require_once(__DIR__ . '/header.html.php')
?>

    
<h1><?=$this->title?></h1>
<form action="<?=route('addcombined')?>" method="POST">

    <select name="combined_id_city">
        <?php
            foreach($this->selectcity as $selectcity) {
                echo '<option value="'.$selectcity->id.'">';
                echo $selectcity->name;
                echo "</option>";
            }
        ?>
    </select>

    <select name="combined_id_code">
        <?php
            foreach($this->selectpostcode as $selectpostcode) {
                echo '<option value="'.$selectpostcode->id.'">';
                echo $selectpostcode->postcode;
                echo "</option>";
            }
        ?>
    </select>
    <button type="submit"><?=$this->addButton?></button>
</form>

<table id="tab" class="table table-striped table-bordered">

</table>


<script>
    var combined_id=[];
    var combined_name=[];
    var combined_postcode=[];
    var i=0;


    
    function list_table() {
        str="<tr><th>Miasta</th><th>Kody Pocztowe</th></tr>";
        rember="";
        for(var w=0;w<i;w++){
            if(rember!=combined_name[w]){
                str+="<tr><td>"+combined_name[w] + "</td><td>";
            }
            str+='<form action="delcombined" method="post"><input type="hidden" name="combined_id" value="'+combined_id[w]+'">';
            str+='<span class="badge bg-secondary">'+combined_postcode[w]+'</span> <input type="submit" value="Usuń" class="btn btn-danger btn-sm btn-block"></form>';

            str+=''

            rember=combined_name[w];

            if(w+1==i || rember!=combined_name[w+1]){
                str+='</td>';
            }
            else{
                str+='';
            }
            
        }
        document.getElementById("tab").innerHTML=str;
    }

</script>

<?php
    foreach($this->combined as $combined)
    {
        echo "<script>"; 
        echo 'combined_id[i]="' . $combined["id"] .'";';
        echo 'combined_name[i]="' . $combined["name"] . '";';
        echo 'combined_postcode[i]="' . $combined["postcode"] . '";';
        echo "i++";
        echo "</script>";
        
        /*
        echo '<form action="delcombined" method="post">';
        echo "<li>" . $combined["id"] . " - " . $combined["name"] . " - " . $combined["postcode"];
        echo "<input type='hidden' name='combined_id' value='".$combined["id"]."'>";
        echo ' - <input type="submit" value="Usuń"></li>';
        echo "</form>";
        */
        
    }
    echo "<script>list_table()</script>"

?>



<?php
    require_once(__DIR__ . '/footer.html.php')
?>
