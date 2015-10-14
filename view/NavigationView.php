<?php

class NavigationView {
    
    public function showLinks() {
        if(isset($_GET['register'])) {
            return '<br /><a class="smallerlinks" href="?"><< Back to login</a>';
        }
        else {
            return '<br /><a class="smallerlinks" href="?register">Register a new user >></a>';
        }
    }
    
//return '<a href="?exerciselist">LOG RESULTS</a>' . ' | ' . '<a href="?exerciseadd">ADD EXERCISE</a>';
}