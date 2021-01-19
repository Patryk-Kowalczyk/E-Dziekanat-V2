import React from "react";
import TableRow from "./TableRow";
import {useSelector} from "react-redux";

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
