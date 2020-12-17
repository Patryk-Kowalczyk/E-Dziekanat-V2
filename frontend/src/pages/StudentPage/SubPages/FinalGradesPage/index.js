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
];

export default function index() {
  return <div className="finalgrades">Ocenki</div>;
}
