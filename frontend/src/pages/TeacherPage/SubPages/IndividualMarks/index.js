import React from 'react';
import "./individualmarks.scss";
import ClassChoice from "./ClassChoice";
import {useDispatch} from "react-redux";
import {login} from "../../../../actions/auth";
import data from "../../endpoints/dashboard.json";
import {setClasses} from "../../../../actions/classes";


function index() {

    return (
        <div className="timetable">
            <ClassChoice/>
        </div>
    );
}

export default index;
