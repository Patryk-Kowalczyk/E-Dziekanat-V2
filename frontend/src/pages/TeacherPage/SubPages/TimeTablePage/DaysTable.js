import React from "react";
import DayTable from "./DayTable";
import Calendar from "react-calendar";
import "react-calendar/dist/Calendar.css";
import {motion} from "framer-motion";

const data = [
    {
        from: "8:15",
        to: "10:00",
        name: "Matematyka Stosowana",
        teacher: "Grażyna Żarko",
        group: "221A",
        room: "202",
        form: "W",
    },
    {
        from: "12:15",
        to: "14:00",
        name: "Matematyka Stosowana 2",
        teacher: "Grażyna Żarko",
        group: "332",
        room: "204",
        form: "L",
    },
    {
        from: "14:15",
        to: "16:00",
        name: "Matematyka Stosowana",
        teacher: "Grażyna Żarko",
        group: "222",
        room: "204",
        form: "L",
    },
];

export default function DaysTable() {
    const [isCalendar, setIsCalendar] = React.useState(false);
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
                    initial={{opacity: 0, y: 300}}
                    animate={{opacity: 1, y: 0}}
                >
                    <Calendar/>
                </motion.div>
            )}
            <br/>
            <table>
                <thead>
                <tr>
                    <th>Od</th>
                    <th>Do</th>
                    <th>Nazwa</th>
                    <th>Grupa</th>
                    <th>Sala</th>
                    <th>Forma</th>
                </tr>
                </thead>
                <tbody>
                {data.map((item) => {
                    return <DayTable data={item}/>;
                })}
                </tbody>
            </table>
        </div>
    );
}
