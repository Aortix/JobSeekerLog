<?php
    class JobCard {
        private $companyName;
        private $companyPosition;
        private $jobWebsite;
        private $appliedDate;
        private $location;
        private $aboutCompany;
        private $aboutPositionDescription;
        private $aboutPositionPoints;

        public function __construct($companyName, $companyPosition, $jobWebsite, 
        $appliedDate, $location, $aboutCompany, $aboutPositionDescription, $aboutPositionPoints) {
            $this->companyName = $companyName;
            $this->companyPosition = $companyPosition;
            $this->jobWebsite = $jobWebsite;
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

        public function getJobWebsite() {
            return $this->jobWebsite;
        }

        public function setJobWebsite($jobWebsite) {
            $this->jobWebsite = $jobWebsite;
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
?>