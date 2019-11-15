<?php 
    include("./classes/JobCard.php");
    include("./queries/jobQueries.php");

    //Function comes from jobQueries
    $job_posts = getJobPostings();
    
    $jobsArray = [];

    foreach ($job_posts as $job_post) {
        $jobsArray["Job" . $job_post["id"]] = new JobCard($job_post["company_name"], $job_post["company_position"], $job_post["company_website"], 
        $job_post["date_applied"], $job_post["location"], $job_post["about_company"],
        $job_post["about_position"], $job_post["notes"]);
    }
?>

<?php foreach ($jobsArray as $job) { ?>
    <div class="card" style="width: 90%; margin: 30px auto">
    <h5 class="card-header" style="cursor: pointer">
        <?php 
            echo "{$job->getCompanyName()} - {$job->getCompanyPosition()}";
        ?>
        <div style="position: absolute; right: 18px; top: 12px;">
            <i class="fas fa-pencil-alt" style="margin-right: 10px;"
            onclick="updatingACard([
            '<?php echo $job->getCompanyName(); ?>',
            '<?php echo $job->getCompanyPosition(); ?>',
            '<?php echo $job->getCompanyWebsite(); ?>',
            '<?php echo $job->getAppliedDate(); ?>',
            '<?php echo $job->getLocation(); ?>',
            '<?php echo $job->getAboutCompany(); ?>',
            '<?php echo $job->getAboutPosition(); ?>',
            '<?php echo $job->getNotes(); ?>',])">
            </i>
            <i class="fas fa-trash-alt" onclick="deletingACard()"></i>
        </div>
    </h5>

    <div class="card-body">
        <h5 class="card-title">Company Website</h5>
        <a href="#" class="card-link">
            <?php 
                echo $job->getCompanyWebsite();
            ?>
        </a>
    </div>
    <div class="card-body">
        <h5 class="card-title">Date Applied</h5>
        <p class="card-text">
            <?php 
                echo $job->getAppliedDate();
            ?>
        </p>
    </div>
    <div class="card-body">
        <h5 class="card-title">Location</h5>
        <p class="card-text">
            <?php 
                echo $job->getLocation();
            ?>
        </p>
    </div>
    <div class="card-body">
        <h5 class="card-title">About Company</h5>
        <p class="card-text">
            <?php 
                echo $job->getAboutCompany();
            ?>
        </p>
    </div>
    <div class="card-body">
        <h5 class="card-title">About Position</h5>
        <p class="card-text">
            <?php 
                echo $job->getAboutPosition();
            ?>
        </p>
    </div>
    <div class="card-body">
        <h5 class="card-title">Notes</h5>
        <p class="card-text">
            <?php 
                echo $job->getNotes();
            ?>
        </p>
    </div>
    </div>
<?php } ?>