import React, { useState, useEffect } from "react";
import "./partialgradespage.scss";
import GradesTable from "./GradesTable";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";

// const data = [
//   {
//     subject: "Zarządzanie informacją 2",
//     type: "W",
//     grades: [
//       {
//         category: "Zaliczenie praktyka",
//         grade: 4,
//         date: "10-02-2021",
//         comments: "10/13 punktów",
//       },
//       {
//         category: "Zaliczenie teoria",
//         grade: 5,
//         date: "11-02-2021",
//         comments: "19/20 punktów",
//       },
//     ],
//   },
//   {
//     subject: "Zarządzanie informacją 2",
//     type: "L",
//   },
//   {
//     subject: "Podstawy ochrony informacji",
//     type: "W",
//   },
//   {
//     subject: "Podstawy ochrony informacji",
//     type: "L",
//   },
// ];

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
  const [data, setData] = useState(null);
  const [grades, setGrades] = useState(null);
  const [activeIndex, setActiveIndex] = useState(null);

  const handleClick = (newGrades, index) => {
    setGrades(newGrades);
    setActiveIndex(index);
  };

  const config = {
    headers: header(),
  };
  useEffect(() => {
    axios.get(API_URL + "student/partialGrades", config).then((response) => {
      setData(response.data.partial_grades);
    });
  }, []);

  return (
    <div className="partialgrades">
      <h1>Oceny cząstkowe</h1>
      <div className="partialgrades-container">
        <div className="partialgrades-list">
          <ul>
            {data ? (
              data.map((obj, index) => (
                <SubjectRow
                  key={index}
                  subject={obj.name}
                  type={obj.form}
                  grades={obj.grades}
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
