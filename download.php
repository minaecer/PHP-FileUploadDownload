<div class="down">
    <div class="card-down">
        <div class="rown">
<link rel="stylesheet" href="css/style.css">

<?php

// This will return all files in that folder
$files = scandir("upload");


for ($a = 2; $a < count($files); $a++)
{
    ?>
    <p>
        <!-- Displaying file name !-->
        <?php echo $files[$a]; ?>


        <a href="upload/<?php echo $files[$a]; ?>" download="<?php echo $files[$a]; ?>">
            Download
        </a>
    </p>

  <?php @readfile($files[$a]); ?>


<a href="upload/<?php echo $files[$a]; ?>" target="_BLANK">Preview</a>



    <?php
}
?>
</div>
</div>
</div>