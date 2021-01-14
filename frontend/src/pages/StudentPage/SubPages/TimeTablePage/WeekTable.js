import React from "react";

const HOURS = ["8:15", "10:15", "12:15", "14:15", "16:15", "18:15"];
const END_HOURS = ["10:00", "12:00", "14:00", "16:00", "18:00", "20:00"];

const data = {
  poniedzialek: [
    {
      from: "8:15",
      to: "10:00",
      name: "Podstawy ochrony informacji",
      teacher: "Andrzej Jakiś",
      room: "202",
      form: "L",
    },
    {
      from: "12:15",
      to: "14:00",
      name: "Podstawy ochrony informacji",
      teacher: "Andrzej Jakiś",
      room: "204",
      form: "W",
    },
    {
      from: "14:15",
      to: "16:00",
      name: "ZI",
      teacher: "Andrzej Jakiś",
      room: "204",
      form: "W",
    },
  ],
  wtorek: [
    {
      from: "8:15",
      to: "10:00",
      name: "Podstawy ochrony informacji",
      teacher: "Andrzej Jakiś",
      room: "202",
      form: "L",
    },
    {
      from: "10:15",
      to: "12:00",
      name: "Podstawy ochrony informacji",
      teacher: "Andrzej Jakiś",
      room: "204",
      form: "W",
    },
  ],
  sroda: [],
  czwartek: [],
  piatek: [],
};

function DayRows({ daydata }) {
  return (
    <>
      {HOURS.map((hour, index) => {
        const row = daydata.filter((item) => {
          if (hour === item.from) {
            return item;
          }
        });
        if (row.length > 0) {
          const data = row[0];

          let form;
          if (data.form === "W") {
            form = "lecture";
          } else if (data.form === "L") {
            form = "laboratory";
          } else if (data.form === "Lek") {
            form = "langcourse";
          }

          return (
            <div className={`weektable-item color-${form}`} key={index}>
              {data.name}
            </div>
          );
        } else {
          return <div className="weektable-item" key={index}></div>;
        }
      })}
    </>
  );
}

export default function WeekTable() {
  return (
    <div className="weektable">
      <div className="weektable-paginate">
        <div className="paginate-button">{"<"}</div>
        <h3>14-12-2020 - 20-12-2020</h3>
        <div className="paginate-button">{">"}</div>
      </div>
      <div className="table-container">
        <div className="weektable-days">
          <div className="weektable-hours">
            <h5>Godziny</h5>
            {HOURS.map((hour, index) => (
              <div className="weektable-hour" key={index}>
                {hour} - {END_HOURS[index]}
              </div>
            ))}
          </div>
          <div className="weektable-day">
            <h5>Poniedziałek</h5>
            <DayRows daydata={data.poniedzialek} />
          </div>
          <div className="weektable-day">
            <h5>Wtorek</h5>
            <DayRows daydata={data.wtorek} />
          </div>
          <div className="weektable-day">
            <h5>Środa</h5>
            <DayRows daydata={data.sroda} />
          </div>
          <div className="weektable-day">
            <h5>Czwartek</h5>
            <DayRows daydata={data.czwartek} />
          </div>
          <div className="weektable-day">
            <h5>Piątek</h5>
            <DayRows daydata={data.piatek} />
          </div>
        </div>
      </div>
      <div className="weektable-legend">
        <h4>Legenda: </h4>
        <div className="color-lecture">Wykład</div>
        <div className="color-laboratory">Laboratorium</div>
        <div className="color-langcourse">Lektorskie</div>
      </div>
    </div>
  );
}
