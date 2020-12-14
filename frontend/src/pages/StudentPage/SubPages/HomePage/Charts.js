import React from "react";
import Chart from "react-apexcharts";

const series = [
  {
    name: "Przedmioty",
    data: [4, 3, 2, 2, 5, 3.5],
  },
];

const options = {
  chart: {
    id: "basic-bar",
    width: "100%",
  },
  xaxis: {
    categories: ["POI", "ZI", "SI", "SK", "WF", "ANGIELSKI", "DS"],
  },
  responsive: [
    {
      breakpoint: 1000,
      options: { chart: { width: "100%" } },
    },
  ],
};

export default function Charts() {
  return (
    <div className="studenthome__charts">
      <h3>Obecna średnia z ocen</h3>
      <div className="studenthome__charts-chart">
        <Chart options={options} series={series} type="bar" height={"100%"} />
      </div>
    </div>
  );
}
