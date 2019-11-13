<?php 
    include("./templates/JobCard/JobCard.php");

    $jobsArray = [];

    $Job = new JobCard("MilliporeSigma", "Data Governance Technician", "Indeed", "10/01/2019", "Temecula, CA", 
    "Some quick example text to build on the card title and make up the bulk of the card's content.",
    "Description for job", ["first", "second", "third"]);

    $Job1 = new JobCard("MilliporeSigma", "Data Governance Technician", "Indeed", "10/01/2019", "Temecula, CA", 
    "Some quick example text to build on the card title and make up the bulk of the card's content.",
    "Description for job", ["first", "second", "third"]);

    $jobsArray[] = $Job;
    $jobsArray[] = $Job1;
?>

<?php foreach ($jobsArray as $job) { ?>
    <div class="card" style="width: 90%; margin: 30px auto">
    <h5 class="card-header" style="cursor: pointer">
        <?php 
            echo "{$job->getCompanyName()} - {$job->getCompanyPosition()}";
        ?>
    </h5>
    <div class="card-body">
        <h5 class="card-title">Job Posted</h5>
        <p class="card-text">
            <?php 
                echo $job->getJobWebsite();
            ?>
        </p>
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
        <a href="#" class="card-link">Card link</a>
    </div>
    <div class="card-body">
        <h5 class="card-title">About Position</h5>
        <p class="card-text">
            <?php 
                echo $job->getAboutPositionDescription();
            ?>
        </p>
        <ul class="list-group">
                <?php 
                    foreach ($job->getAboutPositionPoints() as $point){
                        echo '<li class="list-group-item">' . $point . '</li>';
                    }
                ?>
        </ul>
    </div>
    </div>
<?php } ?>