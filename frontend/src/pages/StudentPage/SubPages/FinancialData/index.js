import React, { useState, useEffect } from "react";
import "./financialdata.scss";
import { Link } from "react-router-dom";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";

// const data = [
//   {
//     title: "Czesne",
//     subaccount: "321321321321321312321",
//     id: 32132,
//   },
//   {
//     title: "Legitymacja",
//     subaccount: "43223423423423423432432",
//     id: 543543,
//   },
// ];

function TableRow({ data }) {
  return (
    <tr>
      <td>{data.title}</td>
      <td>{data.sub_account}</td>
      <td>
        <Link to={`/student/dane-finansowe/${data.id}`}>Więcej</Link>
      </td>
    </tr>
  );
}

function FinancialData() {
  const [data, setData] = useState(null);

  useEffect(() => {
    const config = {
      headers: header(),
    };
    axios.get(API_URL + "student/payments", config).then((response) => {
      setData(response.data.payments);
    });
  }, []);

  return (
    <div className="financialdata">
      <h1>Dane finansowe</h1>
      <div className="financialdata-container">
        <h2>Należności</h2>
        {data ? (
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
                data.map((single, index) => (
                  <TableRow data={single} key={index} />
                ))
              ) : (
                <div className="loading"></div>
              )}
            </tbody>
          </table>
        ) : (
          <h3>Brakt danych dla danego studenta</h3>
        )}
      </div>
    </div>
  );
}

export default function index(props) {
  return <FinancialData {...props} />;
}
