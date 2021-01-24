import React, {Suspense, useState, lazy} from "react";
import "./teacherpage.scss";
import LeftMenu from "./LeftMenu";

import TeacherMenu from './TeacherMenu';
import {useDispatch} from "react-redux";
import {login} from "../../actions/auth";
import {Route, Switch} from "react-router-dom";
import axios from "axios";
import API_URL from "../../services/API_URL";
import {setInfo} from "../../actions/info";
import header from "../../services/auth-header";
import data from './endpoints/dashboard.json';

const HomePage = lazy(() => import("./SubPages/HomePage"));
const TimeTablePage = lazy(() => import("./SubPages/TimeTablePage"));
const IndividualMarks = lazy(() => import("./SubPages/IndividualMarks"));
const FinalMarks = lazy(() => import("./SubPages/FinalMarks"));
const AnnoucmentsPage = lazy(() => import("./SubPages/AnnoucmentsPage"));
const AnnoucmentPage = lazy(() =>
    import("./SubPages/AnnoucmentsPage/AnnoucmentPage")
);

function App() {
    const dispatch = useDispatch();
    dispatch(login(data.teacher_data));
    dispatch(
        setInfo({
            day_plan: data.day_plan,
            meetings: data.meetings
        }))

    const [isMenuOpen, setIsMenuOpen] = useState(false);

    return (
        <div className="user-page">
            <LeftMenu open={isMenuOpen} setopen={setIsMenuOpen}/>
            <div className="content">
                <Suspense fallback={<div className="loading"></div>}>
                    <Switch>
                        <Route path="/teacher" component={HomePage} exact/>
                        <Route path="/teacher/plan-zajec/" component={TimeTablePage}/>
                        <Route path="/teacher/oceny-czastkowe/" component={IndividualMarks}/>
                        <Route path="/teacher/oceny/" component={FinalMarks}/>
                        <Route
                            path="/teacher/wiadomosci"
                            exact
                            component={AnnoucmentsPage}
                        />
                        <Route path="/teacher/wiadomosci/:id" component={AnnoucmentPage} />

                    </Switch>
                </Suspense>
            </div>
            <TeacherMenu open={isMenuOpen} setopen={setIsMenuOpen}/>
        </div>
    );
}

export default function index() {
    return <App/>;
}
