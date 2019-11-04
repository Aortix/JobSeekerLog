<?php 
    class Header {
        private $title;
        function __construct($title) {
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

<h2 class="display-4 text-center text-dark mt-4">
    <?php 
        $header = new Header("Job Seeker's Log");
        echo $header->getTitle();
    ?>
</h2>
<p class="text-muted text-center">Record your job search.</p>
