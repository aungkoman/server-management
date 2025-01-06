<?php
// Disable error reporting for security reasons
error_reporting(0);

// Function to get the command output safely
function getCommandOutput($command) {
    return shell_exec($command);
}

// Get server specifications
$os = getCommandOutput("lsb_release -d | cut -f2");
$kernel = getCommandOutput("uname -r");
$hostname = getCommandOutput("hostname");
$cpu = getCommandOutput("lscpu | grep 'Model name' | awk -F ':' '{print $2}' | xargs");
$memory = getCommandOutput("free -h | grep Mem | awk '{print $2}'");
$disk = getCommandOutput("df -h --total | grep total | awk '{print $2}'");
$uptime = getCommandOutput("uptime -p");
$phpVersion = phpversion();
$serverSoftware = $_SERVER['SERVER_SOFTWARE'];
$ipAddress = $_SERVER['SERVER_ADDR'] ?? 'Unknown';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Specifications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 20px;
        }
        table {
            width: 70%;
            margin: 0 auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #fff;
        }
        th, td {
            padding: 10px 15px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            text-align: left;
        }
        h1 {
            text-align: center;
            color: #444;
        }
    </style>
</head>
<body>
    <h1>Server Specifications</h1>
    <table>
        <tr>
            <th>Specification</th>
            <th>Details</th>
        </tr>
        <tr>
            <td>Operating System</td>
            <td><?php echo htmlspecialchars($os); ?></td>
        </tr>
        <tr>
            <td>Kernel Version</td>
            <td><?php echo htmlspecialchars($kernel); ?></td>
        </tr>
        <tr>
            <td>Hostname</td>
            <td><?php echo htmlspecialchars($hostname); ?></td>
        </tr>
        <tr>
            <td>CPU</td>
            <td><?php echo htmlspecialchars($cpu); ?></td>
        </tr>
        <tr>
            <td>Total Memory</td>
            <td><?php echo htmlspecialchars($memory); ?></td>
        </tr>
        <tr>
            <td>Total Disk Space</td>
            <td><?php echo htmlspecialchars($disk); ?></td>
        </tr>
        <tr>
            <td>Uptime</td>
            <td><?php echo htmlspecialchars($uptime); ?></td>
        </tr>
        <tr>
            <td>PHP Version</td>
            <td><?php echo htmlspecialchars($phpVersion); ?></td>
        </tr>
        <tr>
            <td>Web Server</td>
            <td><?php echo htmlspecialchars($serverSoftware); ?></td>
        </tr>
        <tr>
            <td>IP Address</td>
            <td><?php echo htmlspecialchars($ipAddress); ?></td>
        </tr>
    </table>
</body>
</html>
