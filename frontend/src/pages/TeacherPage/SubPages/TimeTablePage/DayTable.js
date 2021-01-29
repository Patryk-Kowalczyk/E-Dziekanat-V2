import React from "react";

export default function DayTable({ data }) {
  console.log(data);
  return (
    <tr className="subject">
      <td>{data.since}</td>
      <td>{data.to}</td>
      <td>{data.name}</td>
      <td>{data.room}</td>
      <td>{data.form}</td>
    </tr>
  );
}
