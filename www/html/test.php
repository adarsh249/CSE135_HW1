<!DOCTYPE html>
<html>
<head>
  <title>Line Chart with Three Series - ZingChart</title>
  <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
</head>
<body>
  <div id="myChart"></div>

  <script>
    // Chart data
    var chartData = {
      "type": "line",
      "series": [
        {
          "values": [5, 10, 15, 20, 25],
          "text": "Series 1"
        },
        {
          "values": [10, 15, 20, 25, 30],
          "text": "Series 2"
        },
        {
          "values": [15, 20, 25, 30, 35],
          "text": "Series 3"
        }
      ]
    };

    // Chart configuration
    var chartConfig = {
      "graphset": [
        {
          "type": "line",
          "series": chartData.series
        }
      ]
    };

    // Render the chart
    zingchart.render({
      id: 'myChart',
      data: chartConfig,
      height: '100%',
      width: '100%'
    });
  </script>
</body>
</html>
