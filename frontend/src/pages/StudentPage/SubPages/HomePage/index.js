import React, { useState, useEffect } from "react";
import "./homepage.scss";
import Hello from "./Hello";
import TodaysTimeTable from "./TodaysTimeTable";
import LastGrades from "./LastGrades";
import Charts from "./Charts";
import { useSelector } from "react-redux";

function HomePage() {
  const user = useSelector((state) => state.auth.user);
  return (
    <div className="student-home-content">
      <Hello studentname={user.first_name} />
      <TodaysTimeTable />
      <LastGrades />
      <Charts />
    </div>
  );
}

export default function index() {
  return <HomePage />;
}
