<?php 
    class Header {
        private $title;
        public function __construct($title) {
            $this->title = $title;
        }

        public function getTitle() {
            return $this->title;
        }

        public function setTitle($title) {
            $this->title = $title;
        }
    }
?>

<header>
    <h2 class="display-4 text-center text-dark pt-4">
        <?php 
            $header = new Header("Job Seeker's Log");
            echo $header->getTitle();
        ?>
    </h2>
    <p class="text-muted text-center">Record your job search.</p>
    <?php include("./templates/SearchBar/SearchBar.php")?>
    <div class="text-center mt-4 mb-2">
    <button type="button" class="btn btn-outline-primary" onclick="onclickAddJobButton();">Add Job</button>
    </div>
</header>
