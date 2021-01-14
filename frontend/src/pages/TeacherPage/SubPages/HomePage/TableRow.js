import React from "react";

export default function TableRow({row}) {
    return (
        <tr>
            <td>{row.name}</td>
            <td>{row.since}</td>
            <td>{row.to}</td>
            <td>{row.room}</td>
            <td>{row.form}</td>
        </tr>
    );
}
