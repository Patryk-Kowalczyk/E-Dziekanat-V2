import React from "react";

export default function Hello({ studentname }) {
  const date = new Date().toLocaleDateString("pl-PL");
  return (
    <div className="studenthome__hello">
      <h2>Witaj {studentname},</h2>
      <p>Dzisiaj jest {date}</p>
    </div>
  );
}
