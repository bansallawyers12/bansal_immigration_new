<?php
/**
 * Migration Script: Convert pages to use main layout
 * 
 * This script helps convert existing pages from layouts.frontend to layouts.main
 * Run this from the project root: php migrate-to-main-layout.php
 */

$viewsPath = 'resources/views/';
$pagesToMigrate = [
    'contact.blade.php',
    'blogs.blade.php',
    'success-stories.blade.php',
    'bookappointment.blade.php',
    // Add more pages as needed
];

foreach ($pagesToMigrate as $page) {
    $filePath = $viewsPath . $page;
    
    if (!file_exists($filePath)) {
        echo "Skipping $page - file not found\n";
        continue;
    }
    
    $content = file_get_contents($filePath);
    
    // Check if already using main layout
    if (strpos($content, "extends('layouts.main')") !== false) {
        echo "Skipping $page - already using main layout\n";
        continue;
    }
    
    // Convert from frontend layout to main layout
    $content = str_replace(
        "@extends('layouts.frontend')",
        "@extends('layouts.main')"
    );
    
    // Convert seoinfo section to title and description sections
    $content = preg_replace(
        '/@section\(\'seoinfo\'\)\s*<title>(.*?)<\/title>\s*<meta name="description" content="(.*?)">/s',
        "@section('title', '$1')\n@section('description', '$2')",
        $content
    );
    
    // Remove @endsection for seoinfo
    $content = str_replace("@endsection\n@section('content')", "@section('content')", $content);
    
    // Write back to file
    file_put_contents($filePath, $content);
    echo "Migrated $page successfully\n";
}

echo "Migration completed!\n";
?>
