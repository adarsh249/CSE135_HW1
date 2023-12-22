zingchart.render({
    id: "staticChart",
    data: {
        type: "pie",
        series: [{
            values: deviceCounts.map(function(device) {
                return device.value;
            }),
            text: deviceCounts.map(function(device) {
                return device.label;
            })
        }]
    }
});

zingchart.render({
    id: "barChart",
    data: {
        type: "bar",
        series: barChartData.series
    }
});

zingchart.render({
    id: "pieChart",
    data: {
        type: "pie",
        series: pieChartData.series
    }
});

