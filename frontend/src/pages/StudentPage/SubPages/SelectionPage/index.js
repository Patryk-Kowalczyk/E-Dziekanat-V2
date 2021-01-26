import React, { useState, useEffect } from "react";
import "./selectionpage.scss";
import Select from "./Select";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";

function SelectRow({ name, answers, handleClick, index, activeIndex }) {
  let activeClass = "";
  if (activeIndex === index) {
    activeClass = "active";
  }
  return (
    <li
      className={`${activeClass}`}
      onClick={() => {
        handleClick(answers, index);
      }}
    >
      {name}
    </li>
  );
}

function SelectionPage() {
  const [data, setData] = useState(null);
  const [answers, setAnswers] = useState(null);
  const [activeIndex, setActiveIndex] = useState(null);

  function handleClick(answers, index) {
    setActiveIndex(index);
    setAnswers(answers);
  }

  const config = {
    headers: header(),
  };
  useEffect(() => {
    axios.get(API_URL + "student/choiceSubject", config).then((response) => {
      setData(response.data.subject_choose);
    });
  }, []);

  function resetAnswers() {
    setAnswers(null);
  }
  return (
    <div className="selectionpage">
      <h1>Wybór bloków/ specjalizacji</h1>
      <div className="selectionpage-container">
        <div className="selectionpage-list">
          <ul>
            {data ? (
              data.map((obj, index) => (
                <SelectRow
                  key={index}
                  name={obj.name_question}
                  answers={{
                    answers: obj.answers,
                    id_question: obj.id_question,
                    chosenValue: obj.chosen,
                  }}
                  handleClick={handleClick}
                  index={index}
                  activeIndex={activeIndex}
                />
              ))
            ) : (
              <div className="loading"></div>
            )}
          </ul>
        </div>
        <div className="selectionpage-answers">
          {answers ? (
            <Select answers={answers} resetAnswers={resetAnswers} />
          ) : (
            <h3>Wybierz z listy</h3>
          )}
        </div>
      </div>
    </div>
  );
}

export default function index(props) {
  return <SelectionPage {...props} />;
}
