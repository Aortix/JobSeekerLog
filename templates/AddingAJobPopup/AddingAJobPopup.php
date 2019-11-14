<?php 

?>

<div id="AddingAJobPopup" style="display: none; width: 100%; height: 100%; z-index: 2; overflow-y: scroll;" class="position-fixed bg-light text-secondary border rounded p-4">
    <i style="cursor: pointer; position: absolute; right: 20px;" class="fas fa-times fa-lg mt-1 mb-4"
    onclick="onclickCloseAddJobForm()"></i>
    <form class="mt-4" method="post" action="JobsContainer.php">
        <div class="form-group">
            <label for="company-name" class="h4">Company Name</label>
            <input required type="text" class="form-control" id="company-name" placeholder="Required">
        </div>
        <div class="form-group">
            <label for="company-position" class="h4">Position</label>
            <input required type="text" class="form-control" id="company-position" placeholder="Required">
        </div>
        <div class="form-group">
            <label for="company-website" class="h4">Company Website</label>
            <input type="text" class="form-control" id="company-website" placeholder="Optional">
        </div>
        <div class="form-group">
            <label for="date-applied" class="h4">Date you applied</label>
            <input type="text" class="form-control" id="date-applied" placeholder="Optional (Defaults to current date)">
        </div>
        <div class="form-group">
            <label for="job-location" class="h4">Location</label>
            <input type="text" class="form-control" id="job-location" placeholder="Optional">
        </div>
        <div class="form-group">
            <label for="company-about" class="h4">About Company</label>
            <textarea class="form-control" id="company-about" rows="4" placeholder="Optional"></textarea>
        </div>
        <div class="form-group">
            <label for="position-about" class="h4">About Position</label>
            <textarea class="form-control" id="position-about" rows="4" placeholder="Optional"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>