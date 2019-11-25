<?php
include("./classes/JobCard.php");
include("./queries/jobQueries.php");

$searchCookie = NULL;

if (isset($_COOKIE["regex"])) {
    $searchCookie = trim(htmlspecialchars($_COOKIE["regex"]));
}

//Function comes from jobQueries
$job_posts = getJobPostings();

$jobsArray = array();

if (isset($job_posts) && !isset($job_posts['job_postings'])) {
    foreach ($job_posts as $job_post) {
        if (!$searchCookie || $searchCookie === "") {
            $jobsArray["Job" . $job_post["id"]] = new JobCard(
                $job_post['id'],
                $job_post["company_name"],
                $job_post["company_position"],
                $job_post["company_website"],
                $job_post["date_applied"],
                $job_post["company_location"],
                $job_post["about_company"],
                $job_post["about_position"],
                $job_post["notes"]
            );
        } else if (
            strpos(strtoupper($job_post["company_name"]), strtoupper($searchCookie)) !== false
        ) {
            $arrayFromString = explode(" ", $job_post["company_name"]);
            $indexOfFirstCharacter = -1;
            foreach ($arrayFromString as $individualStrings) {
                $indexOfFirstCharacter = strpos(strtoupper($individualStrings), strtoupper($searchCookie));
                if ($indexOfFirstCharacter === 0) {
                    $jobsArray["Job" . $job_post["id"]] = new JobCard(
                        $job_post['id'],
                        $job_post["company_name"],
                        $job_post["company_position"],
                        $job_post["company_website"],
                        $job_post["date_applied"],
                        $job_post["company_location"],
                        $job_post["about_company"],
                        $job_post["about_position"],
                        $job_post["notes"]
                    );
                    break;
                }
            }
        } else if (
            strpos(strtoupper($job_post["company_position"]), strtoupper($searchCookie)) !== false
        ) {
            $arrayFromString = explode(" ", $job_post["company_position"]);
            $indexOfFirstCharacter = -1;
            foreach ($arrayFromString as $individualStrings) {
                $indexOfFirstCharacter = strpos(strtoupper($individualStrings), strtoupper($searchCookie));
                if ($indexOfFirstCharacter === 0) {
                    $jobsArray["Job" . $job_post["id"]] = new JobCard(
                        $job_post['id'],
                        $job_post["company_name"],
                        $job_post["company_position"],
                        $job_post["company_website"],
                        $job_post["date_applied"],
                        $job_post["company_location"],
                        $job_post["about_company"],
                        $job_post["about_position"],
                        $job_post["notes"]
                    );
                    break;
                }
            }
        } else { }
    }
} else {
    $jobsArray = NULL;
}
?>

<?php if (isset($jobsArray) && count($jobsArray) > 0) { ?>
    <div style="display: flex; justify-content: center; margin-top: 30px;">
        <button onclick="changeColumnsShown(1)" type="button" style="margin-left: 5px; margin-right: 5px;" class="btn btn-outline-primary">1</button>
        <button onclick="changeColumnsShown(2)" type="button" style="margin-left: 5px; margin-right: 5px;" class="btn btn-outline-primary">2</button>
        <button onclick="changeColumnsShown(3)" type="button" style="margin-left: 5px; margin-right: 5px;" class="btn btn-outline-primary">3</button>
        <button onclick="changeColumnsShown(4)" type="button" style="margin-left: 5px; margin-right: 5px;" class="btn btn-outline-primary">4</button>
    </div>
    <div id="jobCards" style="display: grid; grid-template-columns: repeat(1, 1fr);">
        <?php foreach ($jobsArray as $job) { ?>
            <div class="card" style="width: 90%; max-width: 1000px; margin: 40px auto">
                <div class="card-header" style="cursor: pointer">
                    <h5 style="width: 82%;">
                        <?php
                                echo "{$job->getCompanyName()} - {$job->getCompanyPosition()}";
                                ?>
                    </h5>
                    <div style="position: absolute; right: 18px; top: 12px;">
                        <i class="fas fa-pencil-alt" style="margin-right: 10px;" onclick="updatingACard({
                id: '<?php echo $job->getId(); ?>',
                company_name: '<?php echo $job->getCompanyName(); ?>',
                company_position: '<?php echo $job->getCompanyPosition(); ?>',
                company_website: '<?php echo $job->getCompanyWebsite(); ?>',
                date_applied: '<?php echo $job->getAppliedDate(); ?>',
                company_location: '<?php echo $job->getLocation(); ?>',
                about_company: '<?php echo $job->getAboutCompany(); ?>',
                about_position: '<?php echo $job->getAboutPosition(); ?>',
                company_notes: '<?php echo $job->getNotes(); ?>',})">
                        </i>
                        <i class="fas fa-trash-alt" onclick="deletingACard('<?php echo $job->getId(); ?>')"></i>
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Company Website</h5>
                    <a class="card-link" href="<?php echo $job->getCompanyWebsite() ?>" rel="noopener noreferrer" target="_blank">
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
    </div>
<?php } else { ?>
    <h2 id="jobCards" style="margin-top: 75px; margin-bottom: 150px;" class="text-center text-muted">No Jobs Posted.</h2>
<?php } ?>