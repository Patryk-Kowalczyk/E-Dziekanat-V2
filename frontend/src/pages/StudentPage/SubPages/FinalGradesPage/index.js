import React from "react";
import "./finalgrades.scss";

//Nazwa przedmiotu	Typ 	Wystawił	Liczba godzin	I termin	I poprawka	II poprawka	Komis	Awans	Pkt. ECTS

const data = [
  {
    name: "Aplikacje internetowe 1",
    teacher: "Andrzej Jakiś",
    forms: [
      {
        type: "Laboratorium",
        teacher: "Andzej Jakiś",
        hours: 30,
        firstTerm: null,
        firstRepeat: null,
        secondRepeat: null,
        committee: null,
        awans: null,
      },
      {
        type: "Wykład",
        teacher: "Andzej Jakiś",
        hours: 30,
        firstTerm: null,
        firstRepeat: null,
        secondRepeat: null,
        committee: null,
        awans: null,
      },
    ],
    ects: 3,
    finalGrade: null,
  },
  {
    name: "Zarządzanie informacją 2",
    teacher: "Andrzej Jakiś",
    forms: [
      {
        type: "Laboratorium",
        teacher: "Andzej Jakiś",
        hours: 30,
        firstTerm: null,
        firstRepeat: 4.5,
        secondRepeat: null,
        committee: null,
        awans: null,
      },
      {
        type: "Wykład",
        teacher: "Andzej Jakiś",
        hours: 30,
        firstTerm: 4,
        firstRepeat: null,
        secondRepeat: null,
        committee: null,
        awans: null,
      },
    ],
    ects: 5,
    finalGrade: 4,
  },
];

function TimeTablePage(props) {
  const [infoToShow, setInfoToShow] = React.useState(null);

  const whichInfoShow = () => {
    if (infoToShow) {
      return data.filter((subject) => subject.name === infoToShow)[0];
    } else {
      return null;
    }
  };

  const info = whichInfoShow();

  return (
    <div className="finalgrades">
      <h1>Oceny końcowe</h1>
      <div className="finalgrades-container">
        <div className="finalgrades-subjects">
          {data.map((subject) => {
            return (
              <div
                className="finalgrades-subjects__item"
                key={subject.name}
                onClick={() => setInfoToShow(subject.name)}
              >
                <p>{subject.name}</p>
              </div>
            );
          })}
        </div>
        <div className="finalgrades-details">
          {info ? (
            <>
              <h3>{info.name}</h3>
              <p>
                Ocena:{" "}
                <span className="grade">{info.finalGrade || "Brak"}</span>
              </p>
              <p>Ects: {info.ects}</p>
              <br />
              <h5 className="linebottom">Formy:</h5>
              {info.forms.map((form) => (
                <div className="finalgrades-details__form">
                  <p>
                    Forma: <strong>{form.type}</strong>
                  </p>
                  <p>
                    Prowadzący: <strong>{form.teacher}</strong>
                  </p>
                  <p>
                    Ilość godzin: <strong>{form.hours}</strong>
                  </p>
                  <p>
                    Pierwszy termin: <strong>{form.firstTerm}</strong>
                  </p>
                  <p>
                    Pierwsza poprawa: <strong>{form.firstRepeat}</strong>
                  </p>
                  <p>
                    Druga poprawa: <strong>{form.secondRepeat}</strong>
                  </p>
                  <p>
                    Komisja: <strong>{form.committee}</strong>
                  </p>
                  <p>
                    Awans: <strong>{form.awans}</strong>
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
