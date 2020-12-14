import React from "react";
import TableRow from "./TableRow";

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

export default function TodaysTimeTable() {
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
          {sampleTable.map((row, index) => {
            return <TableRow key={index} row={row} />;
          })}
        </tbody>
      </table>
    </div>
  );
}
