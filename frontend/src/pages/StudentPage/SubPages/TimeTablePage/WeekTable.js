import React, { useState, useEffect } from "react";
import parseDateFormat from "./parseDateFormat";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";

const HOURS = ["08:00", "10:00", "12:00", "14:00", "16:00", "18:00"];
const END_HOURS = ["10:00", "12:00", "14:00", "16:00", "18:00", "20:00"];
const DAYS = [
  "Poniedziałek",
  "Wtorek",
  "Środa",
  "Czwartek",
  "Piątek",
  "Sobota",
  "Niedziela",
];

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

const getMonday = (d) => {
  d = new Date(d);
  var day = d.getDay(),
    diff = d.getDate() - day + (day === 0 ? -6 : 1);
  return new Date(d.setDate(diff));
};

const getSunday = (d) => {
  d = new Date(d);
  d.setDate(d.getDate() + 6);
  return d;
};

const changeWeek = (d, sign) => {
  d = new Date(d);
  d.setDate(d.getDate() + sign * 7);
  return d;
};

function DayRows({ daydata }) {
  return (
    <>
      {HOURS.map((hour, index) => {
        const row = daydata.filter((item) => {
          if (hour === item.since.slice(0, 5)) {
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
  const [monday, setMonday] = useState(getMonday(new Date()));
  const [sunday, setSunday] = useState(getSunday(monday));
  const [data, setData] = useState(null);
  useEffect(() => {
    const config = {
      headers: header(),
    };
    axios
      .post(
        API_URL + "student/planWeek",
        {
          dateStart: parseDateFormat(monday),
          dateEnd: parseDateFormat(sunday),
        },
        config
      )
      .then((response) => {
        const resp_data = response.data.plan_week;
        setData(resp_data);
      });
  }, [sunday]);

  return (
    <div className="weektable">
      <div className="weektable-paginate">
        <div
          className="paginate-button"
          onClick={() => {
            setMonday(changeWeek(monday, -1)); //One week before
            setSunday(changeWeek(sunday, -1));
          }}
        >
          {"<"}
        </div>
        <h3>
          {parseDateFormat(monday)} - {parseDateFormat(sunday)}
        </h3>
        <div
          className="paginate-button"
          onClick={() => {
            setMonday(changeWeek(monday, 1)); //One week after
            setSunday(changeWeek(sunday, 1));
          }}
        >
          {">"}
        </div>
      </div>
      {data ? (
        <>
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
              {DAYS.map((day, index) => {
                return (
                  <div className="weektable-day" key={index}>
                    <h5>{day}</h5>
                    <DayRows daydata={data[Object.keys(data)[index]]} />
                  </div>
                );
              })}
            </div>
          </div>
          <div className="weektable-legend">
            <h4>Legenda: </h4>
            <div className="color-lecture">Wykład</div>
            <div className="color-laboratory">Laboratorium</div>
            <div className="color-langcourse">Lektorskie</div>
          </div>
        </>
      ) : (
        <h3>Brak zajęć w podanym tygodniu</h3>
      )}
    </div>
  );
}
