import React, { useState, useEffect } from "react";
import DayTable from "./DayTable";
import Calendar from "react-calendar";
import "react-calendar/dist/Calendar.css";
import { motion } from "framer-motion";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";
import parseDateFormat from "./parseDateFormat";

// const data = [
//   {
//     from: "8:15",
//     to: "10:00",
//     name: "Podstawy ochrony informacji",
//     teacher: "Andrzej Jakiś",
//     room: "202",
//     form: "L",
//   },
//   {
//     from: "12:15",
//     to: "14:00",
//     name: "Podstawy ochrony informacji",
//     teacher: "Andrzej Jakiś",
//     room: "204",
//     form: "W",
//   },
//   {
//     from: "14:15",
//     to: "16:00",
//     name: "ZI",
//     teacher: "Andrzej Jakiś",
//     room: "204",
//     form: "W",
//   },
// ];

const getDate = (date, changeState) => {
  const config = {
    headers: header(),
  };
  axios
    .post(API_URL + "student/planDay", { dateOfDay: date }, config)
    .then((response) => {
      changeState(response.data.plan_day);
    });
};

export default function DaysTable() {
  const [isCalendar, setIsCalendar] = React.useState(false);
  const [data, setData] = useState(null);
  const [date, setDate] = useState(new Date());

  useEffect(() => {
    const dateText = parseDateFormat(date);
    getDate(dateText, setData);
  }, [date]);
  return (
    <div className="daystable">
      <button
        className="button primary"
        onClick={() => setIsCalendar(!isCalendar)}
      >
        Wybierz datę
      </button>
      {isCalendar && (
        <motion.div
          className="calendar"
          initial={{ opacity: 0, y: 300 }}
          animate={{ opacity: 1, y: 0 }}
        >
          <Calendar
            value={date}
            onChange={(value) => {
              setDate(value);
              setIsCalendar(false);
            }}
          />
        </motion.div>
      )}
      <br />
      <div className="table-container">
        <table>
          <thead>
            <tr>
              <th>Od</th>
              <th>Do</th>
              <th>Nazwa</th>
              <th>Prowadzący</th>
              <th>Sala</th>
              <th>Forma</th>
            </tr>
          </thead>
          <tbody>
            {data && data.length > 0 ? (
              data.map((item, index) => {
                return <DayTable data={item} key={index} />;
              })
            ) : (
              <tr>
                <td colSpan={6}>Brak zajęć w podanym dniu</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}
