# ============================================
# Scathach Theme - Live Deployment Script
# ============================================
# This script deploys the current-theme to the live WordPress server
# 
# Usage: .\deploy-live.ps1 [-DryRun] [-Backup]
# ============================================

param(
    [switch]$DryRun,      # Preview changes without deploying
    [switch]$Backup       # Create backup before deploying
)

# ============================================
# CONFIGURATION - Update these for your server
# ============================================
$Config = @{
    # Local paths
    LocalThemePath = "C:\Users\user\Documents\projects\Scathach\current-theme"
    
    # Remote server settings (update these)
    RemoteHost = "your-server.com"
    RemoteUser = "your-username"
    RemotePath = "/home/username/public_html/wp-content/themes/scathach-theme"
    
    # SSH key path (optional - leave empty to use password)
    SSHKeyPath = ""
    
    # FTP settings (alternative to SSH)
    UseFTP = $false
    FTPHost = "ftp.your-server.com"
    FTPUser = "ftp-username"
    FTPPath = "/public_html/wp-content/themes/scathach-theme"
    
    # Files/folders to exclude from deployment
    ExcludePatterns = @(
        "*.md",
        ".git",
        ".gitignore",
        "node_modules",
        ".DS_Store",
        "Thumbs.db"
    )
}

# ============================================
# FUNCTIONS
# ============================================

function Write-Header {
    param([string]$Message)
    Write-Host ""
    Write-Host "========================================" -ForegroundColor Cyan
    Write-Host " $Message" -ForegroundColor Cyan
    Write-Host "========================================" -ForegroundColor Cyan
    Write-Host ""
}

function Write-Step {
    param([string]$Message)
    Write-Host "[*] $Message" -ForegroundColor Yellow
}

function Write-Success {
    param([string]$Message)
    Write-Host "[OK] $Message" -ForegroundColor Green
}

function Write-Error {
    param([string]$Message)
    Write-Host "[ERROR] $Message" -ForegroundColor Red
}

function Test-Prerequisites {
    Write-Step "Checking prerequisites..."
    
    # Check if local theme path exists
    if (-not (Test-Path $Config.LocalThemePath)) {
        Write-Error "Local theme path not found: $($Config.LocalThemePath)"
        return $false
    }
    
    # Check for required files
    $requiredFiles = @("style.css", "functions.php", "index.php")
    foreach ($file in $requiredFiles) {
        $filePath = Join-Path $Config.LocalThemePath $file
        if (-not (Test-Path $filePath)) {
            Write-Error "Required file missing: $file"
            return $false
        }
    }
    
    Write-Success "All prerequisites met"
    return $true
}

function Get-ThemeVersion {
    $stylePath = Join-Path $Config.LocalThemePath "style.css"
    $content = Get-Content $stylePath -Raw
    if ($content -match "Version:\s*(.+)") {
        return $Matches[1].Trim()
    }
    return "unknown"
}

function New-DeploymentPackage {
    Write-Step "Creating deployment package..."
    
    $timestamp = Get-Date -Format "yyyyMMdd-HHmmss"
    $packageDir = "C:\Users\user\Documents\projects\Scathach\deploy\packages"
    $packageName = "scathach-theme-$timestamp"
    $packagePath = Join-Path $packageDir $packageName
    
    # Create packages directory if needed
    if (-not (Test-Path $packageDir)) {
        New-Item -ItemType Directory -Path $packageDir -Force | Out-Null
    }
    
    # Copy theme to package directory
    Copy-Item -Path $Config.LocalThemePath -Destination $packagePath -Recurse
    
    # Remove excluded files
    foreach ($pattern in $Config.ExcludePatterns) {
        Get-ChildItem -Path $packagePath -Recurse -Filter $pattern -Force -ErrorAction SilentlyContinue | 
            Remove-Item -Recurse -Force -ErrorAction SilentlyContinue
    }
    
    Write-Success "Package created: $packagePath"
    return $packagePath
}

