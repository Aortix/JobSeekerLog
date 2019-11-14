<?php
    class JobCard {
        private $companyName;
        private $companyPosition;
        private $companyWebsite;
        private $appliedDate;
        private $location;
        private $aboutCompany;
        private $aboutPositionDescription;
        private $notes;

        public function __construct($companyName, $companyPosition, $companyWebsite, 
        $appliedDate, $location, $aboutCompany, $aboutPositionDescription, $notes) {
            $this->companyName = $companyName;
            $this->companyPosition = $companyPosition;
            $this->companyWebsite = $companyWebsite;
            $this->appliedDate = $appliedDate;
            $this->location = $location;
            $this->aboutCompany = $aboutCompany;
            $this->aboutPositionDescription = $aboutPositionDescription;
            $this->notes = $notes;
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

        public function getCompanyWebsite() {
            return $this->companyWebsite;
        }

        public function setCompanyWebsite($companyWebsite) {
            $this->companyWebsite = $companyWebsite;
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

        public function getNotes() {
            return $this->notes;
        }

        public function setNotes($notes) {
            $this->notes = $notes;
        }
    }
?>