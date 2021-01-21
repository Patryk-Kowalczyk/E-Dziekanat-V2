import React, { useState, useEffect } from "react";
import TableRow from "./TableRow";
import header from "../../../../services/auth-header";
import { useSelector } from "react-redux";

// const sampleTable = [
//   {
//     name: "Podstawy ochrony informacji",
//     since: "08:15",
//     to: "10:00",
//     room: "WI WI1-Zaj_zdalne",
//     form: "W",
//   },
//   {
//     name: "Angielski",
//     since: "10:15",
//     to: "12:00",
//     room: "WI WI1-Zaj_zdalne",
//     form: "L",
//   },
// ];

// function Rows() {
//   const [data, setData] = useState([]);
//   setData(useSelector((state) => state.info.day_plan));
//   const renderRows = data.map((row, index) => {
//     return <TableRow key={index} row={row} />;
//   });
//   return <>{renderRows}</>;
// }

export default function TodaysTimeTable() {
  const info = useSelector((state) => state.info.day_plan) || [];
  const [data, setData] = useState([]);

  useEffect(() => {
    if (info.length !== data.length) {
      setData(info);
    }
  }, [info]);

  return (
    <div className="studenthome__timetable">
      <h3>Plan zajęć na dziś:</h3>
      <table className="primary-table">
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
