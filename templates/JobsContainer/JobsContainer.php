<?php 

    include("./sql_connection_info.php");

    $conn = mysqli_connect('localhost', $username, $password, $database_name);

    if (!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }

    //Write query for all job posts
    $sql = 'SELECT * FROM Job_posts';

    //Make query and get result
    $result = mysqli_query($conn, $sql);

    //Fetch the resulting rows as an array
    $job_posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //Free result from memory
    mysqli_free_result($result);

    //Close Connection
    mysqli_close($conn);

    include("./templates/JobCard/JobCard.php");

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
                echo $job->getAboutPositionDescription();
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