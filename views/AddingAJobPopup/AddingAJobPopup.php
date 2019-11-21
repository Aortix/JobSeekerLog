<?php
?>

<div id="AddingAJobPopup" class="adding_job_popup bg-light text-secondary border rounded p-4">
    <i style="cursor: pointer; position: absolute; right: 40px;" class="fas fa-times fa-lg mt-1 mb-4" onclick="onclickCloseAddJobForm()"></i>
    <form class="mt-4" method="post" action="redirects/addedAJob.php">
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="company_name" style="display: block;" class="h4">Company Name</label>
            <input required type="text" style="width: 100%; padding: 6px 12px; color: #495057; border: 1px solid #ced4da; border-radius: .25rem;" name="company_name" id="company_name" placeholder="Required">
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="company_position" class="h4">Position</label>
            <input required type="text" class="form-control" name="company_position" id="company_position" placeholder="Required">
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="company_website" class="h4">Company Website</label>
            <input type="text" class="form-control" name="company_website" id="company_website" placeholder="Optional">
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="date_applied" class="h4">Date you applied</label>
            <input type="text" class="form-control" name="date_applied" id="date_applied" placeholder="Optional (Defaults to current date)">
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="company_location" class="h4">Location</label>
            <input type="text" class="form-control" name="company_location" id="company_location" placeholder="Optional">
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="about_company" class="h4">About Company</label>
            <textarea class="form-control" name="about_company" id="about_company" rows="4" placeholder="Optional"></textarea>
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="about_position" class="h4">About Position</label>
            <textarea class="form-control" name="about_position" id="about_position" rows="4" placeholder="Optional"></textarea>
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="company_notes" class="h4">Notes</label>
            <textarea class="form-control" name="company_notes" id="company_notes" rows="4" placeholder="Optional"></textarea>
        </div>
        <input type="submit" name="submit" value="Submit" style="position: relative; left: 7.5%;" class="btn btn-primary"></input>
    </form>
</div>