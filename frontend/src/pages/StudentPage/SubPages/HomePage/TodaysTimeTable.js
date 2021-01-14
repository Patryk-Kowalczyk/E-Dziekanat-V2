import React, { useState, useEffect } from "react";
import TableRow from "./TableRow";
import axios from "axios";
import header from "../../../../services/auth-header";

const sampleTable = [
  {
    name: "Podstawy ochrony informacji",
    since: "08:15",
    to: "10:00",
    room: "WI WI1-Zaj_zdalne",
    form: "W",
  },
  {
    name: "Angielski",
    since: "10:15",
    to: "12:00",
    room: "WI WI1-Zaj_zdalne",
    form: "L",
  },
];

// function Rows() {
//   const [data, setData] = useState([]);
//   setData(useSelector((state) => state.info.day_plan));
//   const renderRows = data.map((row, index) => {
//     return <TableRow key={index} row={row} />;
//   });
//   return <>{renderRows}</>;
// }

export default function TodaysTimeTable() {
  const [data, setData] = useState([]);

  const config = {
    headers: header(),
  };

  useEffect(() => {
    axios
      .get("http://createosm.pl/IPZ/backend/public/api/auth/dashboard", config)
      .then((response) => {
        setData(response.data.day_plan);
      })
      .catch((err) => console.error(err));
  }, []);
  return (
    <div className="studenthome__timetable">
      <h3>Plan zajęć na dziś:</h3>
      <table>
        <thead>
          <tr>
            <th>Nazwa</th>
            <th>Od</th>
            <th>Do</th>
            <th>Sala</th>
            <th>Forma</th>
          </tr>
        </thead>
        <tbody>
          {data.map((row, index) => {
            return <TableRow key={index} row={row} />;
          })}
        </tbody>
      </table>
    </div>
  );
}
