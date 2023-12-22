function renderDashBoard() {
    // Code to render the dashboard goes here
  
  // Rest of your code...
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
  /*fetch('lineChart.php')
    .then((res) => res.json())
    .then((data) => {
      renderLineChart(data);
    })
    .catch((error) => {
      console.log(error);
    });*/
    
}
  
window.addEventListener('load', () => {
  if(sessionStorage.getItem('admin-token') === null && sessionStorage.getItem('auth-token') === null){
    const error = new Error('Unauthorized Access');
    error.status = 503;
    throw error;
  }
  if (sessionStorage.getItem('admin-token') !== null) {
    const userManagementLink = document.createElement('p');
    const link = document.createElement('button');
    link.textContent = 'User Management';
    link.onclick = function() {
      window.location.href = './users.html';
    };
    const reportLink = document.createElement('p');
    const l = document.createElement('button');
    l.textContent = 'Generate Report';
    l.onclick = function() {
      window.location.href = './metricName.html';
    };
    reportLink.appendChild(l);
    userManagementLink.appendChild(link);
    document.querySelector('.links').appendChild(userManagementLink);
    document.querySelector('.links').appendChild(reportLink);
  }
  else if(sessionStorage.getItem('auth-token') !== null) {
    const reportLink = document.createElement('p');
    const l = document.createElement('button');
    l.textContent = 'Generate Report';
    l.onclick = function() {
      window.location.href = './metricName.html';
    }
    reportLink.appendChild(l);
    document.querySelector('.links').appendChild(reportLink);
  }
  else if(sessionStorage.getItem('auth-token') === null) {
    const error = new Error('Unauthorized Access');
          error.status = 503;
          throw error;
  }
  renderDashBoard();
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

function renderLineChart(data) {
  let chartData = {
    type: "scatter",
    title: {
        text: "Load Times on Different Operating Systems Over Time",
        fontSize: 18,
        fontColor: "#333",
        bold: true
    },
    series: [
      {
        values: data.android
          .map((item) => [item[0], parseInt(item[1])])
          .sort((a, b) => a[0] - b[0]), // Sort by timestamp in ascending order
        text: "Android",
      },
      {
        values: data.windows
          .map((item) => [item[0], parseInt(item[1])])
          .sort((a, b) => a[0] - b[0]), // Sort by timestamp in ascending order
        text: "Windows",
      },
      {
        values: data.macintosh
          .map((item) => [item[0], parseInt(item[1])])
          .sort((a, b) => a[0] - b[0]), // Sort by timestamp in ascending order
        text: "Macintosh",
      },
      {
        values: data.ios
          .map((item) => [item[0], parseInt(item[1])])
          .sort((a, b) => a[0] - b[0]), // Sort by timestamp in ascending order
        text: "iOS",
      },
    ],
    scaleX: {
      minValue: data.android[0][0], // Set the minimum value as the first timestamp
      step: "hour", // Display labels at hourly intervals
      transform: {
        type: "date",
        all: "%H:%i", // Format the labels as hour:minute
      },
      label: {
        text: "Time of the Day (H:M)",
        fontSize: "14px",
        fontColor: "#333",
      },
    },
    
    scaleY: {
        label: {
            text: "Load Time (ms)",
            fontSize: "14px",
            fontColor: "#333"
        }          
    },
    scaleX: {
      step: "hour",
      transform: {
        type: 'date',
        all: '%g:%i'
      },
        label: {
            text: "Time of the Day (H:M:S)",
            fontSize: "14px",
            fontColor: "#333"
        }
    },
};
}