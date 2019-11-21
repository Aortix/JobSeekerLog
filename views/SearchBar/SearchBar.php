<?php
?>

<div>
    <form class="form-inline justify-content-center" style="width: 80%; margin: 0 auto;">
        <input type="search" class="searchbar_submit_button form-control mr-sm-2" oninput="setRegexCookie(this.value)" id="job-search" placeholder="Search" aria-label="Search"></input>
        <input class="btn btn-outline-success my-2 my-sm-0" type="submit"></input>
        <button type="button" class="btn btn-outline-secondary ml-2" onclick="clearSearchBar()">Clear</button>
    </form>
</div>