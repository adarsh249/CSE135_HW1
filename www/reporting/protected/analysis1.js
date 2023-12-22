  
window.addEventListener('load', () => {
    fetch('barChartBadExample.php')
    .then((res) => res.json())
    .then((data) => {
      renderBadBarChart(data);
    })
    .catch((error) => {
      console.log(error);
    });
    
    fetch('barChart.php')
    .then((res) => res.json())
    .then((data) => {
      renderBarChart(data);
    })
    .catch((error) => {
      console.log(error);
    });
    
    fetch('pieChart.php')
    .then((res) => res.json())
    .then((data) => {
      renderPieChart(data);
    })
    .catch((error) => {
      console.log(error);
    });

    
});

function renderPieChart(data) {
  let chartData = {
    type: "pie3d",
    backgroundColor: "#2F2B3F",
    title: {
      text: "Types of Operating Systems Accessing Our Site",
      fontColor: "#7d798d",
      fontSize: "14px",
      textAlign: "left",
    },
    plot: {
      valueBox: {
        text: "%t\n%npv%",
        placement: "out"
      },
      borderColor: "none"
    },
    series: [
      {
        values: [data.Android],
        text: "Android",
        backgroundColor: "#ee98d0",
      },
      {
        values: [data.iOS],
        text: "iOS",
        backgroundColor: "#e6e6fa",
      },
      {
        values: [data.Windows],
        text: "Windows",
        backgroundColor: "#30b8ea",
      },
      {
        values: [data.Macintosh],
        text: "Macintosh",
        backgroundColor: "#7121ea",
      },
    ]
  };
  zingchart.render({
    id: "pieChart",
    data: chartData,
    height: "400px",
    width: "100%",
  });
}


function renderBarChart(data) {
    let chartData = {
        type: "hbar",
        backgroundColor: "#2F2B3F",
        title: {
          text: "Page Load Time by Operating System on Different Network Speeds",
          color: "#7d798d",
          fontSize: "14px",
        },
        scaleY: {
          label: {
            text: "Page Loading Time (ms)",
            color: "#7d798d",
          },
        },
        scaleX: {
          values: ["Macintosh", "Windows", "iOS", "Android"],
          label: {
            text: "Operating Systems",
            color: "#7d798d",
          },
        },
        series: [
          {
            values: [
              data.Macintosh3G,
              data.Windows3G,
              data.iOS3G,
              data.Android3G,
            ],
            text: "3G Network",
            "backgroundColor": "#7f70ce",
          },
          {
            values: [
              data.Macintosh4G,
              data.Windows4G,
              data.iOS4G,
              data.Android4G,
            ],
            text: "4G Network",
            "backgroundColor": "#5ab0d0",
          },
        ],
        plotarea: {
          margin: "dynamic",
          marginRight: "50",
        },
        plot: {
          showZero: true,
          barSpace: 0,
          'border-radius': "5px",
          'value-box': {
            text: "%v ms",
            decimals: 2,
          },
        },
        legend: {
          backgroundColor: "none",
          borderWidth: 0,
          item: {
            fontColor: "#7d798d",
            cursor: "pointer",
          },
          marker: {
            type: "circle",
            cursor: "pointer",
            size: 6,
          },
          toggleAction: "remove",
        },
    };

    zingchart.render({
        id: "barChart",
        data: chartData,
        height: "400px",
        width: "100%",
    });
}

function renderBadBarChart(data) {
    let chartData = {
        type: "hbar",
        backgroundColor: "#2F2B3F",
        title: {
          text: "Page Load Time by Operating System",
          color: "#7d798d",
          fontSize: "14px",
        },
        scaleY: {
          label: {
            text: "Page Loading Time (ms)",
            color: "#7d798d",
          },
        },
        scaleX: {
          values: ["Macintosh", "Windows", "iOS", "Android"],
          label: {
            text: "Operating Systems",
            color: "#7d798d",
          },
        },
        series: [
          {
            values: [
              data.Macintosh,
              data.Windows,
              data.iOS,
              data.Android,
            ],
            "backgroundColor": "#7f70ce",
          },
        ],
        plotarea: {
          margin: "dynamic",
          marginRight: "50",
        },
        plot: {
          showZero: true,
          barSpace: 0,
          'border-radius': "5px",
          'value-box': {
            text: "%v ms",
            decimals: 2,
          },
        },
        legend: {
          backgroundColor: "none",
          borderWidth: 0,
          item: {
            fontColor: "#7d798d",
            cursor: "pointer",
          },
          marker: {
            type: "circle",
            cursor: "pointer",
            size: 6,
          },
          toggleAction: "remove",
        },
    };

    zingchart.render({
        id: "barChartBadExample",
        data: chartData,
        height: "400px",
        width: "100%",
    });
}