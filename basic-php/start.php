<?php
require('books/MyUtility.php');
require('authors/MyUtility.php');

Books\MyUtility::export();
Authors\MyUtility::exportAll();