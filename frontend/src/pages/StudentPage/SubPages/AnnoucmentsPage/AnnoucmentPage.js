import React, { useState, useEffect } from "react";
import "./annoucmentspage.scss";
import { useParams } from "react-router-dom";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";


export default function AnnoucmentPage() {
  const { id } = useParams();
  const [data, setData] = useState(null);

  useEffect(() => {
    const config = {
      headers: header(),
    };
    axios
      .post(API_URL + "student/messageDetails", { id: id }, config)
      .then((response) => {
        setData(response.data.message);
      });
  }, []);
  return (
    <div className="annoucment-page">
      {data ? (
        <>
          <h1>{data.title}</h1>
          <p className="date">
            Dodano: {data.date} przez {data.added_by}
          </p>
          <p className="text">{data.text}</p>
        </>
      ) : (
        <div className="loading"></div>
      )}
    </div>
  );
}
