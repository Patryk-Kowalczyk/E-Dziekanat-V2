import React from "react";

export default function DayTable({data}) {
    return (
        <tr className="subject">
            <td>{data.from}</td>
            <td>{data.to}</td>
            <td>{data.name}</td>
            <td>{data.group}</td>
            <td>{data.room}</td>
            <td>{data.form}</td>
        </tr>
    );
}
