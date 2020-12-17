import React from "react";
import DayTable from "./DayTable";

const data = [
  {
    from: "8:15",
    to: "10:00",
    name: "Podstawy ochrony informacji",
    teacher: "Andrzej Jakiś",
    room: "202",
    form: "L",
  },
  {
    from: "12:15",
    to: "14:00",
    name: "Podstawy ochrony informacji",
    teacher: "Andrzej Jakiś",
    room: "204",
    form: "W",
  },
  {
    from: "14:15",
    to: "16:00",
    name: "ZI",
    teacher: "Andrzej Jakiś",
    room: "204",
    form: "W",
  },
];

export default function DaysTable() {
  return (
    <div className="daystable">
      <table>
        <thead>
          <tr>
            <th>Od</th>
            <th>Do</th>
            <th>Nazwa</th>
            <th>Prowadzący</th>
            <th>Sala</th>
            <th>Forma</th>
          </tr>
        </thead>
        <tbody>
          {data.map((item) => {
            return <DayTable data={item} />;
          })}
        </tbody>
      </table>
    </div>
  );
}
