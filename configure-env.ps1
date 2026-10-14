# Points the Laravel .env at XAMPP's MySQL (user root, no password, database zild_cafe).
# Run from the Laravel project folder (setup.bat does this for you).
$envFile = Join-Path (Get-Location) '.env'
$lines = Get-Content $envFile

$map = [ordered]@{
    DB_CONNECTION = 'mysql'
    DB_HOST       = '127.0.0.1'
    DB_PORT       = '3306'
    DB_DATABASE   = 'zild_cafe'
    DB_USERNAME   = 'root'
    DB_PASSWORD   = ''
}

foreach ($key in $map.Keys) {
    $pattern = '^\s*#?\s*' + $key + '='
    $out = @()
    $found = $false
    foreach ($line in $lines) {
        if ($line -match $pattern) { $out += ($key + '=' + $map[$key]); $found = $true }
        else { $out += $line }
    }
    if (-not $found) { $out += ($key + '=' + $map[$key]) }
    $lines = $out
}

# WriteAllLines = UTF-8 without BOM (a BOM can break .env parsing)
[System.IO.File]::WriteAllLines($envFile, [string[]]$lines)
Write-Host ".env now points to MySQL database 'zild_cafe'."
