<?php
?>

<div id="UpdatingAJobPopup" style="display: none; width: 100%; height: 100%; z-index: 2; overflow-y: scroll;" class="position-fixed bg-light text-secondary border rounded p-4">
    <i style="cursor: pointer; position: absolute; right: 40px;" class="fas fa-times fa-lg mt-1 mb-4" onclick="onclickCloseUpdateJobForm()"></i>
    <form class="mt-4" method="post" action="redirects/updatedAJob.php">
        <input type="hidden" name="updating_id" id="updating_id">
        <input type="hidden" name="updating_scroll" id="updating_scroll">
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="updating_company_name" class="h4">Company Name</label>
            <input required type="text" style="width: 100%; padding: 6px 12px; color: #495057; border: 1px solid #ced4da; border-radius: .25rem;" name="updating_company_name" id="updating_company_name" placeholder="Required">
            <small class="form-text text-muted mb-3">Some characters outside of ASCII are not allowed.</small>
            <?php if (isset($_SESSION['updating_company_name'])) { ?>
                <div class="alert alert-danger mt-1 mb-1 p-2" style="display: inline-block; font-size: 15px;" role="alert">
                    <?php echo $_SESSION['updating_company_name']; ?>
                </div>
            <?php } ?>
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="updating_company_position" class="h4">Position</label>
            <input required type="text" class="form-control" name="updating_company_position" id="updating_company_position" placeholder="Required">
            <small class="form-text text-muted mb-3">Some characters outside of ASCII are not allowed.</small>
            <?php if (isset($_SESSION['updating_company_position'])) { ?>
                <div class="alert alert-danger mt-1 mb-1 p-2" style="display: inline-block; font-size: 15px;" role="alert">
                    <?php echo $_SESSION['updating_company_position']; ?>
                </div>
            <?php } ?>
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="updating_company_website" class="h4">Company Website</label>
            <input type="text" class="form-control" name="updating_company_website" id="updating_company_website" placeholder="Optional">
            <small class="form-text text-muted mb-3">Some characters outside of ASCII are not allowed.</small>
            <?php if (isset($_SESSION['updating_company_website'])) { ?>
                <div class="alert alert-danger mt-1 mb-1 p-2" style="display: inline-block; font-size: 15px;" role="alert">
                    <?php echo $_SESSION['updating_company_website']; ?>
                </div>
            <?php } ?>
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="updating_date_applied" class="h4">Date you applied</label>
            <input type="text" class="form-control" name="updating_date_applied" id="updating_date_applied" placeholder="Optional (Defaults to current date)">
            <small class="form-text text-muted mb-3">Some characters outside of ASCII are not allowed.</small>
            <?php if (isset($_SESSION['updating_date_applied'])) { ?>
                <div class="alert alert-danger mt-1 mb-1 p-2" style="display: inline-block; font-size: 15px;" role="alert">
                    <?php echo $_SESSION['updating_date_applied']; ?>
                </div>
            <?php } ?>
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="updating_company_location" class="h4">Location</label>
            <input type="text" class="form-control" name="updating_company_location" id="updating_company_location" placeholder="Optional">
            <small class="form-text text-muted mb-3">Some characters outside of ASCII are not allowed.</small>
            <?php if (isset($_SESSION['updating_company_location'])) { ?>
                <div class="alert alert-danger mt-1 mb-1 p-2" style="display: inline-block; font-size: 15px;" role="alert">
                    <?php echo $_SESSION['updating_company_location']; ?>
                </div>
            <?php } ?>
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="updating_about_company" class="h4">About Company</label>
            <textarea class="form-control" name="updating_about_company" id="updating_about_company" rows="4" placeholder="Optional"></textarea>
            <small class="form-text text-muted mb-3">Some characters outside of ASCII are not allowed.</small>
            <?php if (isset($_SESSION['updating_about_company'])) { ?>
                <div class="alert alert-danger mt-1 mb-1 p-2" style="display: inline-block; font-size: 15px;" role="alert">
                    <?php echo $_SESSION['updating_about_company']; ?>
                </div>
            <?php } ?>
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="updating_about_position" class="h4">About Position</label>
            <textarea class="form-control" name="updating_about_position" id="updating_about_position" rows="4" placeholder="Optional"></textarea>
            <small class="form-text text-muted mb-3">Some characters outside of ASCII are not allowed.</small>
            <?php if (isset($_SESSION['updating_about_position'])) { ?>
                <div class="alert alert-danger mt-1 mb-1 p-2" style="display: inline-block; font-size: 15px;" role="alert">
                    <?php echo $_SESSION['updating_about_position']; ?>
                </div>
            <?php } ?>
        </div>
        <div class="form-group" style="width: 85%; margin: 10px auto;">
            <label for="updating_company_notes" class="h4">Notes</label>
            <textarea class="form-control" name="updating_company_notes" id="updating_company_notes" rows="4" placeholder="Optional"></textarea>
            <small class="form-text text-muted mb-3">Some characters outside of ASCII are not allowed.</small>
            <?php if (isset($_SESSION['updating_company_notes'])) { ?>
                <div class="alert alert-danger mt-1 mb-1 p-2" style="display: inline-block; font-size: 15px;" role="alert">
                    <?php echo $_SESSION['updating_company_notes']; ?>
                </div>
            <?php } ?>
        </div>
        <input type="submit" name="submit" value="Update" style="position: relative; left: 7.5%;" class="btn btn-primary"></input>
    </form>
</div>