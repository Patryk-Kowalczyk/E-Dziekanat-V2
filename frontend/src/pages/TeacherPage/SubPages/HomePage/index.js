import React from "react";
import "./homepage.scss";
import Hello from "./Hello";

import {useSelector} from "react-redux";
import TodaysTimeTable from './TodaysTimeTable'
import Meetings from "./Meetings";

function HomePage() {
    const user = useSelector((state) => state.auth.user);
    console.log(user)
    return (
        <div className="teacher-home-content">
            <Hello user={user}/>
            <TodaysTimeTable/>
            <Meetings/>
        </div>
    );
}

export default function index() {
    return <HomePage/>;
}
