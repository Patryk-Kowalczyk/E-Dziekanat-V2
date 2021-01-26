import React, { useState, useEffect } from "react";
import "./pollspage.scss";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";
import Chart from "react-apexcharts";

const LABELS = [
  "Bardzo słabo",
  "Słabo",
  "Umiarkowanie",
  "Dobrze",
  "Bardzo dobrze",
];

function GenerateChart({ seriesData }) {
  const series = [
    {
      name: "Głosy",
      data: seriesData,
    },
  ];
  const options = {
    chart: {
      id: "basic-bar",
      width: "100%",
    },
    xaxis: {
      categories: LABELS,
    },
    responsive: [
      {
        breakpoint: 1000,
        options: { chart: { width: "100%" } },
      },
    ],
  };

  return <Chart options={options} series={series} type="bar" height={"100%"} />;
}

function PollsPage() {
  const [data, setData] = useState(null);

  const config = {
    headers: header(),
  };
  useEffect(() => {
    axios.get(API_URL + "educator/pollStats", config).then((response) => {
      setData(response.data.stats);
    });
  }, []);

  const getSeries = (answers) => {
    return answers.map((answer) => answer.count);
  };

  return (
    <div className="pollspage">
      <h1>Ankiety</h1>
      <div className="pollspage-container">
        {data ? (
          <div className="pollspage-stats">
            {Object.values(data).map((result) => {
              return (
                <div className="pollspage-stat" key={result.name}>
                  <h2>{result.name}:</h2>
                  <GenerateChart seriesData={getSeries(result.answers)} />
                </div>
              );
            })}
          </div>
        ) : (
          <h3>Aktualnie brak ankiet</h3>
        )}
      </div>
    </div>
  );
}

export default function index(props) {
  return <PollsPage {...props} />;
}
