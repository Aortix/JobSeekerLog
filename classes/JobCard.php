<?php
    class JobCard {
        private $id;
        private $companyName;
        private $companyPosition;
        private $companyWebsite;
        private $appliedDate;
        private $location;
        private $aboutCompany;
        private $aboutPosition;
        private $notes;

        public function __construct($id, $companyName, $companyPosition, $companyWebsite, 
        $appliedDate, $location, $aboutCompany, $aboutPosition, $notes) {
            $this->id = $id;
            $this->companyName = $companyName;
            $this->companyPosition = $companyPosition;
            $this->companyWebsite = $companyWebsite;
            $this->appliedDate = $appliedDate;
            $this->location = $location;
            $this->aboutCompany = $aboutCompany;
            $this->aboutPosition = $aboutPosition;
            $this->notes = $notes;
        }

        public function getId() {
            return $this->id;
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

        public function getAboutPosition() {
            return $this->aboutPosition;
        }

        public function setAboutPosition($aboutPosition) {
            $this->aboutPosition= $aboutPosition;
        }

        public function getNotes() {
            return $this->notes;
        }

        public function setNotes($notes) {
            $this->notes = $notes;
        }
    }
?>