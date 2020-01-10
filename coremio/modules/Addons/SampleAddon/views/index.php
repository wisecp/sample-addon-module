<p>This is the index page of the module</p>
<p>Here you can show everything you want.</p>
<p>The currently installed version is: <strong><?php echo $version; ?></strong></p>
<p>Module Name: <strong><?php echo $name; ?></strong></p>
<p>File path to this page: <strong><?php echo __FILE__; ?></strong></p>
<p>Configuration Fields</p>
<p>
    <?php
        if($fields){
            foreach($fields AS $field){
                ?>
                <?php echo $field['name']; ?>: <strong><?php echo isset($field["value"]) ? $field["value"] : ''; ?></strong><br>
                <?php
            }
        }
    ?>
</p>

<a class="lbtn" href="<?php echo $link; ?>?action=other">Open Other Page</a>