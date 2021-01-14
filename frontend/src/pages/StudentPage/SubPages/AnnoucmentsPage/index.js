import React from "react";
import "./annoucmentspage.scss";
import { MdUnfoldMore } from "react-icons/md";
import { Link } from "react-router-dom";

const data = [
  {
    id: 423,
    title: "Ankiety",
    date: "21-10-2020",
    text: "No byczki klikajcie w ankiety",
  },
  {
    id: 613,
    title: "Rozpoczęcie roku",
    date: "01-10-2020",
    text:
      "No hejka, co tam się z Tobą dzieje? Skąd to zwątpienie? Dlaczego chcesz teraz się poddać, tylko dlatego, że raz czy drugi Ci nie wyszło? To nie jest żaden powód. Musisz iść i walczyć. Osiągniesz cel. Prędzej czy później go osiągniesz,",
  },
];

const Annoucment = ({ data }) => {
  return (
    <div className="annoucmentspage-item">
      <h2>{data.title}</h2>
      <p className="date">{data.date}</p>
      <p className="text">{data.text}</p>
      <Link to={`/student/wiadomosci/${data.id}`}>
        <button className="button primary">
          <MdUnfoldMore />
          <p>Więcej</p>
        </button>
      </Link>
    </div>
  );
};

export default function index() {
  return (
    <div className="annoucmentspage">
      <h1>Wiadomości</h1>
      <div className="annoucmentspage-annoucments">
        {data.map((annoucment) => {
          return <Annoucment data={annoucment} />;
        })}
      </div>
    </div>
  );
}
