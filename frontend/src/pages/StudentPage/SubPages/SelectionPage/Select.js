import React, { useState, useEffect } from "react";
import "./selectionpage.scss";
import { GiConfirmed } from "react-icons/gi";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";

export default function Select({ answers, resetAnswers }) {
  const [chosen, setChosen] = useState(null);

  useEffect(() => {
    setChosen(answers.chosenValue);
  }, [answers.chosenValue]);

  function sendChose(choice_id, option_id) {
    const config = {
      headers: header(),
    };
    if (window.confirm("Potwierdzasz swój wybór?")) {
      axios
        .post(
          API_URL + "student/choiceStore",
          [{ choice_id: choice_id, option_id: option_id }],
          config
        )
        .then((res) => {
          window.alert("Pomyślnie wybrano opcję");
          setChosen(null);
          resetAnswers();
        });
    }
  }

  return (
    <>
      <b>Dostępne wybory:</b>
      {answers.answers.map((answer) => {
        let chosenClass = "";
        if (chosen === answer.option_id) {
          chosenClass = "chosen";
        }
        return (
          <div
            className={`selectionpage-answer ${chosenClass}`}
            key={answer.option_id}
            onClick={() => {
              setChosen(answer.option_id);
            }}
          >
            {answer.option}
          </div>
        );
      })}
      <br />
      <button
        className="button"
        onClick={() => {
          if (chosen) {
            sendChose(answers.id_question, chosen);
          }
        }}
      >
        <GiConfirmed />
        Zatwierdź wybór
      </button>
    </>
  );
}
