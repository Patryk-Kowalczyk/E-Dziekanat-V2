import React, { useState } from "react";
import "./partialgradespage.scss";
import GradesTable from "./GradesTable";

const data = [
  {
    subject: "Zarządzanie informacją 2",
    type: "W",
    grades: [
      {
        category: "Zaliczenie praktyka",
        grade: 4,
        date: "10-02-2021",
        comments: "10/13 punktów",
      },
      {
        category: "Zaliczenie teoria",
        grade: 5,
        date: "11-02-2021",
        comments: "19/20 punktów",
      },
    ],
  },
  {
    subject: "Zarządzanie informacją 2",
    type: "L",
  },
  {
    subject: "Podstawy ochrony informacji",
    type: "W",
  },
  {
    subject: "Podstawy ochrony informacji",
    type: "L",
  },
];

const TYPES = {
  L: "laboratory",
  W: "lecture",
  A: "langcourse",
};

function SubjectRow({
  subject,
  type,
  grades,
  handleClick,
  index,
  activeIndex,
}) {
  let activeClass = "";
  if (activeIndex === index) {
    activeClass = "active";
  }

  return (
    <li
      className={`color-${TYPES[type]} ${activeClass}`}
      onClick={() => {
        handleClick(grades, index);
      }}
    >
      {subject}
    </li>
  );
}

function PartialGradesPage() {
  const [grades, setGrades] = useState([]);
  const [activeIndex, setActiveIndex] = useState(null);

  const handleClick = (newGrades, index) => {
    setGrades(newGrades);
    setActiveIndex(index);
  };

  return (
    <div className="partialgrades">
      <h1>Oceny cząstkowe</h1>
      <div className="partialgrades-container">
        <div className="partialgrades-list">
          <ul>
            {data.map((obj, index) => (
              <SubjectRow
                key={index}
                subject={obj.subject}
                type={obj.type}
                grades={obj.grades}
                handleClick={handleClick}
                index={index}
                activeIndex={activeIndex}
              />
            ))}
          </ul>
        </div>
        <div className="partialgrades-table">
          <GradesTable grades={grades} />
        </div>
      </div>
    </div>
  );
}

function index(props) {
  return <PartialGradesPage {...props} />;
}

export default index;
