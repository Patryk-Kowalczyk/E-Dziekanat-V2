import React, { useState, useEffect } from "react";
import "./pollspage.scss";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";
import { Link } from "react-router-dom";

function TableRow({ poll }) {
  const isButtonEnabled = () => {
    const today = new Date();
    const since = new Date(poll.since);
    const to = new Date(poll.to);

    if (!poll.status && today < to && today > since) {
      return true;
    } else {
      return false;
    }
  };

  return (
    <tr>
      <td>{poll.poll_name}</td>
      <td>{poll.since}</td>
      <td>{poll.to}</td>
      <td>
        {isButtonEnabled() ? (
          <Link to={`/student/ankiety/${poll.poll_id}`}>
            <button className="button primary">Wypełnij</button>
          </Link>
        ) : (
          <button className="button primary" disabled>
            Wypełnij
          </button>
        )}
      </td>
    </tr>
  );
}

function PollsPage() {
  const [data, setData] = useState(null);

  const config = {
    headers: header(),
  };
  useEffect(() => {
    axios.get(API_URL + "student/pollList", config).then((response) => {
      setData(response.data.list_polls);
    });
  }, []);

  return (
    <div className="pollspage">
      <h1>Ankiety</h1>
      <div className="pollspage-container">
        <h2>Dostępne ankiety:</h2>
        {data ? (
          <div className="table-container">
            <table>
              <thead>
                <tr>
                  <th>Nazwa ankiety</th>
                  <th>Dostępna od</th>
                  <th>Dostępna do</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                {data.map((poll) => {
                  return <TableRow poll={poll} key={poll.poll_name} />;
                })}
              </tbody>
            </table>
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
