import React from "react";
import "./financialdata.scss";
import { Link } from "react-router-dom";

const data = [
  {
    title: "Czesne",
    subaccount: "321321321321321312321",
    id: 32132,
  },
  {
    title: "Legitymacja",
    subaccount: "43223423423423423432432",
    id: 543543,
  },
];

function TableRow({ data }) {
  return (
    <tr>
      <td>{data.title}</td>
      <td>{data.subaccount}</td>
      <td>
        <Link to={`/student/dane-finansowe/${data.id}`}>Więcej</Link>
      </td>
    </tr>
  );
}

export default function index() {
  return (
    <div className="financialdata">
      <h1>Dane finansowe</h1>
      <div className="financialdata-container">
        <h2>Należności</h2>
        <table className="primary-table">
          <thead>
            <tr>
              <th>Tytuł opłaty</th>
              <th>Subkonto</th>
              <th>Szczegóły</th>
            </tr>
          </thead>
          <tbody>
            {data ? (
              data.map((single) => <TableRow data={single} />)
            ) : (
              <div className="loading"></div>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}
