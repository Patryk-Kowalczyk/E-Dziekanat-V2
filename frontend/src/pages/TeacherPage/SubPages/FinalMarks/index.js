import React from 'react';
import {useDispatch} from "react-redux";
import {login} from "../../../../actions/auth";
import data from "../../endpoints/dashboard.json";
import {setClasses} from "../../../../actions/classes";
import './finalMarks.scss'
import ClassChoice from "./ClassChoice";

function index() {

    return (
        <div className="timetable">
            <ClassChoice/>
        </div>
    );
}

export default index;
