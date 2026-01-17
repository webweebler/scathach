# ============================================
# Scathach Theme - Deploy to XAMPP (Local)
# ============================================
# Quick deployment script for local testing
#
# Usage: .\deploy-xampp.ps1
# ============================================

$SourcePath = "C:\Users\user\Documents\projects\Scathach\current-theme"
$TargetPath = "C:\xampp\htdocs\wp-content\themes\scathach-theme"

Write-Host ""
Write-Host "Deploying Scathach Theme to XAMPP..." -ForegroundColor Cyan
Write-Host ""

# Verify source exists
if (-not (Test-Path $SourcePath)) {
    Write-Host "[ERROR] Source path not found: $SourcePath" -ForegroundColor Red
    exit 1
}

# Verify XAMPP is installed
if (-not (Test-Path "C:\xampp\htdocs")) {
    Write-Host "[ERROR] XAMPP not found at C:\xampp" -ForegroundColor Red
    exit 1
}

# Create theme directory if it doesn't exist
if (-not (Test-Path $TargetPath)) {
    New-Item -ItemType Directory -Path $TargetPath -Force | Out-Null
}

# Copy theme files
Write-Host "[*] Copying theme files..." -ForegroundColor Yellow

# Get all items except videos folder (large files that rarely change)
$items = Get-ChildItem -Path $SourcePath -Exclude "videos"
foreach ($item in $items) {
    try {
        Copy-Item -Path $item.FullName -Destination $TargetPath -Recurse -Force -ErrorAction Stop
    } catch {
        Write-Host "[WARN] Could not copy: $($item.Name) - file may be in use" -ForegroundColor Yellow
    }
}

# Copy videos separately with error handling
$videosSource = Join-Path $SourcePath "videos"
$videosDest = Join-Path $TargetPath "videos"
if (Test-Path $videosSource) {
    if (-not (Test-Path $videosDest)) {
        New-Item -ItemType Directory -Path $videosDest -Force | Out-Null
    }
    Get-ChildItem -Path $videosSource | ForEach-Object {
        try {
            Copy-Item -Path $_.FullName -Destination $videosDest -Force -ErrorAction Stop
        } catch {
            Write-Host "[SKIP] Video file in use: $($_.Name)" -ForegroundColor Gray
        }
    }
}

Write-Host "[OK] Theme deployed to XAMPP!" -ForegroundColor Green
Write-Host ""
Write-Host "View at: http://localhost" -ForegroundColor White
Write-Host "Admin:   http://localhost/wp-admin" -ForegroundColor White
Write-Host ""
