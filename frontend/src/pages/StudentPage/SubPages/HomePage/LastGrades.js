import React, { useState, useEffect } from "react";
import { useSelector } from "react-redux";

// const data = [
//   {
//     przedmiot: "Angielski",
//     forma: "Lek",
//     ocena: 3.5,
//     data_dodania: "2020-01-04",
//   },
//   {
//     przedmiot: "Podstawy ochrony informacji",
//     forma: "W",
//     ocena: 4,
//     data_dodania: "2020-01-04",
//   },
//   {
//     przedmiot: "Sieci komputerowe",
//     forma: "L",
//     ocena: 2,
//     data_dodania: "2020-01-04",
//   },
//   {
//     przedmiot: "Projekt inżynierski",
//     forma: "L",
//     ocena: 5,
//     data_dodania: "2020-01-04",
//   },
// ];

export default function LastGrades() {
  const info = useSelector((state) => state.info.last_grades) || [];
  const [data, setData] = useState([]);

  useEffect(() => {
    if (info.length !== data.length) {
      setData(info);
    }
  }, [info]);
  return (
    <div className="studenthome__lastgrades">
      <h3>Ostatnie oceny</h3>
      <table className="primary-table transparent">
        <thead>
          <tr>
            <th>Przedmiot</th>
            <th>Forma</th>
            <th>Ocena</th>
            <th>Data dodania</th>
          </tr>
        </thead>
        <tbody>
          {info.length > 0 ? (
            info.map((row, index) => {
              return (
                <tr key={index}>
                  <td>{row.name}</td>
                  <td>{row.form}</td>
                  <td>{row.value}</td>
                  <td>{row.date}</td>
                </tr>
              );
            })
          ) : (
            <tr>
              <td colSpan={4}>Obecnie jeszcze nie ma ocen</td>
            </tr>
          )}
        </tbody>
      </table>
    </div>
  );
}
