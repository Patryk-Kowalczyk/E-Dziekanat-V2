import React from "react";

export default function GradesTable({ grades }) {
  if (grades && grades.length > 0) {
    return (
      <>
        <h4>Oceny:</h4>
        <div className="table-container">
          <table className="gradestable">
            <thead>
              <tr>
                <th>Lp.</th>
                <th>Kategoria</th>
                <th>Ocena</th>
                <th>Data</th>
                <th>Uwagi</th>
              </tr>
            </thead>
            <tbody>
              {grades.map((grade, index) => {
                return (
                  <tr key={index}>
                    <td>{`${index + 1}.`}</td>
                    <td>{grade.category}</td>
                    <td>{grade.grade}</td>
                    <td>{grade.date}</td>
                    <td>{grade.comments}</td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
      </>
    );
  } else {
    return <p>Wybierz przedmiot z listy.</p>;
  }
}
