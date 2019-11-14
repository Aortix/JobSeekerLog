<?php 
?>

<header>
    <h2 class="display-4 text-center text-dark pt-4">
        Job Seeker's Log
    </h2>
    <p class="text-muted text-center">Record your job search.</p>
    <?php include("./views/SearchBar/SearchBar.php")?>
    <div class="text-center mt-4 mb-2">
    <button type="button" class="btn btn-outline-primary" onclick="onclickAddJobButton();">Add Job</button>
    </div>
</header>
