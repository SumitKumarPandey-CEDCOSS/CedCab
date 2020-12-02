<?php
/**
 * Php version 7.2.10
 * 
 * @category Components
 * @package  Packagename
 * @author   Sumit kumar Pandey <pandeysumit399@gmail.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://localhost/training/php%20mysql%20task1/register/signup.php
 */
require 'config.php';
$db = new Ride();
$Us = new User();
$loc = new LocationTable();
$loc->connect('localhost', 'root', '', 'CabBooking');
$db->connect('localhost', 'root', '', 'CabBooking');
$Us->connect('localhost', 'root', '', 'CabBooking');
$sql = $db->count_pending_ride();
$confirm = $db->count_ride();
$confirm_rides = $db->count_confirm_ride();
$count_user = $Us->count_user();
$count_pending_user = $Us->count_pending_request();
$total_revenue = $db->Total_Revenue();
$blocked = $Us->count_blocked();
$location = $loc->count_location();

// check Admin Login
if (!empty(isset($_SESSION['userdata']) && ($_SESSION['userdata']['is_admin'] == 'admin'))) {
    $user = $_SESSION['userdata']['username'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    header("Refresh:0; url=login.php");
}
// Header
require 'header.php';
?>
<body class="admintop">
    <div class="adminbody" style="height:800px;">
        <img src="../images/taxi4.jpg" alt="" style="height:800px;">
        <div id="AdminWelcomeQuote">
            <h1>Welcome &nbsp;<?php if (!empty($user)) {
                                    echo $user;
                                } ?></h1>
        </div>
        <div class="maintiles">
            <div class="tiles"><a href="pending_ride.php">
                    <p><i class="fa fa-bar-chart"></i></p>Pending_Rides &nbsp;<span><?php echo $sql ?></span>
                </a>
            </div>
            <div class="tiles"><a href="pending_request.php">
                    <p><i class="fa fa-cubes"></i></p>Pending User &nbsp;<span><?php echo $count_pending_user ?></span>
                </a>
            </div>
            <div class="tiles"><a href="All_rides.php">
                    <p><i class="fa fa-group"></i></p>Total Rides &nbsp; <span><?php echo $confirm ?></span>
                </a>
            </div>
            <div class="tiles"><a href="manageLocation.php">
                    <p><i class="fa fa-handshake-o"></i></p>All location &nbsp; <span><?php echo $location ?></span>
                </a>
            </div>
        </div>
        <div class="maintiles">
            <div class="tiles"><a href="completed_ride.php">
                    <p><i class="fa fa-hourglass-2"></i></p>Confirm_Rides &nbsp;<span><?php echo $confirm_rides ?></span>
                </a>
            </div>
            <div class="tiles"><a href="javascript:void(0)">
                    <?php
                    $sum = 0;
                    foreach ($total_revenue as $key) {
                        $sum += $key['total_fare'];
                    }   ?>
                    <p><i class="fa fa-line-chart"></i></p>Total_Revenue <span><?php echo $sum ?> &nbsp;$</span></a></div>
            <div class="tiles"><a href="javascript:void(0)">
                    <p><i class="fa fa-search-plus"></i></p>Blocked_Users <span><?php echo $blocked ?></span>
                </a>
            </div>
            <div class="tiles"><a href="manageCustomer.php">
                    <p><i class="fa fa-signal"></i></p>All_Users <span><?php echo $count_user ?></span>
                </a>
            </div>
        </div>
    </div>

    <!-- Google Chart to show data in Graphical form -->
    <script type="text/javascript">
        // Load google charts
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart and set the chart values
        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Total Rides', <?php echo $confirm ?>],
                ['Total User', <?php echo $count_user ?>],
                ['Confirm Rides', <?php echo $confirm_rides ?>],
                ['Pending Rides', <?php echo $sql ?>]
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {
                'title': 'Graphical Representation of data',
                'width': 1350,
                'height': 400
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
    <div id="piechart"></div>
    <!-- Footer -->
    <?php require 'footer.php' ?>
    <!-- Javascript included -->
    <script src="../script.js"></script>
</body>