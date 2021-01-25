import React, { useState, useEffect } from "react";
import "./annoucmentspage.scss";
import { useParams } from "react-router-dom";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";

// const data = {
//   id: 613,
//   title: "Rozpoczęcie roku",
//   date: "01-10-2020",
//   text:
//     'No hejka, co tam się z Tobą dzieje? Skąd to zwątpienie? Dlaczego chcesz teraz się poddać, tylko dlatego, że raz czy drugi Ci nie wyszło? To nie jest żaden powód. Musisz iść i walczyć. Osiągniesz cel. Prędzej czy później go osiągniesz, ale musisz iść do przodu, przeć, walczyć o swoje. Nie ważne, że wszystko dookoła jest przeciwko Tobie. Najważniejsze jest to, że masz tutaj wole zwycięstwa. To się liczy. Każdy może osiągnąć cel, nie ważne czy taki czy taki, ale trzeba iść i walczyć. To teraz masz trzy sekundy żeby się otrąsnąć, powiedzieć sobie "dobra basta", pięścią w stół, idę to przodu i osiągam swój cel. Pozdro.',
//   added_by: "Jan Janowski",
// };

export default function AnnoucmentPage() {
  const { id } = useParams();
  const [data, setData] = useState(null);

  useEffect(() => {
    const config = {
      headers: header(),
    };
    axios
      .post(API_URL + "messageDetails", { id: id }, config)
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
