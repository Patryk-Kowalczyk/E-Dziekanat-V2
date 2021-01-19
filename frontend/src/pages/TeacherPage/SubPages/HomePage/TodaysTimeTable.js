import React from "react";
import TableRow from "./TableRow";
import {useSelector} from "react-redux";

const sampleTable = [
    {
        name: "Matematyka Stosowana",
        since: "08:15",
        to: "10:00",
        room: "WI WI1-Zaj_zdalne",
        form: "W",
    },
    {
        name: "Matematyka Stosowana 2",
        since: "10:15",
        to: "12:00",
        room: "WI WI1-Zaj_zdalne",
        form: "L",
    },
    {
        name: "Matematyka Stosowana",
        since: "12:15",
        to: "14:00",
        room: "WI WI1-Zaj_zdalne",
        form: "L",
    },
];

export default function TodaysTimeTable() {
    const info = useSelector((state) => state.info.day_plan) || [];
    return (
        <div className="teacherhome__timetable">
            <h3>Plan zajęć na dziś:</h3>
            <table>
                <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Od</th>
                    <th>Do</th>
                    <th>Grupa</th>
                    <th>Sala</th>
                    <th>Forma</th>

                </tr>
                </thead>
                <tbody>
                {info.map((row, index) => {
                    return <TableRow key={index} row={row}/>;
                })}
                </tbody>
            </table>
        </div>
    );
}
