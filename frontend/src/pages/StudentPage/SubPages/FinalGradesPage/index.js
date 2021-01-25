import React, { useState, useEffect } from "react";
import "./finalgrades.scss";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";

//Nazwa przedmiotu	Typ 	Wystawił	Liczba godzin	I termin	I poprawka	II poprawka	Komis	Awans	Pkt. ECTS

// const data = [
//   {
//     name: "Aplikacje internetowe 1",
//     teacher: "Andrzej Jakiś",
//     forms: [
//       {
//         type: "Laboratorium",
//         teacher: "Andzej Jakiś",
//         hours: 30,
//         firstTerm: null,
//         firstRepeat: null,
//         secondRepeat: null,
//         committee: null,
//         awans: null,
//       },
//       {
//         type: "Wykład",
//         teacher: "Andzej Jakiś",
//         hours: 30,
//         firstTerm: null,
//         firstRepeat: null,
//         secondRepeat: null,
//         committee: null,
//         awans: null,
//       },
//     ],
//     ects: 3,
//     finalGrade: null,
//   },
//   {
//     name: "Zarządzanie informacją 2",
//     teacher: "Andrzej Jakiś",
//     forms: [
//       {
//         type: "Laboratorium",
//         teacher: "Andzej Jakiś",
//         hours: 30,
//         firstTerm: null,
//         firstRepeat: 4.5,
//         secondRepeat: null,
//         committee: null,
//         awans: null,
//       },
//       {
//         type: "Wykład",
//         teacher: "Andzej Jakiś",
//         hours: 30,
//         firstTerm: 4,
//         firstRepeat: null,
//         secondRepeat: null,
//         committee: null,
//         awans: null,
//       },
//     ],
//     ects: 5,
//     finalGrade: 4,
//   },
// ];

var groupBy = function (xs, key) {
  return xs.reduce(function (rv, x) {
    (rv[x[key]] = rv[x[key]] || []).push(x);
    return rv;
  }, []);
};

function TimeTablePage(props) {
  const [data, setData] = useState(null);
  const [infoToShow, setInfoToShow] = useState(null);

  const whichInfoShow = () => {
    if (infoToShow) {
      return data[infoToShow];
    } else {
      return null;
    }
  };

  const info = whichInfoShow();

  const config = {
    headers: header(),
  };
  useEffect(() => {
    axios.get(API_URL + "student/finalGrade", config).then((response) => {
      const res = response.data.final_grade;
      setData(groupBy(res, "name"));
    });
  }, []);
  return (
    <div className="finalgrades">
      <h1>Oceny końcowe</h1>
      <div className="finalgrades-container">
        <div className="finalgrades-subjects">
          {data ? (
            Object.keys(data).map((subject) => {
              return (
                <div
                  className="finalgrades-subjects__item"
                  key={subject}
                  onClick={() => setInfoToShow(subject)}
                >
                  <p>{subject}</p>
                </div>
              );
            })
          ) : (
            <div className="loading"></div>
          )}
        </div>
        <div className="finalgrades-details">
          {info ? (
            <>
              <h3>{info[0].name}</h3>
              <h5 className="linebottom">Formy:</h5>
              {info.map((form, index) => (
                <div className="finalgrades-details__form" key={index}>
                  <p>
                    Forma: <strong>{form.form}</strong>
                  </p>
                  <p>
                    ECTS: <strong>{form.ECTS}</strong>
                  </p>
                  <p>
                    Prowadzący: <strong>{form.educator}</strong>
                  </p>
                  <p>
                    Ilość godzin: <strong>{form.hours}</strong>
                  </p>
                  <p>
                    Pierwszy termin: <strong>{form.first_term}</strong>
                  </p>
                  <p>
                    Pierwsza poprawa: <strong>{form.first_repeat}</strong>
                  </p>
                  <p>
                    Druga poprawa: <strong>{form.second_repeat}</strong>
                  </p>
                  <p>
                    Komisja: <strong>{form.committee}</strong>
                  </p>
                  <p>
                    Awans: <strong>{form.promotion}</strong>
                  </p>
                </div>
              ))}
            </>
          ) : (
            <h2>Wybierz przedmiot z listy po prawej stronie</h2>
          )}
        </div>
      </div>
    </div>
  );
}

export default function index(props) {
  return <TimeTablePage {...props} />;
}
