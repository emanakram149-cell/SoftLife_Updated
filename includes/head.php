<?php
// Shared <head> section
$pageTitle = $pageTitle ?? 'SoftLife – Your Personal Growth Journey';
?>
<!DOCTYPE html>
<html lang="en" id="htmlRoot">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($pageTitle) ?></title>
<meta name="description" content="SoftLife – Track habits, mood, goals and activities in one beautiful place.">
<link id="favicon" rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'><rect width='64' height='64' rx='16' fill='%237c6ff7'/><text y='46' x='8' font-size='42'>🌱</text></svg>">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<link rel="stylesheet" href="style.css">
<style>
/* Multi-page mode: active page always visible, no flash */
.page { display: none; }
.page.active { display: block !important; opacity: 1 !important; visibility: visible !important; }
</style>
</head>
<body id="bodyEl">
