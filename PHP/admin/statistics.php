<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/echarts"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <link rel="stylesheet" href="../../CSS/style.css">
    <link rel="stylesheet" href="../../CSS/statistics.css">
    <title>Statistics</title>
    <link href="../../Image/logo.png" rel="icon">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">

            <div id="logo">
                <h1><a href="../admins_interface.php">Open Lib<span>rary</span></a></h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="../admins_interface.php">Home</a></li>
                    <li><a class="nav-link scrollto active" href="./statistics.php">Statistics</a></li>
                    <li><a class="nav-link scrollto" href="./add_book.php">Add Book</a></li>
                    <li><a class="nav-link scrollto" href="./update_info.php">Profile</a></li>
                    <li><a href="../log_out.php">Log Out</a></li>
                </ul>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->
    <div class="full">
        <div class="delete_user">
            <h2>List of Accounts Currently Using The Service</h2>
            <?php
            include('../libs/helper.php');
            Database::db_connect();
            $sql_select_users = "SELECT Email, UserName, Gender, Place_of_origin, A_phone_number
                                FROM users WHERE Users_status = 'Đang hoạt động' AND Roles = 1";
            if (Database::db_execute($sql_select_users)) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Email</th>';
                echo '<th>Full Name</th>';
                echo '<th>Gender</th>';
                echo '<th>Place of Origin</th>';
                echo '<th>A Phone Number</th>';
                echo '<th>Delete</th>';
                echo '</tr>';
                $users = Database::db_get_list($sql_select_users);
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>" . $user['Email'] . "</td>";
                    echo "<td>" . $user['UserName'] . "</td>";
                    echo "<td>" . $user['Gender'] . "</td>";
                    echo "<td>" . $user['Place_of_origin'] . "</td>";
                    echo "<td>" . $user['A_phone_number'] . "</td>";
                    echo "<td>
                <a href='delete.php?email=" . $user['Email'] . "'><button id = 'btn'>Delete</button></a>
                </td>";

                    echo '</tr>';
                }
                echo '</table>';
            }
            ?>
        </div>
        <div class="book_views">
            <h2>Book Views Statistics</h2>
            <div id="myChart1" style="width: 80vh; height: 80vh;"></div>
        </div>
    </div>
    <h2>The Total Views</h2>
    <div class="statistical">
        <canvas id="myChart" width="100%" height="30"></canvas>
    </div>
</body>
<script>
    // Lấy dữ liệu từ tệp PHP
    fetch('data_views.php')
        .then(response => response.json())
        .then(data => {
            // Chuẩn bị dữ liệu cho biểu đồ
            var labels = data.map(item => item.dates);
            var values_sach2 = data.map(item => item.views);

            // Vẽ biểu đồ
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Views',
                        data: values_sach2,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        lineTension: 0.4, // Điều chỉnh độ cong của đường
                        datalabels: {
                            color: 'blue',
                            anchor: 'end',
                            align: 'end',
                        }
                    }]
                },
                plugins: [ChartDataLabels],
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

    fetch('data_book.php')
        .then(response => response.json())
        .then(data => {
            var labels = data.map(item => item.Genre_name);
            var values_sach2 = data.map(item => item.genre_views);

            var backgroundColor = [];
            var borderColor = [];

            while (backgroundColor.length < labels.length) {
                var randomColor = 'rgba(' +
                    Math.floor(Math.random() * 256) + ',' +
                    Math.floor(Math.random() * 256) + ',' +
                    Math.floor(Math.random() * 256) + ',' +
                    '0.8)';
                backgroundColor.push(randomColor);
                borderColor.push(randomColor.replace('0.8', '1'));
            }

            var option = {
                tooltip: {
                    trigger: 'item',
                    formatter: '{a} <br/>{b}: {c} ({d}%)',
                },
                legend: {
                    // Đặt vị trí của chú thích
                    orient: 'horizontal',
                    left: 'center',
                    top: 20,
                },
                series: [{
                    name: 'Views',
                    type: 'pie',
                    radius: ['30%', '60%'],
                    avoidLabelOverlap: false,
                    itemStyle: {
                        borderColor: '#fff',
                        borderWidth: 3,
                    },
                    label: {
                        show: true,
                        position: 'inside',
                        formatter: '{d}%',
                        fontSize: 12,
                        fontWeight: 'bold',
                        fontFamily: "Arial",
                        color: 'black',
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: '30',
                            fontWeight: 'bold',
                            fontFamily: "Arial",
                        }
                    },
                    labelLine: {
                        show: false,
                    },
                    data: values_sach2.map((value, index) => ({
                        value,
                        name: labels[index],
                        itemStyle: {
                            color: backgroundColor[index],
                            borderColor: borderColor[index],
                            borderWidth: 1,
                        },
                    })),
                }]
            };

            var myChart = echarts.init(document.getElementById('myChart1'));
            myChart.setOption(option);
        });
</script>
<script src="../../assets/js/main.js"></script>

</html>