<?php
    class Job {
        private $companyName;
        private $companyPosition;
        private $appliedDate;
        private $location;
        private $aboutCompany;
        private $aboutPositionDescription;
        private $aboutPositionPoints;

        public function __construct($companyName, $companyPosition, $appliedDate, 
        $location, $aboutCompany, $aboutPositionDescription, $aboutPositionPoints) {
            $this->companyName = $companyName;
            $this->companyPosition = $companyPosition;
            $this->appliedDate = $appliedDate;
            $this->location = $location;
            $this->aboutCompany = $aboutCompany;
            $this->aboutPositionDescription = $aboutPositionDescription;
            $this->aboutPositionPoints = $aboutPositionPoints;
        }

        public function getCompanyName() {
            return $this->companyName;
        }

        public function setCompanyName($companyName) {
            $this->companyName = $companyName;
        }

        public function getCompanyPosition() {
            return $this->companyPosition;
        }

        public function setCompanyPosition($companyPosition) {
            $this->companyPosition = $companyPosition;
        }

        public function getAppliedDate() {
            return $this->appliedDate;
        }

        public function setAppliedDate($appliedDate) {
            $this->appliedDate = $appliedDate;
        }

        public function getLocation() {
            return $this->location;
        }

        public function setLocation($location) {
            $this->location = $location;
        }

        public function getAboutCompany() {
            return $this->aboutCompany;
        }

        public function setAboutCompany($aboutCompany) {
            $this->aboutCompany = $aboutCompany;
        }

        public function getAboutPositionDescription() {
            return $this->aboutPositionDescription;
        }

        public function setAboutPositionDescription($aboutPositionDescription) {
            $this->aboutPositionDescription = $aboutPositionDescription;
        }

        public function getAboutPositionPoints() {
            return $this->aboutPositionPoints;
        }

        public function setAboutPositionPoints($aboutPositionPoints) {
            $this->aboutPositionPoints = $aboutPositionPoints;
        }
    }

    $Job = new Job("MilliporeSigma", "Data Governance Technician", "10/01/2019", "Temecula, CA", 
    "Some quick example text to build on the card title and make up the bulk of the card's content.",
    "Description for job", ["first", "second", "third"]);
?>

<div class="card" style="width: 90%; margin: 30px auto">
  <h5 class="card-header" style="cursor: pointer">
    <?php 
        echo "{$Job->getCompanyName()} - {$Job->getCompanyPosition()}";
    ?>
  </h5>
  <div class="card-body">
    <h5 class="card-title">Date Applied</h5>
    <p class="card-text">
        <?php 
            echo $Job->getAppliedDate();
        ?>
    </p>
  </div>
  <div class="card-body">
    <h5 class="card-title">Location</h5>
    <p class="card-text">
        <?php 
            echo $Job->getLocation();
        ?>
    </p>
  </div>
  <div class="card-body">
    <h5 class="card-title">About Company</h5>
    <p class="card-text">
        <?php 
            echo $Job->getAboutCompany();
        ?>
    </p>
    <a href="#" class="card-link">Card link</a>
  </div>
  <div class="card-body">
    <h5 class="card-title">About Position</h5>
    <p class="card-text">
        <?php 
            echo $Job->getAboutPositionDescription();
        ?>
    </p>
    <ul class="list-group">
            <?php 
                foreach ($Job->getAboutPositionPoints() as $point){
                    echo '<li class="list-group-item">' . $point . '</li>';
                }
            ?>
    </ul>
  </div>
</div>