import React, { useState, useEffect } from "react";
import "./pollspage.scss";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";
import { useParams } from "react-router-dom";

function Question({ question, answers, addAnswer }) {
  const [chosenAnswer, setChosenAnswer] = useState(null);

  useEffect(() => {
    if (answers[question.id]) {
      setChosenAnswer(answers[question.id]);
    } else {
      setChosenAnswer(null);
    }
  }, [question]);

  const handleChange = (e) => {
    setChosenAnswer(e.target.value);
    addAnswer(question.id, e.target.value);
  };

  return (
    <div className="question">
      <h2>{`${question.id}. ${question.name}`}</h2>
      <div className="question-answers">
        {question.pollanswers.map((answer) => {
          return (
            <label key={answer.name}>
              <input
                type="radio"
                name={answer.name}
                value={answer.id}
                checked={chosenAnswer === "" + answer.id}
                onChange={handleChange}
              />
              {answer.name}
            </label>
          );
        })}
      </div>
    </div>
  );
}

export default function PollPage() {
  const [answers, setAnswers] = useState(null);
  const [currentQuestion, setCurrentQuestion] = useState(null);
  const [data, setData] = useState(null);

  const { id } = useParams();

  const config = {
    headers: header(),
  };
  useEffect(() => {
    axios
      .post(API_URL + "student/pollShow", { poll_id: id }, config)
      .then((response) => {
        setData(response.data);
        if (response.data.status.status === 1) {
          window.location = "/student/ankiety";
        }
      })
      .catch(() => {
        window.location = "/student/ankiety";
      });
  }, []);

  const addAnswer = (key, value) => {
    setAnswers({ ...answers, [key]: value });
  };

  const submitValues = () => {
    if (
      Object.keys(answers).length === data.question_and_answers.length &&
      window.confirm("Czy chcesz wysłać wyniki?")
    ) {
      const dataToSend = Object.keys(answers).map((key) => ({
        poll_id: id,
        question_id: key,
        answer_id: answers[key],
      }));
      axios.post(API_URL + "student/pollStore", dataToSend, config).then(() => {
        alert("Pomyślnie wysłałeś ankietę");
        window.location = "/student/ankiety";
      });
    }
  };

  let percents;
  if (answers && data) {
    percents = parseInt(
      (Object.keys(answers).length / data.question_and_answers.length) * 100
    );
  } else {
    percents = 0;
  }

  if (!data) {
    return <div className="loading"></div>;
  } else {
    return (
      <div className="pollspage">
        <h1>Ankiety</h1>
        <div className="pollspage-container">
          <div className="pollspage-poll">
            <div className="pollspage-progress">
              <div
                className="pollspage-progress__bar"
                style={{ width: `${percents}%` }}
              ></div>
              <p>{percents}%</p>
            </div>
            <div className="pollspage-poll__container">
              {answers ? (
                <>
                  <Question
                    question={data.question_and_answers[currentQuestion]}
                    addAnswer={addAnswer}
                    answers={answers}
                  />
                  <div className="buttons">
                    {/* Back button */}
                    {currentQuestion === 0 ? (
                      <button className="button primary" disabled>
                        Poprzednie
                      </button>
                    ) : (
                      <button
                        className="button primary"
                        onClick={() => {
                          setCurrentQuestion(currentQuestion - 1);
                        }}
                      >
                        Poprzednie
                      </button>
                    )}
                    {/* Next button */}
                    {currentQuestion ===
                    data.question_and_answers.length - 1 ? (
                      <button className="button primary" onClick={submitValues}>
                        Prześlij
                      </button>
                    ) : (
                      <button
                        className="button primary"
                        onClick={() => {
                          setCurrentQuestion(currentQuestion + 1);
                        }}
                      >
                        Następne
                      </button>
                    )}
                  </div>
                </>
              ) : (
                <>
                  <h2>Aby rozpocząć ankietę naciśnij przycisk</h2>
                  <button
                    className="button primary"
                    onClick={() => {
                      setAnswers({});
                      setCurrentQuestion(0);
                    }}
                  >
                    Rozpocznij
                  </button>
                </>
              )}
            </div>
          </div>
        </div>
      </div>
    );
  }
}
