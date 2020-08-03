<div class="col-12">
<select class="form-control col" name="diet">
        <option value="" disabled selected>Selectionnez</option>
        <?php
        foreach ($dinoType as $type) {
        ?><option value="<?= $type ?>"><?= $type ?></option><?php } ?>
      </select>


</div>