function Deploy-ViaSSH {
    param([string]$PackagePath)
    
    Write-Step "Deploying via SSH/SCP..."
    
    $scpArgs = @()
    if ($Config.SSHKeyPath -and (Test-Path $Config.SSHKeyPath)) {
        $scpArgs += "-i", $Config.SSHKeyPath
    }
    
    $remoteDest = "$($Config.RemoteUser)@$($Config.RemoteHost):$($Config.RemotePath)"
    
    if ($DryRun) {
        Write-Host "  [DRY RUN] Would execute: scp -r $PackagePath/* $remoteDest" -ForegroundColor Magenta
    } else {
        # Using rsync if available (more efficient), fallback to scp
        $rsyncAvailable = Get-Command rsync -ErrorAction SilentlyContinue
        
        if ($rsyncAvailable) {
            $excludeArgs = $Config.ExcludePatterns | ForEach-Object { "--exclude=$_" }
            $rsyncCmd = "rsync -avz --delete $excludeArgs `"$PackagePath/`" `"$remoteDest/`""
            Write-Host "  Executing: $rsyncCmd" -ForegroundColor Gray
            Invoke-Expression $rsyncCmd
        } else {
            # Fallback to SCP
            $scpCmd = "scp -r `"$PackagePath\*`" `"$remoteDest`""
            Write-Host "  Executing: $scpCmd" -ForegroundColor Gray
            Invoke-Expression $scpCmd
        }
    }
}

function Deploy-ViaFTP {
    param([string]$PackagePath)
    
    Write-Step "Deploying via FTP..."
    
    if ($DryRun) {
        Write-Host "  [DRY RUN] Would upload $PackagePath to $($Config.FTPHost)$($Config.FTPPath)" -ForegroundColor Magenta
        return
    }
    
    # Using WinSCP if available, or provide manual instructions
    $winscp = Get-Command winscp.com -ErrorAction SilentlyContinue
    
    if ($winscp) {
        Write-Host "  Using WinSCP for FTP transfer..." -ForegroundColor Gray
        $ftpScript = @"
open ftp://$($Config.FTPUser)@$($Config.FTPHost)
synchronize remote "$PackagePath" "$($Config.FTPPath)"
exit
"@
        $ftpScript | & winscp.com /script=/dev/stdin
    } else {
        Write-Host ""
        Write-Host "  Manual FTP upload required:" -ForegroundColor Yellow
        Write-Host "  1. Connect to: $($Config.FTPHost)" -ForegroundColor White
        Write-Host "  2. Navigate to: $($Config.FTPPath)" -ForegroundColor White
        Write-Host "  3. Upload contents of: $PackagePath" -ForegroundColor White
        Write-Host ""
        Write-Host "  Tip: Install WinSCP for automated FTP deployment" -ForegroundColor Gray
    }
}

function Deploy-ToXAMPP {
    Write-Step "Deploying to local XAMPP..."
    
    $xamppThemePath = "C:\xampp\htdocs\wp-content\themes\scathach-theme"
    
    if ($DryRun) {
        Write-Host "  [DRY RUN] Would copy to: $xamppThemePath" -ForegroundColor Magenta
        return
    }
    
    Copy-Item -Path "$($Config.LocalThemePath)\*" -Destination $xamppThemePath -Recurse -Force
    Write-Success "Deployed to XAMPP: $xamppThemePath"
}

# ============================================
# MAIN EXECUTION
# ============================================

Write-Header "Scathach Theme Deployment"

if ($DryRun) {
    Write-Host "*** DRY RUN MODE - No changes will be made ***" -ForegroundColor Magenta
    Write-Host ""
}

# Check prerequisites
if (-not (Test-Prerequisites)) {
    exit 1
}

# Display deployment info
$version = Get-ThemeVersion
Write-Host "Theme Version: $version" -ForegroundColor White
Write-Host "Source: $($Config.LocalThemePath)" -ForegroundColor White
Write-Host "Target: $($Config.RemoteHost):$($Config.RemotePath)" -ForegroundColor White
Write-Host ""

# Confirm deployment
if (-not $DryRun) {
    $confirm = Read-Host "Deploy to LIVE server? (yes/no)"
    if ($confirm -ne "yes") {
        Write-Host "Deployment cancelled." -ForegroundColor Yellow
        exit 0
    }
}

# Create deployment package
$packagePath = New-DeploymentPackage

# Deploy based on configuration
if ($Config.UseFTP) {
    Deploy-ViaFTP -PackagePath $packagePath
} else {
    Deploy-ViaSSH -PackagePath $packagePath
}

# Also update local XAMPP
Deploy-ToXAMPP

Write-Header "Deployment Complete"
Write-Success "Theme deployed successfully!"
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Yellow
Write-Host "  1. Clear any caching plugins on the live site" -ForegroundColor White
Write-Host "  2. Test the live site thoroughly" -ForegroundColor White
Write-Host "  3. Check browser console for any errors" -ForegroundColor White
Write-Host ""
