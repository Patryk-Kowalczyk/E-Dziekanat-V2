import React from "react";

const data = [
  {
    przedmiot: "Angielski",
    forma: "Lek",
    ocena: 3.5,
    data_dodania: "2020-01-04",
  },
  {
    przedmiot: "Podstawy ochrony informacji",
    forma: "W",
    ocena: 4,
    data_dodania: "2020-01-04",
  },
  {
    przedmiot: "Sieci komputerowe",
    forma: "L",
    ocena: 2,
    data_dodania: "2020-01-04",
  },
  {
    przedmiot: "Projekt inżynierski",
    forma: "L",
    ocena: 5,
    data_dodania: "2020-01-04",
  },
];

export default function LastGrades() {
  return (
    <div className="studenthome__lastgrades">
      <h3>Ostatnie oceny</h3>
      <table className="transparent">
        <thead>
          <tr>
            <th>Przedmiot</th>
            <th>Forma</th>
            <th>Ocena</th>
            <th>Data dodania</th>
          </tr>
        </thead>
        <tbody>
          {data.map((row, index) => {
            return (
              <tr key={index}>
                <td>{row.przedmiot}</td>
                <td>{row.forma}</td>
                <td>{row.ocena}</td>
                <td>{row.data_dodania}</td>
              </tr>
            );
          })}
        </tbody>
      </table>
    </div>
  );
}
