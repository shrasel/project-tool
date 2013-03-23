<option value="">Select</option>
<?php foreach($project_list as $value):?>
<option value="<?=$value->id?>"><?=$value->business_name?> <?= $value->terminate==1? "(terminated)":""?> </option>
<?php endforeach;?>