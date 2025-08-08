<?php
session_start();
require_once __DIR__ . '/DropboxService.php';

$dropbox = new DropboxService();

if (isset($_GET['code'])) {
    try {
        $dropbox->authenticate($_GET['code']);
        echo "✅ Dropbox Connected. <a href='../add_employe.php'>Go Back</a>";
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage();
    }
} else {
    echo "❌ Authorization failed.";
}
?>